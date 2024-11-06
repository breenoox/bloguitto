<!DOCTYPE html>
<html>

<head>
    <title>Posts</title>
    <link rel="stylesheet" href="/bloguitto/views/styles/style.css">
</head>

<body>

    <header>
        <div class="header-content">
            <h1 class="logo">Bloguitto</h1>
            <a href="/bloguitto/logout" class="logout">Sair</a>
        </div>
    </header>

    <div class="teste-1">
        <h1>Posts</h1>
        <a href="/bloguitto/create" class="createPost">Criar novo post</a>
        <div class="teste">
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <li>
                        <?php foreach ($users as $user): ?>
                            <?php if ($post->user_id === $user->id) : ?>
                                <h2><?php echo ($user->first_name); ?></h2>
                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <h4><?php echo ($post->title); ?></h4>
                        <p><?php echo ($post->description); ?></p>

                        <p><?php echo $post->likeCount; ?> <?= ($post->likeCount === 1) ? 'Like' : 'Likes'; ?></p>

                        <button type="submit">
                            <?= $post->userLiked ? 'Descurtir' : 'Curtir'; ?>
                        </button>

                        <form method="get" action="/bloguitto/comentar/<?php echo ($post->post_id); ?>">
                            <button type="submit" class="comentarBotao">Comentar</button>
                        </form>

                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post->user_id): ?>
                            <div class="botoes">
                                <form method="post" action="/bloguitto/delete/<?php echo ($post->post_id); ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="deleteButton">Excluir</button>
                                </form>

                                <form method="get" action="/bloguitto/edit/<?php echo ($post->post_id); ?>">
                                    <button type="submit" class="editButton">Editar</button>
                                </form>
                            </div>
                        <?php endif; ?>

                        <div class="comentarios">
                            <h3>Comentários:</h3>
                            <?php if (!empty($comentariosPorPost[$post->post_id])): ?>
                                <?php foreach ($comentariosPorPost[$post->post_id] as $comentario): ?>
                                    <div class="comentario">
                                        <?php
                                        $usuario = $usuariosPorId[$comentario->user_id];
                                        ?>
                                        <p><strong><?php echo $usuario->first_name; ?>:</strong> <?php echo $comentario->descricao; ?></p>

                                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $comentario->user_id): ?>
                                            <form method="post" action="/bloguitto/deletarComentario/<?php echo ($comentario->id); ?>">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="deleteButton">Excluir</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Seja o primeiro a comentar!</p>
                            <?php endif; ?>
                        </div>

                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>