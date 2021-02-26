<?php
declare(strict_types=1);

class PostLoader implements JsonSerializable
{
    private array $post;

    function __construct($title, $DTime, $content, $name)
    {
        $this->post = array('title' => $title, 'DTime' => $DTime, 'content' => $content, 'name' => $name);
        $this->saveData();
    }

    public function jsonSerialize()
    {
        return $this->post;
        // TODO: Implement jsonSerialize() method.
    }


    public function getDATA()
    {
        if (!empty(file_get_contents("post.json"))) {
            $data = file_get_contents("post.json");
            $data = json_decode($data);
            return $data;
        } else {
            return 0;
        }

    }

    public function saveData()
    {
        $newData = [];
        $data = $this->getDATA();
        if ($data) {
            foreach ($data as $post) {
                array_push($newData, $post);
            }
        }
        array_push($newData, $this->post);
        file_put_contents("post.json", json_encode($newData, JSON_PRETTY_PRINT));
        return $newData;
    }

}
