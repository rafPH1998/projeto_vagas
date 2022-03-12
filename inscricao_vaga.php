<main>
  <form method="POST" id="b7validator">

    <h1 class="h1">Fazer inscrição</h1>

    <div class="container">
        <div id="area-alert" class="alert alert-success" >Inscrição feita com sucesso! <a href="vagas.php">Voltar</a></div>
    </div>

    <div class="main-content">
        <input type="hidden" name="id">
        
        <!-- INICIO DIV AREA 1-->
        <div class="area">
            <div class="form-group">
                <label>Nome Completo:</label>
                <input placeholder="Digite seu Nome Completo"  class="form-control-content" type="text" name="name" data-rules="required|min=2" />
            </div>

            <div class="form-group">
                <label>CPF:</label>
                <input placeholder="Digite seu CPF" class="form-control-content" type="text" name="cpf" data-rules="required|min=2" />
            </div>

            <div class="form-group">
                <label>Endereço:</label>
                <input placeholder="Digite seu Endereço" class="form-control-content" type="text" name="endereco" data-rules="required|min=2" />
            </div>
        </div>

        <div class="area">
            <div class="form-group">
                <label>Telefone 1:</label>
                <input placeholder="Digite seu telefone" class="form-control-content" type="text" name="tel_1" data-rules="required|min=2" />
            </div>      

            <div class="form-group">
                <label>Telefone 2:</label>
                <input placeholder="Digite seu telefone" class="form-control-content" type="text" name="tel_2" data-rules="required|min=2" />
            </div>   

            <div class="form-group">
                <label>Telefone para recado:</label>
                <input placeholder="Telefone para recado" class="form-control-content" type="text" name="tel_recado" data-rules="required|min=2" />
            </div>   
        </div>

        <div class="area">
            <div class="form-group">
                <label>Rua:</label>
                <input placeholder="Digite sua Rua" class="form-control-content" type="text" name="rua" data-rules="required|min=2" />
            </div> 

            <div class="form-group">
                <label>Cidade:</label>
                <input placeholder="Digite sua Cidade" class="form-control-content" type="text" name="cidade" data-rules="required|min=2" />
            </div>   

            <div class="form-group">
                <label>Estado:</label>
                <input placeholder="Digite seu Estado" class="form-control-content" type="text" name="estado" data-rules="required|min=2"/>
            </div>   
        </div>
        <!-- FIM DIV AREA 1-->

        <input class="btn btn-outline-primary" type="submit" value="Cadastrar">
        <a href="vagas.php" type="button" class="btn btn-outline-secondary">Cancelar</a>
    </div>
  </form>
</main>


