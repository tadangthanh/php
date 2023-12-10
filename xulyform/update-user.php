<?php
session_start();
$pathUserDAO = __DIR__ . "\..\DAO\UserDAO.php";
$pathRoleDAO = __DIR__ . "\..\DAO\RoleDAO.php";
include $pathUserDAO;
include $pathRoleDAO;
$userDAO = new UserDAO();
if (isset($_REQUEST['update'])) {
    $roleId= $_REQUEST['role_id'];
    $email = $_REQUEST['email'];
    $userId = $_REQUEST['id'];
    $status = $_REQUEST['status'];
    echo $roleId;
    echo $email;
    $result = $userDAO->updateUserById($userId,$email,$roleId,$status);
    if($result!==null){ 
        header("Location: ../views/user-management.php?success=info_updated&id=".$userId."");
    }
}