<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="/bloguitto/views/styles/register.css">
</head>
<body>
    <div class="container">
        <h1>Registre-se</h1>
        <form method="post" action="/bloguitto/register">
            <label for="">Nome</label>
            <input type="text" name="first_name" placeholder="Nome" required>

            <label for="">Email</label>
            <input type="email" name="email" placeholder="Email" required>

            <label for="">Senha</label>
            <input type="password" name="password" placeholder="Senha" required>

            <?php if(isset($existingUser)): ?> 
                <p style="color: red;"><?= $error_message_existing_user; ?></p>
            <?php endif; ?>
            
            <p>Já possui uma conta? <b><a href="/bloguitto/login">Acesse aqui</a></b> </p>

            <button type="submit">Registrar</button>
    </form>
    </div>

    <script>
        function toggleRegisterButton() {
            const name = document.querySelector('input[name="first_name"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;
            const registerButton = document.querySelector('button[type="submit"]');
            registerButton.disabled = !(name && email && password);
    }
    </script>
</body>
</html>
