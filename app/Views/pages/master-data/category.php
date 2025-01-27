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
                                <th width="20px">No</th>
                                <th>Nama Kategori</th>
                                <th width="120px" class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cek Data Kategori -->
                            <?php if ($categories && count($categories) > 0): ?>
                                <?php foreach ($categories as $i => $category): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <!-- Edit Button -->
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal-<?= $category['id'] ?>">
                                                    <i class="fa-solid fa-edit"></i>
                                                </button>
                                                <!-- Delete Button -->
                                                <?= btnDelete(route_to('kategori_delete', esc($category['id'])), 'Kategori ' . esc($category['name'])) ?>
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

<!-- Modal Tambah Kategori -->
<?= modal(
    id: 'createModal',
    title: 'Tambah Kategori',
    action: route_to('kategori_store'),
    body: textInput(
        label: 'Nama Kategori',
        type: 'text',
        name: 'name',
        value: old('name') ?? '',
        errors: session('errors.name') ?? '',
        ph: 'Masukkan Nama Kategori',
        attributes: ['required' => 'required']
    ),
) ?>

<!-- Modal Ubah Kategori -->
<?php foreach ($categories as $category): ?>
    <?= modal(
        id: 'editModal-' . $category['id'],
        title: 'Ubah Kategori',
        action: route_to('kategori_update', $category['id']),
        body: textInput(
            label: 'Nama Kategori',
            type: 'text',
            name: 'name',
            value: old('name') ?? $category['name'],
            errors: session('errors.name') ?? '',
            ph: 'Masukkan Nama Kategori',
            attributes: ['required' => 'required']
        )
    ) ?>
<?php endforeach; ?>

<?= $this->endSection(); ?>