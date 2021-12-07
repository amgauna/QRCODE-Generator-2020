var http = require("http");

var QRCode = require("qrcode-svg");

var qrcode = new QRCode({ 
  content: "https://webisora.com",
  padding: 4,
  width: 256,
  height: 256,
  color: "#000000",
  background: "#ffffff",
  ecl: "M"
});
qrcode.save("Webisora.svg", function (error) {
  if (error) throw error;
  console.log("QR Code generated!");
});

//create a server object:
http
  .createServer(function(req, res) {
    res.statusCode = 200;
    res.setHeader('Content-Type', 'text/html');
    res.write("QR Code generated")
  })
  .listen(8080); //the server object listens on port 8080
