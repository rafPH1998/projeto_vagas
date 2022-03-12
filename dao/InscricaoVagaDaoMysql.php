<?php
require_once 'models/InscricaoVaga.php';

class InscricaoVagaDaoMysql implements InscricaoVagaDAO {
    
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function inscricaoVaga(InscricaoVaga $iv) {
        $sql = $this->pdo->prepare("INSERT INTO inscricao_vagas
        (name_user, cpf, endereco, telefone_one, telefone_two, telefone_recado, rua, cidade, estado, cargo
        ) VALUES 
        (:name_user, :cpf, :endereco, :telefone_one, :telefone_two, :telefone_recado, :rua, :cidade, :estado, :cargo
        )");
        
        $sql->bindValue(':name_user', $iv->name_user);
        $sql->bindValue(':cpf', $iv->cpf);
        $sql->bindValue(':endereco', $iv->endereco);
        $sql->bindValue(':telefone_one', $iv->telefone_one);
        $sql->bindValue(':telefone_two', $iv->telefone_two);
        $sql->bindValue(':telefone_recado', $iv->telefone_recado);
        $sql->bindValue(':rua', $iv->rua);
        $sql->bindValue(':cidade', $iv->cidade);
        $sql->bindValue(':estado', $iv->estado);
        $sql->bindValue(':cargo', $iv->cargo);
        $sql->execute();
    }

    
}