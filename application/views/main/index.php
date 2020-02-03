<?php

session_start();
include_once 'application/views/layouts/front_style.php';

use application\models\Admin;

$banners = new Admin();
$allBan = $banners->getBanners(); ?>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">My Admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span><?php echo FRONT_TITLE ?></span></a>
        </li>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <?php if (empty($_SESSION['user'])) { ?>
                        <form action="admin/index/" method="post">
                            <button class="btn btn-light">Sign in</button>
                        </form>
                    <?php }
                    if (!empty($_SESSION['user'])) { ?>
                        <form action="admin/dashboard/" method="post">
                            <button class="btn btn-light">Sign in</button>
                        </form>
                    <?php } ?>

                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid ">
                <div class="flexslider" id="flexslider-basic">
                    <ul class="slides">
                        <?php foreach ($allBan as $data => $bannerData) : ?>
                            <?php if (!$bannerData['status'] === 0) {
                                false;
                            } else { ?>
                                <li>
                                    <?php echo $bannerData['name']; ?>
                                    <a href="<?php echo $bannerData['link'] ?>" target="_blank"><img
                                                src="<?php echo $bannerData['img'] ?>" alt="">
                                </li>
                            <?php } ?>
                        <?php endforeach; ?>
                    </ul>

                </div>

            </div>
            <!-- /.container-fluid -->
            <script>
                $(function () {
                    $("#flexslider-basic").flexslider({
                        animation: "slide"
                    });
                });
            </script>
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once 'application/views/layouts/footer.php' ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
