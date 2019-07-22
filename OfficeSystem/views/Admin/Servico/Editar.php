<div class="content margin-painel-cadastro">
  <div class="col-12">
    <div class="card-header">
        <h3><b>Editar </b> Serviço</h3>
    </div>
    <div class="card-body">
  <?php
    if(!empty($msg)){
      echo $msg;
    }
  ?>
    <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>Servico/Dados/<?php echo $ResultDados['id']; ?>" enctype="multipart/form-data">
    <div class="row">
            <div class="form-group col-md-5">  
                <label for="nome">Usuário:</label>
                <div class="mb-3">  
                    <input type="text" class="hidden"  readonly name="id_col" id="id_col"  value="<?php echo $ResultDados['id_col']; ?>">
                    <input type="text" class="form-control " name="nome" id="nome" placeholder="Nome" readonly required value="<?php echo $ResultDados['nome']; ?>" >    
                </div> 
            </div> 
            <div class="form-group col-md-5">
                <label for="matricula">Matricula:</label>    
                <div class="mb-3">  
                    <input type="text" class="form-control" name="matricula" id="matricula" placeholder="Matricula" readonly  required value="<?php echo $ResultDados['matricula']; ?>">
                </div> 
            </div>
        </div>
        <div class="col-12">
            <div class="card-header">
                <h4 ><b>Dados </b> de Apontamento</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="matricula">Procedimento:</label>    
                        <div class="input-group mb-3">  
                            <input type="text" class="hidden"  readonly name="id_proc" id="id_proc" value="<?php echo $ResultDados['id_proc']; ?>" >
                            <input type="text" class="form-control pointer"  name="descricao_proc" id="descricao_proc" readonly placeholder="Procedimento" data-toggle="modal" data-target=".Modal-Procedimento" required value="<?php echo $ResultDados['descricao_proc']; ?>" >
                            <div class="input-group-append">
                                <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Procedimento" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                            </div>
                        </div> 
                        <span class="hidden msg-error invalido-descricao_proc">Preencher o Campo Procedimento.
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Codigo:</label>  
                        <div class="input-group mb-3">  
                            <input type="codigo_proc" class="form-control pointer" name="codigo_proc" id="codigo_proc" placeholder="Codigo" readonly data-toggle="modal" data-target=".Modal-Procedimento" required value="<?php echo $ResultDados['codigo_proc']; ?>" >
                            <div class="input-group-append">
                                <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Procedimento" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                            </div>
                        </div> 
                        <span class="hidden msg-error invalido-codigo_proc">Preencher o Campo Codigo.
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Componente:</label>  
                        <div class="input-group mb-3">  
                            <input type="text" class="hidden"  readonly name="id_comp" id="id_comp" value="<?php echo $ResultDados['id_comp']; ?>">
                            <input type="text" class="form-control pointer" name="descricao_comp" id="descricao_comp" data-toggle="modal" data-target=".Modal-Componente" readonly placeholder="Componente" required value="<?php echo $ResultDados['descricao_comp']; ?>"  >
                            <div class="input-group-append">
                                <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Componente" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                            </div>
                        </div> 
                        <span class="hidden msg-error invalido-id_comp">Preencher o Campo Componente.
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Codigo:</label>  
                        <div class="input-group mb-3">  
                            <input type="codigo_comp" class="form-control pointer"  name="codigo_comp" data-toggle="modal" data-target=".Modal-Componente"  id="codigo_comp" placeholder="Codigo" readonly  required value="<?php echo $ResultDados['codigo_comp']; ?>">
                            <div class="input-group-append">
                                <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Componente" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                            </div>
                        </div> 
                        <span class="hidden msg-error invalido-codigo_comp">Preencher o Campo Codigo.
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Item:</label>  
                        <div class="input-group mb-3">  
                            <input type="text" class="hidden" readonly  name="id_item" id="id_item"  value="<?php echo $ResultDados['id_item']; ?>" >
                            <input type="text" class="form-control pointer" name="descricao_item" onclick="ModalItemDados();"  id="descricao_item" readonly placeholder="Item"  required value="<?php echo $ResultDados['descricao_item']; ?>" >
                            <div class="input-group-append">
                                <span alert-tooltip="tooltip" title="Click para Selecionar" onclick="ModalItemDados();" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                            </div>
                        </div> 
                        <span class="hidden msg-error invalido-descricao_item">Preencher o Campo Item.
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Item:</label>  
                        <div class="input-group mb-3">  
                            <input type="codigo_item" class="form-control pointer"name="codigo_item" onclick="ModalItemDados();" id="codigo_item" placeholder="Codigo" readonly required value="<?php echo $ResultDados['codigo_item']; ?>">
                            <div class="input-group-append">
                                <span alert-tooltip="tooltip" title="Click para Selecionar" onclick="ModalItemDados();" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                            </div>
                        </div> 
                        <span class="hidden msg-error invalido-codigo_item">Preencher o Campo Codigo.
                    </div>
                    <div class="col-5">
                        <h5 >Abertura:</h5>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="nome">Data:</label>
                                    <input type="text" class="form-control" name="dataAbertura" id="dataAbertura" required readonly value="<?php echo $ResultDados['dataAbertura']; ?>">
                                    <span class="hidden msg-error invalido-dataAbertura">Preencher o Campo Data Abertura.
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="nome">Hora:</label>
                                    <input type="text" class="form-control" name="horaAbertura" id="horaAbertura"  required readonly value="<?php echo $ResultDados['horaAbertura']; ?>">
                                    <span class="hidden msg-error invalido-horaAbertura">Preencher o Campo Hora Abertura.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="hidden"  readonly name="status" id="status" value="<?php echo $ResultDados['status']; ?>" >
                        <?php if ($ResultDados['status'] == "Aberto") { ?>
                            <div class="form-group" >
                                <h5>Status:
                                    <span class="badge badge-warning">
                                        <?php echo $ResultDados['status']; ?>
                                    </span>
                                </h5>
                            </div>
                        <?php } else { ?>
                            <div class="form-group" >
                                <h5>Status:
                                    <span class="badge badge-danger">
                                        <?php echo $ResultDados['status']; ?>
                                    </span>
                                </h5>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" id="enviar" class="btn btn-primary ">Salvar</button>
                <button type="button" class="btn btn-danger btn-margin-list" onclick="AlertFecharApt(<?php echo $ResultDados['id']; ?>)">Fechar</button> 
            </div>
        </div>
    </form>
</div>

<div class="modal fade Modal-Procedimento" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="fundoTable">
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header">
                                <h4><b>Lista</b> de Procedimento Veicular</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example2" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Procedimento</th>
                                                <th>Codigo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($ResultDadosProcedimento as $listar):?>
                                                <tr class="pointer" title="SELECIONAR" data-dismiss="modal" aria-label="Close" onclick="SelecionaProcedimento(<?php echo $listar['id']?>,'<?php echo $listar['descricao']?>','<?php echo $listar['codigo']?>')">
                                                    <td><?php echo $listar['descricao']; ?></td>
                                                    <td><?php echo $listar['codigo']?></td>
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
                                    <table id="example3" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Componente</th>
                                                <th>Compon Codigo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($ResultDadosComponente as $listar):?>
                                                <tr class="pointer" title="SELECIONAR" data-dismiss="modal" aria-label="Close" onclick="SelecionaComponente2(<?php echo $listar['id']?>,'<?php echo $listar['descricao']?>','<?php echo $listar['codigo']?>')">
                                                    <td><?php echo $listar['descricao']; ?></td>
                                                    <td><?php echo $listar['codigo']?></td>
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
<div class="modal fade Modal-Item" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundoTable">
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card-header" >
                <h3 ><b>Lista </b> de Itens Veicular</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive " id="ResultDados">
            
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>      
    </div>
  </div>
</div>


<script type="text/javascript">
    $('#dataAbertura').mask("00/00/0000", {placeholder: "__/__/____"});
    $('#horaAbertura').mask(mask, pattern);
    $('#dataFechamento').mask("00/00/0000", {placeholder: "__/__/____"});
    $('#horaFechamento').mask(mask, pattern);
</script>