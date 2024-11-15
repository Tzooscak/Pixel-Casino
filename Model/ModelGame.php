<?php

class Game {

    protected $id;
    protected $name;
    protected $description;
    protected $createdAt;

    public function __construct($id, $name, $description, $createdAt) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt;
    }

}

?>