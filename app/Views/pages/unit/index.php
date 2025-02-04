<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <?= headTableAction(
                    label: 'Satuan',
                    href: base_url(route_to('unit_create'))
                ) ?>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table id="myTable" class="table table-sm table-bordered my-2" style="width:100%">
                        <thead>
                            <tr class="w-100">
                                <?= allCheked() ?>
                                <th>Nama Satuan</th>
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
<?= $this->include('script/unit_script') ?>