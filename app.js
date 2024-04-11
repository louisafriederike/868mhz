var http = require('http');
var fs = require('fs');
var express = require('express');
var app = express();
var path = require('path');
var server = http.createServer(app);
var port = 8000;
var osc = require('osc');
var activeUsers = new Set(); // Active users Set
var name = [];

var udpPort = new osc.UDPPort({
  // This is the port we're listening on.
  localAddress: "0.0.0.0",
  localPort: 57121,

  // This is where sclang is listening for OSC messages.
  remoteAddress: "192.168.2.5", //this is the hamsters ip
  remotePort: 8080, //this is the hamsters port :*s
  metadata: true
});

var trashcan = new osc.UDPPort({
  // This is the port we're listening on.
  localAddress: "0.0.0.0",
  localPort: 57122,

  // This is where sclang is listening for OSC messages.
  remoteAddress: "192.168.2.21", //this is the trashc  an ip
  remotePort: 8888, //this is the trashcan port :*s
  metadata: true
});


// Open the socket.
udpPort.open();
trashcan.open();

const { SerialPort } = require('serialport')
const { ReadlineParser } = require('@serialport/parser-readline')
const sport = new SerialPort({ path: '/dev/ttyACM0', baudRate: 115200 })

const parser = sport.pipe(new ReadlineParser({ delimiter: '\r\n' }))

server.listen(port, () => {
  console.log("Server is listening at port %d", port);
});

app.use(express.static(path.join(__dirname, "public")));

var io = require('socket.io')(server);

io.on('connection', function(socket) {
  console.log("new user online!");

  // Add the new socket ID to the activeUsers Set
  activeUsers.add(socket.id);

  // Emit the updated activeUsers Set to all connected clients
  io.emit('activeUsers', Array.from(activeUsers));

  parser.on('data', function(data) {
    const msg = data.split(' ');
    console.log(msg[0], msg[1]);
    io.emit('node-data', data);
  });

  socket.on("blink", () => {
    console.log("Blink event received!");
    io.emit("blink"); // Emit the "blink" event to all connected clients
  });




  socket.on('chat message', (msg) => {
    console.log('[user][' + socket.id + '][' + msg + ']');
    socket.broadcast.emit('chat message', msg);

    var oscmsg = {
      address: "/silentserver",
      args: [
        {
          type: "s",
          value: socket.id
        },
        {
          type: "s",
          value: msg
        }
      ]
    };
  
    udpPort.send(oscmsg);
  
    
    if (msg == "9292") {
      console.log('secret trash received');
      var oscmsg = {
        address: "/silentserver",
        args: [
          {
            type: "s",
            value: msg
          }
        ]
      };
  
      trashcan.send(oscmsg);
    }
  
    if (msg == "comp") {
      console.log('comp received');
      var hampctrl = {
        address: "/silentserver",
        args: [
          {
            type: "s",
            value: "comp"
          }
        ]
      };
  
      udpPort.send(hampctrl);
      
    }

    if (msg == "off") {
      console.log('off received');
      var hampctrl = {
        address: "/silentserver",
        args: [
          {
            type: "s",
            value: "off"
          }
        ]
      };
  
      udpPort.send(hampctrl);
      
    }
  
    var oscmsg = {
      address: "/silentserver",
      args: [
        {
          type: "s",
          value: socket.id
        },
        {
          type: "s",
          value: msg
        }
      ]
    };
  
    udpPort.send(oscmsg);
  });


  app.post('/trash', (req, res) => {
    console.log('9292 received');
    var hampctrl = {
      address: "/silentserver",
      args: [
        {
          type: "s",
          value: "9292"
        }
      ]
    };
  
    trashcan.send(hampctrl);
  
    // Send a response back to the client
    res.status(200).send("OSC message sent to trash");
  });



  app.post('/hamp-off', (req, res) => {
    console.log('off received');
    var hampctrl = {
      address: "/silentserver",
      args: [
        {
          type: "s",
          value: "off"
        }
      ]
    };
  
    udpPort.send(hampctrl);
  
    // Send a response back to the client
    res.status(200).send("OSC message sent");
  });
  
  app.post('/hamp-on', (req, res) => {
    console.log('on received');
    var hampctrl = {
      address: "/silentserver",
      args: [
        {
          type: "s",
          value: "comp"
        }
      ]
    };
  
    udpPort.send(hampctrl);
  
    // Send a response back to the client
    res.status(200).send("OSC message sent");
  });
      
   
  socket.on('userposition', (msg) => {
    console.log('[user][' + socket.id + '][position: ' + msg[0] + ',' + msg[1] + ']');
    socket.to('expo').emit(socket.id, msg);
  });

  // socket.on('name', (msg)=> {
  //   console.log("[name]["+socket.id +"]["+ msg +"]");
  //   name.push({ id: socket.id, name: msg }); // Push an object with user ID and name
  //   console.log(name);
  // });
  



  // Handle disconnection event
  socket.on('disconnect', () => {
    console.log("new user online:", socket.id);

    // Remove the disconnected socket ID from the activeUsers Set
    activeUsers.delete(socket.id);

    // Emit the updated activeUsers Set to all connected clients
    io.emit('activeUsers', Array.from(activeUsers));
  });
});