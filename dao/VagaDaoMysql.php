<?php
require 'models/Vaga.php';

class VagaDaoMysql implements VagaDAO {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function findAll() {
        $array = [];
        // $offset = ($page - 1) * $perPage;

        $sql = $this->pdo->query("SELECT * FROM vagas_users");
        if ($sql->rowCount() > 0 ) {
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $item) {
                $v = new Vaga();
                $v->id = $item['id'];
                $v->titulo = $item['titulo'];
                $v->descricao = $item['descricao'];
                $v->status = $item['status'];
                $v->data = $item['data'];
                $v->cidade = $item['cidade'];

                $array[] = $v;
            }
        }

        return $array;
    }

    public function insertVaga(Vaga $v) {
        $sql = $this->pdo->prepare("INSERT INTO vagas_users (
            titulo, descricao, status, data, cidade
        ) VALUES (
            :titulo, :descricao, :status, :data, :cidade
        )");

        $sql->bindValue(':titulo', $v->titulo);
        $sql->bindValue(':descricao', $v->descricao);
        $sql->bindValue(':status', $v->status);
        $sql->bindValue(':data', $v->data);
        $sql->bindValue(':cidade', $v->cidade);
        $sql->execute();
      
        return true;
    }

    public function deleteVaga($id) {
        $sql = $this->pdo->prepare("DELETE FROM vagas_users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function findByIdVaga($id) {
        $sql = $this->pdo->prepare("SELECT * FROM vagas_users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $data = $sql->fetch();

            $v = new Vaga();
            $v->id = $data['id'];
            $v->titulo = $data['titulo'];
            $v->descricao = $data['descricao'];
            $v->status = $data['status'];
            $v->data = $data['data'];
            $v->cidade = $data['cidade'];

            return $v;
        } else {
            return false;
        }
    }

    public function updateVaga(Vaga $v) {
        $sql = $this->pdo->prepare("UPDATE vagas_users SET 
        titulo = :titulo,
        cidade = :cidade,
        descricao = :descricao
        WHERE id = :id");

        $sql->bindValue(':titulo', $v->titulo);
        $sql->bindValue(':cidade', $v->cidade);
        $sql->bindValue(':descricao', $v->descricao);
        $sql->bindValue(':id', $v->id);
        $sql->execute();

        return true;
    }

}