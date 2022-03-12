
<?php
require 'config.php';
require 'assets/partials/header.php';
?>

<main>
  <section>
    <a href="vagas.php">
      <button class="btn btn-success">Voltar</button>
    </a>
  </section>

  <h2 class="mt-3"></h2>

  <form method="POST" action="cadastrar_vagas_action.php">

    <?php if(!empty($_SESSION['flash'])):?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['flash']; ?>
            <?= $_SESSION['flash'] = ''; ?>
        </div>
    <?php elseif(!empty($_SESSION['success'])):?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success']; ?>
            <?= $_SESSION['success'] = ''; ?>
        </div>
    <?php endif;?>

    <div class="form-group">
      <label>Título  da Vaga</label>
      <input type="text" class="form-control" name="titulo">
    </div>

    <div class="form-group">
      <label>Descrição da Vaga</label>
      <textarea class="form-control" name="descricao" rows="5"></textarea>
    </div>

    <div class="form-group">
      <label>Cidade</label>
      <input type="text" class="form-control" name="cidade">
    </div>

    <div class="form-group">
      <label>Status</label>

      <div>
          <div class="form-check form-check-inline">
            <label class="form-control">
              <input type="radio" name="ativo"> Ativo
            </label>
          </div>

          <div class="form-check form-check-inline">
            <label class="form-control">
              <input type="radio" name="inativo"> Inativo
            </label>
          </div>
      </div>

    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-success">Enviar</button>
    </div>

  </form>
</main>

<?php
require 'assets/partials/footer.php';
?>