<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro">
  <div class="col-12">
    <div class="card-header">
      <h3 ><b>Relatorio </b> de Manutenção</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>Relatorio/ManutencaoVeiculo">                   
            <div class="col-sm-15">   
              <div class="row">
                <div class="form-group col-md-5">  
                  <label>Veículo:</label> 
                  <div class="input-group mb-3">  
                    <input type="text" class="hidden" name="id" id="id_veiculo" required readonly>
                    <input type="text" class="form-control"  name="modelo" id="modelo"  placeholder="Selecionar" readonly  required>
                    <div class="input-group-append">
                      <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Veiculo" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-modelo">Preencher o Campo Veículo.
                </div>
                <div class="form-group col-md-3">
                    <label for="nome">Data Inicio:</label>
                    <div class="input-group mb-3" >  
                      <input type="text" class="form-control " name="dataInicio" id="dataInicio" data-date-end-date="0d" readonly required >
                      <div class="input-group-append" >
                        <span alert-tooltip="tooltip" title="Click para Selecionar" class="input-group-text pointer" id="dateinicio"><i class="far fa-calendar-alt"></i></span>
                      </div>
                    </div> 
                  </div>
                  <div class="form-group col-md-3">
                    <label for="nome">Data Final:</label>
                    <div class="input-group mb-3" >  
                      <input type="text" class="form-control " name="dataFinal" id="dataFinal" data-date-end-date="0d" readonly required >
                      <div class="input-group-append" >
                        <span alert-tooltip="tooltip" title="Click para Selecionar" class="input-group-text pointer" id="datefinal"><i class="far fa-calendar-alt"></i></span>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary ">Gerar</button>
              </div>
            </div>
          </form>
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
                <div class="table-responsive ">
                    <table id="example1" class="table  table-hover">
                        <thead>
                        <tr>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Cor</th>
                            <th>Placa</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php foreach($linha as $listar):?>
                              <tr class="pointer" title="SELECIONAR" data-dismiss="modal" aria-label="Close" onclick="SelecionaVeiculoRl(<?php echo $listar['id']?>,'<?php echo $listar['modelo']?>','<?php echo $listar['placa']?>')">
                              <td><?php echo $listar['modelo']?></td>
                              <td><?php echo $listar['marca']?></td>
                              <td><?php echo $listar['cor']?></td>
                              <td><?php echo $listar['placa']; ?></td>
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
<script>
  let $dataInicio = $('#dataInicio'), $dataFinal = $('#dataFinal');

  $dataInicio.datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    clearBtn: true
  }).data('datepicker');

  $dataFinal.datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    tautoclose: true,
    todayHighlight: true,
    clearBtn: true
  }).data('datepicker');

  $('#dateinicio').on('click', function() {
    $dataInicio.show();
    $dataInicio.focus();
  });
  $('#datefinal').on('click', function() {
    $dataFinal.show();
    $dataFinal.focus();
  });

  $('#dataInicio').mask("00/00/0000", {placeholder: "__/__/____"});
  $('#dataFinal').mask("00/00/0000", {placeholder: "__/__/____"});
</script>