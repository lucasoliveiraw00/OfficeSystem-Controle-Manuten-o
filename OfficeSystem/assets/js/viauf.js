function limpa_formulário_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('cep').value=("");
        
      
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('cep').value=(conteudo.cep);
      
  
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var uf = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (uf != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(uf)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('cep').value="...";
          
            

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.

            script.src = 'viacep.com.br/ws/'+uf+'/'+cidade+'/'+rua+'/json/ ';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};
