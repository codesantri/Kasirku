<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">
            <div class="">
                <div class="main-menu-header">
                    <img class="img-radius" src="<?= base_url('male.png') ?>" alt="User-Profile-Image">
                    <div class="user-details">
                        <span>Murtaki Shihab</span>
                        <div id="more-details">Kasir<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                        <li class="list-group-item"><a href="auth-normal-sign-in.html"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <?= $this->include('components/sidebar_menu'); ?>
        </div>
    </div>
</nav>