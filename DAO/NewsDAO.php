<?php
// include_once('Util/Connection.php');
$pathConnection = __DIR__ . "\..\Util\Connection.php";
$pathNewsModel = __DIR__ . "\..\model\News.php";
include_once $pathConnection;
include_once $pathNewsModel;
class NewsDAO
{
    public function getAll()
    {
        $newsList = array();
        $conn = Connect::getConnection();

        $sqlQuery = "select n.title,n.id,n.content,c.id as cid,n.publish_date,u.id as uid from News as n inner join users as u on n.user_id=u.id inner join categories as c on c.id=n.category_id";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $news = new News();
                $news->setId($row["id"]);
                $news->setContent($row["content"]);
                $news->setTitle($row["title"]);
                $news->setPublishDate($row["publish_date"]);
                $news->setUserId($row["uid"]);
                $news->setCategoryId($row['cid']);
                array_push($newsList, $news);
            }
        }
        return $newsList;
    }

    public function paging($limit, $offset, $search)
    {
        $newsList = array();
        $conn = Connect::getConnection();
        $sqlQuery = "select n.title,n.id,n.content,c.id as cid,n.publish_date,u.id as uid,u.username from News as n inner join users as u on n.user_id=u.id inner join categories as c on c.id=n.category_id where n.title like '%$search%' or n.content like '%$search%' or u.username like '%$search%' order by n.id asc limit " . $limit . " offset " . $offset;
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $news = new News();
                $news->setId($row["id"]);
                $news->setContent($row["content"]);
                $news->setTitle($row["title"]);
                $news->setPublishDate($row["publish_date"]);
                $news->setUserId($row["uid"]);
                $news->setCategoryId($row['cid']);
                array_push($newsList, $news);
            }
        }
        return $newsList;
    }
    public function count()
    {
        $conn = Connect::getConnection();
        $sqlQuery = "select count(*) from news";
        $result = mysqli_query($conn, $sqlQuery);
        return mysqli_fetch_array($result)[0];
    }
    public function update(News $news)
    {
        $conn = Connect::getConnection();
        $sqlQuery = "update news set content='" . $news->getContent() . "',title='" . $news->getTitle() . "',category_id='" . $news->getCategoryId() . "' where id='" . $news->getId() . "'";
        $result = mysqli_query($conn, $sqlQuery);
        return $result;
    }

    public function getById($id)
    {
        $news = new News();
        $conn = Connect::getConnection();
        $sqlQuery = "select n.title,n.id,n.content,c.id as cid,n.publish_date,u.id as uid from News as n inner join users as u on n.user_id=u.id inner join categories as c on c.id=n.category_id where n.id=" . $id;
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            if ($row = mysqli_fetch_array($result)) {
                $news->setId($row["id"]);
                $news->setContent($row["content"]);
                $news->setTitle($row["title"]);
                $news->setPublishDate($row["publish_date"]);
                $news->setUserId($row["uid"]);
                $news->setCategoryId($row['cid']);
            }
        }
        return $news;
    }

    public function save(News $news)
    {
        $conn = Connect::getConnection();
        $sqlQuery = "insert into news (title, content, publish_date, category_id, user_id) VALUES ('" . $news->getTitle() . "', '" . $news->getContent() . "', '" . date("Y-m-d") . "', '" . $news->getCategoryId() . "', '" . $news->getUserId() . "')";
        $result = mysqli_query($conn, $sqlQuery);
        return $result;
    }
}
