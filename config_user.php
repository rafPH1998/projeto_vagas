<?php
require 'config.php';
require 'assets/partials/header.php';
require_once 'dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);
$user = [];

$user = $userDao->checkLogin();

?>
<main>
  <form method="POST" action="config_user_action.php">

    <h1>Editar Usuário</h1>

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

    <div class="main-form">
        <input type="hidden" name="id">

        <div class="form-group">
            <label>Nome Completo:</label>
            <input placeholder="Digite seu Nome Completo" id="input-name" class="form-control" type="text" name="name" value="<?= $user->name; ?>" />
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input placeholder="Digite seu e-mail" id="input-email" class="form-control" type="email" name="email" value="<?= $user->email; ?>"/>
        </div>

        <div class="form-group">
            <label>Senha:</label>
            <input placeholder="Digite sua Senha" id="input-password" class="form-control" type="password" name="password" />
        </div>

        <div class="form-group">
            <label>Confirmar Senha:</label>
            <input placeholder="Confirme sua Senha" class="form-control" type="password" name="password_confirmation" />
        </div>

        <div class="form-group">
            <label>Endereço:</label>
            <input placeholder="Confirme seu Endereço" class="form-control" type="text" name="endereco" value="<?= $user->endereco; ?>"/>
        </div>

        <div class="form-group">
            <label>Número:</label>
            <input placeholder="Confirme seu Número de endereço" class="form-control" type="text" name="numero" value="<?= $user->numero; ?>"/>
        </div>

        <div class="form-group">
            <label>Bairro:</label>
            <input placeholder="Confirme seu Bairro" class="form-control" type="text" name="bairro" value="<?= $user->bairro; ?>"/>
        </div>

        <div class="form-group">
            <label>Cidade:</label>
            <input placeholder="Confirme sua Cidade" class="form-control" type="text" name="cidade" value="<?= $user->cidade; ?>"/>
        </div>

        <div class="form-group">
            <label>Estado:</label>
            <input placeholder="Confirme seu Estado" class="form-control" type="text" name="estado" value="<?= $user->estado; ?>"/>
        </div>

        <input type="submit" class="btn btn-outline-success" value="Salvar">
        <a href="vagas.php" type="button" class="btn btn-outline-light">Voltar</a>
    </div>
  </form>
</main>



<?php
require 'assets/partials/footer.php';
?>