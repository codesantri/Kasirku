<ul class="nav pcoded-inner-navbar sidenav-inner mx-auto">
    <?= linka(
        href: '/',
        icon: 'fa-house',
        label: 'Beranda',
        active: 'active'
    ) ?>

    <?= linka(
        href: '/produk',
        icon: 'fa-shopping-cart',
        label: 'Produk',
        active: 'active'
    ) ?>

    <?= linka(
        href: '/cart',
        icon: 'fa-cash-register',
        label: 'Transaksi',
        active: 'active'
    ) ?>

</ul>