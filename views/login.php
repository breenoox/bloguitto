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

            <?php if (isset($error_message)): ?>
                <p style="color: red;"><?= $error_message; ?></p>
            <?php endif; ?>

            <p>Não tem uma conta? <b><a href="/bloguitto/register">Cadastre-se</a></b></p>
            
            <button type="submit">Entrar</button>

        </form>
    </div>


    <script>
        function toggleLoginButton() {
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;
            const loginButton = document.querySelector('button[type="submit"]');
            loginButton.disabled = !(email && password);
        }
    </script>
</body>
</html>
