<?php
        if(!empty($msg)){
          echo $msg;
        }
?> 
<div class="content margin-painel-cadastro">
  <div class="col-12">
    <div class="card-header">
      <h3 ><b>Editar </b> Item Veicular</h3>
    </div>
    <div class="card-body"> 
      <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>Item/Editar/<?php echo $DadosItemComp['id_item']; ?>" enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-md-5">
            <label for="descricao">Item:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Nome" required value="<?php echo $DadosItemComp['descricao_item']; ?>" >
            </div>  
          <span class="hidden msg-error invalido-descricao">Preencher o Campo Nome.
          </div>
          <div class="form-group col-md-3">
            <label for="codigo_sub">Codigo:</label>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="codigo" id="codigo" readonly  required  value="<?php echo $DadosItemComp['codigo_item']; ?>" >
            </div>  
            <span class="hidden msg-error invalido-codigo">Preencher o Campo Codigo.
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
                <label for="modelo">Componente:</label>  
                <div class="input-group mb-3">  
                <input type="text" class="hidden" name="id_comp" id="id_comp" value="<?php echo $DadosItemComp['id_comp']; ?>">
                <input type="text" class="form-control pointer" name="descricao_comp" id="descricao_comp" alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Componente" placeholder="Selecionar" readonly required  value="<?php echo $DadosItemComp['descricao_comp']; ?>" >
                  <div class="input-group-append">
                    <div data-toggle="modal" data-target=".Modal-Componente"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></div>
                  </div>
                </div>
                <span class="hidden msg-error invalido-descricao_comp">Preencher o Campo Nome. 
              </div> 
              <div class="form-group col-md-5"> 
                <label for="modelo">Codigo:</label>  
                <div class="input-group mb-3">  
                <input type="text" class="form-control pointer"  name="codigo_comp" id="codigo_comp"  alert-tooltip="tooltip" title="Click para Selecionar"  data-toggle="modal" data-target=".Modal-Componente" placeholder="Selecionar" readonly required  value="<?php echo $DadosItemComp['codigo_comp']; ?>" >
                  <div class="input-group-append">
                    <div data-toggle="modal" data-target=".Modal-Componente"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></div>
                  </div>
                </div>
                <span class="hidden msg-error invalido-codigo_comp">Preencher o Campo Codigo. 
              </div> 
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" id="enviar" value="Cadastrar" class="btn btn-primary ">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade Modal-Componente" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="fundoTable">
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header">
                                <h4><b>Lista</b> de Componente Veicular</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Componente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($listDadosComp as $listar):?>
                                                <tr class="pointer" title="SELECIONAR" data-dismiss="modal" aria-label="Close" onclick="SelecionaComponente(<?php echo $listar['id']?>,'<?php echo $listar['descricao']?>','<?php echo $listar['codigo']?>')">
                                                    <td><?php echo $listar['codigo']?></td>
                                                    <td><?php echo $listar['descricao']; ?></td>
                                                </tr>
                                            <?php endforeach; ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>      
        </div>
    </div>
</div>
