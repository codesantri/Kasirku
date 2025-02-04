<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?= form_open(route_to('produk_update', $product['id']), 
                ['method' => 'POST', 'enctype' => 'multipart/form-data']) ?>
                <?= csrf_field() ?>

                <?= inputText(
                    label: 'Nama Produk',
                    type: 'text',
                    name: 'name',
                    value: old('name') ?? $product['name'],
                    errors: session('errors.name') ?? '',
                    ph: 'Masukkan Nama Produk',
                    attributes: ['required' => 'required']
                ) ?>

                <?= inputText(
                    label: 'Kode Produk',
                    type: 'text',
                    name: 'code',
                    value: old('code') ?? $product['code'],
                    errors: session('errors.code') ?? '',
                    ph: 'Masukkan Kode Produk',
                    attributes: ['required' => 'required']
                ) ?>

                <?= inputSelect(
                    name: 'unit_id',
                    options: $units,
                    title: 'Satuan',
                    selected: old('unit_id', $product['unit_id'] ?? ''),
                    errors: session('errors.unit_id') ?? '',
                    attributes: ['required' => 'required']
                ) ?>

                <?= inputSelect(
                    name: 'category_id',
                    options: $categories,
                    title: 'Kategori',
                    selected: old('category_id', $product['category_id'] ?? ''),
                    errors: session('errors.category_id') ?? '',
                    attributes: ['required' => 'required']
                ) ?>

                <?= inputTextIdr(
                    label: 'Harga Beli/Modal',
                    name: 'capital_price',
                    value: old('capital_price') ?? rp($product['capital_price']),
                    errors: session('errors.capital_price') ?? '',
                    ph: 'Masukkan Harga Beli/Modal',
                    attributes: ['required' => 'required']
                ) ?>

                <?= inputTextIdr(
                    label: 'Harga Jual',
                    name: 'sell_price',
                    value: old('sell_price') ?? rp($product['sell_price']),
                    errors: session('errors.sell_price') ?? '',
                    ph: 'Masukkan Harga Jual',
                    attributes: ['required' => 'required']
                ) ?>

                <?= inputText(
                    label: 'Stok',
                    type: 'number',
                    name: 'stock',
                    value: old('stock') ?? $product['stock'],
                    errors: session('errors.stock') ?? '',
                    ph: 'Masukkan Stok',
                    attributes: ['required' => 'required']
                ) ?>

                <?= inputUpload(
                    name: 'image',
                    label: 'Gambar Produk',
                    errors: session('errors.image') ?? '',
                    defaultFile: $product['image'] ? base_url('uploads/products/' . $product['image']) : ''
                ) ?>

                <?= btn_submit(base_url('/produk')) ?>
                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>