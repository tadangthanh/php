<?php

include('DAO/NewsDAO.php');
$dao = new NewsDAO();
$data = array($dao->getAll());
$newsList = $dao->getAll();
if (!empty($newsList)) {
    foreach ($newsList as $news) {
        echo "ID: " . $news->getId() . "<br>";
        echo "Title: " . $news->getTitle() . "<br>";
        echo "Content: " . $news->getContent() . "<br>";
        echo "Image URL: " . $news->getImgUrl() . "<br>";
        echo "<hr>";
    }
} else {
    echo "Không có tin tức nào.";
}
