<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            paging: true,
            searching: true,
            ordering: true,
            ajax: {
                url: '<?= base_url(route_to('get_produk')) ?>',
                type: 'POST',
                data: function(d) {
                    d.category_id = $('#categoryFilter').val();
                    d.unit_id = $('#unitFilter').val();
                },
                dataSrc: function(json) {
                    if (json.data) {
                        console.log('Data diterima dari server:', json);
                        return json.data;
                    } else {
                        console.error('Kesalahan data:', json);
                        return [];
                    }
                }
            },
            columns: [{
                    data: 'checked',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="form-check-input selectProduct" value="${row.id}" />`;
                    }
                },
                {
                    data: 'code'
                },
                {
                    data: 'name'
                },
                {
                    data: 'category_name'
                },
                {
                    data: 'unit_name'
                },
                {
                    data: 'capital_price'
                },
                {
                    data: 'sell_price'
                },
                {
                    data: 'stock'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            ${row.view}
                            ${row.show}
                            ${row.edit}
                            ${row.delete}`;
                    }
                }
            ]
        });

        // Filter kategori dan unit
        $('#categoryFilter').on('change', function() {
            table.ajax.reload();
        });

        $('#unitFilter').on('change', function() {
            table.ajax.reload();
        });

        // Refresh tombol
        $('#refreshButton').on('click', function() {
            $('#categoryFilter').val('');
            $('#unitFilter').val('');
            table.ajax.reload();
        });

        // Pilih semua checkbox
        $('#selectAll').on('click', function() {
            var checked = $(this).prop('checked');
            $('.selectProduct').prop('checked', checked);
        });

        // Hapus produk yang dipilih
        $('#deleteSelected').on('click', function() {
            var selectedIds = [];
            $('.selectProduct:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                swal({
                    title: "Oops!",
                    text: "Pilih produk yang ingin dihapus!",
                    icon: "error",
                });
                return;
            }

            swal({
                title: "Apakah Anda yakin?",
                text: "Produk yang dipilih akan dihapus secara permanen.",
                icon: "warning",
                buttons: ["Batal", "Hapus"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url(route_to('produk_deletes')) ?>', // Pastikan URL yang digunakan benar
                        type: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            if (response.success) {
                                swal("Berhasil!", "Produk yang dipilih berhasil dihapus.", "success");
                                table.ajax.reload();
                            } else {
                                swal("Gagal!", "Produk gagal dihapus.", "error");
                            }
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan pada server.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>