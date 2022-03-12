<?php
require 'config.php';
require_once 'dao/vagaDaoMysql.php';
$vagaDao = new VagaDaoMysql($pdo);
$status = []; 

$titulo = filter_input(INPUT_POST, 'titulo');
$descricao = filter_input(INPUT_POST, 'descricao');
$ativo = filter_input(INPUT_POST, 'ativo');
$inativo = filter_input(INPUT_POST, 'inativo');
$cidade = filter_input(INPUT_POST, 'cidade');

if ($titulo && $descricao && $cidade) {
    if($ativo) {
        $status = $ativo = 1;
    } elseif($inativo) {
        $status = $inativo = 0;
    } 
    
    $newVaga = new Vaga();
    $newVaga->titulo = $titulo;
    $newVaga->descricao = $descricao;
    $newVaga->status = $status;
    $newVaga->data = date('Y-m-d H:i:s');
    $newVaga->cidade = $cidade;

    $vagaDao->insertVaga($newVaga);

    $_SESSION['success'] = 'Vaga cadastrada com sucesso! <a href="vagas.php"><strong>Visualizar vagas</strong></a>';
    header("Location: cadastrar_vagas.php");
    exit;

} else {
    $_SESSION['flash'] = 'Preencha todos os campos para cadastrar uma vaga.';
    header("Location: cadastrar_vagas.php");
    exit;
}