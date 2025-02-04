<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <?= headTableAction(
                    label: 'Produk',
                    href: base_url(route_to('produk_create'))
                ) ?>
                <?= filter([
                    [
                        'idSelect' => 'categoryFilter',
                        'label' => 'Kategori',
                        'dataOption' => array_column($categories, 'name', 'id'),
                    ],
                    [
                        'idSelect' => 'unitFilter',
                        'label' => 'Satuan',
                        'dataOption' => array_column($units, 'name', 'id'),
                    ]
                ]) ?>
            </div>
            <div class="card-body">
                <!-- Tabel Data Produk -->
                <div class="table-responsive">
                    <table id="myTable" class="table table-sm table-bordered my-2">
                        <thead>
                            <tr>
                                <?= allCheked() ?>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Satuan/Unit</th>
                                <th>Modal</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->include('script/product_script') ?>