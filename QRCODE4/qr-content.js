
function encodeQR(text_content) {
    return $('<div/>').text(text_content)
        .html();
}

$(function () {
    $('#QR-generate').click(function () {
        let QR_url =
            'https://chart.googleapis.com/chart?cht=qr&chl='
            + encodeQR($('#QR-content').val()) +
            '&chs=300x300&chld=L|0'
 
        $('.qr-code').attr('src', QR_url);
    });
});
