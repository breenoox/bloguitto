<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
    <link rel="stylesheet" href="<?= 'views/styles/style.css'?>">
</head>
<body>
    <?php if (!empty($posts)): ?>
        <div class="teste-1">
            <h1>Posts</h1>
        <div class="teste">
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

                </li>

                <div class="botoes">
                    <form method="post" action="/bloguitto/delete/<?php echo ($post->post_id); ?>">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="deleteButton">Excluir</button>
                    </form>

                    <form method="get" action="/bloguitto/edit/<?php echo ($post->post_id); ?>">
                        <button type="submit" class="editButton">Editar</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        </div>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>

</body>
</html>