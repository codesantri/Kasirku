<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?= form_open(route_to('stock_store'), ['method' => 'POST']) ?>
                <?= csrf_field() ?>


                <?= inputSelectTwo(
                    name: 'product_id',
                    options: $products,
                    title: 'Nama Produk',
                    selected: old('product_id') ?? '',
                    errors: session('errors.product_id') ?? '',
                ) ?>

                <!-- Pilih Type Stok -->
                <?= inputRadio(
                    '', // Tidak ada error
                    'Tipe Stok', // Label judul
                    [
                        ['name' => 'status', 'id' => 'in', 'value' => 'in', 'title_option' => 'Masuk'],
                        ['name' => 'status', 'id' => 'out', 'value' => 'out', 'title_option' => 'Keluar'],
                    ],
                    'in'
                ) ?>

                <?= inputText(
                    label: 'Jumlah Stok',
                    type: 'number',
                    name: 'quantity',
                    value: old('quantity') ?? '',
                    errors: session('errors.quantity') ?? '',
                    ph: 'Masukkan Jumlah Stok',
                    attributes: ['']
                ) ?>

                <?= inputText(
                    label: 'Keterangan',
                    type: 'text',
                    name: 'description',
                    value: old('description') ?? '',
                    errors: session('errors.description') ?? '',
                    ph: 'Masukkan Keterangan',
                    attributes: ['']
                ) ?>

                <!-- Tombol Submit -->
                <?= btn_submit(route_to('stock_index')) ?>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>