<?php
    if(!empty($msg)){
        echo $msg;
    }
?>






<section class="content">
  <div class="col-12">
    <div class="card-header">
      <h3 ><b>Relatorio </b> de Produção</h3>
    </div>
    <div class="card-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Individual</h3>
              </div>
              <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>Relatorio/ProducaoIndividual">                   
                <div class="card-body"> 
                  <div class="row">
                    <div class="form-group col-md-12">  
                      <label>Colaborador:</label> 
                      <div class="input-group mb-3">  
                        <input type="text" class="hidden"  readonly name="id" id="id_col"  >
                        <input type="text" class="form-control " name="nome" id="nome" placeholder="Nome" readonly required >
                        <div class="input-group-append">
                        <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Colaborador" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                        </div>
                      </div> 
                      <span class="hidden msg-error invalido-nome">Preencher o Campo Colaborador.
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="nome">Data Inicio:</label>
                      <div class="input-group mb-3" >  
                        <input type="text" class="form-control " name="dataInicio" id="dataInicio" data-date-end-date="0d" readonly required >
                        <div class="input-group-append" >
                          <span alert-tooltip="tooltip" title="Click para Selecionar" class="input-group-text pointer" id="dateinicio"><i class="far fa-calendar-alt"></i></span>
                        </div>
                      </div> 
                      <span class="hidden msg-error invalido-dataInicio">Preencher o Campo Data Inicio.
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nome">Data Final:</label>
                      <div class="input-group mb-3" >  
                        <input type="text" class="form-control " name="dataFinal" id="dataFinal" data-date-end-date="0d" readonly required >
                        <div class="input-group-append" >
                          <span alert-tooltip="tooltip" title="Click para Selecionar" class="input-group-text pointer" id="datefinal"><i class="far fa-calendar-alt"></i></span>
                        </div>
                      </div> 
                      <span class="hidden msg-error invalido-dataFinal">Preencher o Campo Data Final.
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="nome">Horas de Produção:</label>
                        <div class="input-group mb-3"> 
                            <select name="horasdiaria" id="horasdiaria" class="form-control" >
                              <option value="" selected >Selecionar</option>
                              <option value="5" > 05 </option>
                              <option value="6" > 06 </option>
                              <option value="7" > 07 </option>
                              <option value="8" > 08 </option>
                              <option value="9" > 09 </option>
                              <option value="10" > 10 </option>
                              <option value="11" > 11 </option>
                              <option value="12" > 12 </option>
                            </select>
                        </div>
                        <span class="hidden msg-error invalido-horasdiaria">Preencher o Campo Horas de Produção.
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nome">Dias de Produção:</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="totaldias" maxlength="2" placeholder="Dias de Produção" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="totaldias"  >
                        </div>
                        <span class="hidden msg-error invalido-totaldias">Preencher o Campo Dias de Produção.
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" id="enviar" class="btn btn-primary ">Gerar</button>
                  </div>
                </div>
              </form>
            </div>          
          </div>

          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Geral</h3>
              </div>
              <form  name="form2" id="form2" method="POST"  action="<?= BASE; ?>Relatorio/ProducaoGeral">                   
                <div class="card-body"> 
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="nome">Data Inicio:</label>
                      <div class="input-group mb-3" >  
                        <input type="text" class="form-control " name="dataInicio" id="dataInicio2" data-date-end-date="0d" readonly required >
                        <div class="input-group-append" >
                          <span alert-tooltip="tooltip" title="Click para Selecionar" class="input-group-text pointer" id="dateinicio2"><i class="far fa-calendar-alt"></i></span>
                        </div>
                      </div> 
                      <span class="hidden msg-error invalido-dataInicio2">Preencher o Campo Data Inicio.
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nome">Data Final:</label>
                      <div class="input-group mb-3" >  
                        <input type="text" class="form-control " name="dataFinal" id="dataFinal2" data-date-end-date="0d" readonly required >
                        <div class="input-group-append" >
                          <span alert-tooltip="tooltip" title="Click para Selecionar" class="input-group-text pointer" id="datefinal2"><i class="far fa-calendar-alt"></i></span>
                        </div>
                      </div> 
                      <span class="hidden msg-error invalido-dataFinal2">Preencher o Campo Data Final.
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="nome">Horas de Produção:</label>
                        <div class="input-group mb-3"> 
                            <select name="horasdiaria" id="horasdiaria2" class="form-control" >
                              <option value="" selected >Selecionar</option>
                              <option value="5" > 05 </option>
                              <option value="6" > 06 </option>
                              <option value="7" > 07 </option>
                              <option value="8" > 08 </option>
                              <option value="9" > 09 </option>
                              <option value="10" > 10 </option>
                              <option value="11" > 11 </option>
                              <option value="12" > 12 </option>
                            </select>
                        </div>
                        <span class="hidden msg-error invalido-horasdiaria2">Preencher o Campo Horas de Produção.
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nome">Dias de Produção:</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" name="totaldias" maxlength="2" placeholder="Dias de Produção" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="totaldias2"  >
                        </div>
                        <span class="hidden msg-error invalido-totaldias2">Preencher o Campo Dias de Produção.
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" id="enviar2" class="btn btn-primary ">Gerar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  let $dataInicio = $('#dataInicio') , $dataFinal = $('#dataFinal');
  let $dataInicio2 = $('#dataInicio2') , $dataFinal2 = $('#dataFinal2');

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
    autoclose: true,
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

  $dataInicio2.datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    clearBtn: true
  }).data('datepicker');

  $dataFinal2.datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    clearBtn: true
  }).data('datepicker');

  $('#dateinicio2').on('click', function() {
    $dataInicio2.show();
    $dataInicio2.focus();
  });
  $('#datefinal2').on('click', function() {
    $dataFinal2.show();
    $dataFinal2.focus();
  });



  $('#dataInicio').mask("00/00/0000", {placeholder: "__/__/____"});
  $('#dataFinal').mask("00/00/0000", {placeholder: "__/__/____"});
  $('#dataInicio2').mask("00/00/0000", {placeholder: "__/__/____"});
  $('#dataFinal2').mask("00/00/0000", {placeholder: "__/__/____"});
</script>

<div class="modal fade Modal-Colaborador" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="fundoTable">
                <section class="content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header">
                                <h4><b>Lista</b> de Colaboradores</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Matricula</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($ResultDadosCol as $listar):?>
                                                <tr class="pointer" title="SELECIONAR" data-dismiss="modal" aria-label="Close" onclick="SelecionaColaboradorRl(<?php echo $listar['id']?>,'<?php echo $listar['nome']?>','<?php echo $listar['matricula']?>')">
                                                    <td><?php echo $listar['nome']; ?></td>
                                                    <td><?php echo $listar['matricula']?></td>
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