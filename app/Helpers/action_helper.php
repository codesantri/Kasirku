<?php
if (!function_exists('btnDelete')) {
    function btnDelete(
        string $action = '',
        string $dataName = ''
    ): string {
        return '
        <form action="' . $action . '" method="post" class="d-inline">
            ' . csrf_field() . '
            <input type="hidden" name="_method" value="DELETE">
            <button type="button" class="btn btn-danger btn-sm" onclick="deleteConfirmed(this, \'' . $dataName . '\')">
                <i class="fa-solid fa-trash"></i>
            </button>
        </form>
        <script>
            function deleteConfirmed(button, dataName) {
                swal({
                    title: "Apakah Anda yakin?",
                    text: dataName + " akan dihapus secara permanen.",
                    icon: "warning",
                    buttons: ["Batal", "Hapus"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        button.closest("form").submit();
                    }
                });
            }
        </script>';
    }
}

if (!function_exists('btnEdit')) {
    function btnEdit(
        string $href = '#!',
        string $label = ''
    ): string {
        // Encode nilai untuk mencegah XSS
        $href = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');
        $label = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');

        // Kembalikan tautan
        return '
            <a href="' . $href . '" class="btn btn-warning btn-sm">
                <i class="fa-solid fa-edit"></i> ' . $label . '
            </a>
        ';
    }
}

if (!function_exists('btnEditModal')) {
    function btnEditModal(
        string $modalTarget,
        string $label = ''
    ): string {
        // Encode nilai untuk mencegah XSS
        $modalTarget = htmlspecialchars($modalTarget, ENT_QUOTES, 'UTF-8');
        $label = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');

        // Kembalikan tombol modal
        return '
            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-' . $modalTarget . '">
                <i class="fa-solid fa-edit"></i> ' . $label . '
            </button>
        ';
    }
}

if (!function_exists('btnShow')) {
    function btnShow(
        string $href = '#!',
        string $label = ''
    ): string {
        $href = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');
        $label = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');

        // Kembalikan tautan
        return '
            <a href="' . $href . '" class="btn btn-success btn-sm">
                <i class="fa-solid fa-eye"></i> ' . $label . '
            </a>
        ';
    }
}

if (!function_exists('btnView')) {
    function btnView(
        string $id,
        string $label = ''
    ): string {
        $modalTarget = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
        $label = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');
        return '
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalView-' . $id . '">
                <i class="fa-solid fa-eye"></i> ' . $label . '
            </button>
        ';
    }
}
