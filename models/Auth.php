<?php

class Auth {
    public $id;
    public $name;
    public $email;
    public $password;
    public $token;
}

interface AuthDAO {
    public function checkLogin();
} 