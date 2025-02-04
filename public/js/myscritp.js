// Fungsi untuk format Rupiah
function formatRupiah(value) {
    var numberString = value.replace(/[^,\d]/g, '').toString(); // Hapus karakter non-digit
    var split = numberString.split(',');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    if (split[1] !== undefined) {
        rupiah = rupiah + ',' + split[1];
    }

    return rupiah;
}

$(document).ready(function () {
    // Format Rupiah untuk input yang memiliki id berakhiran 'idrformat'
    $('[id$="idrformat"]').on('keyup change', function () {
        var value = $(this).val();
        $(this).val(formatRupiah(value));
    });

    // Format input yang sudah ada nilainya saat halaman dimuat
    $('[id$="idrformat"]').each(function () {
        var value = $(this).val();
        if (value) {
            $(this).val(formatRupiah(value));
        }
    });
});


$(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Oops, something went wrong.'
            }
        });
    });