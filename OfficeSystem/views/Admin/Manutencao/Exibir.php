<?php
  if(!empty($msg)){
    echo $msg;
  }
?>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card-header">
                <h3 ><b>Exibir</b> Componentes Veicular
                <a href="<?= BASE;?>Componente/Cadastro" class="btn btn-outline-info btn-add" >Adicionar Componente</a>
                </h3>
            </div>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-office" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link hover-btn"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <b>Componente: </b> <?php echo $Nome?>
                </button>
            </h2>
        </div>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5>Componente:</h5>
                        <div class="col-sm-12">                      
                            <div class="row">
                                <div class="form-group col-md-4" ><h6 ><b> Codigo: </b> <?php echo $Codigo?></h6></div>
                                <div class="form-group col-md-4" ><h6 ><b> Descrição: </b><?php echo $Nome?></h6></div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                       <a href="<?= BASE;?>Componente/Dados/<?php echo $id?>" class="btn btn-success ">Editar</a> 
                            <?php if ($_SESSION['sistema']['cargo'] == "Admin") { ?><button class="btn btn-outline-danger btn-margin-list " onclick="AlertExcluirComponente(<?php echo $id?>)"><i class="fas fa-trash"></i></button> <?php } ?>
                    </div>
                </div>
            </div>
         </div>
        <div class="card">
            <div class="card-office" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link hover-btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <b>Itens: </b> <?php echo $Nome?>
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header">
                                <h3 ><b>Lista </b> de Itens Veicular 
                                <a href="<?= BASE;?>Item/Cadastro/<?php echo $id?>" class="btn btn-outline-info btn-add" >Adicionar Item</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Item</th>
                                                <th class="text-center">Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($listDadosItem)) { foreach($listDadosItem as $listar):?>
                                                <tr>
                                                    <td><?php echo $listar['codigo']?></td>
                                                    <td><?php echo $listar['descricao']?></td>
                                                    <td class="text-center">
                                                    <a class="btn btn-outline-primary btn-sm" href="<?php echo BASE; ?>Item/Dados/<?php echo $listar['id']; ?>" role="button" ><i class="fas fa-edit"></i></a>
                                                    <?php if ($_SESSION['sistema']['cargo'] == "Admin") { ?><button class="btn btn-outline-danger btn-sm btn-margin-list"  onclick="AlertExcluirItem(<?php echo $listar['id']; ?>)"><i class="fas fa-trash"></i></button><?php } ?>
                                                </tr>
                                            <?php endforeach; } ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    