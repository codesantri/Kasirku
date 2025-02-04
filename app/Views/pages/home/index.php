<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Selamat Datang dihalaman Penjualan</h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info mb-0" role="alert">
                    <p class="mb-0">
                        Silahkan Menuju kehalaman Produk Untuk Memulai Transaksi Penjualan Produk Anda!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 col-xl-4">
        <div class="card support-bar overflow-hidden">
            <div class="card-body pb-0">
                <h3 class="text-c-blue">Total Pendapatan</h3>
                <h2 class="m-0"><?= rp($totalRevenue) ?></h2>
                <p class="mb-3 mt-3">Total pendapatan penjualan produk toko.</p>
            </div>
            <!-- <div class="card-footer bg-primary text-white">
                <div class="row text-center">
                    <div class="col">
                        <span>Modal</span>
                        <h5 class="m-0 text-white"><?= rp($totalCapital) ?></h5>
                    </div>
                    <div class="col">
                        <span>Selisih</span>
                        <h5 class="m-0 text-white"><?= $percentageDifference ?>%</h5>
                    </div>
                    <div class="col">
                        <span>Laba</span>
                        <h5 class="m-0 text-white"><?= rp($totalProfit) ?></h5>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- table card-1 start -->
    <div class="col-md-12 col-xl-4">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-2">
                            <!-- <i class="icon feather icon-eye text-c-green mb-1 d-block"></i> -->
                            <i class="fa-solid fa-bag-shopping text-c-green"></i>
                        </div>
                        <div class="col-sm-6">
                            <h5><?= $countProduct ?></h5>
                            <span>Produk</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <i class="fa-solid fa-business-time text-c-red"></i>
                        </div>
                        <div class="col-sm-6">
                            <h5><?= $totalStock ?></h5>
                            <span>Stok</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-2">
                            <i class="fa-solid fa-chevron-up text-c-green"></i>
                        </div>
                        <div class="col-sm-8 ">
                            <h5>2000 +</h5>
                            <span>Stok Masuk</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <i class="fa-solid fa-chevron-down text-c-red"></i>
                        </div>
                        <div class="col-sm-8 ">
                            <h5>2000 +</h5>
                            <span>Stok Keluar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- widget primary card start -->
    </div>
    <div class="col-md-12 col-xl-4">
        <div class="card flat-card">
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-2">
                            <i class="icon feather icon-calendar text-c-blue mb-1 d-block"></i>
                        </div>
                        <div class="col-sm-10 text-md-center">
                            <h5>Rp <?= rp($revenueToday) ?></h5>
                            <span>Pendapatan Hari Ini</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <i class="icon feather icon-calendar text-c-blue mb-1 d-block"></i>
                        </div>
                        <div class="col-sm-10 text-md-center">
                            <h5>Rp <?= rp($revenueThisWeek) ?></h5>
                            <span>Pendapatan Minggu Ini</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-table">
                <div class="col-sm-6 card-body br">
                    <div class="row">
                        <div class="col-sm-2">
                            <i class="icon feather icon-calendar text-c-blue mb-1 d-block"></i>
                        </div>
                        <div class="col-sm-10 text-md-center">
                            <h5>Rp <?= rp($revenueThisMonth) ?></h5>
                            <span>Pendapatan Bulan Ini</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <i class="icon feather icon-calendar text-c-blue mb-1 d-block"></i>
                        </div>
                        <div class="col-sm-10 text-md-center">
                            <h5>Rp <?= rp($revenueThisYear) ?></h5>
                            <span>Pendapatan Tahun Ini</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-between">
    <div class="card col-md-3 flat-card widget-primary-card">
        <div class="row-table">
            <div class="col-sm-3 card-body">
                <i class="feather icon-star-on"></i>
            </div>
            <div class="col-sm-9">
                <h6>Modal</h6>
                <h4><?= rp($totalCapital) ?></h4>
            </div>
        </div>
    </div>
    <div class="card col-md-3 flat-card widget-primary-card">
        <div class="row-table">
            <div class="col-sm-3 card-body">
                <i class="feather icon-star-on"></i>
            </div>
            <div class="col-sm-9">
                <h6>Selisih</h6>
                <h4><?= $percentageDifference ?> %</h4>
            </div>
        </div>
    </div>
    <div class="card col-md-3 flat-card widget-primary-card">
        <div class="row-table">
            <div class="col-sm-3 card-body">
                <i class="feather icon-star-on"></i>
            </div>
            <div class="col-sm-9">
                <h6>Laba</h6>
                <h4><?= rp($totalProfit) ?></h4>
            </div>
        </div>
    </div>
</div>
<div class="row">



    <!-- table card-1 end -->
    <!-- table card-2 start -->

    <!-- table card-2 end -->
    <!-- Widget primary-success card start -->

    <!-- Widget primary-success card end -->

    <!-- prject ,team member start -->
    <div class="col-xl-6 col-md-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Projects</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>
                                    <div class="chk-option">
                                        <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                    Assigned
                                </th>
                                <th>Name</th>
                                <th>Due Date</th>
                                <th class="text-right">Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="chk-option">
                                        <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <img src="assets/images/user/avatar-4.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                        <div class="d-inline-block">
                                            <h6>John Deo</h6>
                                            <p class="text-muted m-b-0">Graphics Designer</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Able Pro</td>
                                <td>Jun, 26</td>
                                <td class="text-right"><label class="badge badge-light-danger">Low</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="chk-option">
                                        <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                        <div class="d-inline-block">
                                            <h6>Jenifer Vintage</h6>
                                            <p class="text-muted m-b-0">Web Designer</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Mashable</td>
                                <td>March, 31</td>
                                <td class="text-right"><label class="badge badge-light-primary">high</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="chk-option">
                                        <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                        <div class="d-inline-block">
                                            <h6>William Jem</h6>
                                            <p class="text-muted m-b-0">Developer</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Flatable</td>
                                <td>Aug, 02</td>
                                <td class="text-right"><label class="badge badge-light-success">medium</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="chk-option">
                                        <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-label"></span>
                                        </label>
                                    </div>
                                    <div class="d-inline-block align-middle">
                                        <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                        <div class="d-inline-block">
                                            <h6>David Jones</h6>
                                            <p class="text-muted m-b-0">Developer</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Guruable</td>
                                <td>Sep, 22</td>
                                <td class="text-right"><label class="badge badge-light-primary">high</label></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12">
        <div class="card latest-update-card">
            <div class="card-header">
                <h5>Latest Updates</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="latest-update-box">
                    <div class="row p-t-30 p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline-flex">2 hrs ago</p>
                            <i class="feather icon-twitter bg-twitter update-icon"></i>
                        </div>
                        <div class="col">
                            <a href="#!">
                                <h6>+ 1652 Followers</h6>
                            </a>
                            <p class="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>
                        </div>
                    </div>
                    <div class="row p-b-30">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline-flex">4 hrs ago</p>
                            <i class="feather icon-briefcase bg-c-red update-icon"></i>
                        </div>
                        <div class="col">
                            <a href="#!">
                                <h6>+ 5 New Products were added!</h6>
                            </a>
                            <p class="text-muted m-b-0">Congratulations!</p>
                        </div>
                    </div>
                    <div class="row p-b-0">
                        <div class="col-auto text-right update-meta">
                            <p class="text-muted m-b-0 d-inline-flex">2 day ago</p>
                            <i class="feather icon-facebook bg-facebook update-icon"></i>
                        </div>
                        <div class="col">
                            <a href="#!">
                                <h6>+1 Friend Requests</h6>
                            </a>
                            <p class="text-muted m-b-10">This is great, keep it up!</p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tr>
                                        <td class="b-none">
                                            <a href="#!" class="align-middle">
                                                <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                                <div class="d-inline-block">
                                                    <h6>Jeny William</h6>
                                                    <p class="text-muted m-b-0">Graphic Designer</p>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a href="#!" class="b-b-primary text-primary">View all Projects</a>
                </div>
            </div>
        </div>
    </div>
    <!-- prject ,team member start -->
    <!-- seo start -->
    <div class="col-xl-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3>$16,756</h3>
                        <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                    </div>
                    <div class="col-6">
                        <div id="seo-chart1" class="d-flex align-items-end"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3>49.54%</h3>
                        <h6 class="text-muted m-b-0">Bounce Rate<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                    </div>
                    <div class="col-6">
                        <div id="seo-chart2" class="d-flex align-items-end"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3>1,62,564</h3>
                        <h6 class="text-muted m-b-0">Products<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                    </div>
                    <div class="col-6">
                        <div id="seo-chart3" class="d-flex align-items-end"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- seo end -->

    <!-- Latest Customers start -->
    <div class="col-lg-8 col-md-12">
        <div class="card table-card review-card">
            <div class="card-header borderless ">
                <h5>Customer Reviews</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                <div class="review-block">
                    <div class="row">
                        <div class="col-sm-auto p-r-0">
                            <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius profile-img cust-img m-b-15">
                        </div>
                        <div class="col">
                            <h6 class="m-b-15">John Deo <span class="float-right f-13 text-muted"> a week ago</span></h6>
                            <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                            <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                            <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                            <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                            <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                            <p class="m-t-15 m-b-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <a href="#!" class="m-r-30 text-muted"><i class="feather icon-thumbs-up m-r-15"></i>Helpful?</a>
                            <a href="#!"><i class="feather icon-heart-on text-c-red m-r-15"></i></a>
                            <a href="#!"><i class="feather icon-edit text-muted"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-auto p-r-0">
                            <img src="assets/images/user/avatar-4.jpg" alt="user image" class="img-radius profile-img cust-img m-b-15">
                        </div>
                        <div class="col">
                            <h6 class="m-b-15">Allina D’croze <span class="float-right f-13 text-muted"> a week ago</span></h6>
                            <a href="#!"><i class="feather icon-star-on f-18 text-c-yellow"></i></a>
                            <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                            <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                            <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                            <a href="#!"><i class="feather icon-star f-18 text-muted"></i></a>
                            <p class="m-t-15 m-b-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <a href="#!" class="m-r-30 text-muted"><i class="feather icon-thumbs-up m-r-15"></i>Helpful?</a>
                            <a href="#!"><i class="feather icon-heart-on text-c-red m-r-15"></i></a>
                            <a href="#!"><i class="feather icon-edit text-muted"></i></a>
                            <blockquote class="blockquote m-t-15 m-b-0">
                                <h6>Allina D’croze</h6>
                                <p class="m-b-0 text-muted">Lorem Ipsum is simply dummy text of the industry.</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Power</h5>
                        <h2>2789<span class="text-muted m-l-5 f-14">kw</span></h2>
                        <div id="power-card-chart1"></div>
                        <div class="row">
                            <div class="col col-auto">
                                <div class="map-area">
                                    <h6 class="m-0">2876 <span> kw</span></h6>
                                    <p class="text-muted m-0">month</p>
                                </div>
                            </div>
                            <div class="col col-auto">
                                <div class="map-area">
                                    <h6 class="m-0">234 <span> kw</span></h6>
                                    <p class="text-muted m-0">Today</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Temperature</h5>
                        <h2>7.3<span class="text-muted m-l-10 f-14">deg</span></h2>
                        <div id="power-card-chart3"></div>
                        <div class="row">
                            <div class="col col-auto">
                                <div class="map-area">
                                    <h6 class="m-0">4.5 <span> deg</span></h6>
                                    <p class="text-muted m-0">month</p>
                                </div>
                            </div>
                            <div class="col col-auto">
                                <div class="map-area">
                                    <h6 class="m-0">0.5 <span> deg</span></h6>
                                    <p class="text-muted m-0">Today</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card chat-card">
            <div class="card-header">
                <h5>Chat</h5>
                <div class="card-header-right">
                    <div class="btn-group card-option">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="feather icon-more-horizontal"></i>
                        </button>
                        <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                            <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                            <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                            <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row m-b-20 received-chat">
                    <div class="col-auto p-r-0">
                        <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40">
                    </div>
                    <div class="col">
                        <div class="msg">
                            <p class="m-b-0">Nice to meet you!</p>
                        </div>
                        <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                    </div>
                </div>
                <div class="row m-b-20 send-chat">
                    <div class="col">
                        <div class="msg">
                            <p class="m-b-0">Nice to meet you!</p>
                        </div>
                        <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                    </div>
                    <div class="col-auto p-l-0">
                        <img src="assets/images/user/avatar-3.jpg" alt="user image" class="img-radius wid-40">
                    </div>
                </div>
                <div class="row m-b-20 received-chat">
                    <div class="col-auto p-r-0">
                        <img src="assets/images/user/avatar-2.jpg" alt="user image" class="img-radius wid-40">
                    </div>
                    <div class="col">
                        <div class="msg">
                            <p class="m-b-0">Nice to meet you!</p>
                            <img src="assets/images/widget/dashborad-1.jpg" alt="">
                            <img src="assets/images/widget/dashborad-3.jpg" alt="">
                        </div>
                        <p class="text-muted m-b-0"><i class="fa fa-clock-o m-r-10"></i>10:20am</p>
                    </div>
                </div>
                <div class="input-group m-t-15">
                    <input type="text" name="task-insert" class="form-control" id="Project" placeholder="Send message">
                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="feather icon-message-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Total Leads</h5>
                <p class="text-c-green f-w-500"><i class="fa fa-caret-up m-r-15"></i> 18% High than last month</p>
                <div class="row">
                    <div class="col-4 b-r-default">
                        <p class="text-muted m-b-5">Overall</p>
                        <h5>76.12%</h5>
                    </div>
                    <div class="col-4 b-r-default">
                        <p class="text-muted m-b-5">Monthly</p>
                        <h5>16.40%</h5>
                    </div>
                    <div class="col-4">
                        <p class="text-muted m-b-5">Day</p>
                        <h5>4.56%</h5>
                    </div>
                </div>
            </div>
            <div id="tot-lead" style="height:150px"></div>
        </div>
    </div>
    <!-- Latest Customers end -->
</div>
<?= $this->endSection(); ?>