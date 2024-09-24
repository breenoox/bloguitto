<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/bloguitto/views/styles/login.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" action="/bloguitto/login">
        
            <label for="">Email</label>
            <input type="email" name="email" placeholder="Email" required>
    
            <label for="">Senha</label>
            <input type="password" name="password" placeholder="Senha" required>

            <p>Não tem uma conta? <b><a href="/bloguitto/register">Cadastre-se</a></b></p>
            <p><?php echo $teste ?></p>
            
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
