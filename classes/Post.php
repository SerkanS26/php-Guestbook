<?php

class Post {
    private string $title;
    private $date;
    private string $content;
    private string $name;

    function __construct (string $title, string $content, string $name) {
        $this->title = $title;
        $this->content = $content;
        $this->name = $name;
    }

    public function getTitle () {
        return $this->title;
    }

    public function getDate ($dateTime){
        $this->date = $dateTime;
    }

    public function setDate () {
        return $this->date;
    }

    public function getContent () {
        return $this->content;
    }

    public function getName () {
        return $this->name;
    }


}
