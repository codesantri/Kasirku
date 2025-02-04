<?= $this->include('layouts/header') ?>
<style>
    td.dt-empty {
        display: none !important;
    }
</style>
<?= $this->include('components/topbar') ?>
<?= $this->include('components/header') ?>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper container">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <?= $this->include('components/page_title') ?>
                        <?= $this->renderSection('content'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('layouts/footer') ?>