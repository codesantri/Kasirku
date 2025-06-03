$(document).ready(function () {
    function formatRupiah(value) {
        var numberString = value.replace(/[^,\d]/g, '').toString(); // Remove non-numeric characters
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

    $('[id$="idrformat"]').on('input', function () {
        $(this).val(formatRupiah($(this).val()));
    }).each(function () {
        // Format the input when the page loads
        var value = $(this).val();
        if (value) {
            $(this).val(formatRupiah(value));
        }
    });
    
    $('input[name="total"], input[name="cash"], input[name="change"]').on('input', function () {
        let value = $(this).val();
        if (value) {
            $(this).val(formatRupiah(value));
        }
    });

    function calculateChange() {
        let totalValue = $('input[name="total"]').val();
        let cashValue = $('input[name="cash"]').val();

        if (totalValue === undefined || cashValue === undefined) {
            return;
        }

        let total = totalValue ? parseInt(totalValue.replace(/[^0-9]/g, '')) : 0;
        let cash = cashValue ? parseInt(cashValue.replace(/[^0-9]/g, '')) : 0;
        let change = cash - total;

        // Format the change as Rupiah and update the change field
        $('input[name="change"]').val(change > 0 ? formatRupiah(change.toString()) : 'Rp 0');
    }
    $('input[name="cash"]').on('keyup change', calculateChange);

    // SCRIPT UNTUK UPLOAD GAMBAR
    // Initialize Dropify (only if the element exists)
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

    // Initialize Select2 (only if the element exists)
    if ($('.select-two').length) {
        $('.select-two').select2({
            theme: 'bootstrap'
        });
    }
});
