<?php
  if(!empty($msg)){
    echo $msg;
  }
?>
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card-header">
        <h3 ><b>Lista </b> de Subsistema Veicular 
          <a href="<?= BASE;?>Subsistema/Cadastro" class="btn btn-outline-info btn-add" >Adicionar Subsistema</a>
        </h3>
      </div>
      <div class="card-body">
        <div class="table-responsive ">
          <table id="example1" class="table table-hover">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Descrição</th>
                <th>Ativo</th>
                <th>Opções</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($listDados as $listar):?>
                <tr>
                  <td><?php echo $listar['codigo']?></td>
                  <td><?php echo $listar['descricao']?></td>
                  <td class="text-center"><?php if ($listar['ativo'] == 'Sim') { ?> <a  onclick="AlertSubsistema(<?php  echo $listar['id']; ?>)" ><button class="btn btn-outline-success btn-sm "><?php echo $listar['ativo']; ?></button></a> <?php } else { ?> <a href="<?php echo BASE; ?>Subsistema/Situacao/<?php echo $listar['id']; ?>" ><button class="btn btn-outline-danger btn-sm "><?php echo $listar['ativo']; ?></button></a> <?php } ?> </td>
                  <td class="text-center">
                  <a><img src="http://localhost/OfficeSystem/assets/icons/png/search.png"></a>
                  <button class="btn btn-outline-danger btn-sm "  onclick="AlertExcluirSubsistema(<?php echo $listar['id']; ?>)"><i class="fas fa-trash"></i></button></td>
                </tr>
              <?php endforeach; ?> 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>