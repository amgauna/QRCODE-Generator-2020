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
  
  console.log("QR Code saved!");
});
