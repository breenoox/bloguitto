<?php

namespace src\app\controllers;

require __DIR__ . "/../models/Posts.php";
require __DIR__ . "/../models/Users.php";
require __DIR__ . "/../models/Likes.php";

use src\app\models\Users;
use src\app\models\Posts;
use src\app\models\Likes;
use src\app\models\Comentario;

class PostsController
{
    public function readPosts()
    {
        $userController = new UsersController();
        $userController->checkLogin();

        $postModel = new Posts();
        $posts = $postModel->find()->fetch(true);

        $comentarios = (new Comentario())->find()->fetch(true);
        $comentariosPorPost = [];
        foreach ($comentarios as $comentario) {
            $comentariosPorPost[$comentario->post_id][] = $comentario;
        }

        $likeModel = new Likes();
        $usuario_id = $_SESSION['user_id'];
        $curtido = $likeModel->find("user_id = :user_id AND post_id = :post_id", "user_id={$usuario_id}&post_id={$postModel->post_id}")->fetch();

        $userModel = new Users();
        $users = $userModel->find()->fetch(true);

        $usuariosPorId = [];
        foreach ($users as $usuario) {
            $usuariosPorId[$usuario->id] = $usuario;
        }

        $posts = $postModel->find()->fetch(true);
        if ($posts === null) {
            $posts = [];
        }

        $likeModel = new Likes();
        $likes = $likeModel->find("user_id = :user_id", "user_id={$usuario_id}")->fetch(true);
        if ($likes === null) {
            $likes = []; 
        }

        $postsComCurtidas = [];
        foreach ($posts as $post) {
            $liked = false;

            foreach ($likes as $like) {
                if ($like->post_id == $post->post_id) { 
                    $liked = true;
                    break;
                }
            }

            $likesForPost = $likeModel->find("post_id = :post_id", "post_id={$post->post_id}")->fetch(true); 
            $likeCount = $likesForPost ? count($likesForPost) : 0;  

            $postsComCurtidas[] = [
                'post' => $post,
                'liked' => $liked,
                'likeCount' => $likeCount
            ];
        }


        require __DIR__ . "/../../../views/home.php";
    }

    public function createPost()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
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
        if (isset($data['id'])) {
            $post = (new Posts())->findById($data['id']);

            if ($post) {
                if ($post->destroy()) {
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

    public function curtirPost()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /bloguitto/login');
            exit;
        }

        $usuarioId = $_POST['user_id'];
        $postId = $_POST['post_id'];

        $Like = new Likes();

        $curtido = $Like->find("user_id = :user_id AND post_id = :post_id", "user_id={$usuarioId}&post_id={$postId}")->fetch();

        if ($curtido) {
            $Like->findById($curtido->id)->destroy();
            $liked = false;
        } else {

            $Like->user_id = $usuarioId;
            $Like->post_id = $postId;
            $Like->save();
            $liked = true;
        }

        $likeCount = $Like->find("post_id = :post_id", "post_id={$postId}")->count();

        echo json_encode([
            'like_count' => $likeCount,
            'liked' => $liked
        ]);
        exit;
    }
}
