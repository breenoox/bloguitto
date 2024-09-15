<?php

 namespace src\app;

 class CreatePost 
 {
    public function createPost()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            $post = new Posts();
            $post->user_id = $userId;
            $post->title = $title;
            $post->description = $description;

            
            if ($post->save()) {
                header('Location: ' . URL_BASE);
                exit;
            } else {
                echo "Erro ao criar o post.";
            } 
        } 

        require __DIR__ . "/../../views/createPost.php";
    }
 }