<?php

class Task
{
    private $id;
    private $title;
    private $description;
    private $important;
    private $completed;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function isImportant()
    {
        return $this->important;
    }

    public function setImportant($important)
    {
        $this->important = $important;
    }

    public function getCompleted()
    {
        return $this->completed;
    }

    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    public function isCompleted()
    {
        return $this->completed;
    }
}