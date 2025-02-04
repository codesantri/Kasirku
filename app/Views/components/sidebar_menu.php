<ul class="nav pcoded-inner-navbar">
    <li class="nav-item pcoded-menu-caption">
        <label>Menu</label>
    </li>
    <?= linka(
        href: route_to('dashboard'),
        icon: 'fa-house',
        label: 'Dashboard',
        active: 'active'
    ) ?>
    <?= linka(
        href: route_to('home_product'),
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
        href: route_to('stock_index'),
        icon: 'fa-truck-fast',
        label: 'Stoker',
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