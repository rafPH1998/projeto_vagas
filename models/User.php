<?php

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $endereco;
    public $numero;
    public $bairro;
    public $cidade;
    public $estado;
    public $token;
    public $admin;
}

interface UserDAO {
    public function findByEmail($email);
    public function findByToken($token);
    public function checkLogin();
    public function insert(User $u);
    public function update(User $u);
    public function updateUser($id, User $u);
    public function delete($id);
} 