<?php
require_once 'models/Auth.php';

class AuthUserDaoMysql implements AuthDAO {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function checkLogin() {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
 
            $userDao = new UserDaoMysql($this->pdo);
            $user = $userDao->findByToken($token);

            if($user) {
                return $user;
            } 
        }
        header("Location: index.php");
        exit;
    }
}