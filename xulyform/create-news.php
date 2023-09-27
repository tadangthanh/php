<?php
session_start();
$pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
include $pathNewsDAO;
$newsDAO = new NewsDAO();
$news = new News();
$news->setTitle($_POST["title"]);
$news->setCategoryId($_POST["category"]);
$news->setContent($_POST["content"]);
$news->setUserId($_SESSION['id']);
if ($newsDAO->save($news)) {
    header("Location: ../index.php?offset=1&limit=2");
}
