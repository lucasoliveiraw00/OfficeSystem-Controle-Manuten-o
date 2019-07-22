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
        <h3 ><b>Lista </b> de Colaboradores
        <?php if ($_SESSION['sistema']['cargo'] == 'Admin') { ?>
          <a href="<?= BASE;?>Colaborador/Cadastro" class="btn btn-outline-info btn-add" >Adicionar Colaborador</a>
        <?php } ?>
        </h3>
        </div>
        <div class="card-body">
          <div class=" table-responsive ">
            <table id="example1" class="table table-hover ">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Matricula</th>
                  <th>Cargo</th>
                  <th class="text-center">Opções</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($listDados as $listar):
                  if ($listar['id'] != $_SESSION['sistema']['id']) { ?>
                    <tr>
                      <td><?php echo $listar['nome']?></td>
                      <td><?php echo $listar['matricula']; ?></td>
                      <td><?php echo $listar['cargo']; ?></td>
                      <td class="text-center">
                        <?php if ($_SESSION['sistema']['cargo'] == 'Atendente') { ?>
                          <a class="btn-margin-list" href="<?php echo BASE; ?>Colaborador/Exibir/<?php echo $listar['id']; ?>" ><img class="icone-opcoes-ordsem" src="<?php $BASE;?>assets/icons/png/search.png"></i></a>
                        <?php } ?>
                        <?php if ($_SESSION['sistema']['cargo'] == 'Admin') { ?>
                          <a class="btn btn-outline-primary btn-sm btn-margin-list" href="<?php echo BASE; ?>Colaborador/Dados/<?php echo $listar['id']; ?>" ><i class="fas fa-edit"></i></a>
                          <button class="btn btn-outline-danger btn-sm btn-margin-list" onclick="AlertExcluirCol(<?php echo $listar['id']; ?>)"><i class="fas  fa-trash"></i></button>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php } ?>
                <?php endforeach; ?> 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
