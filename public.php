<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<?php
session_start();
if($_SESSION['username']==null){
    header("Location: views/login.php?err=vui lòng đăng nhập!");
}

$success = isset($_GET['success']) ? $_GET['success'] : '';
if ($success === 'info_updated') {
    echo '<script>alert("Cập nhật thông tin thành công!");</script>';
}
$baseUrl = "http://localhost/BaiTapLonPHP/views/home-news.php?offset=1&limit=2";
$baseUrlAdmin = "http://localhost/BaiTapLonPHP/index.php?offset=1&limit=2";
$baseUrlSetting = "http://localhost/BaiTapLonPHP/views/profile.php";
$baseUrlLogout="http://localhost/BaiTapLonPHP/xulyform/handle-logout.php";
$baseUrlPostNews="http://localhost/BaiTapLonPHP/views/them-moi.php";
?>
<style>
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
<body>
    <div class="container">     
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
    <div class="container-fluid">
        <!-- Brand/logo -->
        <a class="navbar-brand" href="<?php echo $baseUrl; ?>">Tin tức</a>
        <!-- Toggle button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar items -->
        <div class="collapse navbar-collapse d-flex" id="navbarNav" style="justify-content: space-between;">
            <ul class="navbar-nav">
                 <li class="nav-item">
                    <a class="nav-link" href="<?php echo $baseUrlPostNews; ?>">Đăng bài</a>
                </li>
                <?php 
                    if($_SESSION['role']=="ADMIN"){
                        echo '
                        <li class="nav-item">
                             <a class="nav-link" href="'.$baseUrlAdmin.'">Trang chủ ADMIN</a>
                        </li>
                        ';
                        
                    }
                ?>
            </ul>
            <div>
                                <div class="user-container" style=" user-select: none;">
                                <input type="checkbox" id="userDropdownToggle">
                                <label for="userDropdownToggle" class="user-icon">
                                <i class="fa-regular fa-user"></i>
                                    <?php
                                            echo $_SESSION['username']
                                        ?></label>
                                <div class="dropdown-content">
                                    <button><a href="<?php echo $baseUrlSetting; ?>">Cài đặt</a></button>
                                    <form method="post" action="<?php echo $baseUrlLogout; ?>">
                                        <button type="submit" name="logout" value="logout">Đăng xuất</button>
                                    </form>
                                </div>
                            </div>
            </div>
        </div>
    </div>
</nav>
         
                    
    </div>
</body>
</html>