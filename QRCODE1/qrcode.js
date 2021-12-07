<script type="text/javascript">
    
const qrcode = document.getElementById("qrcode");
const textInput = document.getElementById("text");

const qr = new QRCode(qrcode);
qr.makeCode(textInput.value.trim());

textInput.oninput = (e) => {
    qr.makeCode(e.target.value.trim());
};

</script>
