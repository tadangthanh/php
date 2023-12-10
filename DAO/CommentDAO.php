<?php
$pathConnection = __DIR__ . "\..\Util\Connection.php";
$pathNewsModel = __DIR__ . "\..\model\News.php";
$pathUserModel = __DIR__ . "\..\model\User.php";
$pathCommentModel = __DIR__ . "\..\model\Comment.php";
include_once $pathConnection;
include_once $pathNewsModel;
include_once $pathUserModel;
include_once $pathCommentModel;
class CommentDAO{
    public function getAll()
    {
        $listComment = array();
        $conn = Connect::getConnection();

        $sqlQuery = "select * from comments";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $comment = new Comment();
                $comment->setId($row["id"]);
                $comment->setNewsId($row["news_id"]);
                $comment->setUserId($row["user_id"]);
                $comment->setCommentDate($row["comment_date"]);
                $comment->setContent($row["content"]);

                array_push($listComment, $comment);
            }
        }
        return $listComment;
    }
    public function postComment($idNews,$idUser,$content){
        $conn = Connect::getConnection();
        $currentDateTime = date('Y-m-d H:i:s', time());
        $sqlQuery = "insert into comments (news_id,user_id,content,comment_date) values($idNews,$idUser,'$content','$currentDateTime')";
        $result = mysqli_query($conn, $sqlQuery);
        return $result;
    }
    public function loadCommentByNewsId($id){
        $commentList = array();
        $conn = Connect::getConnection();
        $sqlQuery = "select * from comments where news_id= $id";
        $result = mysqli_query($conn, $sqlQuery);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $comment = new Comment();
                $comment->setId($row["id"]);
                $comment->setNewsId($row["news_id"]);
                $comment->setUserId($row["user_id"]);
                $comment->setCommentDate($row["comment_date"]);
                $comment->setContent($row["content"]);

                array_push($commentList, $comment);
            }
        }
        return $commentList;
    }
    public function deleteByNewsId($id){
        $conn = Connect::getConnection();
        $sqlQuery = "delete from comments where news_id= $id";
        $result = mysqli_query($conn, $sqlQuery);
        return $result;
    }
}