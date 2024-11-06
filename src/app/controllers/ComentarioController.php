<?php

namespace src\app\controllers;

require_once __DIR__ . "/../models/Posts.php";
require_once __DIR__ . "/../models/Comentarios.php";

use src\app\models\Comentario;
use src\app\models\Posts;

class ComentariosController
{
    
    public function comentarPost($data)
    {
        if (isset($data['id'])) {
            $postId = (int) $data['id'];
            $post = (new Posts())->findById($postId);

            if ($post) {
                require __DIR__ . "/../../../views/comentario.php";
            } else {
                echo "Post não encontrado.";
            }
        } else {
            echo "ID inválido.";
        }
    }

    public function enviarComentario()
    {
        session_start();

        if(!isset($_SESSION['user_id'])) {
            header('Location: /bloguitto/login');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['post_id']))
        {
            $postId = $_POST['post_id'];
            $userId = $_SESSION['user_id'];
            $comentario = $_POST['descricao'];
    
            $Comentario = new Comentario();
            $Comentario->descricao = $comentario;
            $Comentario->post_id = $postId;
            $Comentario->user_id = $userId;

            if($Comentario->save()) {
                header('Location: ' . URL_BASE);
                exit;
            } else {
                echo "Erro ao criar o post.";
            }
        }
    }

    public function deletarComentario($data)
    {
        if(isset($data['id'])) {
            $comentario = (new Comentario())->findById($data['id']);

            if($comentario) {
                if ($comentario->destroy()) {
                    header('Location: ' . URL_BASE);
                    exit;
                } else {
                    echo 'Erro ao excluir comentario';
                }
            } else {
                echo 'Comentário não existe';
            }
        } else {
            echo 'ID inválido';
        }
    }
}