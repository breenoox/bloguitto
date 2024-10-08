<!DOCTYPE html>
<html>
<head>
    <title>Atualizar Post</title>
    <link rel="stylesheet" href="/bloguitto/views/styles/updatePost.css">
</head>
<body>
    <div class="container">
        <h1>Atualizar Post</h1>
        <form method="post" action="/bloguitto/update">
            <input type="hidden" name="post_id" value="<?php echo ($post->post_id); ?>">

            <label for="title">Título:</label>
            <input type="text" id="title" name="title" value="<?php echo ($post->title); ?>" required>

            <label for="description">Descrição:</label>
            <textarea id="description" name="description" required><?php echo ($post->description); ?></textarea>

            <button type="submit" class="updateButton">Atualizar Post</button>
        </form>
    </div>
</body>
</html>
