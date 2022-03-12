<?php
require_once 'models/User.php';

class UserDaoMysql implements UserDAO {
    
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function verifyLogin($email, $password) {
        $user = $this->findByEmail($email);
        if($user) {
            if(password_verify($password, $user->password)) {

                $token = md5(time().rand(0,9999));
                $_SESSION['token'] = $token;
                $user->token = $token;
                $this->update($user);
                
                return true;
            }
        }

        return false;
    }

      // CHECANDO QUAL USUÁRIO ESTÁ LOGADO PELO TOKEN
      public function checkLogin() {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $sql = $this->pdo->prepare("SELECT * FROM login_users WHERE token = :token"); 
            $sql->bindValue(':token', $token);
            $sql->execute();

            if($sql->rowCount() > 0) {

                $data = $sql->fetch(PDO::FETCH_ASSOC);
    
                $user = new User();
                $user->id = $data['id'];
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->admin = $data['admin'];
                $user->endereco = $data['endereco']; 
                $user->numero = $data['numero']; 
                $user->bairro = $data['bairro']; 
                $user->cidade = $data['cidade']; 
                $user->estado = $data['estado'];  
                
                return $user;
            }
        }
    
        return false;
    }

    // PROCURANDO O USÚARIO PELO EMAIL
    public function findByEmail($email) {
        $sql = $this->pdo->prepare("SELECT * FROM login_users WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new User();
            $u->id = $data['id'];
            $u->name = $data['name'];
            $u->email = $data['email'];
            $u->admin = $data['admin'];
            $u->password = $data['password']; 
            $u->token = $data['token'];

            return $u;
        } else {
            return false;
        }
    }

    // PROCURANDO O USÚARIO PELO TOKEN
    public function findByToken($token) {
        $sql = $this->pdo->prepare("SELECT * FROM login_users WHERE token = :token");
        $sql->bindValue(':token', $token);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $u = new User();
            $u->id = $data['id'];
            $u->name = $data['name'];
            $u->email = $data['email'];
            $u->password = $data['password']; 
            $u->admin = $data['admin']; 
            $u->token = $data['token'];

            return $u;
        } else {
            return false;
        }
    }

    public function insert(User $u) {
        $sql = $this->pdo->prepare("INSERT INTO login_users (
            name, email, password, token
        ) VALUES (
            :name, :email, :password, :token
        )");

        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':token', $u->token);
        $sql->execute();
      
        return true;
    }

    public function update(User $u) {
        $sql = $this->pdo->prepare("UPDATE login_users SET 
        name = :name,
        email = :email,
        password = :password,
        token = :token
        WHERE id = :id");

        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':token', $u->token);
        $sql->bindValue(':id', $u->id);
        $sql->execute();

        return true;
    }

    public function updateUser($idUser, User $u) {

        $sql = $this->pdo->prepare("UPDATE login_users SET 
        name = :name,
        endereco = :endereco,
        numero = :numero,
        bairro = :bairro,
        cidade = :cidade,
        estado = :estado
        WHERE id = :id");

        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':endereco', $u->endereco);
        $sql->bindValue(':numero', $u->numero);
        $sql->bindValue(':bairro', $u->bairro);
        $sql->bindValue(':cidade', $u->cidade);
        $sql->bindValue(':estado', $u->estado);
        $sql->bindValue(':id', $idUser);
        $sql->execute();

        if(!empty($u->email)) {
            $sql = $this->pdo->prepare("UPDATE login_users SET 
            email = :email
            WHERE id = :id");
            $sql->bindValue(':email', $u->email);
            $sql->bindValue(':id', $idUser);
            $sql->execute();
        }

        if(!empty($u->password)) {
            $sql = $this->pdo->prepare("UPDATE login_users SET 
            password = :password
            WHERE id = :id");
            $sql->bindValue(':password', $u->password);
            $sql->bindValue(':id', $idUser);
            $sql->execute();
        }
        
        
    }

    public function delete($id) {

    }
}