<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            pageLength: 12,
            lengthMenu: [12, 24, 48, 96],
            searching: true,
            ordering: true,
            ajax: {
                url: '<?= route_to('get_produk_sale') ?>',
                type: 'POST',
                data: function(d) {
                    d.category_id = $('#categoryFilter').val();
                    d.unit_id = $('#unitFilter').val();
                },
                dataSrc: function(json) {
                    if (json.data && json.data.length > 0) {
                        $('#productContainer').html('');

                        // ✅ Menambahkan data ke dalam container
                        json.data.forEach(function(row) {
                            $('#productContainer').append(row.view);
                        });

                        return null;
                    } else {
                        console.error('Kesalahan data:', json);
                        return []; // ✅
                    }
                }
            },
            columns: [{
                data: 'name'
            }],
            initComplete: function(settings, json) {
                $(".dt-empty").remove();
            }
        });

        // 🔄 Filter kategori
        $('#categoryFilter').on('change', function() {
            table.ajax.reload();
            $(".dt-empty").remove();
        });

        // 🔄 Filter unit
        $('#unitFilter').on('change', function() {
            table.ajax.reload();
            $(".dt-empty").remove();
        });

        // 🔄 Tombol reset filter
        $('#refreshButton').on('click', function() {
            $('#categoryFilter').val('');
            $('#unitFilter').val('');
            table.ajax.reload();
            $(".dt-empty").remove();
        });
    });
</script>
<?= $this->endSection(); ?>