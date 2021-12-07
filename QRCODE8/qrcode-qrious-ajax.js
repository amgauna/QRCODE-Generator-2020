<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js">

// Our textarea
const input = document.querySelector("#qrCodeTextArea");
// Our canvas element with 'qr' id
const canvas = document.getElementById("qr");

// The various parameters
const createQR = v => {
  return new QRious({
    element: canvas,
    value: v,
    level: "L",
    size: 400,
    backgroundAlpha: 0,
    foreground: "white" });

};

// We create the qr code
const qr = createQR(input.value);

// If the text box changes, update the qr code.
input.addEventListener("input", () => {
  const qr = createQR(input.value);
});

</script>
