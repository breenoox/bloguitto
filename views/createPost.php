<!DOCTYPE html>
<html>
<head>
    <title>Criar Novo Post</title>
</head>
<body>
    <h1>Criar Novo Post</h1>
    <form method="post" action="/bloguitto/create">
        <!--<label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br> -->

        <label for="title">Título:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Descrição:</label>
        <textarea id="description" name="description" required></textarea><br>

        <button type="submit">Criar Post</button>
    </form>
</body>
</html>
