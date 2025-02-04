<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?= form_open(route_to('category_store'), ['method' => 'POST']) ?>
                <?= csrf_field() ?>
                <?= inputText(
                    label: 'Nama Kategori',
                    type: 'text',
                    name: 'name',
                    value: old('name') ?? '',
                    errors: session('errors.name') ?? '',
                    ph: 'Masukkan Nama Kategori',
                    attributes: []
                ) ?>
                <?= btn_submit(base_url(route_to('category_index'))) ?>
                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>