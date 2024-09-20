<?php

namespace src\app\controllers;

require __DIR__ . "/../models/Posts.php";
require __DIR__ . "/../models/Users.php";

use src\app\models\Users;
use src\app\models\Posts;

class PostsController
{
    public function readPosts()
    {
        $userController = new UsersController();
        $userController->checkLogin();

        $postModel = new Posts();
        $posts = $postModel->find()->fetch(true);

        $userModel = new Users();
        $users = $userModel->find()->fetch(true);

        require __DIR__ . "/../../../views/home.php";
    }

    public function createPost()
    {
        session_start();

        if(!isset($_SESSION['user_id'])) {
            header('Location: /bloguitto/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
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

        require __DIR__ . "/../../../views/createPost.php";
    }

    public function deletePost($data)
    {
        if(isset($data['id'])) {
            $post = (new Posts())->findById($data['id']);

            if($post) {
                if($post->destroy()) {
                    header('Location: ' . URL_BASE);
                    exit;
                } else {
                    echo 'Erro ao excluir o Post';
                }
            } else {
                echo "Post não encontrado.";
            }
        } else {
            echo "ID inválido.";
        }
    }

    public function updatePost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postId = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
            $title = $_POST['title'] ?? 'Titulo não preenchido';
            $description = $_POST['description'] ?? 'Descrição não preenchida.';

            if ($postId && $title && $description) {
                $post = (new Posts())->findById($postId);

                if ($post) {
                    $post->title = $title;
                    $post->description = $description;

                    if ($post->save()) {
                        header('Location: ' . URL_BASE);
                        exit;
                    } else {
                        echo "Erro ao atualizar o post. ";
                    }

                } else {
                    echo "Post não encontrado.";
                }
            } else {
                echo "Dados inválidos.";
            }
        }
    }

    public function edit($data)
    {
        if (isset($data['id'])) {
            $postId = (int) $data['id'];
            $post = (new Posts())->findById($postId);

            if ($post) {
                require __DIR__ . "/../../../views/updatePost.php";
            } else {
                echo "Post não encontrado.";
            }
        } else {
            echo "ID inválido.";
        }
    }
}