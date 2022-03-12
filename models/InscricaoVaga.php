<?php

class InscricaoVaga {
    public $id;
    public $name_user;
    public $cpf;
    public $endereco;
    public $telefone_one;
    public $telefone_two;
    public $telefone_recado;
    public $rua;
    public $cidade;
    public $estado;
    public $cargo;
}

interface InscricaoVagaDAO {
    public function inscricaoVaga(InscricaoVaga $iv);
} 