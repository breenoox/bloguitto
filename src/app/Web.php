<?php

namespace src\app;

use League\Plates\Engine;

require __DIR__ . "/Posts.php";

class Web 
{
    public function readPosts()
    {
        $postModel = new Posts();
        $posts = $postModel->find()->fetch(true);

        require __DIR__ . "/../../views/home.php";

    }
}