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
                <h3 ><b>Exibir</b> Ordem de Serviço  <c>Nº: <?php echo $dadosOrdem->numeroOs;; ?></c></h3>
            </div>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-office" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link hover-btn" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Dados da Ordem de Serviço
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body" id="print">
                    <a onclick="printContent('print')" id="PrintHidden" class="float-right hover-btn-print pointer"><img class="icone-opcoes-ordsem" src="<?=BASE;?>assets/icons/png/print.png"></a>
                        <div class="row">
                            <div class="col">
                                <h5>Ordem de Serviço:</h5>
                                <div class="col-sm-7">                      
                                    <div class="row">
                                        <div class="form-group col-md-5" ><h6 ><b> Numero:</b> <?php echo $dadosOrdem->numeroOs; ?></h6></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <h5>Solicitante:</h5>
                                <div class="col">
                                    <div class="col-sm-15">                      
                                        <div class="row">
                                            <div class="form-group col-md-5" ><h6 ><b> Usuário:</b> <?php echo $dadosOrdem->nomeUsuario; ?></h6></div>
                                            <div class="form-group col-md-5" ><h6 ><b> Matricula:</b> <?php echo $dadosOrdem->matriculaUsuario; ?></h6></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                                <h5>Proprietário:</h5>
                                <div class="col-sm-12">                  
                                    <div class="row">
                                            <div class="form-group col-md-5" ><h6 ><b> Nome:</b> <?php echo $dadosOrdem->nomeCliente; ?></h6></div>
                                            <div class="form-group col-md-5" ><h6 ><b> CPF/CNPJ:</b> <?php echo $dadosOrdem->cpfcnpjCliente; ?></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Veiculo:</h5>
                                <div class="col-sm-12">                    
                                    <div class="row">
                                        <div class="form-group col-md-3" ><h6 ><b> Modelo:</b> <?php echo $dadosOrdem->modeloVeiculo; ?></h6></div>
                                        <div class="form-group col-md-3" ><h6 ><b> Marca:</b> <?php echo $dadosOrdem->marcaVeiculo; ?></h6></div>
                                        <div class="form-group col-md-3" ><h6 ><b> Ano:</b> <?php echo $dadosOrdem->anoVeiculo; ?></h6></div>
                                        <div class="form-group col-md-3" ><h6 ><b> Placa:</b> <?php echo $dadosOrdem->placaVeiculo; ?></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <h5 >Abertura:</h5>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group col-md-3" ><h6 ><b> Data:</b> <?php echo $dadosOrdem->dataAbertura; ?></h6></div>
                                        <div class="form-group col-md-3" ><h6 ><b> Hora:</b> <?php echo $dadosOrdem->horaAbertura; ?></h6></div>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty ($dadosOrdem->dataFechamento && $dadosOrdem->horaFechamento)) { ?>
                                <div class="col-5">
                                    <h5 >Fechamento:</h5>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="form-group col-md-3" ><h6 ><b> Data:</b> <?php echo $dadosOrdem->dataFechamento; ?></h6></div>
                                            <div class="form-group col-md-3" ><h6 ><b> Hora:</b> <?php echo $dadosOrdem->horaFechamento; ?> </h6></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-5">
                                <h5 >Prazo:</h5>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="form-group col-md-3" ><h6 ><b> Data:</b> <?php echo $dataprazo; ?></h6></div>
                                        <div class="form-group col-md-3" ><h6 ><b> Hora:</b> <?php echo $horaprazo; ?></h6></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h5>Descrição:</h5>
                                <div class="col-sm-12">                
                                    <div class="row">
                                        <textarea  class="form-control"  rows="3" style="resize:none" readonly><?php echo $dadosOrdem->descricao_os; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row"> 
                            <?php if ($dadosOrdem->status_os == "Aberto") { ?>
                                <div class="form-group col-md-2" ><h6><b>Status: </b><span class="badge badge-info"><?php echo $dadosOrdem->status_os; ?></span></h6></div>
                            <?php }  else if ($dadosOrdem->status_os == "Fechado") { ?>
                                <div class="form-group col-md-2" ><h6><b>Status: </b><span class="badge badge-danger"><?php echo $dadosOrdem->status_os; ?></span></h6></div>
                            <?php } ?>
                            <?php if ($dadosOrdem->status_prazo == "Normal" && $dadosOrdem->status_os != "Fechado") { ?>
                                <div class="form-group col-md-2" ><h6><b>Prazo: </b><span class="badge badge-info"><?php echo $dadosOrdem->status_prazo; ?></span></h6></div>
                            <?php }  else if ($dadosOrdem->status_prazo == "ProximoVen" && $dadosOrdem->status_os != "Fechado") { ?>
                                <div class="form-group col-md-2" ><h6><b>Prazo: </b><span class="badge badge-warning"><?php echo $dadosOrdem->status_prazo; ?></span></h6></div>
                            <?php }  else if ($dadosOrdem->status_prazo == "Vencido" && $dadosOrdem->status_os != "Fechado") { ?>
                                <div class="form-group col-md-2" ><h6><b>Prazo: </b><span class="badge badge-danger"><?php echo $dadosOrdem->status_prazo; ?></span></h6></div>
                            <?php } ?>
                            <?php if ($dadosOrdem->status_prazo != "Vencido" && $dadosOrdem->status_os != "Fechado") { ?>
                                <div class="form-group col-md-6" ><h6><b>Prazo Pro Vencimento: </b>Dias: <?php echo $dias;?> - Horas: <?php echo $horas;?> - Minutos: <?php echo $minutos;?> - Segundos: <?php echo $segundos;?></h6></div>
                            <?php }  else if ($dadosOrdem->status_prazo == "Vencido" && $dadosOrdem->status_os != "Fechado") { ?>
                                <div class="form-group col-md-6" ><h6><b>Prazo Vencido : </b>Dias: <?php echo $dias;?> - Horas: <?php echo $horas;?> - Minutos: <?php echo $minutos;?> - Segundos: <?php echo $segundos;?></h6></div>
                            <?php } ?>
                        </div>
                        <div class="card-footer" id="PrintHidden">
                            <a  class="btn btn-success " href="<?= BASE;?>OrdemDeServico/Editar/<?php echo $dadosOrdem->id_Ordem; ?>" >Editar</a>
                            <?php if ($dadosOrdem->status_os == "Aberto") { ?>
                                <button type="button" class="btn btn-danger btn-margin-list" onclick="FecharOrdemDeServico(<?php echo $dadosOrdem->id_Ordem; ?>)">Fechar</button>
                            <?php }  else if ($dadosOrdem->status_os == "Fechado" && $_SESSION['sistema']['cargo'] == "Admin") { ?>
                                <button type="button" id="PrintHidden" class="btn btn-outline-danger btn-margin-list"  onclick="AlertVerificarExcluirOrdem(<?php echo $dadosOrdem->id_Ordem; ?>)"><i id="PrintHidden" class="fas fa-trash"></i></button>
                            <?php } ?>
                        </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-office" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed hover-btn" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" >
                    Dados de Serviço
                    </button>
                </h2>
            </div>
            
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header">
                                <h3 ><b>Lista </b> de Serviço
                                <a href="<?= BASE;?>Servico/Iniciar/<?php echo $dadosOrdem->id_Ordem; ?>" class="btn btn-outline-info btn-add" >Adicionar Serviço</a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <table id="example1" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Usuário</th>
                                            <th>Matricula</th>
                                            <th>Data Abertura</th>
                                            <th>Data Fechamento</th>
                                            <th>Status</th>
                                            <th>Opcões</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ( !empty ($DadosListOrdemApontamento)) { foreach($DadosListOrdemApontamento as $listar):?>
                                            <tr>
                                                <td><?php echo $listar['nome'];?></td>
                                                <td><?php echo $listar['matricula']; ?></td>
                                                <td><?php echo $listar['dataAbertura']; ?></td>
                                                <td><?php echo $listar['dataFechamento']; ?></td>
                                                <td><?php if ($listar['status'] == 'Aberto') { ?><span class="badge badge-warning opcao-ativo-sim btn-margin-list">Aberto</span><?php }else { ?> <span class="badge badge-danger opcao-ativo-sim btn-margin-list">Fechado</span><?php } ?></td>
                                                <td class="text-center">
                                                    <a class="btn hover-btn-limpar btn-sm"  onclick="ExibirApontamento(<?php echo $listar['id_servico'];?>,'<?php echo $_SESSION['sistema']['cargo']; ?>');" ><img src="http://localhost/OfficeSystem/assets/icons/png/search.png"></a>
                                                </td>
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


<div class="modal fade Modal-Apontamento" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Dados</b> de Serviço</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <br>
                <div class="col-12" id="ResultDados2">
                </div>
            </div>
        </div>
    </div>
</div>
