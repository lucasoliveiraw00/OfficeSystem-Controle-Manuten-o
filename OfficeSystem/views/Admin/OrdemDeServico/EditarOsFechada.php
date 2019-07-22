
  <?php
  if(!empty($msg)){
    echo $msg;
  }
?>  
<div class="content margin-painel-cadastro">
  <h3><b>Editar </b> Ordem de Serviço <c> Nº: <?php echo $ResultDados->numero_os; ?></c></h3> 
    <form  name="form1" id="form1"  enctype="multipart/form-data">    
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
                    <input type="text" class="hidden" name="id_cliente" id="id_cliente" value="<?php  echo $ResultDados->id_cliente ?>" required readonly>
                    <input type="text" class="form-control pointer"  name="nome" id="nome"  placeholder="Selecionar" value="<?php  echo $ResultDados->nome ?>" readonly  required>
                  <span class="hidden msg-error invalido-nome">Preencher o Campo Nome.
                </div> 
                <div class="form-group col-md-5">
                <label for="modelo">CPF/CNPJ:</label>  
                    <input type="text" class="form-control"  name="cpfcnpj" id="cpfcnpj" placeholder="Selecionar" value="<?php  echo $ResultDados->cpfcnpj ?>" readonly required >
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
                    <input type="text" class="hidden" name="id_veiculo" id="id_veiculo" value="<?php  echo $ResultDados->id_veiculo ?>" required readonly>
                    <input type="text" class="form-control " name="modelo_veiculo" id="modelo_veiculo" placeholder="Selecionar" value="<?php  echo $ResultDados->modelo ?>" readonly required  >
                  <span class="hidden msg-error invalido-modelo_veiculo">Preencher o Campo Modelo. 
                </div> 
                <div class="form-group col-md-5"> 
                  <label for="modelo">Marca:</label>   
                    <input type="text" class="form-control " name="marca" id="marca_veiculo"  placeholder="Selecionar" value="<?php  echo $ResultDados->marca ?>" readonly required  >
                  <span class="hidden msg-error invalido-marca_veiculo">Preencher o Campo Marca.
                </div>
                <div class="form-group col-md-5"> 
                  <label for="modelo">Ano:</label>   
                    <input type="text" class="form-control " name="ano" id="ano_veiculo"  placeholder="Selecionar" value="<?php  echo $ResultDados->ano ?>" readonly required >
                   <span class="hidden msg-error invalido-ano_veiculo">Preencher o Campo Ano.
                </div>
                <div class="form-group col-md-5"> 
                  <label for="modelo">Placa:</label>   
                    <input type="text" class="form-control " name="placa" id="placa_veiculo"   placeholder="Selecionar" value="<?php  echo $ResultDados->placa ?>" readonly required>
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
                      <input type="text" class="form-control"  name="dataAbertura" id="dataAbertura" value="<?php  echo $ResultDados->dataAbertura; ?>" readonly required>
                  </div>
                  <div class="form-group col-md-5">
                      <label for="nome">Hora:</label>
                      <input type="text" class="form-control" name="horaAbertura" id="horaAbertura" value="<?php  echo $ResultDados->horaAbertura; ?>" readonly required >
                  </div>
                </div>
              </div>
          </div>
          <div class="col-5">
            <h5>Fechamento:</h5>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="nome">Data:</label>
                            <input type="text" class="form-control" name="dataFechamento" id="dataFechamento" value="<?php  echo $ResultDados->dataFechamento; ?>" readonly  required >
                        </div>
                        <div class="form-group col-md-5">
                            <label for="nome">Hora:</label>
                            <input type="text" class="form-control" name="horaFechamento" id="horaFechamento" value="<?php  echo $ResultDados->horaFechamento; ?>" readonly placeholder="Hora" required >
                        </div>
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
      <div class="row">
        <div class="form-group col-md-10">
          <label for="descricao">Descrição:</label>
          <div class="mb-3">
            <textarea  class="form-control " readonly  required id="descricao" rows="3" style="resize:none" name="descricao"><?php  echo $ResultDados->descricao;?></textarea>
          </div>
            <span class="hidden msg-error invalido-descricao">Preencher o Campo Descrição.
        </div>
        <div class="form-group col-md-10">
                <input type="text" class="hidden"  readonly name="status" id="status" value="<?php echo $ResultDados->status;?>" >
                <div class="form-group" >
                    <h5>Status:
                      <span class="badge badge-danger">
                        <?php echo $ResultDados->status; ?>
                      </span>
                    </h5>
                </div>  
            </div>
        </div>
      </div>
      <?php if($_SESSION['sistema']['cargo'] == "Admin") { ?>
        <div class="card-footer ">
          <button type="button" class="btn btn-outline-danger btn-margin-list"  onclick="AlertVerificarExcluirOrdem(<?php echo $ResultDados->id_ordem; ?>)"><i class="fas fa-trash"></i></button>
        </div> 
      <?php } ?>
    </form>
</div>

