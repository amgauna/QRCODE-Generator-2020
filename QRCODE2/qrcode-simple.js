<script type="text/javascript">
            
  function generateBarCode()
   {
       var nric = $('#text').val();
       var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=100x100';
       $('#barcode').attr('src', url);
       }

</script>
