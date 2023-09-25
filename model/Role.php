<?php
class Role
{
    private $id;
    private $name;


    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        return $this->name = $name;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }
}
