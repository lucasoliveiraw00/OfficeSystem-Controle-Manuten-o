<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3><b>Lista </b> de Ordem de Serviço
            <a href="<?= BASE;?>OrdemDeServico/Abrir" class="btn btn-outline-info btn-add" >Abrir ordem de serviço</a>
        </h3>
        </div>
        <div class="card-body">
          <div class="table-responsive ">
            <table id="example1" class="table table-hover">
              <thead>
                <tr>   
                  <th>Numero da Ordem</th>
                  <th>Cliente</th>
                  <th>Veiculo</th>
                  <th>Palca</th>
                  <th>Abertura</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Prazo</th>
                  <th class="text-center">Opções</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($Dados as $listar):?>
                  <tr class="pointer">
                    <td><?php echo $listar['numero_os']; ?></td>
                    <td><?php echo $listar['nome']; ?></td>
                    <td><?php echo $listar['modelo']; ?></td>
                    <td><?php echo $listar['placa']; ?></td>
                    <td><?php echo $listar['dataAbertura']?>  <?php echo  $listar['horaAbertura']; ?></td>
                    <td class="text-center"><span class="badge badge-info"><?php echo $listar['status']; ?></span></td>
                    <?php if ($listar['status_prazo'] == 'Normal') { ?>

                      <td class="text-center"><span class="badge badge-info"><?php echo $listar['status_prazo']; ?></span></td>
                   
                    <?php }else if ($listar['status_prazo'] == 'ProximoVen') { ?>
                      
                      <td class="text-center"><span class="badge badge-warning"><?php echo $listar['status_prazo']; ?></span></td>

                    <?php }else if ($listar['status_prazo'] == 'Vencido') { ?>

                      <td class="text-center"><span class="badge badge-danger"><?php echo $listar['status_prazo']; ?></span></td>
                      
                    <?php } ?>
                    <td class="text-center">
                        <a class="btn hover-btn-limpar btn-margin-list" title="Exibir Ordem de Serviço" href="<?=BASE;?>OrdemDeServico/Exibir/<?php echo $listar['id']; ?>" ><img class="icone-opcoes-ordsem" src="<?=BASE;?>/assets/icons/png/search.png"></a>
                        <a class="btn hover-btn-limpar btn-sm " title="Fechar Ordem de Serviço" onclick="FecharOrdemDeServico(<?php echo $listar['id']; ?>)"><img class="icone-opcoes-ordsem"  src="<?=BASE;?>/assets/icons/png/iconfecharordem.png"></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody> 
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
