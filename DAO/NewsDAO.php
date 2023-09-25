<?php
include('Util/Connection.php');
include('model/News.php');
class NewsDAO
{
    public function getAll()
    {
        $newsList = array();
        $conn = Connect::getConnection();
        $sqlQuery = "select n.title,n.id,n.content,c.name,n.image_url,n.publish_date,u.username from News as n inner join users as u on n.user_id=u.id inner join categories as c on c.id=n.category_id";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $news = new News();
                $news->setId($row["id"]);
                $news->setContent($row["content"]);
                $news->setImgUrl($row["image_url"]);
                $news->setTitle($row["title"]);
                $news->setPublishDate($row["publish_date"]);
                $news->setAuthor($row["username"]);
                $news->setCategory($row['name']);
                array_push($newsList, $news);
            }
        }
        return $newsList;
    }

    public function getById($id)
    {
        $news = new News();
        $conn = Connect::getConnection();
        $sqlQuery = "select n.title,n.id,n.content,c.name,n.image_url,n.publish_date,u.username from News as n inner join users as u on n.user_id=u.id inner join categories as c on c.id=n.category_id where n.id=" + $id;
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            if ($row = mysqli_fetch_array($result)) {
                $news->setId($row["id"]);
                $news->setContent($row["content"]);
                $news->setImgUrl($row["image_url"]);
                $news->setTitle($row["title"]);
                $news->setPublishDate($row["publish_date"]);
                $news->setAuthor($row["username"]);
                $news->setCategory($row['name']);
            }
        }
        return $news;
    }
}
