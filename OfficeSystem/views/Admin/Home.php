<?php
  if(!empty($msg)){
    echo $msg;
    exit;
  }
?>
<div class="container-fluid">
  <div class="content">
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $CountStatusNotmal->total;?></h3>
            <p>Prazo:<br>Normal</p>
          </div>
          <div class="icon">
            <img src="<?=BASE;?>/assets/icons/calendar1.png" alt="">
          </div>
          <a href="<?=BASE;?>OrdemDeServico/Prazo/Normal" class="small-box-footer">Ordem de Seviço <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo $CountStatusProximoVen->total;?></h3>
            <p>Prazo:<br>Proxima do Vencimento</p>
          </div>
          <div class="icon">
            <img src="<?=BASE;?>/assets/icons/calendar2.png" alt="">
          </div>
          <a href="<?=BASE;?>OrdemDeServico/Prazo/ProximoVen" class="small-box-footer">Ordem de Seviço <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $CountStatusVencido->total;?></h3>
            <p>Prazo:<br>Vencido</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"><img src="<?=BASE;?>/assets/icons/calendar3.png" alt=""></i>
          </div>
          <a href="<?=BASE;?>OrdemDeServico/Prazo/Vencido" class="small-box-footer">Ordem de Seviço <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>


