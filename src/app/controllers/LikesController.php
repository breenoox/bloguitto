<?php

namespace src\app\controllers;

use src\app\models\Likes;

class LikesController
{
    public function likePost($postId)
    {
        session_start();

        if(!isset($_SESSION['user_id'])) {
            header('Location: /bloguitto/login');
            exit;
        }

        $user_id = $_SESSION['user_id'];
        $post_id = $_SESSION['post_id'];

        $likesModel = new Likes();
        $existingLikes = $likesModel->find("user_id = :user_id AND post_id = :post_id", "user_id={$user_id}&post_id={$post_id})")->fetch();

        if($existingLikes) {
            $existingLikes->destroy();
        } else {
            $like = new Likes();
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->save();
        }

    }
}