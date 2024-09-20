<!DOCTYPE html>
<html>
<head>
    <title>Criar Novo Post</title>
    <link rel="stylesheet" href="<?= 'views/styles/createPost.css'?>">
</head>
<body>
    <div class="container">
        <h1>Criar Novo Post</h1>
        <form method="post" action="/bloguitto/create">

            <label for="title">Título:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="description">Descrição:</label>
            <textarea id="description" name="description" required></textarea><br>

            <button type="submit">Criar Post</button>
        </form>
    </div>
    
</body>
</html>
