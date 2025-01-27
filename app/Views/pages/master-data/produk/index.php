<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <a href="<?= base_url('/produk/create') ?>" class="btn btn-sm border-0 mx-1 btn-success"> <i class="fa-solid fa-circle-plus"></i> Produk</a>
                    <button class="btn btn-sm border-0 mx-1 btn-info"><i class="fa-solid fa-circle-plus"></i> Multi</button>
                    <button id="deleteSelected" class="btn btn-sm border-0 mx-1 btn-danger"><i class="fa-solid fa-trash"></i> Hapus Terpilih</button>
                </div>
                <div class="d-flex">
                    <select id="categoryFilter" class="form-control form-control-sm">
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select id="unitFilter" class="form-control form-control-sm">
                        <option value="">Pilih Unit</option>
                        <?php foreach ($units as $unit): ?>
                            <option value="<?= $unit->id ?>"><?= $unit->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button id="refreshButton" class="btn btn-secondary btn-sm">
                        <i class="fa-solid fa-rotate-right"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- Tabel Data Produk -->
                <div class="table-responsive">
                    <table id="myTable" class="table table-sm table-bordered my-2">
                        <thead>
                            <tr>
                                <th width="w">
                                    <input type="checkbox" class="form-check-input" id="selectAll"> Pilih
                                </th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Satuan/Unit</th>
                                <th>Modal</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->include('script/produk_script') ?>