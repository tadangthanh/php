<?php
$pathUserDAO = __DIR__ . "\..\DAO\UserDAO.php";
$pathRoleDAO = __DIR__ . "\..\DAO\RoleDAO.php";
include $pathUserDAO;
include $pathRoleDAO;
$userDAO = new UserDAO();
$roleDAO = new RoleDAO(); 
$listRole = $roleDAO->getAll();
// login
if (isset($_REQUEST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $userDAO->getByUsernameAndPassword($username, $password);
    if ($user->getUsername() === null) {
        header("Location: ../views/login.php?err=Tài khoản hoặc mật khẩu không chính xác!");
    } else {
        session_start();
        foreach ($listRole as $role) {
            if ($user->getRoleId() == $role->getId()) {
                $_SESSION['role'] = $role->getName();
            }
        }
        $_SESSION['email']=$user->getEmail();
        $_SESSION['created_at']=$user->getCreatedAt();
        $_SESSION['id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        header("Location: ../views/home-news.php?offset=1&limit=2");
    }

    // register
} else if (isset($_REQUEST['register'])) {
    $username = $_POST['username'];
    $user = new User();
    $user = $userDAO->getByUsername($username);
    if ($user->getUsername()) {
        header("Location: ../views/login.php?register=true&err=Username đã tồn tại");
    } else if (strlen($username) < 3) {
        header("Location: ../views/login.php?register=true&err=Tối thiểu 3 kí tự");
    } else {
        $user->setUsername($username);
        $user->setPassword($_POST['password']);
        $user->setEmail($_POST['email']);
        if ($userDAO->save($user)) {
            session_start();
            $_SESSION['username'] = $user->getUsername();
            foreach ($listRole as $role) {
                if ($user->getRoleId() == $role->getId()) {
                    $_SESSION['role'] = $role->getName();
                }
            }
        }
    }
}
