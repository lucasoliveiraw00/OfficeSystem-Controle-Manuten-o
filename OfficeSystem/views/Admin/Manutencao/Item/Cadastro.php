<?php
  if(!empty($msg)){
    echo $msg;
  }
?>  
<div class="content margin-painel-cadastro">
  <div class="col-12">
    <div class="card-header">
      <h3><b>Cadastro </b> do Item Veicular</h3>
    </div>
    <div class="card-body">
      <form  name="form1" method="POST" action="<?= BASE; ?>Item/Adicionar" data-parsley-validate enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-md-5">
            <label for="descricao">Nome do Item:</label>
            <input type="text" class="form-control" name="descricao" placeholder="Nome" id="descricao" pa required data-parsley-required-message="Preencha o Campo NOME" >
          </div>
          <div class="form-group col-md-3">
            <label for="codigo">Codigo do Item:</label>
            <input type="text" class="form-control" name="codigo" placeholder="Codigo" id="codigo" readonly required data-parsley-required-message="Preencha o Campo CODIGO" value="<?php echo $codigo_item ?>" >
          </div>
        </div>
        <div class="content margin-painel-cadastro">
          <div class="col-12">
            <div class="card-header">
              <br><h4><b>Dados </b> do Componente Veicular</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-5">
                  <label for="codigo_comp">Codigo do Componente:</label>   
                  <input type="text" class="hidden" name="id_comp" id="id_comp" value="<?php echo $id?>">
                  <input type="text" class="form-control"  name="codigo_comp" id="codigo_comp"   readonly required data-parsley-required-message="Preencha o Campo CODIGO" value="<?php echo $Codigo?>" >
                </div> 
                <div class="form-group col-md-5">
                  <label for="descricao_comp">Nome do Componente:</label>
                  <input type="text" class="form-control" name="descricao_comp" id="descricao_comp"  readonly required data-parsley-required-message="Preencha o Campo NOME" value="<?php echo $Nome?>">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" value="Cadastrar" class="btn btn-primary ">Salvar</button>
            </div>
      </form>
    </div>
  </div>
</div>