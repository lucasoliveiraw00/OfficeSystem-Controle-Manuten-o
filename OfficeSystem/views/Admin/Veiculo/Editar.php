<div class="content margin-painel-cadastro">
  <div class="col-12">
    <div class="card-header">
      <h3 ><b>Editar </b> Veículo</h3><br>
    </div>
    <div class="card-body">
      <?php
        if(!empty($msg)){
          echo $msg;
        }
      ?>
      <div class="container">
      <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>Veiculo/Editar/<?php echo $infos['id_veiculo']; ?>" data-parsley-validate enctype="multipart/form-data">
        <div class="row">
          <div class="form-group col-md-5">
            <label for="modelo">Modelo:</label>
            <div class="input-group mb-3">  
              <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo" required data-parsley-required-message="Preencha o Campo MODELO" value="<?php echo $infos['modelo']; ?>">
            </div>
            <span class="hidden msg-error invalido-modelo">Preencher o Campo Modelo. 
          </div>
          <div class="form-group col-md-5">
            <label for="marca">Marca:</label>
            <div class="input-group mb-3">  
              <input type="text" class="form-control" name="marca" id="marca" placeholder="Marca" required data-parsley-required-message="Preencha o Campo MARCA" value="<?php echo $infos['marca']; ?>">
            </div>
            <span class="hidden msg-error invalido-marca">Preencher o Campo Marca. 
          </div>
          <div class="form-group col-md-5">
            <label for="ano">Ano:</label>
            <div class="input-group mb-3">  
              <input type="text"  class="form-control" name="ano" id="ano"  placeholder="Ano" required data-parsley-required-message="Preencha o Campo ANO" value="<?php echo $infos['ano']; ?>">
            </div>
            <span class="hidden msg-error invalido-ano">Preencher o Campo Ano. 
          </div>  
          <div class="form-group col-md-5">
            <label for="cor">Cor:</label>
            <div class="input-group mb-3">    
              <input type="text" class="form-control" name="cor" id="cor" placeholder="Cor" required data-parsley-required-message="Preencha o Campo COR" value="<?php echo $infos['cor']; ?>">
            </div>
            <span class="hidden msg-error invalido-cor">Preencher o Campo Cor. 
          </div> 
          <div class="form-group col-md-5">
            <label for="placa">Placa:</label>
            <div class="input-group mb-3">  
              <input type="text" class="form-control" name="placa" id="placa" placeholder="Placa"  required data-parsley-required-message="Preencha o Campo PLACA" value="<?php echo $infos['placa']; ?>">
            </div>
            <span class="hidden msg-error invalido-placa">Preencher o Campo Placa. 
          </div> 
        </div>
        <div class="col-12">
          <div class="card-header">
            <h4 ><b>Dados </b> do Proprietário</h4><br>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-5"> 
                <label for="modelo">Nome:</label>  
                <div class="input-group mb-3">  
                <input type="text" class="hidden" name="id_cliente" id="id_cliente" value="<?php echo $infos['id_cliente']; ?>">
                  <input type="text" class="form-control pointer"  name="nome" id="nome_cliente" alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Cliente" placeholder="Selecionar" readonly required value="<?php echo $infos['nome']; ?>" >
                  <div class="input-group-append">
                    <div data-toggle="modal" data-target=".Modal-Cliente"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></div>
                  </div>
                </div>
                <span class="hidden msg-error invalido-nome_cliente">Preencher o Campo Nome. 
              </div> 
              <div class="form-group col-md-5"> 
                <label for="modelo">CPF/CNPJ:</label>  
                <div class="input-group mb-3">  
                <input type="text" class="form-control pointer" name="cpfcnpj" id="cpfcnpj" alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Cliente" placeholder="Selecionar" readonly required  value="<?php echo $infos['cpfcnpj']; ?>" >
                  <div class="input-group-append">
                    <div data-toggle="modal" data-target=".Modal-Cliente"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></div>
                  </div>
                </div>
                <span class="hidden msg-error invalido-cpfcnpj">Preencher o Campo CPF/CNPJ. 
              </div> 
            </div> 
          </div>  
          <div class="card-footer">
            <button type="submit" id="enviar" value="Cadastrar" class="btn btn-primary ">Salvar</button>
          </div>
        </div>
      </form>
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
                <h3><b>Lista </b> de Cliente</h3>
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

<script type="text/javascript">

  $("#placa").inputmask({mask: 'AAA-9999'});

  var options =  {
  onKeyPress: function(cep, e, field, options) {
  var masks = ['00000 ', '0000/0000'];
  var mask = (cep.length>=5) ? masks[1] : masks[0];
  $('#ano').mask(mask, options);
  }};

  $('#ano').mask('00000', options);
</script>