<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Bootstrap CSS --><link rel="stylesheet" 
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }
 if($_SESSION['role']!="ADMIN"&&$_SESSION['role']!="USER"){
    header("Location: login.php?err=Bạn phải đăng nhập!");
 }
$success = isset($_GET['success']) ? $_GET['success'] : '';
if ($success === 'info_updated') {
    echo '<script>alert("Cập nhật thông tin thành công!");</script>';
}
$pathUserDAO = __DIR__ . "\..\DAO\UserDAO.php";
$pathRoleDAO = __DIR__ . "\..\DAO\RoleDAO.php";
include $pathUserDAO;
include $pathRoleDAO;
$userDAO = new UserDAO();
$roleDAO = new RoleDAO(); 
$listRole = $roleDAO->getAll();
$user= $userDAO->getById($_GET['id']);
$roleName= "";
foreach ($listRole as $r ) {
    if($user->getRoleId() == $r->getId()){
        $roleName=$r->getName();
    }
}
function getRoleIdByName($roleName,$listRole){
    foreach ($listRole as $r ) {
        if($r->getName()==$roleName){
            return $r->getId();
        }
    }
}

?>
<body>

<div class="container">
    <h1>User Management</h1>
    <a href="../views/users.php"><i class="fa-solid fa-backward"></i> Quay lại </a>
    <div class="row">
        <div class="col-md-6">
            <form action="../xulyform/update-user.php"  method="post">
                <input type="text" hidden name="id" value="<?php echo $user->getId() ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" disabled value="<?php echo $user->getUsername() ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->getEmail() ?>">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role" name="role_id">
                        <option value="<?php echo getRoleIdByName("USER",$listRole); ?>" <?php if($roleName=="USER"){echo "selected";} ?> >User</option>
                        <option value="<?php echo getRoleIdByName("ADMIN",$listRole); ?>" <?php if($roleName=="ADMIN"){echo "selected";} ?> >Admin</option>
                        <option value="<?php echo getRoleIdByName("MANAGER",$listRole); ?>" <?php if($roleName=="MANAGER"){echo "selected";} ?> >Manager</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select class="form-select" id="status" name="status">
                        <option value="1" <?php if($user->getStatus()==1){echo "selected";} ?> >Active</option>
                        <option value="0" <?php if($user->getStatus()==0){echo "selected";} ?> >Inactive</option>
                    </select>
                </div>
                <button type="submit" value="update" name="update" class="btn btn-primary">Update User</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
