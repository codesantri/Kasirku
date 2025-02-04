<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?= form_open(route_to('stock_update', $stock['id']), ['method' => 'POST']) ?>
                <?= csrf_field() ?>

                <?= inputSelectTwo(
                    name: 'product_id',
                    options: $products,
                    title: 'Nama Produk',
                    selected: old('product_id', $stock['product_id'] ?? ''),
                    errors: session('errors.product_id') ?? '',
                ) ?>

                <!-- Pilih Type Stok -->
                <?= inputRadio(
                    session('errors.status') ?? '', // Menampilkan error jika ada
                    'Tipe Stok', // Label judul
                    [
                        ['name' => 'status', 'id' => 'in', 'value' => 'in', 'title_option' => 'Masuk'],
                        ['name' => 'status', 'id' => 'out', 'value' => 'out', 'title_option' => 'Keluar'],
                    ],
                    old('status', $stock['status'] ?? 'in') // Mempertahankan nilai lama
                ) ?>

                <?= inputText(
                    label: 'Jumlah Stok',
                    type: 'number',
                    name: 'quantity',
                    value: old('quantity', $stock['quantity'] ?? ''),
                    errors: session('errors.quantity') ?? '',
                    ph: 'Masukkan Jumlah Stok',
                    attributes: ['']
                ) ?>

                <?= inputText(
                    label: 'Keterangan',
                    type: 'text',
                    name: 'description',
                    value: old('description', $stock['description'] ?? ''),
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