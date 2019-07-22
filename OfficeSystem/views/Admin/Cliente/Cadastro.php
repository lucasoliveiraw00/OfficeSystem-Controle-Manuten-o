<div class="content margin-painel-cadastro">
  <h3 ><b>Cadastro </b> de Cliente</h3><br>
  <?php
    if(!empty($msg)){
      echo $msg;
    }
  ?>
  <form  name="form1" method="POST" action="<?= BASE; ?>Cliente/Adicionar" data-parsley-validate enctype="multipart/form-data" >
    <div class="row">
        <div class="form-group col-md-4">
          <label for="nome">Nome:</label>
          <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required data-parsley-required-message="Preencha o Campo NOME">
        </div>
        <div class="form-group col-md-3">
          <label for="cpfcnpj" >CPF/CNPJ:</label>
          <input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj"  placeholder="CPF/CNPJ"   required required data-parsley-required-message="Preencha o Campo CPF/CNPJ" >
        </div>
        <div class="form-group col-md-3">
          <label for="dataNasc">Data de Nacimento:</label>
          <input type="text" name="dataNasc" id="dataNasc"class="form-control" placeholder="Data" required data-parsley-required-message="Preencha o Campo DATA DE NASCIMENTO" >
        </div>
        <div class="form-group col-md-4">
          <label for="email">E-mail:</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required data-parsley-required-message="Preencha o Campo E-MAIL" data-parsley-type-message="Digite um E-MAIL Válido">
        </div>
        <div class="form-group col-md-3">
          <label for="telefone">Telefone:</label>
          <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="Telefone">
        </div>
        <div class="form-group col-md-3">
          <label for="fone">Celular:</label>
          <input type="tel" class="form-control" name="celular" id="celular" placeholder="Celular" required data-parsley-required-message="Preencha o Campo CELULAR">
        </div>     
        <div class="form-group col-md-4">
          <label for="cep">CEP:</label><a class="btn-cep pointer" onCLick="window.open('http://www.buscacep.correios.com.br/sistemas/buscacep/','_blank');" alert-tooltip="tooltip" title="Buscar Cep"><i class="fas fa-search"></i></a>
          <input class="form-control" name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" placeholder="Cep" required data-parsley-required-message="Preencha o Campo CEP">
        </div>
        <div class="form-group col-md-3">
          <label for="cidade">Cidade:</label>
          <input class="form-control" name="cidade" type="text" id="cidade" size="40" placeholder="Cidade"required data-parsley-required-message="Preencha o Campo CIDADE">
        </div>
        <div class="form-group col-md-3">
          <label for="uf">UF:</label>
          <input  class="form-control"  name="estado" type="text" id="uf" size="2" placeholder="UF" required data-parsley-required-message="Preencha o Campo ESTADO">
        </div>
        <div class="form-group col-md-4">
          <label for="bairro">Bairro:</label>
          <input  class="form-control" name="bairro" type="text" id="bairro" size="40"  placeholder="Bairro" required data-parsley-required-message="Preencha o Campo BAIRRO">
        </div>
        <div class="form-group col-md-3">
          <label for="rua">Endereço:</label>
          <input  class="form-control" name="rua" type="text" id="rua" size="60" placeholder="Endereço" required data-parsley-required-message="Preencha o Campo ENDEREÇO">
        </div>
        <div class="form-group col-md-3">
          <label for="numEnd">Numero do Endereço:</label>
          <input type="text" class="form-control" name="numEnd" id="numEnd" placeholder="Numero do Endereço" required data-parsley-required-message="Preencha o Campo NUMERO DO ENDEREÇO">
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" value="Cadastrar" class="btn btn-primary ">Salvar</button>
    </div>
  </form>
</div>


<script>
    
    $("input[id*='cpfcnpj']").inputmask({
    mask: ['999.999.999-99', '99.999.999/9999-99'],
    keepStatic: true
    });
 
    $('#dataNasc').mask("00/00/0000", {placeholder: "__/__/____"});

  
    $("input[id*='telefone']").inputmask({
      mask: ['(99) 9999-9999'],
      keepStatic: true
      });
   
    $("input[id*='celular']").inputmask({
      mask: ["(99) 9999-9999", "(99) 99999-9999"],
      keepStatic: true
      });  
     
    $("input[id*='cep']").inputmask({
      mask: ['99999-999'],
      keepStatic: true
      });

    $("input[id*='uf']").inputmask({
      mask: ['AA'],
      keepStatic: true
      });
</script>