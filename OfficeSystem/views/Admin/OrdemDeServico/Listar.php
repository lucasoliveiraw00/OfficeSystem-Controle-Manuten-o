<?php
  if(!empty($msg)){
    echo $msg;
    exit;
  }
?>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <h3><b>Lista </b> de Ordem de Serviço
                <a href="<?= BASE;?>OrdemDeServico/Abrir" class="btn btn-outline-info btn-add" >Abrir ordem de serviço</a>
                </h3>  
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <h5 class="mb-2">Filtra Por</h5>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box pointer hover" onclick="ListarOrdemDeSevicoAberta();">
                    <span class="info-box-icon bg-info"><img src="<?= BASE; ?>assets/icons/png/001-folder.png"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ordem de Serviço</span>
                        <span class="info-box-text">Aberta:</span>
                        <span class="info-box-number"><?php echo $totalOrdemAberta; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box pointer hover" onclick="ListarOrdemDeSevicoFechada();">
                    <span class="info-box-icon bg-secondary"><img src="<?= BASE; ?>assets/icons/png/002-folder-2.png"></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ordem de Serviço</span>
                        <span class="info-box-text">Fechada:</span>
                        <span class="info-box-number"><?php echo $totalOrdemFechada; ?></span>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</section>


<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card-header"></div>
      <div class="card-body">
        <div class="table-responsive" id="ResultDados">
        </div>     
      </div>
    </div>
  </div>
</section>