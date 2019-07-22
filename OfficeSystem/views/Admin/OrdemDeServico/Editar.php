
  <?php
  if(!empty($msg)){
    echo $msg;
  }
?>  
<div class="content margin-painel-cadastro">
  <h3><b>Editar </b> Ordem de Serviço <c> Nº: <?php echo $ResultDados->numero_os; ?></c></h3> 
    <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>OrdemDeServico/EditarDados/<?php echo $ResultDados->id_ordem; ?>"  enctype="multipart/form-data">    
      <div class="row">
          <div class=col>
            <h5>Solicitante:</h5>
              <div class="col-sm-12">
                <div class="row">
                  <div class="form-group col-md-5">
                    <label for="nome">Usuário:</label>
                    <input type="text" class="hidden" value="<?php echo $ResultDados->numero_os; ?>" name="numero_os" id="numero_os" readonly>
                    <input type="text" class="hidden" value="<?php  echo $ResultDados->id_colaborador ?>" name="id_colaborador" id="id_colaborador" readonly>
                    <input type="text" class="form-control" value="<?php  echo $ResultDados->nome_col ?>" name="nome_usuario" id="nome_usuario"  readonly required >
                  </div> 
                  <div class="form-group col-md-5">
                    <label for="matricula">Matricula:</label>
                    <input type="text" class="form-control" name="matricula" id="matricula" value="<?php  echo $ResultDados->matricula ?>"  readonly required >
                  </div>
                </div>
              </div>
          </div>
      </div>
      <div class="row">
        <div class=col>
          <h5>Dados do Proprietário:</h5>
            <div class="col-sm-12">
              <div class="row"> 
                <div class="form-group col-md-5">  
                <label for="modelo">Nome:</label> 
                  <div class="input-group mb-3">  
                    <input type="text" class="hidden" name="id_cliente" id="id_cliente" value="<?php  echo $ResultDados->id_cliente ?>" required readonly>
                    <input type="text" class="form-control pointer" name="nome" id="nome" data-toggle="modal" data-target=".Modal-Cliente" placeholder="Selecionar" value="<?php  echo $ResultDados->nome ?>" readonly  required>
                    <div class="input-group-append">
                      <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Cliente" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-nome">Preencher o Campo Nome.
                </div> 
                <div class="form-group col-md-5">
                <label for="modelo">CPF/CNPJ:</label>    
                  <div class="input-group mb-3">  
                    <input type="text" class="form-control pointer"  name="cpfcnpj" id="cpfcnpj" data-toggle="modal" data-target=".Modal-Cliente" placeholder="Selecionar" value="<?php  echo $ResultDados->cpfcnpj ?>" readonly required >
                    <div class="input-group-append">
                      <span alert-tooltip="tooltip" title="Click para Selecionar" data-toggle="modal" data-target=".Modal-Cliente" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-cpfcnpj">Preencher o Campo CPF/CNPJ.
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class=col>
          <h5>Dados do Veiculo:</h5>
            <div class="col-sm-12">
              <div class="row"> 
                <div class="form-group col-md-5"> 
                  <label for="modelo">Modelo:</label>  
                  <div class="input-group mb-3">  
                    <input type="text" class="hidden" name="id_veiculo" id="id_veiculo" value="<?php  echo $ResultDados->id_veiculo ?>" required readonly>
                    <input type="text" class="form-control pointer" name="modelo_veiculo" id="modelo_veiculo" onclick="ModalVeiculoDados();"  placeholder="Selecionar" value="<?php  echo $ResultDados->modelo ?>" readonly required  >
                    <div class="input-group-append">
                      <div onclick="ModalVeiculoDados();"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></div>
                    </div>
                  </div>
                  <span class="hidden msg-error invalido-modelo_veiculo">Preencher o Campo Modelo. 
                </div> 
                <div class="form-group col-md-5"> 
                  <label for="modelo">Marca:</label>  
                  <div class="input-group mb-3">  
                    <input type="text" class="form-control pointer " name="marca" id="marca_veiculo" onclick="ModalVeiculoDados();"  placeholder="Selecionar" value="<?php  echo $ResultDados->marca ?>" readonly required  >
                    <div class="input-group-append">
                      <span onclick="ModalVeiculoDados();"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-marca_veiculo">Preencher o Campo Marca.
                </div>
                <div class="form-group col-md-5"> 
                  <label for="modelo">Ano:</label>  
                  <div class="input-group mb-3">  
                    <input type="text" class="form-control pointer" name="ano" id="ano_veiculo" onclick="ModalVeiculoDados();"  placeholder="Selecionar" value="<?php  echo $ResultDados->ano ?>" readonly required >
                    <div class="input-group-append">
                      <div onclick="ModalVeiculoDados();"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></div>
                    </div>
                  </div> 
                   <span class="hidden msg-error invalido-ano_veiculo">Preencher o Campo Ano.
                </div>
                <div class="form-group col-md-5"> 
                  <label for="modelo">Placa:</label>  
                  <div class="input-group mb-3">  
                    <input type="text" class="form-control pointer" name="placa" id="placa_veiculo" onclick="ModalVeiculoDados();"   placeholder="Selecionar" value="<?php  echo $ResultDados->placa ?>" readonly required>
                    <div class="input-group-append">
                      <span onclick="ModalVeiculoDados();"  title="Click para Selecionar" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                    </div>
                  </div> 
                  <span class="hidden msg-error invalido-placa_veiculo">Preencher o Campo Placa.
                </div>
              </div>
            </div>
        </div>
      </div>
      <div class="row">
          <div class="col-5">
            <h5 >Abertura:</h5>
              <div class="col-sm-12">
                <div class="row">
                  <div class="form-group col-md-5">
                      <label for="nome">Data:</label>
                      <input type="text" class="form-control"  name="dataAbertura" id="dataAbertura" value="<?php  echo $ResultDados->dataAbertura; ?>" readonly required >
                  </div>
                  <div class="form-group col-md-5">
                      <label for="nome">Hora:</label>
                      <input type="text" class="form-control" name="horaAbertura" id="horaAbertura" value="<?php  echo $ResultDados->horaAbertura; ?>" readonly required >
                  </div>
                </div>
              </div>
          </div>
          <div class="col-5">
            <h5 >Prazo:</h5>
            <div class="col-sm-12">
              <div class="row">
                <div class="form-group col-md-5">
                  <label for="nome">Data:</label>
                  <input type="text" class="form-control"  name="dataPrazo" id="dataPrazo"  value="<?php  echo $dataprazo; ?>" readonly required >
                  <span class="hidden msg-error invalido-dataPrazo">Preencher o Campo Data.
                </div>
                <div class="form-group col-md-5">
                  <label for="nome">Hora:</label>
                  <input type="text" class="form-control" name="horaPrazo" id="horaPrazo"   value="<?php  echo $horaprazo; ?>" readonly required >
                  <span class="hidden msg-error invalido-horaPrazo">Preencher o Campo Hora.
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="form-group col-md-10">
          <label for="descricao">Descrição:</label>
          <div class="mb-3">
            <textarea  class="form-control " id="descricao" rows="3" style="resize:none" name="descricao"><?php  echo $ResultDados->descricao;?></textarea>
          </div>
            <span class="hidden msg-error invalido-descricao">Preencher o Campo Descrição.
        </div>
        <div class="form-group col-md-10">
                <input type="text" class="hidden"  readonly name="status" id="status" value="<?php echo $ResultDados->status;?>" >
                <div class="form-group" >
                    <h5>Status:
                      <span class="badge badge-warning">
                        <?php echo $ResultDados->status; ?>
                      </span>
                    </h5>
                </div>  
            </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" id="enviar" value="Cadastrar" class="btn btn-primary ">Salvar</button>
        <button type="button" class="btn btn-danger btn-margin-list" onclick="FecharOrdemDeServico(<?php echo $ResultDados->id_ordem; ?>)">Fechar</button>
      </div> 
    </form>
</div>


<div class="modal fade Modal-Cliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="fundoTable">
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card-header">
                <h3 ><b>Lista </b> de Cliente</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table id="example1" class="table  table-hover">
                    <thead>
                      <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach($DadosCliente as $listar):?>
                          <tr class="pointer" title="SELECIONAR" data-dismiss="modal" aria-label="Close" onclick="SelecionaCliente2(<?php echo $listar['id']?>,'<?php echo $listar['nome']?>','<?php echo $listar['cpfcnpj']?>');VerificarDadosProprietario(<?php echo $listar['id']?>,'<?php echo $listar['nome']?>');">
                            <td><?php echo $listar['nome']?></td>
                            <td><?php echo $listar['cpfcnpj']; ?></td>
                          </tr>
                        <?php endforeach; ?> 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>   
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade Modal-Veiculo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="fundoTable">
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card-header" >
                <h3 ><b>Lista </b> de Veiculo</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive " id="ResultDadoVeiculo">
                 
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>      
    </div>
  </div>
</div>
