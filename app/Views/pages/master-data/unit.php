<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><?= isset($title) ? $title : '' ?></h5>
                <button data-toggle="modal" data-target="#createModal" class="btn btn-secondary btn-sm float-right">Tambah</button>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered my-3" style="width:100%">
                        <thead>
                            <tr class="w-100">
                                <th width="20px"><?= 'No' ?></th>
                                <th width="100%"><?= 'Nama Satuan' ?></th>
                                <th width="120px" class="text-right"><?= 'Aksi' ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($units && count($units) > 0): ?>
                                <?php foreach ($units as $i => $unit): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= htmlspecialchars($unit['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td>
                                            <div class="btn-group float-right">
                                                <!-- Button for opening modal -->
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal-<?= $unit['id'] ?>">
                                                    <i class="fa-solid fa-edit"></i>
                                                </button>
                                                <?= btnDelete(route_to('satuan_delete', esc($unit['id'])), 'Satuan ' . esc($unit['name'])) ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak tersedia</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= modal(
    id: 'createModal',
    title: 'Tambah Satuan',
    action: '/satuan/store',
    body: inputText(
        label: 'Nama Satuan',
        type: 'text',
        name: 'name',
        value: old('name') ?? '',
        errors: session('errors.name') ?? '',
        ph: 'Masukkan Nama Satuan',
        attributes: ['required' => 'required']
    ),
) ?>
<!-- Edit Data -->
<?php foreach ($units as $unit): ?>
    <?= modal(
        id: 'editModal-' . $unit['id'],
        title: 'Ubah Satuan',
        action: route_to('satuan_update', $unit['id']),
        body: inputText(
            label: 'Nama Satuan',
            type: 'text',
            name: 'name',
            value: old('name') ?? $unit['name'],
            errors: session('errors.name') ?? '',
            ph: 'Masukkan Nama Satuan',
            attributes: ['required' => 'required']
        )
    ) ?>
<?php endforeach; ?>
<?= $this->endSection(); ?>