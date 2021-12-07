/* Load the library */
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

/* Basic and simple one */
<div id="qrcode"></div>
<script type="text/javascript">
new QRCode(document.getElementById("qrcode"), "https://webisora.com");
</script>

/*With some options*/

<div id="qrcode-2"></div>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode-2"), {
	text: "https://webisora.com",
	width: 128,
	height: 128,
	colorDark : "#5868bf",
	colorLight : "#ffffff",
	correctLevel : QRCode.CorrectLevel.H
});
</script>
