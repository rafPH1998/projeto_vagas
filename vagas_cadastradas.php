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



// $p = 1;
// $p = filter_input(INPUT_GET, 'p');

// if($p) {
//     $pagina = 4;
//     $vagas = 5;

//     $list = $vagaDao->findAll($p, $pagina);
//     $total_paginas = ceil($vagas/ $pagina);
// }


?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Vagas</title>
</head>
<body>
   <section>
        <div class="area-geral">
            <div class="area-menu">
                <div class="area-perfil">
                    <img id="image-login" style="width:25px;" src="assets/images/user.svg" alt="">
                    Bem vindo(a) <?=$user->name ;?>
                </div>

                <a href="vagas.php">
                    <div class="area-logout">
                        Página inicial
                    </div>
                </a>

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


            <div class="area-vagas bg-dark text-light">
                <div class="container">
                    <div class="jumbotron bg-danger">
                        <h1>WDEV Vagas</h1>
                        <p>Exemplo de CRUD com PHP orientados a objetos</p>
                    </div>
                    <main>
                        <div class="area-vagas-cadastradas">
                            <?php foreach($list as $vagas):?>
                               <div class="area-geral-infos">
                                <h4>Cód: <?=$vagas->id;?> - <?=$vagas->titulo;?> - Temporário</h4>
                                    <div class="area-infos">
                                        <div class="area-date">
                                            <span>Status: </span><?=($vagas->status == 1) ? 'Ativa': 'Inativa';?>
                                        </div>
                                        <div class="area-inscricao">
                                            <span>Data inscrição: </span><?= date('d/m/Y', strtotime($vagas->data)); ?>
                                        </div>
                                    </div>
                                    <div class="area-descricao">
                                        <p>
                                            Responsável por organizar o galpão/Hub.
                                            Recebimento, separação e conferência de mercadorias
                                            Receber retornos de pacotes dos mensageiros
                                            Acompanhamento do fluxo de movimentação de pedidos, visando atender as metas estabelecidas.
                                            Irá organizar o galpão/Hub. Recebimento, separação e conferência de mercadorias, receber retornos de pacotes dos mensageiros Acompanhamento do fluxo de movimentação de pedidos, visando atender as metas estabelecidas.
                                        </p>
                                        <hr/>
                                    </div>
                               </div>
                            <?php endforeach;?>
                        </div>
                    </main> 
                   
                </div>
            </div>
        </div>
   </section>

   
    <script type="text/javascript" src="assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>



