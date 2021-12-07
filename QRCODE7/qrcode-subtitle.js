// Add custom title and subtitle to the QR code.

var qrcode = new QRCode(document.getElementById("qrcode"), {
    title: "",
    titleFont: "bold 16px Arial",
    titleColor: "#000000",
    titleBackgroundColor: "#ffffff",
    titleHeight: 0,
    titleTop: 30, 
    subTitle: "",
    subTitleFont: "14px Arial",
    subTitleColor: "#4F4F4F",
    subTitleTop: 0,
});
