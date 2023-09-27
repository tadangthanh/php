<?php
$pathNewsDAO = __DIR__ . "\..\DAO\NewsDAO.php";
$pathCategoryDAO = __DIR__ . "\..\DAO\CategoryDAO.php";
include $pathNewsDAO;
include $pathCategoryDAO;
$categoryDAO = new CategoriesDAO();
$newsDAO = new NewsDAO();
$news = new News();
$news->setContent($_POST['content']);
$news->setId($_POST['id']);
$news->setTitle($_POST['title']);
$news->setCategoryId($_POST['category']);
$news->setUserId($_POST['user_id']);

if ($newsDAO->update($news)) {
    header("Location: ../index.php?offset=1&limit=2");
}
