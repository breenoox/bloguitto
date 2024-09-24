<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <link rel="stylesheet" href="/bloguitto/views/styles/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Adicione jQuery -->
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
                            <?php if ($post->user_id === $user->id) :?>
                                <h2><?php echo ($user->first_name); ?></h2>
                                <?php break;?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <h4><?php echo ($post->title); ?></h4>
                        <p><?php echo ($post->description); ?></p>

                        <p class="like-count" id="like-count-<?= $post->post_id; ?>"><?= $post->likeCount; ?> <?= ($post->likeCount === 1) ? 'Like' : 'Likes'; ?></p>

                        <button class="like-button" data-post-id="<?= $post->post_id; ?>">
                            <?= $post->userLiked ? 'Descurtir' : 'Curtir'; ?>
                        </button>

                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $post->user_id):?>
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
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.like-button').click(function(e) {
                e.preventDefault(); // Evita o comportamento padrão do botão

                const postId = $(this).data('post-id');

                $.ajax({
                    url: '/bloguitto/toggleLike', // Altere para o endpoint correto
                    type: 'POST',
                    data: { post_id: postId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            const likeCountElement = $('#like-count-' + postId);
                            likeCountElement.text(response.likeCount + ' ' + (response.likeCount === 1 ? 'Like' : 'Likes'));

                            // Altera o texto do botão de acordo com a ação
                            $('.like-button[data-post-id="' + postId + '"]').text(response.action === 'like' ? 'Descurtir' : 'Curtir');
                        } else {
                            alert(response.message); // Exibe uma mensagem de erro, se necessário
                        }
                    },
                    error: function() {
                        alert('Ocorreu um erro. Por favor, tente novamente.');
                    }
                });
            });
        });
    </script>
</body>
</html>
