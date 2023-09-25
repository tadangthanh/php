<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// if ($_SESSION['role'] !== "ADMIN") {
//     header("Location: views/login.php?permission=Bạn không có quyền truy cập vào tài nguyên này!");
// }
include_once('DAO/NewsDAO.php');
$dao = new NewsDAO();
$newsList = $dao->getAll();
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang chủ - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 150px;
        /* Đặt kích thước tối đa của cột */
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Quản lý bài viết</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="views/login.php" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="data:image/jpeg;base64,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">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex" style="justify-content: space-between;">
                        <h1 class="h3 mb-0 text-gray-800">Quản lý bài viết</h1>
                        <form class="">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Số bài viết</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                echo count($newsList);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a href="views/them-moi.php" class="btn btn-primary mb-3">Thêm bài viết mới</a>
                    <!--table  -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tiêu đề</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col">Ngày đăng</th>
                                <th scope="col">Người đăng</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($newsList as $n) {
                                echo
                                "
                                    <tr>
                                        <td>" . $n->getTitle() . "</td>
                                        <td>" . $n->getContent() . "</td>
                                        <td>" . $n->getCategoryId() . "</td>
                                        <td>" . $n->getPublishDate() . "</td>
                                        <td>" . $n->getUserId() . "</td>
                                        <td><a href=\"views/detail.php?id=" . $n->getId() . "\">xem chi tiết</a> </td>
                                    </tr> 
                                ";
                            }
                            ?>

                        </tbody>
                    </table>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>