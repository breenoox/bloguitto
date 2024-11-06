<!DOCTYPE html>
<html>
<head>
    <title>Comentar Post</title>
    <link rel="stylesheet" href="/bloguitto/views/styles/createPost.css">
</head>
<body>
    <div class="container">
        <h1>Comentar Post</h1>
        <form method="post" action="/bloguitto/enviarComentario">
            <input type="hidden" name="post_id" value="<?php echo ($post->post_id); ?>">

            <textarea id="description" name="descricao" required></textarea><br>

            <button class="createButton" type="submit">Comentar</button>
        </form>
    </div>
    
</body>
</html>
