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
        <h3 ><b>Lista </b> de Procedimento Veicular
          <a href="<?= BASE;?>Procedimento/Cadastro" class="btn btn-outline-info btn-add" >Adicionar Procedimento</a>
        </h3>
      </div>
      <div class="card-body">
        <div class="table-responsive ">
          <table id="example1" class="table table-hover">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Procedimento</th>
                <th class="text-center">Opções</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($listDados as $listar):?>
                <tr>
                  <td><?php echo $listar['codigo']?></td>
                  <td><?php echo $listar['descricao']; ?></td>
                  <td class="text-center">
                  <a class="btn btn-outline-primary btn-sm " href="<?php echo BASE; ?>Procedimento/Dados/<?php echo $listar['id']; ?>" ><i class="fas fa-edit"></i></a>
                  <?php if ($_SESSION['sistema']['cargo'] == "Admin") {?>
                    <button class="btn btn-outline-danger btn-sm btn-margin-list"  onclick="AlertExcluirProcedimento(<?php echo $listar['id']; ?>)"><i class="fas fa-trash"></i></button>
                  <?php } ?>
                </tr>
              <?php endforeach; ?> 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

  