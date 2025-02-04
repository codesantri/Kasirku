<?= $this->include('layouts/header') ?>
<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
    <div class="auth-content text-center">
        <div class="card borderless">
            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="card-body">
                        <img src="<?= base_url('logo-primary.png') ?>" alt="" class="img-fluid" width="50">
                        <h4 class="mb-3 f-w-400">Kasirku</h4>
                        <hr>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" id="Email" placeholder="Email address">
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" class="form-control" id="Password" placeholder="Password">
                        </div>
                        <!-- <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Ingatkan Saya</label>
                        </div> -->
                        <a href="<?= route_to('dashboard') ?>" class="btn btn-block btn-primary text-white mb-4">Signin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('layouts/footer') ?>