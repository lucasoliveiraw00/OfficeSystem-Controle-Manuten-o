<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro" id="print">
    <div class="card-header">
      <h3 ><b>Relatorio </b> de Manutenção
        <a onclick="printContent('print')" id="PrintHidden" class="float-right hover-btn-print poiter pointer"><img class="icone-opcoes-ordsem" src="<?=BASE;?>assets/icons/png/print.png"></a>
      </h3>
    </div>
    <div class="card-body">
        <h6>Veículo:</h6>
        <div class="col">                      
            <div class="row">
              <div class="col-lg-auto" ><h6 ><b> Modelo:</b> <?php echo $dadosveiculo->modelo; ?></h6></div>
              <div class="col-lg-auto" ><h6 ><b> Marca:</b> <?php echo $dadosveiculo->marca; ?></h6></div>
              <div class="col-lg-auto" ><h6 ><b> Ano:</b> <?php echo $dadosveiculo->ano; ?></h6></div>
              <div class="col-lg-auto" ><h6 ><b> Cor:</b> <?php echo $dadosveiculo->cor; ?></h6></div>
              <div class="col-lg-auto" ><h6 ><b> Placa:</b> <?php echo $dadosveiculo->placa; ?></h6></div>
              <div class="col-lg-auto" ><h6 ><b> Total de Apontamento:</b> <?php echo $total->total; ?></h6></div>
            </div>
        </div>
        <h6>Proprietário:</h6>
        <div class="col">                      
            <div class="row">
              <div class="col-lg-auto" ><h6 ><b> Nome:</b> <?php echo $dadosveiculo->nome; ?></h6></div>
              <div class="col-lg-auto" ><h6 ><b> CPF/CNPJ:</b> <?php echo $dadosveiculo->cpfcnpj; ?></h6></div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Numero OS</th>
            <th scope="col">Mecânico</th>
            <th scope="col">Matricula</th>
            <th scope="col">Procedimento</th>
            <th scope="col">Componente</th>
            <th scope="col">Item</th>
            <th scope="col">Data Abertura</th>
            <th scope="col">Hora Abertura</th>
            <th scope="col">Data Fachamento</th>
            <th scope="col">Hora Fachamento</th>

          </tr>
        </thead>
        <tbody>
          <?php $T = 1 ;for ($i=0; $i < count($result); $i++): 
            foreach ($result as $list): ?>
            <tr>
                <th scope="row"><?php echo $T++ ?></th>
                <td><?php echo $list['numero_os']; ?></td>
                <td><?php echo $list['nome']; ?></td>
                <td><?php echo $list['matricula']; ?></td>
                <td><?php echo $list['procDes']; ?></td>
                <td><?php echo $list['compDes']; ?></td>
                <td><?php echo $list['itemDes']; ?></td>
                <td><?php echo $list['dataAbertura']; ?></td>
                <td><?php echo $list['horaAbertura']; ?></td>
                <td><?php if ( !empty ( $list['dataFechamento'] ) ) { echo $list['dataFechamento'];  } else { ?>Em Aberto<?php } ?></td>
                <td><?php if ( !empty ( $list['horaFechamento'] ) ) { echo $list['horaFechamento'];  } else { ?>Em Aberto<?php } ?></td>
            </tr>
            <?php if ($T >= 18) { ?> <p class="break"></p><?php } ?>
          <?php endforeach; break; endfor;?>
        </tbody>
      </table>
    </div>
</div>
