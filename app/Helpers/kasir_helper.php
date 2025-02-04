<?php

use PharIo\Manifest\Url;

if (!function_exists('linka')) {
    /**
     * Membuat link menu dengan status aktif berdasarkan URL saat ini
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
        $currentURL = uri_string();
        $isActive = (strpos($currentURL, trim($active, '/')) === 0) ? $classActive : '';

        // Pastikan base_url tidak menyebabkan redirect ke root (localhost:8080)
        $url = !empty($href) ? base_url($href) : '#';

        return '
        <li class="nav-item ' . esc($isActive) . '">
            <a href="' . esc($url) . '" class="nav-link">
                <span class="pcoded-micon">
                    <i class="fa-solid ' . esc($icon) . '"></i>
                </span>
                <span class="pcoded-mtext">' . esc($label) . '</span>
            </a>
        </li>';
    }
}

if (!function_exists('links')) {
    /**
     * Membuat menu dengan atau tanpa submenu dan menandai menu aktif berdasarkan URL
     *
     * @param string $label Label menu utama
     * @param string $icon Ikon Font Awesome untuk menu utama
     * @param string $href Route utama untuk menu ini (default '#')
     * @param array $submenu Array submenu (opsional, format: ['Label' => 'URL'])
     * @return string HTML untuk menu
     */
    function links(
        string $label,
        string $icon,
        string $href = '#',
        array $submenu = []
    ) {
        $currentURL = uri_string();
        $isActive = (strpos($currentURL, trim($href, '/')) === 0) ? 'active' : '';

        // Jika ada submenu, periksa apakah salah satunya sedang aktif
        $hasSubmenu = !empty($submenu) ? ' pcoded-hasmenu' : '';
        foreach ($submenu as $subHref) {
            if (strpos($currentURL, trim($subHref, '/')) === 0) {
                $isActive = 'active';
                $hasSubmenu = ' pcoded-hasmenu'; // Pastikan submenu tetap aktif
                break;
            }
        }

        // Pastikan href tidak kosong
        $url = !empty($href) ? base_url($href) : '#';

        $html = '
        <li class="nav-item' . $hasSubmenu . ' ' . $isActive . '">
            <a href="#" class="nav-link">
                <span class="pcoded-micon">
                    <i class="fa-solid ' . esc($icon) . '"></i>
                </span>
                <span class="pcoded-mtext">' . esc($label) . '</span>
            </a>';

        if (!empty($submenu)) {
            $html .= '<ul class="pcoded-submenu">';
            foreach ($submenu as $subLabel => $subHref) {
                // Cek apakah submenu aktif
                $subActive = (strpos($currentURL, trim($subHref, '/')) === 0) ? 'active' : '';
                $subUrl = !empty($subHref) ? base_url($subHref) : '#';

                // Tambahkan kelas ke submenu jika cocok
                $html .= '
                <li class="nav-item ' . $subActive . '">
                    <a href="' . esc($subUrl) . '" class="nav-link">' . esc($subLabel) . '</a>
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

if (!function_exists('allCheked')) {
    function allCheked()
    {
        return '
            <th width="10">
                <input type="checkbox" class="form-check-input" id="selectAll">
                    All
            </th>
        ';
    }
}

if (!function_exists('headTableAction')) {

    function headTableAction(
        string $href = '#',
        string $label = ''

    ) {
        return '
        <div>
            <a href="' . $href . '" class="btn btn-sm border-0 mx-1 btn-success"> <i class="fa-solid fa-circle-plus"></i> ' . $label . '</a>
            <button id="deleteSelected" class="btn btn-sm border-0 mx-1 btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
        ';
    }
}


if (!function_exists('filter')) {
    function filter($datasets)
    {
        $html = '<div class="d-flex gap-2">';

        // Loop melalui setiap dataset
        foreach ($datasets as $data) {
            // Validasi data yang diperlukan
            if (empty($data['idSelect']) || empty($data['dataOption'])) {
                continue; // Lewati dataset yang tidak valid
            }

            // Default values
            $defaultLabel = $data['label'] ?? 'Pilih Opsi';

            // Dropdown Filter
            $html .= '<select id="' . htmlspecialchars($data['idSelect']) . '" class="form-control form-control-sm w-auto">';
            $html .= '<option value="">' . htmlspecialchars($defaultLabel) . '</option>';

            foreach ($data['dataOption'] as $key => $value) {
                $html .= '<option value="' . htmlspecialchars($key) . '">' . htmlspecialchars($value) . '</option>';
            }

            $html .= '</select>';
        }

        // Tombol Reset (Hanya Ditampilkan Sekali)
        $html .= '<button id="refreshButton" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-rotate-right"></i>
                  </button>';

        $html .= '</div>'; // Penutup wrapper div

        return $html;
    }
}
