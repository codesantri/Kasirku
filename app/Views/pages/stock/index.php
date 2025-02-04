<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <?= headTableAction(
                    label: 'Stok',
                    href: base_url(route_to('stock_create'))
                ) ?>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table id="tableStock" class="table table-sm table-bordered my-2" style="width:100%">
                        <thead>
                            <tr class="w-100">
                                <?= allCheked() ?>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                                <th>Jumlah Stok</th>
                                <th>Keterangan</th>
                                <th width="120px" class="text-right">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->include('script/stock_script') ?>