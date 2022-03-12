<?php
require 'assets/partials/header.php';
require 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="assets/css/login.css" />
</head>
<body>
    <section class="container main">
        <form method="POST" action="login.php">

            <?php if(!empty($_SESSION['flash'])):?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['flash']; ?>
                    <?= $_SESSION['flash'] = ''; ?>
                </div>
            <?php endif;?>

            <label>
                <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />
            </label>

            <label class="label">
                <input placeholder="Digite sua senha" class="input" id="password" type="password" name="password" />
                <div class="area-checkbox">
                    <input type="checkbox" class="checkbox" onclick="togglePassword2()">
                    <p class="p"> Mostrar/Esconder senha</p>
                </div>
            </label>

            <input class="button" type="submit" value="Entrar" />

            <a href="cadastro_usuario.php">Ainda não tem conta? Cadastre-se</a>
        </form>
    </section>


    <script src="assets/js/script.js"></script>
</body>
</html>
    
<?php
require 'assets/partials/footer.php';
?>