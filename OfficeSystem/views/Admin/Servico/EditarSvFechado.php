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
                    <input type="text" class="form-control " name="matricula" id="matricula" placeholder="Matricula" readonly  required value="<?php echo $ResultDados['matricula']; ?>">
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
                            <input type="text" class="hidden"  readonly name="id_proc" id="id_proc" value="<?php echo $ResultDados['id_proc']; ?>" >
                            <input type="text" class="form-control "  name="descricao_proc" id="descricao_proc" readonly placeholder="Procedimento" required value="<?php echo $ResultDados['descricao_proc']; ?>" >
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Codigo:</label>  
                            <input type="codigo_proc" class="form-control " name="codigo_proc" id="codigo_proc" placeholder="Codigo" readonly required value="<?php echo $ResultDados['codigo_proc']; ?>" >
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Componente:</label>  
                            <input type="text" class="hidden"  readonly name="id_comp" id="id_comp" value="<?php echo $ResultDados['id_comp']; ?>">
                            <input type="text" class="form-control " name="descricao_comp" id="descricao_comp" readonly placeholder="Componente" required value="<?php echo $ResultDados['descricao_comp']; ?>"  >
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Codigo:</label>  
                            <input type="codigo_comp" class="form-control "  name="codigo_comp" id="codigo_comp" placeholder="Codigo" readonly  required value="<?php echo $ResultDados['codigo_comp']; ?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Item:</label>  
                            <input type="text" class="hidden" readonly  name="id_item" id="id_item"  value="<?php echo $ResultDados['id_item']; ?>" >
                            <input type="text" class="form-control" name="descricao_item" id="descricao_item" readonly placeholder="Item"  required value="<?php echo $ResultDados['descricao_item']; ?>" >
                    </div>
                    <div class="form-group col-md-5">
                        <label for="codigo_proc">Item:</label> 
                            <input type="codigo_item" class="form-control"name="codigo_item" id="codigo_item" placeholder="Codigo" readonly required value="<?php echo $ResultDados['codigo_item']; ?>">
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
                            <h5 >Fechamento:</h5>
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="form-group col-md-6"> 
                                        <label for="dataFechamento">Data:</label>  
                                        <div class="input-group mb-3">  
                                            <input type="text" class="form-control"  name="dataFechamento" id="dataFechamento"  data-date-end-date="0d" readonly required  value="<?php echo $ResultDados['dataFechamento']; ?>">
                                            <div class="input-group-append">
                                                <span alert-tooltip="tooltip" title="Click para Selecionar" class="input-group-text pointer" id="datefechamento"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                        <span class="hidden msg-error invalido-dataFechamento">Preencher o Campo Data. 
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="nome">Hora:</label>
                                        <input type="text" class="form-control" name="horaFechamento" id="horaFechamento"  required  value="<?php echo $ResultDados['horaFechamento']; ?>">
                                        <span class="hidden msg-error invalido-horaFechamento">Preencher o Campo Hora Fechamento.
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="form-group col-md-3">
                        <input type="text" class="hidden"  readonly name="status" id="status" value="<?php echo $ResultDados['status']; ?>" >
                            <div class="form-group" >
                                <h5>Status:
                                    <span class="badge badge-danger">
                                        <?php echo $ResultDados['status']; ?>
                                    </span>
                                </h5>
                            </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                    <button type="submit" id="enviar" class="btn btn-primary ">Salvar</button>
                    <button type="button" class="btn btn-outline-danger btn-margin-list"  onclick="AlertExcluirApt(<?php echo $ResultDados['id']; ?>)"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $('#dataAbertura').mask("00/00/0000", {placeholder: "__/__/____"});
    $('#horaAbertura').mask(mask, pattern);
    $('#dataFechamento').mask("00/00/0000", {placeholder: "__/__/____"});
    $('#horaFechamento').mask(mask, pattern);

    let $dataFechamento = $('#dataFechamento');

    $dataFechamento.datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true,
    todayHighlight: true,
    clearBtn: true
    }).data('datepicker');


    $('#datefechamento').on('click', function() {
        $dataFechamento.show();
        $dataFechamento.focus();
    });

</script>