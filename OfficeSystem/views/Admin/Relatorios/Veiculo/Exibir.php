<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro" id="print">
    <div class="card-header">
      <h3 ><b>Relação </b> de Veículo
        <a onclick="printContent('print')" id="PrintHidden" class="float-right hover-btn-print poiter pointer"><img class="icone-opcoes-ordsem" src="<?=BASE;?>assets/icons/png/print.png"></a>
      </h3>
    </div>
    <div class="card-body">
        <h5>Proprietário:</h5>
        <div class="col">                      
            <div class="row">
              <div class="col-lg-3" ><h6 ><b> Nome: </b> <?php echo $proprietario->nome; ?></h6></div>
              <div class="col-lg-3" ><h6 ><b> CPF/CNPJ: </b> <?php echo $proprietario->cpfcnpj; ?></h6></div>
              <div class="col-md-4" ><h6 ><b> Total de Veículo: </b> <?php echo $total->total; ?></h6></div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Modelo</th>
            <th scope="col">Marca</th>
            <th scope="col">Ano</th>
            <th scope="col">Cor</th>
            <th scope="col">Placa</th>
          </tr>
        </thead>
        <tbody>
          <?php $T = 1 ;for ($i=0; $i < count($result); $i++): 
            foreach ($result as $list): ?>
            <tr>
              <th scope="row"><?php echo $T++ ?></th>
              <td><?php echo $list['modelo']; ?></td>
              <td><?php echo $list['marca']; ?></td>
              <td><?php echo $list['ano']; ?></td>
              <td><?php echo $list['cor']; ?></td>
              <td><?php echo $list['placa']; ?></td>
            </tr>
            <?php if ($T >= 17) { ?> <p class="break"></p><?php } ?>
          <?php endforeach; break; endfor;?>
        </tbody>
      </table>
    </div>
</div>
