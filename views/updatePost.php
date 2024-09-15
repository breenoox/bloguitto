<!DOCTYPE html>
<html>
<head>
    <title>Editar Post</title>
</head>
<body>
    <h1>Editar Post</h1>
    <form method="post" action="/bloguitto/update">
        <input type="hidden" name="post_id" value="<?php echo ($post->post_id); ?>">

        <label for="title">Título:</label>
        <input type="text" id="title" name="title" value="<?php echo ($post->title); ?>" required><br>

        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required><?php echo ($post->description); ?></textarea><br>

        <button type="submit">Atualizar Post</button>
    </form>
</body>
</html>
