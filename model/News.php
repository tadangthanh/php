<?php
class News
{
    private $id;
    private Categories $category;
    private $content;
    private $img_url;
    private $publish_date;
    private $title;
    private Author $author;
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Categories $category)
    {
        $this->category = $category;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getImgUrl()
    {
        return $this->img_url;
    }

    public function setImgUrl($img_url)
    {
        $this->img_url = $img_url;
    }

    public function getPublishDate()
    {
        return $this->publish_date;
    }

    public function setPublishDate($publish_date)
    {
        $this->publish_date = $publish_date;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }
}
