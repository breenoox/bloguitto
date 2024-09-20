<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="<?= 'views/styles/style.css'?>">
</head>
<body>
    <h1>Registro de Usuário</h1>
    <form method="post" action="/bloguitto/register">
        <input type="text" name="first_name" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Senha" required>
        <input type="password" name="confirm_password" placeholder="Confirme a Senha" required>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
