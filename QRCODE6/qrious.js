/* Load the library */
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

/* Basic and simple one */
<canvas id="qrcode"></canvas>
<script type="text/javascript">
new QRious({element: document.getElementById("qrcode"), value: "https://webisora.com")};
</script>

/*With some options*/

<canvas id="qrcode-2"></canvas>
<script type="text/javascript">
var qrcode = new QRious({
  element: document.getElementById("qrcode-2"),
  background: '#ffffff',
  backgroundAlpha: 1,
  foreground: '#5868bf',
  foregroundAlpha: 1,
  level: 'H',
  padding: 0,
  size: 128,
  value: website
});
</script>
