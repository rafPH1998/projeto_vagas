<?php
require 'config.php';
require_once 'dao/VagaDaoMysql.php';

$vagaDao = new VagaDaoMysql($pdo);
$user = [];

$id = filter_input(INPUT_POST, 'id');
if($id) {
  $user = $vagaDao->findByIdVaga($id);
}
?>
<main>

  <h2 class="mt-3"></h2>

  <form method="POST">

    <input type="hidden" name="id" value="<?= $user->id; ?>">

    <div class="form-group">
      <label>Título  da Vaga</label>
      <input type="text" class="form-control" name="titulo" value="<?= $user->titulo; ?>">
    </div>

    <div class="form-group">
      <label>Descrição da Vaga</label>
      <textarea style="resize: none" class="form-control" name="descricao" rows="20"><?= $user->descricao; ?></textarea>
    </div>

    <div class="form-group">
      <label>Cidade</label>
      <input type="text" class="form-control" name="cidade" value="<?= $user->cidade; ?>">
    </div>

    <div class="form-group">
      <label>Data da Vaga: </label>
      <input type="date" class="form-control" name="data" value="<?= $user->data; ?>" readonly>
    </div>

    <div class="area-button">

      <div class="form-group"> 
        <button class="btn btn-success">Salvar</button>
        <a href="vagas.php" style="margin-left:10px;" class="btn btn-primary" onclick="fechar()">Voltar</a>
      </div>
      
    </div>
  </form>
</main>

