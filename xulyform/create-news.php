<?php
session_start();
$pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
include $pathNewsDAO;
$newsDAO = new NewsDAO();
$news = new News();
$news->setTitle($_POST["title"]);
$news->setCategoryId($_POST["category"]);
$news->setContent($_POST["content"]);
$news->setUserId(2);
// $user_id = $_SESSION("user")->getId();
if ($newsDAO->save($news)) {
    header("Location: ../index.php");
}
