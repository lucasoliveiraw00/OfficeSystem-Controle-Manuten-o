<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro">
  <div class="col-12">
      <div class="card-header">
        <h3 ><b>Relação </b> de Veículo</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="col-sm-15">   
              <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>Relatorio/ProprietarioVeiculo">                   
                <div class="row">
                  <div class="form-group col-md-5">  
                    <label for="modelo">Proprietário:</label> 
                    <div class="input-group mb-3">  
                      <input type="text" class="hidden" name="id" id="id_cliente" required readonly>
                      <input type="text" class="form-control"  name="nome" id="nome_cliente"  placeholder="Selecionar" readonly  required>
                    <div class="input-group-append">
                      <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Cliente" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                    </div> 
                    <span class="hidden msg-error invalido-nome_cliente">Preencher o Campo Nome.
                  </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit"  id="enviar" class="btn btn-primary ">Gerar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
<div class="modal fade Modal-Cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="fundoTable">
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card-header">
                <h3 ><b>Lista </b> de Cliente</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table id="example1" class="table  table-hover">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($linha as $listar):?>
                        <tr class="pointer" title="SELECIONAR" data-dismiss="modal" aria-label="Close" onclick="SelecionaCliente(<?php echo $listar['id']?>,'<?php echo $listar['nome']?>','<?php echo $listar['cpfcnpj']?>')">
                          <td><?php echo $listar['nome']?></td>
                          <td><?php echo $listar['cpfcnpj']; ?></td>
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
