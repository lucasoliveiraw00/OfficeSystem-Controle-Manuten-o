<?php
  if(!empty($msg)){
    echo $msg;
  }
?>  
<div class="content margin-painel-cadastro">
  <h3><b>Abrir </b> Ordem de Serviço <c>Nº: <?php echo $cont; ?></c></h3> 
    <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>OrdemDeServico/Adicionar"  enctype="multipart/form-data">    
      <div class="row">
          <div class=col>
            <h5>Solicitante:</h5>
              <div class="col-sm-12">
                <div class="row">
                  <div class="form-group col-md-5">
                    <label for="nome">Usuário:</label>
                    <input type="text" class="hidden" value="<?php echo $cont; ?>" name="numero_os" id="numero_os" readonly>
                    <input type="text" class="hidden" value="<?php  echo $_SESSION["sistema"]["id"]; ?>" name="id_colaborador" id="id_colaborador" readonly>
                    <input type="text" class="form-control" value="<?php  echo $_SESSION["sistema"]["nome"]; ?>" name="nome_usuario" id="nome_usuario"  readonly required >
                  </div> 
                  <div class="form-group col-md-5">
                    <label for="matricula">Matricula:</label>
                    <input type="text" class="form-control" name="matricula" id="matricula" value="<?php  echo $_SESSION["sistema"]["matricula"]; ?>"  readonly required >
                  </div>
                </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class=col>
          <h5>Dados do Proprietário:</h5>
            <div class="col-sm-12">
              <div class="row"> 
                <div class="form-group col-md-5">  
                <label for="modelo">Nome:</label> 
                  <div class="input-group mb-3">  
                    <input type="text" class="hidden" name="id_cliente" id="id_cliente" required readonly>
                    <input type="text" class="form-control pointer"  name="nome" id="nome" data-toggle="modal" data-target=".Modal-Cliente" placeholder="Selecionar" readonly  required>
                    <div class="input-group-append">
                      <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Cliente" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-nome">Preencher o Campo Nome.
                </div> 
                <div class="form-group col-md-5">
                <label for="modelo">CPF/CNPJ:</label>    
                  <div class="input-group mb-3">  
                    <input type="text" class="form-control pointer"  name="cpfcnpj" id="cpfcnpj" data-toggle="modal" data-target=".Modal-Cliente" placeholder="Selecionar" readonly required >
                    <div class="input-group-append">
                      <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Cliente" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-cpfcnpj">Preencher o Campo CPF/CNPJ.
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class=col>
          <h5>Dados do Veiculo:</h5>
            <div class="col-sm-12">
              <div class="row"> 
                <div class="form-group col-md-5"> 
                  <label for="modelo">Modelo:</label>  
                  <div class="input-group mb-3">  
                    <input type="text" class="hidden" name="id_veiculo" id="id_veiculo"  required readonly>
                    <input type="text" class="form-control pointer" name="modelo_veiculo" id="modelo_veiculo" onclick="ModalVeiculoDados();" placeholder="Selecionar" readonly required  >
                    <div class="input-group-append">
                      <div onclick="ModalVeiculoDados();"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></div>
                    </div>
                  </div>
                  <span class="hidden msg-error invalido-modelo_veiculo">Preencher o Campo Modelo. 
                </div> 
                <div class="form-group col-md-5"> 
                  <label for="modelo">Marca:</label>  
                  <div class="input-group mb-3">  
                    <input type="text" class="form-control pointer" name="marca" id="marca_veiculo" onclick="ModalVeiculoDados();" placeholder="Selecionar" readonly required  >
                    <div class="input-group-append">
                      <span onclick="ModalVeiculoDados();"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-marca_veiculo">Preencher o Campo Marca.
                </div>
                <div class="form-group col-md-5"> 
                  <label for="modelo">Ano:</label>  
                  <div class="input-group mb-3">  
                    <input type="text" class="form-control pointer" name="ano" id="ano_veiculo" onclick="ModalVeiculoDados();" placeholder="Selecionar" readonly required >
                    <div class="input-group-append">
                      <div onclick="ModalVeiculoDados();"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></div>
                    </div>
                  </div> 
                   <span class="hidden msg-error invalido-ano_veiculo">Preencher o Campo Ano.
                </div>
                <div class="form-group col-md-5"> 
                  <label for="modelo">Placa:</label>  
                  <div class="input-group mb-3">  
                    <input type="text" class="form-control pointer" name="placa" id="placa_veiculo" onclick="ModalVeiculoDados();"  placeholder="Selecionar" readonly required>
                    <div class="input-group-append">
                      <span onclick="ModalVeiculoDados();"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-placa_veiculo">Preencher o Campo Placa.
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-5">
          <h5 >Prazo:</h5>
          <div class="col-sm-12">
            <div class="row">
              <div class="form-group col-md-6"> 
                <label for="dataPrazo">Data:</label>  
                <div class="input-group mb-3">  
                  <input type="text" class="form-control"  name="dataPrazo" id="dataPrazo"  data-date-start-date="0d" readonly required >
                  <div class="input-group-append">
                    <span alert-tooltip="tooltip" title="Click para Selecionar" class="input-group-text pointer" id="dateprazo"><i class="far fa-calendar-alt"></i></span>
                  </div>
                </div>
                <span class="hidden msg-error invalido-dataPrazo">Preencher o Campo Data. 
              </div> 
              <div class="form-group col-md-5">
                <label for="horaPrazo">Hora:</label>
                <div class="input-group mb-3" >  
                  <input type="text" class="form-control" name="horaPrazo" id="horaPrazo" required >
                </div> 
                <span class="hidden msg-error invalido-horaPrazo">Preencher o Campo Hora.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-10">
          <label for="descricao">Descrição:</label>
          <div class="mb-3">
            <textarea class="form-control " id="descricao" rows="3" style="resize:none" name="descricao"></textarea>
          </div>
            <span class="hidden msg-error invalido-descricao">Preencher o Campo Descrição.
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" id="enviar" value="Cadastrar" class="btn btn-primary ">Salvar</button>
      </div> 
    </form>
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
                          <tr class="pointer" title="SELECIONAR" data-dismiss="modal" aria-label="Close" onclick="SelecionaCliente2(<?php echo $listar['id']?>,'<?php echo $listar['nome']?>','<?php echo $listar['cpfcnpj']?>');VerificarDadosProprietario(<?php echo $listar['id']?>,'<?php echo $listar['nome']?>');">
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
</div>
<div class="modal fade Modal-Veiculo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="fundoTable">
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card-header" >
                <h3 ><b>Lista </b> de Veículo</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive " id="ResultDadoVeiculo">
                 
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
  $('#dataPrazo').mask("00/00/0000", {placeholder: "__/__/____"});
  $('#horaPrazo').mask(mask, pattern);

  let $dataPrazo = $('#dataPrazo');

  $dataPrazo.datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    clearBtn: true
  }).data('datepicker');


  $('#dateprazo').on('click', function() {
    $dataPrazo.show();
    $dataPrazo.focus();
  });

</script>