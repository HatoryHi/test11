<?php require_once(BACK_END_STYLES); ?>
<?php session_start() ?>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
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
                <span>Backend</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hi, <?php echo strtoupper(
                                    $_SESSION['user']
                                ); ?></span>
                        </a>
                    </li>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <form action="/admin/logout" method="post">
                                <button class="btn btn-success">Logout</button>
                            </form>

                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"> </span>
                        </a>
                </ul>
            </nav>

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                <form action="/admin/create" method="post">
                    <button class="btn btn-success">Add banner</button>
                </form>
                <br>
                <table class="table">
                    <thead>
                    <?php var_dump($_SESSION); ?>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Link</th>
                        <th scope="col">Status</th>
                        <th scope="col">Position</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php use application\models\Admin;

                    $banners = new Admin();
                    $allBanners = $banners->getBanners(); ?>
                    <?php foreach ($allBanners as $item => $value) : ?>
                        <tr>
                            <th><?php echo $value['id'] ?></th>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['img'] ?></td>
                            <td><?php echo $value['link'] ?></td>
                            <td><?php echo $value['status'] ?></td>
                            <td><?php echo $value['pos'] ?></td>

                            <td>
                                <form action="/admin/delete" method="post">
                                    <button name="del" class="btn btn-danger" value="<?php echo $value['id'] ?>">
                                        Delete
                                    </button>
                                </form>
                                <form action="/admin/edit" method="post">
                                    <button name="edt" class="btn btn-primary" value="<?php echo $value['id'] ?>">
                                        Edit
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
    <!-- End of Content Wrapper -->
</div>
</body>
<?php include_once 'application/views/layouts/footer.php' ?>

