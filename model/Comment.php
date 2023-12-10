<?php
class Comment
{
    private $id;
    private $comment_date;
    private $content;
    private $user_id;
    private $news_id;

    // Getter cho thuộc tính $id
    public function getId()
    {
        return $this->id;
    }

    // Setter cho thuộc tính $id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter cho thuộc tính $comment_date
    public function getCommentDate()
    {
        return $this->comment_date;
    }

    // Setter cho thuộc tính $comment_date
    public function setCommentDate($comment_date)
    {
        $this->comment_date = $comment_date;
    }

    // Getter cho thuộc tính $content
    public function getContent()
    {
        return $this->content;
    }

    // Setter cho thuộc tính $content
    public function setContent($content)
    {
        $this->content = $content;
    }

    // Getter cho thuộc tính $user_id
    public function getUserId()
    {
        return $this->user_id;
    }

    // Setter cho thuộc tính $user_id
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    // Getter cho thuộc tính $news_id
    public function getNewsId()
    {
        return $this->news_id;
    }

    // Setter cho thuộc tính $news_id
    public function setNewsId($news_id)
    {
        $this->news_id = $news_id;
    }
}
