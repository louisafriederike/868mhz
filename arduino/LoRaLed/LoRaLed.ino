#include <SPI.h>
#include <LoRa.h>

#define LORA_SS_PIN 10
#define LORA_RST_PIN 9
#define LORA_DI0_PIN 2

void setup() {
  Serial.begin(9600);
  while (!Serial);

  pinMode(LED_BUILTIN, OUTPUT);
  
  // Initialize LoRa module
  LoRa.setPins(LORA_SS_PIN, LORA_RST_PIN, LORA_DI0_PIN);
  if (!LoRa.begin(433E6)) {
    Serial.println("LoRa initialization failed. Check your wiring!");
    while (true);
  }

  // Connect to WiFi or Ethernet here

  // Connect to Socket.IO server
  // Replace <SERVER_ADDRESS> with the actual server address
  // e.g., http://localhost:3000
  // Replace <TOKEN> with an authentication token if required
  // e.g., "?token=abcd1234"
  //socketIO.connect("<SERVER_ADDRESS><TOKEN>");
}

void loop() {
  // Handle Socket.IO events or other tasks here
  
  // Check for incoming LoRa messages
  int packetSize = LoRa.parsePacket();
  if (packetSize) {
    while (LoRa.available()) {
      String message = LoRa.readString();
      Serial.println("Received message: " + message);

      // Process the received message and control the LED
      if (message == "led_on") {
        digitalWrite(LED_BUILTIN, HIGH);  // Turn on the LED
        LoRa.beginPacket();
        LoRa.print("ack");
        LoRa.endPacket();
      } else if (message == "led_off") {
        digitalWrite(LED_BUILTIN, LOW);   // Turn off the LED
        LoRa.beginPacket();
        LoRa.print("ack");
        LoRa.endPacket();
      }
    }
  }
}
