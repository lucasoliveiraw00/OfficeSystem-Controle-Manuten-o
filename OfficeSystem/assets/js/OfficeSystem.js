
var BASE = "http://localhost/OfficeSystem/";

    function printContent(id){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(id).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }

    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
        
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
    
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value = "Buscando Rua..";
                document.getElementById('bairro').value="Buscando Bairro..";
                document.getElementById('cidade').value="Buscando Cidade..";
                document.getElementById('uf').value="Buscando Estado...";
                
    /**
                 *     
                 * document.getElementById('rua').placeholder = "Buscando Rua..";
                document.getElementById('bairro').placeholder = "Buscando Estado..";
                document.getElementById('cidade').placeholder = "Buscando Cidade..";
                document.getElementById('uf').placeholder = "Buscando Estado..";
                */
                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

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

    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable()
        $('#example3').DataTable()
        $('#example4').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })
    });


    $(function () {
        $('[alert-tooltip="tooltip"]').tooltip()
    });
    

    $(document).ready(function(){

        $("#enviar").click(function(e){

        e.preventDefault();
            var erros = 0;
            $("#form1 input,#form1 textarea,#form1 select").each(function(){
                
            var r = $(this).val().trim();
                r == "" ? erros++ : "";

                if (r === '') {
                var x = $(this).attr('id');
                $(".invalido-"+x).css("display", "block");

                }else if (r != '') {
                var x = $(this).attr('id');
                $(".invalido-"+x).css("display", "none");
                }
                
            });
            
            if(erros > 0 ){
                
                alert("Existe(em) campo(os) vazio(os) neste fomulário");
                    
            } else{

                $("#form1").submit()
            }		
            
        });

        $("#enviar2").click(function(e){

        e.preventDefault();
            var erros = 0;
            $("#form2 input,#form2 textarea,#form2 select").each(function(){
                
            var r = $(this).val().trim();
                r == "" ? erros++ : "";

                if (r === '') {
                var x = $(this).attr('id');
                $(".invalido-"+x).css("display", "block");

                }else if (r != '') {
                var x = $(this).attr('id');
                $(".invalido-"+x).css("display", "none");
                }
                
            });
            
            if(erros > 0 ){
                
                alert("Existe(em) campo(os) vazio(os) neste fomulário");
                    
            } else{

                $("#form2").submit()
            }		
            
        });

        
        $('#form1 input,#form1 textarea,#form1 select,#form2 input,#form2 textarea,#form2 select').each(function() {
            if (  $(this).attr('readonly') != "readonly" ){
                $(this).on('keyup',function(){  
                var r = $(this).val().trim();
                if ( r != '' ) {  
                    var x = $(this).attr('id');
                    $(".invalido-"+x).css("display", "none");
                }
                });
            } 
        });

        $(this).on('click',function(){    
            $('#form1 input,#form1 textarea,#form1 select,#form2 input,#form2 textarea,#form2 select').each(function() {
            var r = $(this).val().trim();
            if (r != '') {
                var x = $(this).attr('id');
                $(".invalido-"+x).css("display", "none");
            }
            });
        });

    });

    function VerificarDadosProprietario(id,nome) {
        var id = (id);
        var nome = (nome);
        $.ajax({
            url: BASE+"OrdemdeServico/VerificarDadosVeiculo",
            type:'POST',
            data:{id_proprietario:id},
            dataType:'json',
            success:function(json) {

                var arr = json;

                if(arr.length === 0) {
                    alert(nome + " não possui nenhum veiculo cadastrado !"); 

                    document.getElementById('id_cliente').value="";
                    document.getElementById('nome').value="";
                    document.getElementById('cpfcnpj').value="";
                
                } 
      
            }
        });   

    }

    function ModalVeiculoDados(){
        var id = $('#id_cliente').val();
        var nome = $('#nome_cliente').val();
        
        if (id.length == 0) {
            alert("Para selecionar este campo o campo proprietario deve estar preechido !");
        }else {
            $.ajax({
                url: BASE+"OrdemdeServico/BuscarDadosVeiculo",
                type:'POST',
                data:{id_proprietario:id},
                dataType:'json',
                success:function(json) {
                    //console.log(json);

                    var arr = json;

                    if(arr.length === 0) {
                        alert(nome + " não possui nenhum veiculo cadastrado !");
                        
                    } else {
                        var html = '';

                        html += '<table id=\"example3\" class=\"table  table-hover\">'
                        html += '<thead>'
                        html += '<tr>'
                        html += '<th>Modelo</th>'
                        html += '<th>Marca</th>'
                        html += '<th>Ano</th>'
                        html += '<th>Placa</th>'
                        html += '</tr>'
                        html += '</thead>'
                        html += '<tbody >' 

                            for(var i in json) {
                                html += '<tr class=\"pointer\" title=\"SELECIONAR\" data-dismiss=\"modal\" aria-label="Close" onclick=\"SelecionaVeiculo(\''+json[i].id+'\',\''+json[i].modelo+'\',\''+json[i].marca+'\',\''+json[i].ano+'\',\''+json[i].placa+'\')\">';
                                html += '<td>'+json[i].modelo+'</td>';
                                html += '<td>'+json[i].marca+'</td>';
                                html += '<td>'+json[i].ano+'</td>';
                                html += '<td>'+json[i].placa+'</td></tr>';
                            }
                           
                        html += '</tbody>'
                        html += '</table>'

                        $(document).ready( function () {
                            $('#example3').DataTable();
                        } );
        
                        $("#ResultDadoVeiculo").html(html);
                        $(".Modal-Veiculo").modal();
                    }
                
                }
            });  
        }

    }

    function ModalItemDados(){
        var id = $('#id_comp').val();
        
        if (id.length == 0) {
            alert("Para selecionar este campo o campo componente deve estar preechido !");
        }else {
            $.ajax({
                url: BASE+"item/BuscarDadosItens",
                type:'POST',
                data:{id_comp:id},
                dataType:'json',
                success:function(json) {
                    //console.log(json);

                    var arr = json;

                    if(arr.length === 0) {
                        alert("Não possui nenhum item cadastrado no componente selecionado !");
                        
                    } else {
                        var html = '';
                    
                        html += '<table id=\"example5\" class=\"table table-hover\">'
                        html += '<thead>'
                        html += '<tr>'
                        html += '<th>Descrição</th>'
                        html += '<th>Codigo</th>'
                        html += '</tr>'
                        html += '</thead>'
                        html += '<tbody>'

                            for(var i in json) {   
                                
                                html += '<tr class=\"pointer\" title=\"SELECIONAR\" data-dismiss=\"modal\" aria-label="Close" onclick=\"SelecionaItem(\''+json[i].id+'\',\''+json[i].descricao+'\',\''+json[i].codigo+'\')\">';
                                html += '<td>'+json[i].descricao+'</td>';
                                html += '<td>'+json[i].codigo+'</td>';
                                html += '</tr>';    
                            }

                        html += '</tbody>'
                        html += '</table>'

                        $(document).ready( function () {
                            $('#example5').DataTable();
                        } );

                        $("#ResultDados").html(html);
                        $(".Modal-Item").modal();
                        
                    }
                }
            });  
        }

    }

    function FecharOrdemDeServico(id){

        var id  = (id);
        var r = confirm("Deseja realmente fechar essa ordem de serviço !");
        if (r == true) {
          
            $.ajax({
                url:"http://localhost/OfficeSystem/OrdemdeServico/FecharOrdemDeServico",
                type:'POST',
                data:{id_Ordem:id},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == false) {

                            alert("Ocorreu algum erro ao enviar os dados !");
                            
                        } else {

                            if (result == true) {
                                alert('Ordem de serviço fechada com sucesso !');
                                location.reload();

                            }else {
                                alert(result);
                            }
                        }
                }        
            });
        }
    }

    function ExibirDadosOrdemDeServico(id_Ordem){

    var id_Ordem  = (id_Ordem);

        $.ajax({
            url:"http://localhost/OfficeSystem/OrdemdeServico/BuscarDadosOrdemDeServico",
            type:'POST',
            data:{id_Ordem:id_Ordem},
            dataType:'json',
            success:function(json) {
                //console.log(json);

                var arr = json;

                if(arr.length === 0) {
                    alert(" não possui nenhuma iformação !");
                    
                } else {
                    var html = '';
                    for(var i in json) {

                        html += '<div class=\"row\">';
                            html += '<div class=\"col\">';
                                html += '<h5>Solicitante:</h5>';
                                    html += '<div class=\"col-sm-12\">';                      
                                        html += '<div class=\"row\">';
                                            html += '<div class=\"form-group col-md-5\" ><h6 ><b> Usuário:</b> '+json[i].nomeUsuario+'</h6></div>';
                                            html += '<div class=\"form-group col-md-5\" ><h6 ><b> Matricula:</b> '+json[i].matriculaUsuario+'</h6></div>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                         
                        html += '<div class=\"row\">';
                            html += '<div class=\"col\">';
                                html += '<h5>Proprietário:</h5>';
                                    html += '<div class=\"col-sm-12\">';                      
                                        html += '<div class=\"row\">';
                                            html += '<div class=\"form-group col-md-5\" ><h6 ><b> Nome:</b> '+json[i].nomeCliente+'</h6></div>';
                                            html += '<div class=\"form-group col-md-5\" ><h6 ><b> CPF/CNPJ:</b> '+json[i].cpfcnpjCliente+'</h6></div>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';

                        html += '<div class=\"row\">';
                            html += '<div class=\"col\">';
                                html += '<h5>Veiculo:</h5>';
                                    html += '<div class=\"col-sm-12\">';                      
                                        html += '<div class=\"row\">';
                                            html += '<div class=\"form-group col-md-3\" ><h6 ><b> Modelo:</b> '+json[i].modeloVeiculo+'</h6></div>';
                                            html += '<div class=\"form-group col-md-3\" ><h6 ><b> Marca:</b> '+json[i].marcaVeiculo+'</h6></div>';
                                            html += '<div class=\"form-group col-md-3\" ><h6 ><b> Ano:</b> '+json[i].anoVeiculo+'</h6></div>';
                                            html += '<div class=\"form-group col-md-3\" ><h6 ><b> Placa:</b> '+json[i].placaVeiculo+'</h6></div>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';

                        html += '<div class="row">';
                            html += '<div class="col-5">';
                                html += '<h5 >Abertura:</h5>';
                                html += '<div class="col-sm-12">';
                                    html += '<div class="row">';
                                        html += '<div class=\"form-group col-md-3\" ><h6 ><b> Data:</b> '+json[i].dataAbertura+'</h6></div>';
                                        html += '<div class=\"form-group col-md-3\" ><h6 ><b> Hora:</b> '+json[i].horaAbertura+'</h6></div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                            html += '<div class="col-5">';
                                html += '<h5 >Fechamento:</h5>';
                                html += '<div class="col-sm-12">';
                                    html += '<div class="row">';
                                            html += '<div class=\"form-group col-md-3\" ><h6 ><b> Data:</b> '+json[i].dataFechamento+'</h6></div>';
                                            html += '<div class=\"form-group col-md-3\" ><h6 ><b> Hora:</b> '+json[i].horaFechamento+'</h6></div>';
                                        html += ' </div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';

                        html += '<div class=\"row\">';
                            html += '<div class=\"col\">';
                                html += '<h5>Descrição:</h5>';
                                    html += '<div class=\"col-sm-12\">';                      
                                        html += '<div class=\"row\">';
                                        html += '<textarea  class="form-control"  rows="3" style="resize:none" readonly>'+json[i].descricao_os+'</textarea>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                        html += '</br>';

                        html += '<div class="row">';    
                            html += '<div class=\"form-group col-md-3\" ><h6><b>Status: </b>'+json[i].status_os+'</h6></div>';
                            html += '<div class=\"form-group col-md-3\" ><h6 ><b>Ativo: </b>'+json[i].ativo_os+'</h6></div>';
                        html += '</div>' 
                        html += '<div class=\"card-footer\">';
                        html += '<button  class="btn btn-success ">Editar</button>';
                        html += '</div>';
                    }
    
                    $("#InfoOrdem").html(html);
             
                }
            
            }
        });  

    }

    function ExibirApontamento(id_servico,acesso) {
        
        var id_servico =  (id_servico);
        var acesso =  (acesso);
    
                $.ajax({
                url: BASE+"OrdemDeServico/ExibirOrdemApontamento",
                type:'POST',
                data:{id_servico:id_servico},
                dataType:'json',
                success:function(json) {
                    //console.log(json);

                    var arr = json;

                    if(arr.length === 0) {
                        alert("Não possui nenhum apontamento !");
                        
                    } else {
                        var html = '';

                            html += '<div class=\"row\">';
                                html += '<div class=\"col\">';
                                    html += '<h5>Usuário:</h5>';
                                        html += '<div class=\"col-sm-12\">';                      
                                            html += '<div class=\"row\">';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Nome:</b> '+arr.nome+'</h6></div>';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Matricula:</b> '+arr.matricula+'</h6></div>';
                                            html += '</div>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                            html += '<div class=\"row\">';
                                html += '<div class=\"col\">';
                                    html += '<h5>Apontamento:</h5>';
                                        html += '<div class=\"col-sm-12\">';                      
                                            html += '<div class=\"row\">';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Procedimento:</b> '+arr.descricao_proc+'</h6></div>';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Codigo:</b> '+arr.codigo_proc+'</h6></div>';
                                    
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Componente:</b> '+arr.descricao_comp+'</h6></div>';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Codigo:</b> '+arr.codigo_comp+'</h6></div>';
                                
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Item:</b> '+arr.descricao_item+'</h6></div>';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Codigo:</b> '+arr.codigo_item+'</h6></div>';
                                            html += '</div>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                            html += '<div class="row">';
                                html += '<div class="col">';
                                    html += '<h5 >Abertura:</h5>';
                                    html += '<div class="col-sm-12">';
                                        html += '<div class="row">';
                                            html += '<div class=\"form-group col-md-5\" ><h6 ><b> Data:</b> '+arr.dataAbertura+'</h6></div>';
                                            html += '<div class=\"form-group col-md-4\" ><h6 ><b> Hora:</b> '+arr.horaAbertura+'</h6></div>';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                                html += '<div class="col">';
                                    if (arr.dataFechamento && arr.horaFechamento  != null ) {
                                        html += '<h5 >Fechamento:</h5>';
                                        html += '<div class="col-sm-12">';
                                            html += '<div class="row">';
                                                html += '<div class=\"form-group col-md-5\" ><h6 ><b> Data:</b> '+arr.dataFechamento+'</h6></div>';
                                                html += '<div class=\"form-group col-md-4\" ><h6 ><b> Hora:</b> '+arr.horaFechamento+'</h6></div>';
                                            html += '</div>';
                                        html += '</div>';
                                    }
                                html += '</div>';
                            html += '</div>';
                            html += '<div class="row">'; 
                                if (arr.status == "Aberto") {
                                    html += '<div class=\"form-group col-md-5\" ><h6><b>Status: </b><span class=\"badge badge-warning\">'+arr.status+'</span></div>';
                                } else {
                                    html += '<div class=\"form-group col-md-5\" ><h6><b>Status: </b><span class=\"badge badge-danger\">'+arr.status+'</span></div>';
                                }
                            html += '</div>'
                            html += '<div class=\"card-footer\">';
                                html += '<a class=\"btn btn-success \" href=\"'+BASE+'Servico/Editar/'+arr.id_servico+'\" role=\"button\">Editar</a>';
                                if ((arr.status == "Aberto")) { 
                                    html += '<button type=\"button\" class=\"btn btn-danger btn-margin-list\" onclick=\"AlertFecharAptModal('+arr.id_servico+')\">Fechar</button>';
                                } else if ((arr.status == "Fechado") && (arr.os_status == "Aberto")) { 
                                    html += '<button class=\"btn btn-outline-danger btn-margin-list\"  onclick=\"AlertExcluirAptModal('+arr.id_servico+')\"><i class=\"fas fa-trash\"></i></button>';
                                }else if ((arr.status == "Fechado") && (arr.os_status == "Fechado") && (acesso == "Admin")) { 
                                    html += '<button class=\"btn btn-outline-danger btn-margin-list\"  onclick=\"AlertExcluirAptModal('+arr.id_servico+')\"><i class=\"fas fa-trash\"></i></button>';
                                }
                            html += '</div>';
                        

                        $("#ResultDados2").html(html);
                        $(".Modal-Apontamento").modal();
                        //$($.ajax).empty();
                        
                    }
                            
                }
            });  
    
    }
    
    function InativarOrdem(id){
            var id = (id)
            $.ajax({
                url:"http://localhost/OfficeSystem/OrdemdeServico/InativarOrdem",
                type:'POST',
                data:{id_Ordem:id},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == false) {

                            alert("Ocorreu algum erro ao enviar os dados !");
                            
                        } else {

                            if (result == true) {

                                alert ('Ordem de serviço excluida com sucesso !');
                                window.history.back();

                            }else {
                                alert(result);
                            }

                        }


                }
            });
    }

    function ExcluirCliente(id) {
    
        $.ajax({
            url: BASE+"Cliente/Excluir",
            type:'POST',
            dataType:'json',
            data:{id:id},
            success:function(json) {
                
                var result = json;

                    if(result  == true) {

                        alert("Cliente excluido com sucesso !");
                        window.location.reload();
                        
                    } else {     

                        alert("Erro ao excluido !");
                        

                    }


            }
        });
        
    }

    function ExcluirCol(id) {
    
        $.ajax({
            url: BASE+"Colaborador/Excluir",
            type:'POST',
            dataType:'json',
            data:{id:id},
            success:function(json) {
                
                var result = json;

                    if(result  == true) {

                        alert("Colaborador excluido com sucesso !");
                        window.location.reload();
                        
                    } else if (result == 'logado') {     

                        alert("Este colaborador não pode ser excluído, esta logado no sistema !");

                    }else {     

                        alert("Erro ao excluido !");
                        

                    }


            }
        });
        
    }

    function ExcluirVeiculo(id) {
    
        $.ajax({
            url: BASE+"Veiculo/Excluir",
            type:'POST',
            dataType:'json',
            data:{id:id},
            success:function(json) {
                
                var result = json;

                    if(result  == true) {

                        alert("Veiculo excluido com sucesso !");
                        window.location.reload();
                        
                    } else {     

                        alert("Erro ao excluido !");
                        

                    }


            }
        });
        
    }

    function ExcluirProcedimento(id) {
    
        $.ajax({
            url: BASE+"Procedimento/Excluir",
            type:'POST',
            dataType:'json',
            data:{id:id},
            success:function(json) {
                
                var result = json;

                    if(result  == true) {

                        alert("Procedimento excluido com sucesso !");
                        window.location.reload();
                        
                    } else {     

                        alert("Erro ao excluido !");
                        

                    }


            }
        });
        
    }

    function ExcluirComponente(id) {
    
        $.ajax({
            url: BASE+"Componente/Excluir",
            type:'POST',
            dataType:'json',
            data:{id:id},
            success:function(json) {
                
                var result = json;

                    if(result  == true) {

                        alert("Componente excluido com sucesso !");
                        window.location.assign(BASE+"Componente")
                        
                    } else {     

                        alert("Erro ao excluido !");
                        

                    }


            }
        });
        
    }

    function ExcluirItem(id) {
    
        $.ajax({
            url: BASE+"Item/Excluir",
            type:'POST',
            dataType:'json',
            data:{id:id},
            success:function(json) {
                
                var result = json;

                    if(result  == true) {

                        alert("Item excluido com sucesso !");
                        window.location.reload()
                        
                    } else {     

                        alert("Erro ao excluido !");
                        

                    }


            }
        });
        
    }