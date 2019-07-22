<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro">
    <div class="col-12">
        <div class="card-header">
        <h3 ><b>Exibir </b> Colaborador</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-14">
                    <h5>Dados:</h5>
                    <div class="col">
                        <div class="col-sm-15">                      
                            <div class="row">
                                <div class="form-group col-md-4" ><h6 ><b> Nome:</b> <?php echo $infos['nome']; ?></h6></div>
                                <div class="form-group col-md-4" ><h6 ><b> Matricula:</b> <?php echo $infos['matricula']; ?></h6></div>
                                <div class="form-group col-md-4" ><h6 ><b> Cargo:</b> <?php echo $infos['cargo']; ?></h6></div>
                                <div class="form-group col-md-4" ><h6 ><b> Ativo:</b> <?php echo $infos['ativo']; ?></h6></div>
                                <div class="form-group col-md-4" ><h6 ><b> Email:</b> <?php echo $infos['email']; ?></h6></div>
                                <div class="form-group col-md-4" ><h6 ><b> Celular:</b> <?php echo $infos['celular']; ?></h6></div>
                                <div class="form-group col-md-4" ><h6 ><b> Telefone:</b> <?php echo $infos['telefone']; ?></h6></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>