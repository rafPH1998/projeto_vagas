<?php

class Vaga {
    public $id;
    public $titulo;
    public $descricao;
    public $status;
    public $data;
    public $cidade;
}

interface VagaDAO {
    public function findAll();
    public function insertVaga(Vaga $v);
    public function deleteVaga($id);
    public function findByIdVaga($id);
    public function updateVaga(Vaga $v);
} 