<?php
require 'config.php';
require_once 'dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if ($email && $password) {
    
    $user = $userDao->verifyLogin($email, $password);
    if($user) {
        header("Location: vagas.php");
        exit;
    } else {
        $_SESSION['flash'] = 'Senha ou e-mail inválidos.';
        header("Location: index.php");
        exit;
    }

} else {
    $_SESSION['flash'] = 'E-mail e/ou senha não preenchidos!';
    header("Location: index.php");
    exit;
}