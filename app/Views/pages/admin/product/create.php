<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?= form_open(route_to('produk_store'), ['method' => 'POST', 'enctype' => 'multipart/form-data']) ?>
                <?= csrf_field() ?>
                <?= inputText(
                    label: 'Nama Produk',
                    type: 'text',
                    name: 'name',
                    value: old('name') ?? '',
                    errors: session('errors.name') ?? '',
                    ph: 'Masukkan Nama Produk',
                    attributes: []
                ) ?>
                
                <?= inputText(
                    label: 'Kode Produk',
                    type: 'text',
                    name: 'code',
                    value: old('code') ?? '',
                    errors: session('errors.code') ?? '',
                    ph: 'Masukkan Kode Produk',
                    attributes: ['']
                ) ?>

                <?= inputSelect(
                    name: 'unit_id',
                    options: $units,
                    title: 'Satuan',
                    selected: old('unit_id') ?? '',
                    errors: session('errors.unit_id') ?? '',
                    attributes: ['']
                ) ?>

                <?= inputSelect(
                    name: 'category_id',
                    options: $categories,
                    title: 'Kategori',
                    selected: old('category_id') ?? '',
                    errors: session('errors.category_id') ?? '',
                    attributes: ['']
                ) ?>

                <?= inputTextIdr(
                    label: 'Harga Beli/Modal',
                    name: 'capital_price',
                    value: old('capital_price') ?? '',
                    errors: session('errors.capital_price') ?? '',
                    ph: 'Masukkan Harga Beli/Modal',
                    attributes: ['']
                ) ?>

                <?= inputTextIdr(
                    label: 'Harga Jual',
                    name: 'sell_price',
                    value: old('sell_price') ?? '',
                    errors: session('errors.sell_price') ?? '',
                    ph: 'Masukkan Harga Jual',
                    attributes: ['']
                ) ?>

                <?= inputText(
                    label: 'Stok',
                    type: 'number',
                    name: 'stock',
                    value: old('stock') ?? '',
                    errors: session('errors.stock') ?? '',
                    ph: 'Masukkan Stok',
                    attributes: ['']
                ) ?>

                <?= inputUpload(
                    name: 'image',
                    label: 'Gambar Produk',
                    errors: session('errors.image') ?? '',
                ) ?>

                <?= btn_submit(base_url('/produk')) ?>
                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>