<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <link rel="stylesheet" href="<?= 'views/styles/style.css'?>">
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
</body>
</html>
