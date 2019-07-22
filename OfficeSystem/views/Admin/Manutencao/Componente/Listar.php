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
        <h3 ><b>Lista </b> de Componente Veicular
          <a href="<?= BASE;?>Componente/Cadastro" class="btn btn-outline-info btn-add" >Adicionar Componente</a>
        </h3>
      </div>
      <div class="card-body">
        <div class="table-responsive ">
          <table id="example1" class="table table-hover">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Componente</th>
                <th class="text-center">Opções</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($listDados as $listar):?>
                <tr>
                  <td><?php echo $listar['codigo']?></td>
                  <td><?php echo $listar['descricao']; ?></td>
                  <td class="text-center"><a class="btn hover-btn-limpar btn-sm" title="Exibir Componentes Veicular" href="<?php echo BASE; ?>Componente/Exibir/<?php echo $listar['id']; ?>"><img src="http://localhost/OfficeSystem/assets/icons/png/search.png"></a>
                </tr>
              <?php endforeach; ?> 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
  