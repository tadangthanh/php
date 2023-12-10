<?php
session_start();
$pathCommentDAO = __DIR__ . "\..\DAO\CommentDAO.php";
include $pathCommentDAO;
$commentDAO = new CommentDAO();
if(isset($_POST['postcomment'])){
    $idUser = $_POST['userId'];
    $newsId = $_POST['newsId'];
    $content = $_POST['content'];
    if($commentDAO->postComment($newsId,$idUser,$content)){
        header("Location: ../views/news-detail.php?id=$newsId");
    }
}
