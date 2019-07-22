<div class="content margin-painel-cadastro">
  <div class="col-12">
    <div class="card-header">
      <h3 ><b>Alterar </b> Dados</h3>
    </div>
    <div class="card-body">
      <?php
        if(!empty($msg)){
          echo $msg;
        }
        ?>
    <form  name="form1" method="POST"  action="<?= BASE; ?>Colaborador/AlterarDados/<?php echo $infos['id']; ?>" data-parsley-validate enctype="multipart/form-data">
      <div class="row">
        <div class="form-group col-md-4">
          <label for="nome">Nome:</label>
          <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required data-parsley-required-message="Preencha o Campo NOME" value="<?php echo $infos['nome']; ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="email">E-mail:</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required data-parsley-required-message="Preencha o Campo E-MAIL" data-parsley-type-message="Digite um E-MAIL Válido" value="<?php echo $infos['email']; ?>">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4">
          <label for="telefone">Telefone:</label>
          <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="<?php echo $infos['telefone']; ?>">
        </div> 
        <div class="form-group col-md-4">
            <label for="fone">Celular:</label>
            <input type="text" class="form-control" name="celular" id="celular" placeholder="Celular" required data-parsley-required-message="Preencha o Campo CELULAR" value="<?php echo $infos['celular']; ?>">
        </div>
        <div class="col-12">
          <div class="card-header">
            <h4 ><b>Dados </b>de Login</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-3">
                <label for="senha">Matricula:</label>
                <input type="text" class="form-control" name="matricula" id="matricula" readonly placeholder="Matricula" required data-parsley-required-message="Preencha o Campo Matricula" value="<?php echo $infos['matricula']; ?>" >
                <input type="text" class="hidden" name="id_usuario" id="id_usuario"  value="<?php echo $infos['id_usuario']; ?>" >
              </div>
              <div class="form-group col-md-5">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" value="Cadastrar" class="btn btn-primary ">Salvar</button>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">

  //IPUNTMASK  TELEFONE 
  $("input[id*='telefone']").inputmask({
    mask: ['(99) 9999-9999'],
    keepStatic: true
    });
  //IPUNTMASK  CELULAR 
  $("input[id*='celular']").inputmask({
    mask: ["(99) 9999-9999", "(99) 99999-9999"],
    keepStatic: true
    });  

    $(document).ready(function() {
      $("#ativo").change(function(){
          if($(this).val() == "Não")
              {
                var r = confirm("Deseja realmente bloquear o acesso desse colaborador !");
                if (r == true) {
                  $("#ativo").val('Não');
                }else {
                  $("#ativo").val('Sim');
                }
              }
      });
    });

</script>