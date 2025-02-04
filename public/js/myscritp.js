$(document).ready(function () {
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

    // Format Rupiah untuk input yang memiliki id berakhiran 'idrformat'
    $('[id$="idrformat"]').on('input', function () {
        $(this).val(formatRupiah($(this).val()));
    }).each(function () {
        // Format input saat halaman dimuat
        var value = $(this).val();
        if (value) {
            $(this).val(formatRupiah(value));
        }
    });

    // Inisialisasi Dropify (hanya jika elemen ada di halaman)
    if ($('.dropify').length) {
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Oops, something went wrong.'
            }
        });
    }
    if ($('.select-two').length) {
        $('.select-two').select2({
            theme: 'bootstrap'
        });
    }
});
