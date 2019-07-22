<div class="content margin-painel-cadastro">
  <h3><b>Editar </b> Procedimento Veicular</h3><br>
  <?php
    if(!empty($msg)){
      echo $msg;
    } 
  ?>
  <form  name="form1" method="POST" action="<?= BASE; ?>Procedimento/Editar/<?php echo $infos['id']; ?>" data-parsley-validate enctype="multipart/form-data">
    <div class="row">
      <div class="form-group col-md-5">
        <label for="descricao_op">Nome:</label>
        <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Nome" required data-parsley-required-message="Preencha o Campo NOME" value="<?php echo $infos['descricao']; ?>">
      </div>
      <div class="form-group col-md-3">
        <label for="codigo">Codigo:</label>
        <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Codigo" readonly required data-parsley-required-message="Preencha o Campo CODIGO"  value="<?php echo $infos['codigo']; ?>">
      </div>
     
    </div>
    <div class="card-footer">
      <button type="submit" value="Cadastrar" class="btn btn-primary ">Salvar</button>
    </div>
  </form>
</div>
