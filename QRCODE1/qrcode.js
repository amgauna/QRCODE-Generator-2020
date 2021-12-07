const qrcode = document.getElementById("qrcode");
const textInput = document.getElementById("text");

const qr = new QRCode(qrcode);
qr.makeCode(textInput.value.trim());
