<?php
require 'config.php';
require_once 'dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);
$user = $userDao->checkLogin();

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$passwordConfirm = filter_input(INPUT_POST, 'password_confirmation');
$endereco = filter_input(INPUT_POST, 'endereco');
$numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);
$bairro = filter_input(INPUT_POST, 'bairro');
$cidade = filter_input(INPUT_POST, 'cidade'); 
$estado = filter_input(INPUT_POST, 'estado');

if($name) {

    $updateUser = new User();
    $loggedUser = $user->id;

    $hash = password_hash($user->password, PASSWORD_DEFAULT);

    // E-MAIL
    if(!empty($email)) {
        if($user->email != $email) {
            if($userDao->findByEmail($email) === false) {
                $updateUser->email = $email;
            } else {
                $_SESSION['flash'] = 'Este e-mail já existe!';
                header("Location: config_user.php");
                exit;
            } 
        } 
    }

    // PASSWORD
    if(!empty($password)) {
        //SENHA PRECISA CONTER PELO MENOS 8 CARACTERES PARA MAIS SEGURANÇA
        if($password < 8) {
            if($password === $passwordConfirm) {
                $updateUser->password = $hash;
            } else {
                $_SESSION['flash'] = 'As senhas não batem!';
                header("Location: config_user.php");
                exit;
            }
        } else {
            $_SESSION['flash'] = 'Senha muito curta. Crie uma com pelo menos 8 caracteres!';
            header("Location: config_user.php");
            exit;
        }
    }

    //ATUALIZANDO CAMPOS NORMAIS
    $updateUser->name = $name;
    $updateUser->endereco = $endereco;
    $updateUser->numero = $numero;
    $updateUser->bairro = $bairro;
    $updateUser->cidade = $cidade;
    $updateUser->estado = $estado;
    
    $userDao->updateUser($loggedUser, $updateUser);
    $_SESSION['success'] = 'Dados atualizado com sucesso!';
    header("Location: config_user.php");
    exit;

} 

