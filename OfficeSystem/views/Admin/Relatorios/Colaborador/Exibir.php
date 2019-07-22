<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro" id="print">
    <div class="card-header">
      <h3 ><b>Relatorio </b> de Colaborador
      <a onclick="printContent('print')" id="PrintHidden" class="float-right hover-btn-print poiter pointer"><img class="icone-opcoes-ordsem" src="<?=BASE;?>assets/icons/png/print.png"></a>
      </h3>
    </div>
    <div class="card-body">
        <h6>Ativos:</h6>
        <div class="col">                      
            <div class="row">
              <div class="col-lg-auto" ><h6 ><b> Total: </b> <?php echo $total->total; ?></h6></div>
              <div class="col-lg-auto" ><h6 ><b> Sim: </b> <?php echo $totalAtivoSim->total; ?></h6></div>
              <div class="col-lg-auto" ><h6 ><b> Não: </b> <?php echo $totalAtivoNao->total; ?></h6></div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Matricula</th>
            <th scope="col">E-mail</th>
            <th scope="col">Cargo</th>
            <th scope="col">Celular</th>
            <th scope="col">Telefone</th>
            <th scope="col">Ativo</th>

          </tr>
        </thead>
        <tbody>
          <?php $T = 1 ;for ($i=0; $i < count($result); $i++): 
            foreach ($result as $list): ?>
            <tr>
                <th scope="row"><?php echo $T++ ?></th>
                <td><?php echo $list['nome']; ?></td>
                <td><?php echo $list['matricula']; ?></td>
                <td><?php echo $list['email']; ?></td>
                <td><?php echo $list['cargo']; ?></td>
                <td><?php echo $list['celular']; ?></td>
                <td><?php if ( !empty ( $list['telefone'] ) ) { echo $list['telefone'];  } else { ?>  (00) 0000-0000  <?php } ?></td>
                <td><?php echo $list['colAtivo']; ?></td>
            </tr>
            <?php if ($T >= 17) { ?> <p class="break"></p><?php } ?>
          <?php endforeach; break; endfor;?>
        </tbody>
      </table>
    </div>
</div>
