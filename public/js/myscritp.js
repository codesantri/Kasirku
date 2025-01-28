document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[id$="idrformat"]').forEach(function (input) {
            input.addEventListener('keyup', function (e) {
                var value = e.target.value;
                var numberString = value.replace(/[^,\d]/g, '').toString();
                var split = numberString.split(',');
                var sisa = split[0].length % 3;
                var rupiah = split[0].substr(0, sisa);
                var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                e.target.value = rupiah;
            });
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