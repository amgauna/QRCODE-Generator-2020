<script src="easy.qrcode.js">
  
// Import the EasyQRCodeJS into the HTML document.
// <script src="easy.qrcode.js"></script>
// Create a container in which you want to place the QR code.
// <div id="qrcode"></div>  
  
// Generate a basic QR code.

var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: "https://cssscript.com"
});

// Add a custom logo to the QR code.

var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: "https://cssscript.com",
    logo: "logo.png",
    logoWidth: undefined,
    logoHeight: undefined,
    logoBackgroundColor: '#ffffff',
    logoBackgroundTransparent: false
});

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

// Customize the appearance of the QR code.

var qrcode = new QRCode(document.getElementById("qrcode"), {
    width: 256,
    height: 256,
    typeNumber: 4,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRErrorCorrectLevel.H,
    quietZone: 0,
    quietZoneColor: 'transparent',
    // === Posotion Pattern(Eye) Color
    PO: undefined, // Global Posotion Outer color. if not set, the defaut is `colorDark`
    PI: undefined, // Global Posotion Inner color. if not set, the defaut is `colorDark`
    PO_TL: undefined, // Posotion Outer - Top Left 
    PI_TL: undefined, // Posotion Inner - Top Left 
    PO_TR: undefined, // Posotion Outer - Top Right 
    PI_TR: undefined, // Posotion Inner - Top Right 
    PO_BL: undefined, // Posotion Outer - Bottom Left 
    PI_BL: undefined, // Posotion Inner - Bottom Left 

    // === Alignment Color
    AO: undefined, // Alignment Outer. if not set, the defaut is `colorDark`
    AI: undefined, // Alignment Inner. if not set, the defaut is `colorDark`

    // === Timing Pattern Color
    timing: undefined, // Global Timing color. if not set, the defaut is `colorDark`
    timing_H: undefined, // Horizontal timing color
    timing_V: undefined, // Vertical timing color

    // ==== Backgroud Image
    backgroundImage: undefined, // Background Image
    backgroundImageAlpha: 1, // Background image transparency, value between 0 and 1. default is 1. 
    autoColor: false,
    autoColorDark: "rgba(0, 0, 0, .6)", // Automatic color: dark CSS color
    autoColorLight: "rgba(255, 255, 255, .7)", // Automatic color: light CSS color

    // IE9+ Only
    dotScale: 1,

    // from Version 1 to Version 40. 0 means automatically choose the closest version based on the text length.
    version: 0, 

    // Whether set the QRCode Text as the title attribute value of the image
    tooltip: false, 

    // binary mode or not
    binary: false, 

    // or 'svg'
    drawer: 'canvas',

    // specifies the CORS setting to use when retrieving the image
    crossOrigin: null

    // ==== Event Handler
    onRenderingStart: undefined,
    onRenderingEnd: undefined,
});

// Remove the QR code.

qrcode.clear();
Re-generate a new QR code.

qrcode.makeCode("New Content Here");

// Resize the QR code.

qrcode.resize(460, 460);

</script>
