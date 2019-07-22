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
        <h3><b>Exibir </b> de Cliente
          <a href="<?= BASE;?>Cliente/Cadastro" class="btn btn-outline-info btn-add" >Adicionar Cliente</a>
        </h3>  
      </div>
      <div class="card-body">
        <div class="table-responsive ">
          <table id="example1" class="table ">
            <thead>
              <tr>
                <th>Nome</th>
                <th>CPF/CNPJ</th>
                <th>Telefone</th>
                <th class="text-center">Opções</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($listDados as $listar):?>
                <tr>
                  <td><?php echo $listar['nome']?></td>
                  <td><?php echo $listar['cpfcnpj']?></td>
                  <td><?php echo $listar['telefone']; ?></td>
                  <td class="text-center">
                  <a class="btn btn-outline-primary btn-sm"  href="<?php echo BASE; ?>Cliente/Dados/<?php echo $listar['id']; ?>" ><i class="fas fa-edit" ></i></a>
                  <?php if ($_SESSION['sistema']['cargo'] == 'Admin') { ?>
                    <button class="btn btn-outline-danger btn-sm btn-margin-list" onclick="AlertExcluirCliente(<?php echo $listar['id']; ?>)"><i class="fas fa-trash"></i></button></td>
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
 