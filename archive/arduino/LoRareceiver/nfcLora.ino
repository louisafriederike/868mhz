#include <LoRa.h>
#include <Wire.h>
#include "boards.h"
#include <PN532_I2C.h>
#include <PN532.h>
#include <NfcAdapter.h>

PN532_I2C pn532_i2c(Wire);
NfcAdapter nfc = NfcAdapter(pn532_i2c);
String tagId = "None";
String cleanString = "";


void setup()
{
  Serial.begin(9600);
  Serial.println("System initialized");
  nfc.begin();

  initLoRa();
}

void loop()
{
  readNFC();
  if (!cleanString.isEmpty()) {
    sendLoRaData(cleanString);
  }
}

void initLoRa()
{
  Serial.println("Initializing LoRa...");
  LoRa.setPins(RADIO_CS_PIN, RADIO_RST_PIN, RADIO_DI0_PIN);
  if (!LoRa.begin(LoRa_frequency))
  {
    Serial.println("Starting LoRa failed!");
    while (1);
  }
  Serial.println("LoRa initialized successfully!");
}

void sendLoRaData(String data)
{
  String message = "node3 " + data; // Concatenate "node3 " with the value of cleanString

  LoRa.beginPacket();
  LoRa.print(message);
  LoRa.endPacket();
}

void readNFC() 
{
  if (nfc.tagPresent())
  {
    NfcTag tag = nfc.read();
    tagId = tag.getUidString();
    Serial.print("Tag ID: ");
    Serial.println(tagId);
    
    if (tag.hasNdefMessage())
    {
      NdefMessage message = tag.getNdefMessage();
      int recordCount = message.getRecordCount();
      Serial.print("Number of NDEF records: ");
      Serial.println(recordCount);
      
      for (int i = 0; i < recordCount; i++)
      {
        NdefRecord record = message.getRecord(i);
        int payloadLength = record.getPayloadLength();
        byte payload[payloadLength];
        record.getPayload(payload);
        
        String payloadAsString = "";
        for (int c = 0; c < payloadLength; c++) 
        {
          payloadAsString += (char)payload[c];
        }
        
        cleanString = payloadAsString;
        cleanString.remove(0, 3);
        Serial.print("Payload: ");
        Serial.println(cleanString);
        
        String uid = record.getId();
        if (uid != "") 
        {
          Serial.print("Record ID: ");
          Serial.println(uid);
        }
      }
    }
    else
    {
      Serial.println("No NDEF message found on the tag.");
    }
    delay(2000);
  }
}
