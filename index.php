<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" 
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<?php
session_start();
if ($_SESSION['role'] !== "ADMIN") {
    header("Location: views/login.php?permission=Bạn không có quyền truy cập vào tài nguyên này!");
}
include_once('DAO/NewsDAO.php');
include_once('DAO/CategoryDAO.php');
include_once('DAO/UserDAO.php');
$categoryDAO = new CategoriesDAO();
$listCategory = $categoryDAO->getAll();
$userDAO = new UserDAO();
$dao = new NewsDAO();
// tổng số item
$totalItem = $dao->count();
// tổng số trang
$limit = isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 5;
$sumOfPage = round($totalItem / $limit) + 1;
$numPage = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
$offset = ($numPage - 1) * $limit;
$searchValue = '';
if (isset($_REQUEST['search'])) {
    $searchValue = $_REQUEST['search'];
}
$newsList = $dao->paging($limit, $offset, $searchValue);
function getCategoryNameById($id, $listCategory)
{
    foreach ($listCategory as $c) {
        if ($c->getId() == $id) {
            return $c->getName();
        }
    }
    return "";
}

?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang chủ - Admin</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
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
    }
    .user-container {

    text-align: right;
    margin: 10px;
}

.user-icon {
    cursor: pointer;
    padding: 5px;
    border: 1px solid #ccc;
    display: inline-block;
}

#userDropdownToggle {
    display: none;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content button {
    width: 100%;
    padding: 10px;
    border: none;
    text-align: left;
    background-color: inherit;
    cursor: pointer;
}

.dropdown-content button:hover {
    background-color: #ddd;
}

#userDropdownToggle:checked + .user-icon + .dropdown-content {
    display: block;
}

</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="views/home-news.php?offset=1&limit=2">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Home</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php?offset=1&limit=2">
                    <span>Quản lý bài viết</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MEnu
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="views/users.php" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Quản lý user</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Divider -->
            <hr class="sidebar-divider">
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
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow">
                            <div class="user-container" style=" user-select: none;">
                                <input type="checkbox" id="userDropdownToggle">
                                <label for="userDropdownToggle" class="user-icon">
                                <i class="fa-regular fa-user"></i>
                                    <?php
                                            echo $_SESSION['username']
                                        ?></label>
                                <div class="dropdown-content">
                                    <button><a href="views/profile.php">Cài đặt</a></button>
                                    <form method="post" action="xulyform/handle-logout.php">
                                        <button type="submit" name="logout" value="logout">Đăng xuất</button>
                                    </form>
                                </div>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-flex" style="justify-content: space-between;margin-right:100px">
                        <h1 class="h3 mb-0 text-gray-800">Quản lý bài viết</h1>
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" value="<?php echo $searchValue; ?>" class="form-control bg-light border-0 small" id="search" name="search" placeholder="Search for...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="btn-search" type="button">
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
                                                echo $totalItem;
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
                                                Số user</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $userDAO->count() ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex align-items-center">
                        <a href="views/them-moi.php" class="btn btn-primary mb-3 mr-5">Thêm bài viết mới</a>

                    </div>
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
                                        <td >" . $n->getContent() . "</td>
                                        <td>" . getCategoryNameById($n->getCategoryId(), $listCategory) . "</td>
                                        <td>" . $n->getPublishDate() . "</td>
                                        <td>" . $userDAO->getById($n->getUserId())->getUsername() . "</td>
                                        <td><a href=\"views/detail.php?id=" . $n->getId() . "\">xem chi tiết</a> </td>
                                    </tr> 
                                ";
                            }
                            ?>

                        </tbody>
                    </table>
                    <select id="offset" name="offset">
                        <?php
                        for ($i = 1; $i <= $sumOfPage; $i++) {
                            if ($numPage == $i) {
                                echo "<option selected value=\"index.php?offset=" . $i . "\">Trang " . $i . "</option>";
                            } else {
                                echo "<option value=\"index.php?offset=" . $i    . "\">Trang " . $i . "</option>";
                            }
                        }
                        ?>
                    </select>
                    Số bản ghi:
                    <select class="ml-2" id="limit" name="limit">
                        <option <?php if ($limit == 2) {
                                    echo "selected";
                                } ?> value="2">2</option>
                        <option <?php if ($limit == 5) {
                                    echo "selected";
                                } ?> value="5">5</option>
                        <option <?php if ($limit == 10) {
                                    echo "selected";
                                } ?> value="10">10</option>
                        <option <?php if ($limit == 15) {
                                    echo "selected";
                                } ?> value="15">15</option>
                        <option <?php if ($limit == 20) {
                                    echo "selected";
                                } ?> value="20">20</option>
                    </select>
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
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <script>
        document.getElementById("offset").addEventListener("change", function() {
            var limit = document.getElementById('limit').value;
            let searchValue = document.getElementById('search').value;
            var selectedValue = this.value += "&limit=" + limit + "&search=" + searchValue;
            if (selectedValue !== "") {
                window.location.href = selectedValue;
            }
        });

        document.getElementById("limit").addEventListener("change", function() {
            var limit = document.getElementById('offset').value;
            let searchValue = document.getElementById('search').value;
            var selectedValue = "index.php?offset=1&search="+searchValue+ "&limit=" + this.value;
            if (selectedValue !== "") {
                window.location.href = selectedValue;
            }
        });
        document.querySelector('#btn-search').addEventListener('click', () => {
            let searchValue = document.getElementById('search').value;
            window.location.href = "index.php?offset=1&limit=2&search=" + searchValue;
        });
    </script>


</body>

</html>