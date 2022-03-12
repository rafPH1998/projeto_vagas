<?php
require 'config.php';
require_once 'dao/UserDaoMysql.php';

$userDao = new UserDaoMysql($pdo);

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');
$password_confirmation = filter_input(INPUT_POST, 'password_confirmation');

if ($name && $email && $password && $password_confirmation) {
    if ($password === $password_confirmation) {
        
        if ($userDao->findByEmail($email) === false) {

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $token = md5(time().rand(0,9999));

            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->password = $hash;
            $newUser->token = $token;
            
            $userDao->insert($newUser);
            $_SESSION['token'] = $token;

            $_SESSION['success'] = 'Usuário cadastrado com sucesso!';
            header("Location: cadastro_usuario.php");
            exit;

        } else {
            $_SESSION['flash'] = 'Esse e-mail já está cadastrado em nosso sistema!';
            header("Location: cadastro_usuario.php");
            exit;
        }

    } else {
        $_SESSION['flash'] = 'As senhas não batem!';
        header("Location: cadastro_usuario.php");
        exit;
    }

} else {
    $_SESSION['flash'] = 'Preencha todos os campos para fazer o cadastro!';
    header("Location: cadastro_usuario.php");
    exit;
}