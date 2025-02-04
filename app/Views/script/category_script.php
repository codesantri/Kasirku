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
                url: '<?= base_url(route_to('get_category')) ?>',
                type: 'POST',
                dataSrc: function(json) {
                    if (json.data) {
                        console.log('Data diterima dari server:', json);
                        return json.data;
                    } else {
                        console.error('Kesalahan data:', json);
                        return [];
                    }
                },
                error: function(xhr, error, thrown) {
                    console.error('Error:', xhr.responseText);
                    return [];
                }
            },
            columns: [{
                    data: 'checked',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<input type="checkbox" class="form-check-input selectCategory" value="${row.id}" />`;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                        ${row.edit}
                        ${row.delete}`;
                    }
                }
            ]
        });

        // Refresh tombol
        $('#refreshButton').on('click', function() {
            table.ajax.reload();
        });

        // Pilih semua checkbox kategori
        $('#selectAll').on('click', function() {
            var checked = $(this).prop('checked');
            $('.selectCategory').prop('checked', checked);
        });

        // Hapus kategori yang dipilih
        $('#deleteSelected').on('click', function() {
            var selectedIds = [];
            $('.selectCategory:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                swal({
                    title: "Oops!",
                    text: "Pilih kategori yang ingin dihapus!",
                    icon: "error",
                });
                return;
            }

            swal({
                title: "Apakah Anda yakin?",
                text: "Kategori yang dipilih akan dihapus secara permanen.",
                icon: "warning",
                buttons: ["Batal", "Hapus"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '<?= base_url(route_to('category_deletes')) ?>',
                        type: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            if (response.success) {
                                swal("Berhasil!", "Kategori yang dipilih berhasil dihapus.", "success");
                                table.ajax.reload();
                            } else {
                                swal("Gagal!", "Kategori gagal dihapus.", "error");
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