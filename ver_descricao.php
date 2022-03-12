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

    <h2 class="descricao">Visualizar descrição da vaga: </h2><br/>

    <input type="hidden" name="id" value="<?= $user->id; ?>">

    <div class="form-group">
      <label>Descrição da Vaga: </label>
      <textarea style="resize: none" class="form-control" name="descricao" rows="25" onclick="ver_descricao('<?= $user->id; ?>')"><?= $user->descricao; ?></textarea>
    </div>

    <div class="area-button">

      <div class="form-group"> 
        <a href="vagas.php" style="margin-left:10px;" class="btn btn-primary" onclick="fechar()">Fechar</a>
      </div>
      
    </div>
  </form>
</main>