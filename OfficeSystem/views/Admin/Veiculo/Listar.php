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
        <h3 ><b>Lista </b> de Veículos
          <a href="<?= BASE;?>Veiculo/Cadastro" class="btn btn-outline-info btn-add" >Adicionar Veiculo</a>
        </h3>
        </div>
        <div class="card-body">
          <div class="table-responsive ">
            <table id="example1" class="table table-hover">
              <thead>
                <tr>   
                  <th>Placa</th>
                  <th>Modelo</th>
                  <th class="text-center">Opções</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($listDados as $listar):?>
                  <tr>
                    <td><?php echo $listar['placa']; ?></td>
                    <td><?php echo $listar['modelo']; ?></td>
                    <td class="text-center">
                    <a class="btn btn-outline-primary btn-sm" href="<?php echo BASE; ?>Veiculo/Dados/<?php echo $listar['id']; ?>" role="button"><i class="fas fa-edit"></i></a>
                    <?php if($_SESSION['sistema']['cargo'] == "Admin") { ?>
                      <button class="btn btn-outline-danger btn-sm btn-margin-list" onclick="AlertExcluirVeiculo(<?php echo $listar['id']; ?>)"><i class="fas fa-trash"></i></button>
                    <?php } ?>
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

  