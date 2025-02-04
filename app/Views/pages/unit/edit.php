<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?= form_open(route_to('unit_update', $unit['id']), ['method' => 'POST']) ?>
                <?= csrf_field() ?>
                <?= inputText(
                    label: 'Nama Satuan',
                    type: 'text',
                    name: 'name',
                    value: old('name') ?? $unit['name'],
                    errors: session('errors.name') ?? '',
                    ph: 'Masukkan Nama Satuan',
                    attributes: []
                ) ?>
                <?= btn_submit(base_url(route_to('unit_index'))) ?>
                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>