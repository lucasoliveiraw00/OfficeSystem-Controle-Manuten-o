<?php
    if(!empty($msg)){
        echo $msg;
    }
?>
<div class="content margin-painel-cadastro">
  <div class="col-12">
      <div class="card-header">
        <h3 ><b>Relatorio </b> de Colaborador</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="col-sm-15">   
              <form  name="form1" id="form1" method="POST" action="<?= BASE; ?>Relatorio/ColaboradorDados">                   
                <div class="row">
                  <div class="form-group col-md-5">
                    <label for="ativo">Ativo:</label>
                    <div class="input-group mb-3"> 
                        <select name="ativo" id="ativo" class="form-control" required >
                          <option value="" selected>Selecionar</option>
                          <option >Sim</option>
                          <option >Não</option>
                          <option >Todos</option>
                        </select>
                    </div>
                      <span class="hidden msg-error invalido-ativo">Preencher o Campo Ativo.
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit"  id="enviar" class="btn btn-primary ">Gerar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>