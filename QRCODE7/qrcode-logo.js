// Add a custom logo to the QR code.

var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: "https://cssscript.com",
    logo: "logo.png",
    logoWidth: undefined,
    logoHeight: undefined,
    logoBackgroundColor: '#ffffff',
    logoBackgroundTransparent: false
});
