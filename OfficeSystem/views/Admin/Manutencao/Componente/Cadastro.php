<?php
  if(!empty($msg)){
    echo $msg;
  }
?>
<div class="content margin-painel-cadastro">
  <h3 ><b>Cadastro </b>Componente Veicular</h3><br>
  <form  name="form1" method="POST" action="<?= BASE; ?>Componente/Adicionar" data-parsley-validate enctype="multipart/form-data">
    <div class="row">
      <div class="form-group col-md-5">
        <label for="descricao">Nome:</label>
        <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Nome" required data-parsley-required-message="Preencha o Campo NOME" >
      </div>
      <div class="form-group col-md-2">
        <label for="descricao">Codigo:</label>
        <input type="text" class="form-control" name="codigo" id="codigo" readonly  required data-parsley-required-message="Preencha o Campo CODIGO" value="<?php echo $cont; ?>" >
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" value="Cadastrar" class="btn btn-primary ">Salvar</button>
    </div>
  </form>
</div>

