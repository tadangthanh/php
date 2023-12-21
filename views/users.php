<?php
 include '../public.php';
 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['role']!="ADMIN"){
    header("Location: ../views/login.php?err=Bạn không phải là admin!");
}
$pathUserDAO = __DIR__ . "\..\DAO\UserDAO.php";
$pathRoleDAO = __DIR__ . "\..\DAO\RoleDAO.php";
$pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
include $pathUserDAO;
include $pathRoleDAO;
include $pathNewsDAO;
$userDAO = new UserDAO();
$roleDAO = new RoleDAO(); 
$newsDAO= new NewsDAO();
$users = $userDAO->getAll();
$listRole = $roleDAO->getAll();
?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!--table  -->
<div class="container">
    
    <h1>Danh sách User trong hệ thống</h1>
<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Role</th>
            <th scope="col">Số bài đăng</th>
            <th scope="col">Trạng thái</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($users as $u) {
            $roleName = getRoleNameById($u->getRoleId(), $listRole);
            $count = countNews($u->getId(), $newsDAO);
            echo "
                <tr>
                    <td>" . $u->getId() . "</td>
                    <td>" . $u->getUsername() . "</td>
                    <td>" . $u->getEmail() . "</td>
                    <td>" . $u->getCreatedAt() . "</td>
                    <td>" . $roleName ."</td>
                    <td>".$count. "</td>
                    <td>" . $u->getStatus() ."</td>
                    <td>
                        <a href='user-management.php?id=".$u->getId()."' >update</a>
                    </td>
                
                </tr> 
            ";
        }
        function getRoleNameById($roleId, $listRole) {
            foreach ($listRole as $role) {
                if ($role->getId() == $roleId) {
                    return $role->getName();
                }
            }
            return "Unknown Role";
        }
        function countNews($userId, $newsDAO) {
            $list = $newsDAO->getNewsByUserId($userId);
            $numberOfElements = count($list);
            return $numberOfElements;
        }
        ?>
    </tbody>
</table>

</div>