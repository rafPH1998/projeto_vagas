<?php
require 'config.php';
require_once 'dao/InscricaoVagaDaoMysql.php';

$incricaoVagaDao = new InscricaoVagaDaoMysql($pdo);


$name_user = filter_input(INPUT_POST, 'name');
$cpf = filter_input(INPUT_POST, 'cpf');
$endereco = filter_input(INPUT_POST, 'endereco');
$tel_1 = filter_input(INPUT_POST, 'tel_1');
$tel_2 = filter_input(INPUT_POST, 'tel_2');
$tel_recado = filter_input(INPUT_POST, 'tel_recado');
$rua = filter_input(INPUT_POST, 'rua');
$cidade = filter_input(INPUT_POST, 'cidade');
$estado = filter_input(INPUT_POST, 'estado');
$cargo = filter_input(INPUT_POST, 'cargo');

if($name_user) {
    $newInscricao = new InscricaoVaga();

    $newInscricao->name_user = $name_user;
    $newInscricao->cpf = $cpf;
    $newInscricao->endereco = $endereco;
    $newInscricao->telefone_one = $tel_1;
    $newInscricao->telefone_two = $tel_2;
    $newInscricao->telefone_recado = $tel_recado; 
    $newInscricao->rua = $rua;
    $newInscricao->cidade = $cidade;
    $newInscricao->estado = $estado;
    $newInscricao->cargo = $cargo;

    $incricaoVagaDao->inscricaoVaga($newInscricao);
}


// echo json_encode($array);



