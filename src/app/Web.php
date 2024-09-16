<?php

namespace src\app;

use League\Plates\Engine;

require __DIR__ . "/Posts.php";
require __DIR__ . "/users/Users.php";

class Web 
{
    public function readPosts()
    {
        $postModel = new Posts();
        $posts = $postModel->find()->fetch(true);

        $usersModel = new Users();
        $users = $usersModel->find()->fetch(true);

        require __DIR__ . "/../../views/home.php";

    }
}