<?php
require 'config.php';
require_once 'dao/vagaDaoMysql.php';
require_once 'dao/UserDaoMysql.php';
require_once 'dao/AuthUserDaoMysql.php';

$vagaDao = new vagaDaoMysql($pdo);
$userDao = new UserDaoMysql($pdo);
$authDao = new AuthUserDaoMysql($pdo);

$list = [];
$user = [];

//CHECANDO SE O USUARIO ESTÁ LOGADO
$userInfo = $authDao->checkLogin();

$list = $vagaDao->findAll();

//PEGANDO O USUARIO LOGADO
$user = $userDao->checkLogin();
?>
<div class="area-menu">
    <div class="area-perfil">
        <img id="image-login" style="width:25px;" src="assets/images/user.svg" alt="">
        Bem vindo(a) <?=$user->name ;?>
    </div>

    <a href="cadastrar_vagas.php">
        <div class="area-logout">
            Adicionar vagas
        </div>
    </a>

    <a href="vagas_cadastradas.php">
        <div class="area-logout">
            Visualizar vagas cadastradas
        </div>
    </a>

    <a href="config_user.php">
        <div class="area-logout">           
            Configurações
        </div>
    </a>
    
    <a href="logout.php">
        <div class="area-logout">                   
            Sair
        </div>
    </a>
</div>

<div>
    <img onclick="menuToggle()" class="img-menu" src="assets/images/menu.png" alt="">
</div>


<script type="text/javascript" src="assets/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>