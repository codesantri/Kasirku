<ul class="nav pcoded-inner-navbar">
    <li class="nav-item pcoded-menu-caption">
        <label>Menu</label>
    </li>
    <?= linka(
        href: '/',
        icon: 'fa-house',
        label: 'Dashboard',
        active: 'active'
    ) ?>
    <?= linka(
        href: '/penjualan',
        icon: 'fa-cash-register',
        label: 'Penjualan',
        active: 'active'
    ) ?>

    <?= links(
        label: 'Master Data',
        icon: 'fa-database',
        // active: 'active',
        submenu: [
            'Produk' => route_to('produk_index'),
            'Kategori' => route_to('category_index'),
            'Satuan' => route_to('unit_index'),
        ]
    ); ?>

    <?= linka(
        href: '/gudang',
        icon: 'fa-truck-fast',
        label: 'Gudang',
        active: 'active'
    ) ?>

    <?= linka(
        href: '/pengguna',
        icon: 'fa-users',
        label: 'Pengguna',
        active: 'active'
    ) ?>

    <?= linka(
        href: '/laporan',
        icon: 'fa-file',
        label: 'Laporan',
        active: 'active'
    ) ?>
</ul>