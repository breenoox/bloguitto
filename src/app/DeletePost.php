<?php

namespace src\app;

class DeletePost 
{
    public function deletePost($data)
    {
        if(isset($data['id']) && is_numeric($data['id'])) {
            $postId = (int) $data['id'];

            $post = (new Posts())->findById($postId);

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
}
