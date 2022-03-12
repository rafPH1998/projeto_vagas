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

                <?php if($userInfo->admin == 1):?>
                    <a href="cadastrar_vagas.php">
                        <div class="area-logout">
                            Adicionar vagas
                        </div>
                    </a>
                <?php endif;?>

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
                        <div class="area-buttons">
                            <a href="cadastrar_vagas.php">
                            <button class="btn btn-success">Adicionar nova vaga</button>
                            </a>
                            <div class="center">
                                <form method="POST">
                                    <input type="text" name="pesquisa" id="pesquisa" placeholder="Digite o nome da vaga">
                                    <img id="img-search" src="images/search.svg" alt="">
                                </form>
                            </div>
                        </div>

                        <section>
                            <table class="table bg-light mt-3" id="table">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Vaga</th>
                                        <th>Status</th>
                                        <th>Data da Publicação</th>
                                        <th>Cidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $vagas) :?>
                                        <tr>
                                            <td><?= $vagas->id; ?></td>
                                            <td><?= $vagas->titulo; ?></td>     
                                            <td><?= ($vagas->status) == 1 ? 'Ativo' : 'Não ativo';?></td>
                                            <td><?= date('d/m/Y', strtotime($vagas->data)); ?></td>
                                            <td><?= $vagas->cidade; ?></td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-info" onclick="cadastrar('<?= $user->id; ?>')">Cadastrar</a>
                                                <a href="javascript:;" class="btn btn-warning" onclick="ver_descricao('<?=$vagas->id; ?>')">Ver</a>
                                                <a href="javascript:;" class="btn btn-success" onclick="editar('<?=$vagas->id; ?>')">Editar</a>
                                                <a href="javascript:;" class="btn btn-danger" onclick="excluir('<?=$vagas->id; ?>')">Excluir</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>   

                            <!-- modal de edição -->
                            <div id="modal" class="modal fade" role="dialog">              
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">...</div>
                                    </div>
                                </div>                              
                            </div>
                            <!-- modal de edição -->

                             <!-- modal de edição2 -->
                             <div id="modal2" class="modal fade" role="dialog">              
                                <div class="modal-dialog">
                                    <div class="modal-content2">
                                        <div class="modal-body2">...</div>
                                    </div>
                                </div>                              
                            </div>
                            <!-- modal de edição2 -->
                            
                            <!-- modal de exclusao de uma vaga -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="exampleModalLabel">Excluir Vaga </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <a href="vagas.php" aria-hidden="true">&times;</a>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir essa vaga ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" onclick="deleteUser('<?=$vagas->id; ?>')" >Apagar</button>
                                            <a href="vagas.php" type="button" class="btn btn-danger">Fechar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal de exclusao de uma vaga -->

                        </section>

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

