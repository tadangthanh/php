<?php
session_start();
$pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
$pathCommentDAO = __DIR__ . "\..\DAO\CommentDAO.php";
include $pathNewsDAO;
include $pathCommentDAO;
$newsDAO = new NewsDAO();
$commentDAO = new CommentDAO();
$commentDAO->deleteByNewsId($_GET['id']);
$result =$newsDAO->deleteNewsById($_GET['id']);
if($result){
    if(isset($_GET['fowarde'])){
        header("Location: ../views/home-news.php?offset=1&limit=2");
    }
    else {
        header("Location: ../index.php?offset=1&limit=2");
    }
}
