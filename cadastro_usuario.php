<?php
require 'assets/partials/header.php';
require 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="assets/css/login.css" />
</head>
<body>
    <section class="container main">
        <form method="POST" class="b7validator" action="cadastro_action.php">

            <?php if(!empty($_SESSION['flash'])):?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['flash']; ?>
                    <?= $_SESSION['flash'] = ''; ?>
                </div>
            <?php elseif(!empty($_SESSION['success'])):?>
                <div class="alert alert-success" role="alert">
                    <?= $_SESSION['success']; ?>
                    <?= $_SESSION['success'] = ''; ?>
                </div>
            <?php endif;?>

            <label>
                <input placeholder="Digite seu Nome Completo" class="input" type="text" name="name"/>
            </label>

            <label class="label">
                <input placeholder="Digite seu e-mail" class="input" type="email" name="email"/>
            </label>
            
            <label class="label">
                <input placeholder="Digite sua senha" id="password" class="input" type="password" name="password"/>
            </label>

            <label class="label">
                <input placeholder="Confirme sua senha sua senha" id="password_confirmation" class="input" type="password" name="password_confirmation"/>
                <div class="area-checkbox">
                    <input type="checkbox" class="checkbox" onclick="togglePassword1()">
                    <p class="p">Visualizar senha</p>
                </div>
            </label>

            <input class="button-cadastro" type="submit" value="Fazer cadastro" />
        </form>

        <a href="index.php">Já tem conta? Faça o login</a>

    </section>
    
    <script src="assets/js/script.js"></script>
</body>
</html>
<?php
require 'assets/partials/footer.php';
?>