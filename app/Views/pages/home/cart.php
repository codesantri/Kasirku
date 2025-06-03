<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap gap-2">
                <h5>🛒 Daftar Belanja</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Kode</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($carts as $index => $cart): ?>
                                <tr>
                                    <td><?= esc($cart->product_code) ?></td>
                                    <td><?= esc($cart->product_name) ?></td>
                                    <td><?= esc(rp($cart->product_price)) ?></td>
                                    <td>
                                        <?= form_open(route_to('cart_update', esc($cart->id)), ['method' => 'POST', 'class' => 'input-group']) ?>
                                        <?= csrf_field() ?>
                                        <input type="number" name="quantity" class="form-control form-control-sm text-center" value="<?= esc($cart->quantity) ?>" min="1" />
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa-solid fa-check"></i></button>
                                        <?= form_close() ?>
                                    </td>
                                    <td><?= esc(rp($cart->product_price * $cart->quantity)) ?></td>
                                    <td>
                                        <?= btnDelete(action: route_to('cart_delete', $cart->id), dataName: esc($cart->product_name)) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold">Total Belanja:</td>
                                <td colspan="2" class="font-weight-bold bg-secondary">
                                    <h5 class="text-white"><?= esc(rp($total)) ?></h5>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between flex-wrap gap-2">
                <h5>🛒 Transaksi Pembayaran : Invoice#<strong class="text-success"><?= $invoice ?></strong></h5>
            </div>
            <div class="card-body">
                <?= form_open(route_to('payment'), ['method' => 'POST']) ?>
                <?= csrf_field() ?>
                <?= inputText(
                    type: 'hidden',
                    name: 'invoice',
                    value: $invoice
                ) ?>
                <?= inputText(
                    type: 'hidden',
                    name: 'total',
                    value: $total
                ) ?>
                <?= inputRadio(
                    '', // Tidak ada error
                    'Metode Pembayaran', // Label judul
                    [
                        ['name' => 'payment_method', 'id' => 'cash', 'value' => 'cash', 'title_option' => 'Cash (Tunai)'],
                        ['name' => 'payment_method', 'id' => 'debt', 'value' => 'debt', 'title_option' => 'Debt (Hutang)'],
                    ],
                    'cash' // Default value (Cash)
                ) ?>
                <hr>
                <?= inputTextIdr(
                    label: 'Total Belanja',
                    name: 'total',
                    id: 'total',
                    value: esc($total),
                    attributes: ['readonly' => 'readonly']
                ) ?>
                <?= inputTextIdr(
                    label: 'Nominal Pembayaran',
                    name: 'cash',
                    id: 'cash',
                    value: 0,
                    attributes: ['required' => 'required']
                ) ?>
                <?= inputTextIdr(
                    label: 'Nominal Kembalian',
                    name: 'change',
                    id: 'change',
                    value: 0,
                    attributes: ['readonly' => 'readonly']
                ) ?>
                <div class="d-flex justify-content-between">
                    <a href="<?= route_to('product_sale') ?>" class="btn btn-light rounded-0 mt-3 btn-lg"><i class="fa-solid fa-chevron-left"></i> Belanja</a>
                    <button class="btn btn-success rounded-0 mt-3 btn-lg" id="payNow"><i class="fa-solid fa-hand-holding-dollar"></i> Bayar</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
