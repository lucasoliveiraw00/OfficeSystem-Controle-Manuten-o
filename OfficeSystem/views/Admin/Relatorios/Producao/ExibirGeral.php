<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro" id="print">
    <div class="card-header">
      <h3 ><b>Relatorio </b> de Produção Geral
      <a onclick="printContent('print')" id="PrintHidden" class="float-right hover-btn-print poiter pointer"><img class="icone-opcoes-ordsem" src="<?=BASE;?>assets/icons/png/print.png"></a>
    </h3>
    </div>
    <div class="card-body">
        <h6><b>Informações:</b></h6>
        <div class="col">                      
            <div class="row">
              <div class="col-lg-auto" ><h6 > Hora estimada de produção diaria: <?php echo $horasdiaria?></h6></div>
              <div class="col-lg-auto" ><h6 > Dias estimados de produção: <?php echo $totaldias ?> </h6></div>
              <div class="col-lg-5" ><h6 > Total de horas estimadas de produção: <?php echo $totalhoraespedas ?></h6></div>
              <div class="col-lg-auto" ><h6 > Data inicio: <?php echo $dataInicio ?></h6></div>
              <div class="col-lg-auto" ><h6 > Data final: <?php echo $dataFinal ?></h6></div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th class="text-center">Mecânico</th>
            <th class="text-center">Matricula</th>
            <th class="text-center">Horas Produtivas</th>
            <th class="text-center">Produtividade</th>
            <th class="text-center">Horas Improdutivas</th>
            <th class="text-center">Improdutividade</th>


          </tr>
        </thead>
        <tbody>
          <?php $T = 1 ;for ($i=0; $i < count($result); $i++): 
            foreach ($result as $list): ?>
            <tr>
                <th scope="row"><?php echo $T++ ?></th>
                <td class="text-center"><?php echo $list['nome']; ?></td>
                <td class="text-center"><?php echo $list['matricula']; ?></td>
                <td class="text-center"><?php echo $list['horasprodutivas']; ?> hrs</td>
                <td class="text-center"><?php echo $list['porcentagemprodutivas']; ?>%</td>
                <td class="text-center"><?php echo $list['horasimprodutiva']; ?> hrs</td>
                <td class="text-center"><?php echo $list['porcentagemimprodutivas']; ?>%</td>
            </tr>
            <?php if ($T >= 17) { ?> <p class="break"></p><?php } ?>
          <?php endforeach; break; endfor;?>
        </tbody>
      </table>
    </div>
</div>
