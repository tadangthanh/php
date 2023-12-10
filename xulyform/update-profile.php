<?php
session_start();
$pathUserDAO = __DIR__ . "\..\DAO\UserDAO.php";
$pathRoleDAO = __DIR__ . "\..\DAO\RoleDAO.php";
include $pathUserDAO;
include $pathRoleDAO;
$userDAO = new UserDAO();
if (isset($_REQUEST['update'])) {
    $username= $_SESSION['username'];
    $password= $_REQUEST['password'];
    $re_password=$_REQUEST['re-password'];
    $email = $_REQUEST['email'];
    if($password==$re_password){
        $result = $userDAO->updateEmailPasswordByUsername($username,$email,$password);
        if($result!==null){
            $_SESSION['email']=$email;   
            header("Location: ../public.php?success=info_updated");
        }
    }else{
        header("Location: ../views/profile.php?error=password");
    }

}