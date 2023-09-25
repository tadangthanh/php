<?php
class Comment
{
    private $id;
    private $comment_date;
    private $content;
    private User $user;
    private News $news;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCommentDate()
    {
        return $this->comment_date;
    }

    public function setCommentDate($comment_date)
    {
        $this->comment_date = $comment_date;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getNews()
    {
        return $this->news;
    }

    public function setNews(News $news)
    {
        $this->news = $news;
    }
}
