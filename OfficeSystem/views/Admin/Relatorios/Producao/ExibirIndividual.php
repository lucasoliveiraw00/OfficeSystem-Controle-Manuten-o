<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro" id="print">
    <div class="card-header">
      <h3 ><b>Relatorio </b> de Produção Individual
      <a onclick="printContent('print')" id="PrintHidden" class="float-right hover-btn-print poiter pointer"><img class="icone-opcoes-ordsem" src="<?=BASE;?>assets/icons/png/print.png"></a>
    </h3>
    </div>
    <div class="card-body">
        <h6><b>Dados:</b></h6>
        <div class="col">                      
            <div class="row">
              <div class="col-lg-auto" ><h6 > Nome: <?php echo $dadosCol->nome ?> </h6></div>
              <div class="col-lg-auto" ><h6 > Matricula: <?php echo $dadosCol->matricula ?> </h6></div>
              <div class="col-lg-auto" ><h6 > E-mail: <?php echo $dadosCol->email ?> </h6></div>
              <div class="col-lg-auto" ><h6 > Celular: <?php echo $dadosCol->celular ?> </h6></div>
            </div>
        </div>
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
        <div class="row"> 
          <div class="col">                      
            <h6><b>Resultados de dias e horas de produção:</b></h6>
            <div class="col">
              <div class="col-sm-15"> 
                <div class="row">
                  <div class="col-lg-auto" ><h6 > Dia: <?php echo $ResultDias?></h6></div>
                  <div class="col-lg-auto" ><h6 > Horas:  <?php echo $ResultHora ?> </h6></div>
                  <div class="col-lg-auto" ><h6 > Minutos:  <?php echo $ResultMinuto ?> </h6></div>
                  <div class="col-lg-auto" ><h6 > Segundos:  <?php echo $ResultSegundo ?> </h6></div>
                </div>
              </div> 
            </div> 
          </div>
          <div class="col">                      
            <h6><b>Total de horas de produção:</b></h6>
            <div class="col">
              <div class="col-sm-15"> 
                <div class="row">
                  <div class="col-lg-auto" ><h6 > Horas: <?php echo $horasprodutivas?></h6></div>
                </div>
              </div> 
            </div> 
          </div>
        </div>
        <div class="row"> 
          <div class="col">                      
            <h6><b>Horas Produtivas:</b></h6>
            <div class="col">
              <div class="col-sm-15"> 
                <div class="row">
                  <div class="col-lg-auto" ><h6 >Horas: <?php echo $horasprodutivas ?></h6></div>
                  <div class="col-lg-auto" ><h6 ><?php echo $porcentagemprodutivas ?>%</h6></div>
                </div>
              </div> 
            </div> 
          </div>
          <div class="col">                      
            <h6><b>Horas Improdutivas:</b></h6>
            <div class="col">
              <div class="col-sm-15"> 
                <div class="row">
                <div class="col-lg-auto" ><h6 >Horas: <?php echo $horasinprodutiva ?></h6></div>
                  <div class="col-lg-auto" ><h6 ><?php echo $porcentageminprodutiva ?>%</h6></div>
                </div>
              </div> 
            </div> 
          </div>
        </div>
    </div>
    <?php if (!empty($result)) { ?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>OS</th>
              <th>Modelo</th>
              <th>Placa</th>
              <th>Procedimento</th>
              <th>Componente</th>
              <th>Item</th>
              <th width="130">Data Abertura</th>
              <th width="142">Hora Abertura</th>
              <th width="158">Data Fachamento</th>
              <th width="170">Hora Fachamento</th>
              <th >Total de Horas</th>

            </tr>
          </thead>
          <tbody>
            <?php $T = 1 ;for ($i=0; $i < count($result); $i++): 
              foreach ($result as $list): ?>
              <tr>
                  <th scope="row"><?php echo $T++ ?></th>
                  <td class="text-center"><?php echo $list['numero_os']; ?></td>
                  <td width="115"><?php echo $list['modelo']; ?></td>
                  <td width="95" class="print-table-palca"><?php echo $list['placa']; ?></td>
                  <td class="text-center"><?php echo $list['proc_descricao']; ?></td>
                  <td class="text-center"><?php echo $list['comp_descricao']; ?></td>
                  <td class="text-center"><?php echo $list['item_descricao']; ?></td>
                  <td class="text-center"><?php echo $list['dataAbertura']; ?></td>
                  <td class="text-center"><?php echo $list['horaAbertura']; ?></td>
                  <td class="text-center"><?php if ( !empty ( $list['dataFechamento'] ) ) { echo $list['dataFechamento'];  } else { ?>Em Aberto<?php } ?></td>
                  <td class="text-center"><?php if ( !empty ( $list['horaFechamento'] ) ) { echo $list['horaFechamento'];  } else { ?>Em Aberto<?php } ?></td>
                  <td width="300">
                  <?php if (!empty ( $list['dataFechamento'] ) && !empty ( $list['horaFechamento'] ) ) { 
                    $teste = $this->RlProducaoCalcularHorario($list['dataAbertura'],$list['horaAbertura'],$list['dataFechamento'],$list['horaFechamento'] );
                    echo $teste;
                  } else { ?>Em Aberto<?php }?></td>
              </tr>
              <?php if ($T >= 17) { ?> <p class="break"></p><?php } ?>
            <?php endforeach; break; endfor;?>
          </tbody>
        </table>
      </div>
    <?php }else{ ?>
      <div class="card-body">
        <h6><b>Não á nenhum serviço.</b></h6>
      </div>
    <?php }?>
</div>
