<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between flex-wrap gap-2">
        <?= filter([
            [
                'idSelect' => 'categoryFilter',
                'label' => 'Kategori',
                'dataOption' => array_column($categories, 'name', 'id'),
            ],
            [
                'idSelect' => 'unitFilter',
                'label' => 'Satuan',
                'dataOption' => array_column($units, 'name', 'id'),
            ]
        ]) ?>
    </div>

    <div class="card-body">
        <table class="table table-responsive" id="myTable">
            <thead id="productContainer" class="row">
            </thead>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->include('script/product_sale_script') ?>