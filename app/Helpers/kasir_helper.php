<?php
if (!function_exists('linka')) {
    /**
     * Membuat link menu dengan status aktif
     *
     * @param string $href URL tujuan (misalnya '/dashboard')
     * @param string $active Bagian URL yang digunakan untuk menandai status aktif
     * @param string $icon Ikon Font Awesome untuk link (optional)
     * @param string $label Label yang akan ditampilkan untuk link
     * @param string $classActive Kelas CSS untuk status aktif (default: 'active')
     * @return string HTML untuk link menu
     */
    function linka(
        string $href = '/',
        string $active = '',
        string $icon = '',
        string $label = '',
        string $classActive = 'active'
    ) {
        $isActive = strpos(uri_string(), $active) === 0 ? $classActive : '';
        return '
        <li class="nav-item ' . $isActive . '">
            <a href="' . base_url($href) . '" class="nav-link">
                <span class="pcoded-micon">
                    <i class="fa-solid ' . $icon . '"></i>
                </span>
                <span class="pcoded-mtext">' . $label . '</span>
            </a>
        </li>
        ';
    }
}

if (!function_exists('links')) {
    /**
     * Membuat menu dengan atau tanpa submenu
     *
     * @param string $label Label menu utama
     * @param string $icon Ikon Font Awesome untuk menu utama
     * @param string $active Kelas CSS untuk menu aktif
     * @param array $submenu Array submenu (opsional, format: ['Label' => 'URL'])
     * @return string HTML untuk menu dan submenu
     */
    function links(
        string $label,
        string $icon,
        string $active = '',
        array $submenu = []
    ) {
        $hasSubmenu = !empty($submenu) ? ' pcoded-hasmenu' : '';
        $isActive = $active ? $active : '';

        $html = '
        <li class="nav-item' . $hasSubmenu . ' ' . $isActive . '">
            <a href="#!" class="nav-link">
                <span class="pcoded-micon">
                    <i class="fa-solid ' . $icon . '"></i>
                </span>
                <span class="pcoded-mtext">' . $label . '</span>
            </a>';

        if (!empty($submenu)) {
            $html .= '<ul class="pcoded-submenu">';
            foreach ($submenu as $subLabel => $subHref) {
                $html .= '
                <li>
                    <a href="' . base_url($subHref) . '">' . $subLabel . '</a>
                </li>';
            }
            $html .= '</ul>';
        }

        $html .= '</li>';
        return $html;
    }
}

if (!function_exists('rp')) {
    /**
     * Format angka menjadi format Rupiah
     *
     * @param int|float $amount Jumlah angka yang akan diformat
     * @return string Format Rupiah (contoh: Rp 1.000.000)
     */
    function rp($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('no')) {
    function no($pager, $index)
    {
        $currentPage = $pager->getCurrentPage(); // Nomor halaman saat ini
        $perPage = $pager->getPerPage(); // Jumlah item per halaman
        $offset = ($currentPage - 1) * $perPage; // Hitung offset

        return $offset + $index + 1;
    }
}

if (!function_exists('modalView')) {
    function modalView(
        string $id = '',
        array $data = [],
        string $href = '#',
        string $image = null,
    ) {
        // Cek jika ada gambar dalam data
        $imagePath = base_url('uploads/products/' . $image);
        $imageView = isset($image) && !empty($image) ? '<img class="img-fluid card-img-top" src="' . $imagePath . '" alt="' . $image . '">' : '';

        // Buat form input untuk data lainnya
        $inputFields = '';
        foreach ($data as $key => $value) {
            $inputFields .= '<input class="form-control my-3" type="text" value="' . htmlspecialchars($value, ENT_QUOTES) . '" readonly>';
        }

        return '
        <div id="modalView-' . htmlspecialchars($id, ENT_QUOTES) . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalView-' . $id . '" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalView-' . $id . '">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        ' . $imageView . '
                        ' . $inputFields . '
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="' . $href . '" type="button" class="btn btn-primary">Ubah Data</a>
                    </div>
                </div>
            </div>
        </div>';
    }
}
