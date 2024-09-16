<?php

namespace src\app;

class UpdatePost
{
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
                require __DIR__ . "/../../views/updatePost.php";
            } else {
                echo "Post não encontrado.";
            }
        } else {
            echo "ID inválido.";
        }
    }

}