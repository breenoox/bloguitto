<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?= 'views/styles/login.css'?>">
</head>
<body>
    <div class="box">
        <div class="container">
            <h1>Login</h1>
            <form method="post" action="/bloguitto/login">
        
                <label for="">Email</label>
                <input type="email" name="email" placeholder="Email" required>
                <br>
                <label for="">Senha</label>
                <input type="password" name="password" placeholder="Senha" required>
                <br>
                <button type="submit">Entrar</button>
        </div>
        
    </form>
    </div>

</body>
</html>
