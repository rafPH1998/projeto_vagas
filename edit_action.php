<?php 
require 'config.php';
require_once 'dao/VagaDaoMysql.php';

$vagaDao = new VagaDaoMysql($pdo);

$id = filter_input(INPUT_POST, 'id');
$titulo = filter_input(INPUT_POST, 'titulo');
$cidade = filter_input(INPUT_POST, 'cidade');
$descricao = filter_input(INPUT_POST, 'descricao');

if($titulo && $cidade && $descricao) {
    $newVaga = new Vaga();
    $newVaga->id = $id;
    $newVaga->titulo = $titulo;
    $newVaga->cidade = $cidade;
    $newVaga->descricao = $descricao;
    $vagaDao->updateVaga($newVaga);
}

