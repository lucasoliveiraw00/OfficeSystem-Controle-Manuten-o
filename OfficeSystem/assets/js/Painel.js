var BASE = 'http://localhost/OfficeSystem/';

    (function(window) { 
    'use strict'; 
   
  var noback = { 
       
      //globals 
      version: '0.0.1', 
      history_api : typeof history.pushState !== 'undefined', 
       
      init:function(){ 
          window.location.hash = '#no-back'; 
          noback.configure(); 
      }, 
       
      hasChanged:function(){ 
          if (window.location.hash == '#no-back' ){ 
              window.location.hash = '';
              //mostra mensagem que não pode usar o btn volta do browser
              if($( "#msgAviso" ).css('display') =='none'){
                  $( "#msgAviso" ).slideToggle("slow");
              }
          } 
      }, 
       
      checkCompat: function(){ 
          if(window.addEventListener) { 
              window.addEventListener("hashchange", noback.hasChanged, false); 
          }else if (window.attachEvent) { 
              window.attachEvent("onhashchange", noback.hasChanged); 
          }else{ 
              window.onhashchange = noback.hasChanged; 
          } 
      }, 
       
      configure: function(){ 
          if ( window.location.hash == '#no-back' ) { 
              if ( this.history_api ){ 
                  history.pushState(null, '', ''); 
              }else{  
                  window.location.hash = '';
                  //mostra mensagem que não pode usar o btn volta do browser
        
              } 
          } 
          noback.checkCompat(); 
          noback.hasChanged(); 
      } 
       
      }; 
       
      if (typeof define === 'function' && define.amd) { 
          define( function() { return noback; } ); 
      }  
      else if (typeof module === 'object' && module.exports) { 
          module.exports = noback; 
      }  
      else { 
          window.noback = noback; 
      } 
      noback.init();
    }(window)); 

    var myVar=setInterval(function(){myTimer()},1000);
    function myTimer() {
            var d = new Date();
            document.getElementById("hora").innerHTML = d.toLocaleTimeString();
            document.getElementById("data").innerHTML = d.toLocaleDateString();
    }


    $(document).ready(function(){

        PainelInicio();

    });

    
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


    function PainelInicio() {

        var usuario = $('#usuario').val()
        var titulo = '';

            titulo += '<div class=\"row\">'
            titulo += '<div class=\"col-1"><i class=\"fas fa-times  sair-painel pointer\" title=\"Sair\" onclick="(SairPainel());"></i></div>'
            titulo += '<div class=\"col-10 text-center\">Bem Vindo '+usuario+'</div>';
            titulo += '</div>'; 

        const html = `
        <div class="text-center">
            <button type="button" class="btn btn-primary" onclick="VerificarServico();">Iniciar Serviço</button><br><br>
            <button type="button" class="btn btn-danger" onclick="VerificarFecharServico();">Finalizar Serviço</button><br><br>
            <button type="button" class="btn btn-warning" onclick="ConsultarServico();">Consultar Serviço </button>
        </div>
    `

        $("#titulo").html(titulo);
        $("#dados").html(html);
    }

    function VerificarServico() {

            $.ajax({
                url: BASE+"Painel/VerificarServico",
                type:'POST',
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == 'ServicoAberto') {

                            alert('Existe um apontamento em aberto !');
                            
                        } else {     

                            PaineIniciarServico();

                        }


                }
            });
        
    }

    function VerificarFecharServico() {

        $.ajax({
            url: BASE+"Painel/VerificarServico",
            type:'POST',
            dataType:'json',
            success:function(json) {
                
                var result = json;

                    if(result  == 'ServicoAberto') {

                        var r1 = confirm("Deseja realmente finalizar o serviço !");
                            if (r1 == true) {
                                FecharServico();
                            }
                        
                    } else {     

                        alert('Não existe nenhum serviço em aberto !')

                    }


            }
        });
    
    }

    function FecharServico() {

        $.ajax({
            url: BASE+"Painel/FecharServico",
            type:'POST',
            dataType:'json',
            success:function(json) {
                
                var result = json;

                    if(result  == false) {

                        alert('Ocorreu algum erro ao fechar o serviço !');
                        
                    } else {     

                        alert('Serviço finalizado com sucesso !');

                    }


            }
        });
    
    }

    function ConsultarServico() {

                $.ajax({
                url: BASE+"Painel/ConsultarServico",
                type:'POST',
                dataType:'json',
                success:function(json) {

                    var arr = json;

                    if(arr == 'Status_Fechado') {
                        alert("Não existe nenhum serviço em aberto !");
                        
                    } else {
                        var html = '';

                            html += '<div class=\"card-body\">';
                                html += '<div class=\"row\">';
                                    html += '<div class=\"col\">';
                                        html += '<h5>Ordem de Serviço:</h5>';
                                        html += '<div class=\"col-sm-8\">';                      
                                            html += '<div class=\"row\">';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Numero:</b> '+arr.numero_os+'</h6></div>';
                                            html += '</div>';
                                        html += '</div>';
                                    html += '</div>';
                                    html += '<div class=\"col-7\">';
                                        html += '<h5>Veiculo:</h5>';
                                        html += '<div class=\"col-sm-10\">';                      
                                            html += '<div class=\"row\">';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Modelo:</b> '+arr.modelo+'</h6></div>';
                                                html += '<div class=\"form-group col-md-6\" ><h6 ><b> Placa:</b> '+arr.placa+'</h6></div>';
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
                                html += '</div>';
                                html += '<div class="row">'; 
                                    html += '<div class=\"form-group col-md-5\" ><h6><b>Status: </b><span class=\"badge badge-warning\">'+arr.status+'</span></div>';
                                html += '</div>';
                            html += '</div>';
                        

                        $("#Dados-Modal-Servico").html(html);
                        $(".Modal-Servico").modal();
                        
                    }
                            
                }
            });  
    
    }

    function PaineIniciarServico() {

        
            var titulo = '';

                titulo += '<div class=\"row\">'
                titulo += '<div class=\"col-1"><i class=\"fas fa-angle-left voltar-painel pointer\" onclick="(PainelInicio());"></i></div>'
                titulo += '<div class=\"col-10 text-center\">Iniciar Serviço</div>';
                titulo += '</div>';

            const html = `

                <div class="text-center">
                    <div class="row">
                        <div class="col">
                            <h6>Ordem de Serviço:</h6>
                            <div class="col-sm-12">  
                                <div class="form-group col-md-12">   
                                    <div class="input-group mb-3">  
                                        <input type="number" autofocus class="form-control" name="numero_os" id="numero_os" placeholder="Nº">
                                        <div class="input-group-append">
                                            <span onclick="ListOrdemAberta();" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card-footer text-center">
                    <button class="btn btn-primary btn-margin-list " onclick="VerificarOrdem();">Iniciar</button>
                </div>

            `
        

            $("#titulo").html(titulo);
            $("#dados").html(html);

    }

    function ListOrdemAberta() {

        $.ajax({
            url: BASE+"Painel/ListOrdemAberta",
            type:'POST',
            dataType:'json',
            success:function(json) {
                
                var result = json;

                    if(result.length === 0) {

                        alert("Não exite nenhuma ordem aberta !");
                        
                    } else {

                        var html = '';
                        var titulo = '';

                            titulo += ' <h3 class=\"modal-title\" ><b>Exibir </b> Ordem de Serviço</h3>';
                           
                            html += '<table id=\"example1\" class=\"table  table-hover\">'
                            html += '<thead>'
                            html += '<tr>'
                            html += '<th>Ordem Nº</th>'
                            html += '<th>Modelo</th>'
                            html += '<th>Placa</th>'
                            html += '</tr>'
                            html += '</thead>'
                            html += '<tbody >' 

                                for(var i in json) {
                                    html += '<tr class=\"pointer\" title=\"SELECIONAR\" data-dismiss=\"modal\" aria-label="Close" onclick=\"SelecionaOrdem(\''+json[i].numero_os+'\')\">';
                                    html += '<td>'+json[i].numero_os+'</td>';
                                    html += '<td>'+json[i].modelo+'</td>';
                                    html += '<td>'+json[i].placa+'</td>';
                                }
                            
                            html += '</tbody>'
                            html += '</table>'

                        $(document).ready( function () {
                            $('#example1').DataTable();
                        } );
                        
                        
                        $("#Dados-Modal").html(html);
                        $("#model-titulo").html(titulo);
                        $(".Modal").modal();
                        
                    }
            }
        });
    }

    function VerificarOrdem() {

        numero_os = $("#numero_os").val();

        if ( numero_os.length != 0) { 
            $.ajax({
                url: BASE+"Painel/VerificarOrdem",
                type:'POST',
                data:{numero_os:numero_os},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == false) {

                            alert("Ocorreu algum erro ao enviar os dados !");
                            
                        } else {

                            if (result == 'erro') {

                                alert("Ordem de serviço se encontra fechada ou não existe !");
                                $('#numero_os').focus();
                                $('#numero_os').val(null);

                            } else {
                                var id_ordem = json.id;
                                PainelServico(id_ordem);
                            }

                        }


                }
            });
        } else {
            alert("Preencher o campo Nº ordem de serviço !");
            $('#numero_os').focus();
        }
    }

    function PainelServico(id_ordem) {

        $.ajax({
            url: BASE+"Painel/BuscarDadosPainelServico",
            type:'POST',
            data:{id_ordem:id_ordem},
            dataType:'json',
            success:function(json) {
                
                var result = json;

                    if(result  == false) {

                        alert("Ocorreu algum erro ao carregar os dados da pagina!");
                        
                    } else {

                              
                        var titulo = '';

                        titulo += '<div class=\"row\">'
                        titulo += '<div class=\"col-1"><i class=\"fas fa-angle-left voltar-painel pointer\" onclick="(PaineIniciarServico());"></i></div>'
                        titulo += '<div class=\"col-10 text-center\">Novo Serviço</div>';
                        titulo += '</div>';

                    
                        const html = `
                        
                            <div class="row">
                                <div class="col">
                                    <label for="nome">Procedimento:</label>
                                    <div class="row">
                                        <div class="form-group col-md-6">   
                                            <input type="number" class="hidden" id="id_proc"readonly >
                                            <input type="number" id="codigo_proc" autofocus required class="form-control" placeholder="Codigo">
                                        </div>   
                                        <div class="form-group col-md-6">   
                                            <div class="input-group mb-3">  
                                                    <input type="text" id="descricao_proc" class="form-control" readonly placeholder="Descrição">
                                                <div class="input-group-append">
                                                    <span onclick="ListProcedimento();" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    <label for="nome">Componente:</label>
                                    <div class="row">
                                        <div class="form-group col-md-6">   
                                            <input type="number" class="hidden" id="id_comp"readonly >
                                            <input type="number" id="codigo_comp" readonly required class="form-control" placeholder="Codigo">
                                        </div>   
                                        <div class="form-group col-md-6">   
                                            <div class="input-group mb-3">  
                                                <input type="text" id="descricao_comp" class="form-control" readonly placeholder="Descrição">
                                                <div class="input-group-append">
                                                    <span onclick="ListComponente();" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>

                                    <label for="nome">Item:</label>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <input type="number" class="hidden" id="id_item"readonly >   
                                            <input type="number" id="codigo_item" readonly aria-describedby="inputGroupPrepend" required class="form-control" placeholder="Codigo">
                                        </div>   
                                        <div class="form-group col-md-6">   
                                            <div class="input-group mb-3">  
                                                <input type="text" id="descricao_item" class="form-control" readonly placeholder="Codigo">
                                                <div class="input-group-append">
                                                    <span onclick="ListItem();" class="input-group-text pointer"><i class="fas fa-search"></i></span>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label>Descrição:</label>
                            <div class="row">
                                <div class="col">
                                    <div class="col-sm-12">                
                                        <div class="row">
                                            <textarea  class="form-control"  rows="3" style="resize:none" readonly>${result['descricao']}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card-footer text-center">
                                <button class="btn btn-primary btn-margin-list " onclick="IniciarServico(${id_ordem});">Iniciar</button>
                            </div>

                        `
                        $(document).ready(function(){
                            $("#codigo_proc").keypress(function(){
                                $("#codigo_proc").removeClass('is-invalid').addClass('is-valid');
                            });
                        });

                        $(document).ready(function(){
                            $("#codigo_comp").keypress(function(){
                                $("#codigo_comp").removeClass('is-invalid').addClass('is-valid');
                            });
                        });

                        $(document).ready(function(){
                            $("#codigo_item").keypress(function(){
                                $("#codigo_item").removeClass('is-invalid').addClass('is-valid');
                            });
                        });

                            
                        $(document).ready(function(){
                            
                                $("#codigo_proc").blur(function(){

                                    var codigo_proc = $('#codigo_proc').val();
                                    
                                if (codigo_proc.length != 0) {

                                    BuscarProcDescricao(codigo_proc)

                                }else {
                                    $('#codigo_comp').attr('readonly', true);
                                    $('#codigo_item').attr('readonly', true);
                                    $("#codigo_comp").removeClass('is-valid').removeClass('is-invalid');
                                    $("#codigo_item").removeClass('is-valid').removeClass('is-invalid');
                                    $("#descricao_proc").val(null);
                                    $("#codigo_comp").val(null);
                                    $("#descricao_comp").val(null);
                                    $("#codigo_item").val(null);
                                    $("#descricao_item").val(null);
                                    $('#codigo_proc').addClass('is-invalid');

                                }      
                            });
                        });

                        $(document).ready(function(){

                                $("#codigo_comp").blur(function(){

                                    var codigo_proc = $('#codigo_proc').val();

                                    if (codigo_proc.length != 0) {

                                        $("#codigo_comp").removeAttr("readonly"); 

                                        var codigo_comp = $('#codigo_comp').val();

                                        if (codigo_comp.length != 0) {

                                            BuscarCompDescricao(codigo_comp)
                                            $("#codigo_comp").removeClass('is-invalid');

                                        }else {
                                            $('#codigo_item').attr('readonly', true);
                                            $("#codigo_item").removeClass('is-valid').removeClass('is-invalid');
                                            $('#codigo_comp').addClass('is-invalid');
                                            $("#codigo_comp").val(null);
                                            $("#descricao_comp").val(null);
                                            $("#codigo_item").val(null);
                                            $("#descricao_item").val(null);

                                        }   
                                    }else {
                                        alert('Campo procedimento deve estar preenchido !')
                                        $('#codigo_proc').focus();
                                    }
                                    
                            });
                        }); 

                        $(document).ready(function(){

                            $("#codigo_item").blur(function(){

                                var codigo_comp = $('#codigo_comp').val();

                                if (codigo_comp.length != 0) {

                                        var codigo_item = $('#codigo_item').val();
                                        var id_comp = $('#id_comp').val();
                                        
                                        if (codigo_item.length != 0) {

                                            BuscarItemDescricao(codigo_item, id_comp)
                                            $("#codigo_item").removeClass('is-invalid');
                                        }else {
                                            $('#codigo_item').addClass('is-invalid');
                                            $("#codigo_item").focus();
                                            $("#descricao_item").val(null);

                                        }   
                                    
                                }else {
                                        alert('Campo componente deve estar preenchido !')   
                                        $('#codigo_comp').focus();
                                    }          
                            });
                        }); 

                        $("#titulo").html(titulo);
                        $("#dados").html(html);

                    }
            }, error: function () {
                alert("Ocorreu algum erro ao carregar os dados da pagina!");
            }
        });


    }

    function ListProcedimento() {

        $.ajax({
            url: BASE+"Painel/ListProcedimento",
            type:'POST',
            dataType:'json',
            success:function(json) {
                
                var result = json;

                    if(result.length === 0) {

                        alert("Erro ao carregar os dados do componente !");
                        
                    } else {

                        var html = '';
                        var titulo = '';

                            titulo += ' <h3 class=\"modal-title\" ><b>Exibir </b> Procedimentos</h3>';
                           
                            html += '<table id=\"example1\" class=\"table  table-hover\">'
                            html += '<thead>'
                            html += '<tr>'
                            html += '<th>Codigo</th>'
                            html += '<th>descrição</th>'
                            html += '</tr>'
                            html += '</thead>'
                            html += '<tbody >' 

                                for(var i in json) {
                                    html += '<tr class=\"pointer\" title=\"SELECIONAR\" data-dismiss=\"modal\" aria-label="Close" onclick=\"SelecionaProc(\''+json[i].id+'\',\''+json[i].descricao+'\',\''+json[i].codigo+'\')\">';
                                    html += '<td>'+json[i].codigo+'</td>';
                                    html += '<td>'+json[i].descricao+'</td>';
                                }
                            
                            html += '</tbody>'
                            html += '</table>'

                        $(document).ready( function () {
                            $('#example1').DataTable();
                        } );
                        
                        
                        $("#Dados-Modal").html(html);
                        $("#model-titulo").html(titulo);
                        $(".Modal").modal();
                        
                    }
            }
        });
    }

    function ListComponente() {
        var id_proc = $('#id_proc').val();

        if (id_proc.length != 0) {
            $.ajax({
                url: BASE+"Painel/ListComponente",
                type:'POST',
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result.length === 0) {

                            alert("Erro ao carregar os dados do componente !");
                            
                        } else {

                            var html = '';
                            var titulo = '';

                                titulo += ' <h3 class=\"modal-title\" ><b>Exibir </b> Componentes</h3>';

                                html += '<table id=\"example2\" class=\"table  table-hover\">'
                                html += '<thead>'
                                html += '<tr>'
                                html += '<th>Codigo</th>'
                                html += '<th>descrição</th>'
                                html += '</tr>'
                                html += '</thead>'
                                html += '<tbody >' 

                                    for(var i in json) {
                                        html += '<tr class=\"pointer\" title=\"SELECIONAR\" data-dismiss=\"modal\" aria-label="Close" onclick=\"VerificarComponente(\''+json[i].id+'\',\''+json[i].descricao+'\',\''+json[i].codigo+'\')\">';
                                        html += '<td>'+json[i].codigo+'</td>';
                                        html += '<td>'+json[i].descricao+'</td>';
                                    }
                                
                                html += '</tbody>'
                                html += '</table>'

                            $(document).ready( function () {
                                $('#example2').DataTable();
                            } );
            
                            $("#Dados-Modal").html(html);
                            $("#model-titulo").html(titulo);
                            $(".Modal").modal();
                            
                        }
                }
            });
        }else {
            alert('Campo procedimento deve estar preenchido !')
        }
    }

    function VerificarComponente(id,descricao,codigo){

            $.ajax({
                url: BASE+"Painel/VerificarComponente",
                type:'POST',
                data:{id_comp:id},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == false) {

                            alert("Não existe nenhum item cadastrado para esse componente !");
                            $("#codigo_comp").val(null);
                            $("#descricao_comp").val(null);
                            $("#codigo_item").val(null);
                            $("#descricao_item").val(null);
                            $('#codigo_comp').attr('readonly', true);
                            $('#codigo_item').attr('readonly', true);
                            
                        } else {

                            $("#id_comp").val(id);
                            $("#descricao_comp").val(descricao);
                            $("#codigo_comp").val(codigo);
                            $("#codigo_comp").removeAttr("readonly");
                            $("#codigo_item").removeAttr("readonly");
                            $("#codigo_comp").removeClass('is-invalid');

                            //LIMPAR OS CAMPO ITEM E CODIGO
                            if(document.getElementById('id_item').value!="") {
                                document.getElementById('id_item').value="";
                                document.getElementById('descricao_item').value="";
                                document.getElementById('codigo_item').value="";

                        }
                    }

                }
            });
    }

    function ListItem() {

        var id_comp = $('#id_comp').val();

        if (id_comp.length != 0) {
            $.ajax({
                url: BASE+"Painel/ListItem",
                type:'POST',
                data:{id_comp:id_comp},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;
        
                        if(result.length === 0) {
        
                            alert("Erro ao carregar os dados do componente !");
                            
                        } else {
        
                            var html = '';
                            var titulo = '';

                                titulo += ' <h3 class=\"modal-title\" ><b>Exibir </b> Itens</h3>';
        
                                html += '<table id=\"example3\" class=\"table  table-hover\">'
                                html += '<thead>'
                                html += '<tr>'
                                html += '<th>Codigo</th>'
                                html += '<th>descrição</th>'
                                html += '</tr>'
                                html += '</thead>'
                                html += '<tbody >' 
        
                                    for(var i in json) {
                                        html += '<tr class=\"pointer\" title=\"SELECIONAR\" data-dismiss=\"modal\" aria-label="Close" onclick=\"SelecionaItens(\''+json[i].id+'\',\''+json[i].descricao+'\',\''+json[i].codigo+'\')\">';
                                        html += '<td>'+json[i].codigo+'</td>';
                                        html += '<td>'+json[i].descricao+'</td>';
                                    }
                                
                                html += '</tbody>'
                                html += '</table>'
        
                            $(document).ready( function () {
                                $('#example3').DataTable();
                            } );
            
                            $("#Dados-Modal").html(html);
                            $("#model-titulo").html(titulo);
                            $(".Modal").modal();
                            
                        }
                }
            });
        }else {
            alert('Campo componente deve estar preechido !')
        }

        
    }

    function BuscarProcDescricao(codigo_proc) {

        var codigo_proc = (codigo_proc)

        if ( codigo_proc.length != 0) { 
            $.ajax({
                url: BASE+"Painel/BuscarProcDescricao",
                type:'POST',
                data:{proc_cod:codigo_proc},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == false) {

                            alert("O procedimento não existe!");
                            $("#codigo_proc").val(null);
                            $("#descricao_proc").val(null);
                            $("#codigo_proc").focus();
                            
                        } else {

                            $("#id_proc").val(json['id']);
                            $("#descricao_proc").val(json['descricao']);
                            $("#codigo_comp").focus();
                            $("#codigo_comp").removeAttr("readonly"); 

                        }


                }
            });
        }
    }

    function BuscarCompDescricao(codigo_comp) {

        var codigo_comp = (codigo_comp)

        if ( codigo_comp.length != 0) { 
            $.ajax({
                url: BASE+"Painel/BuscarCompDescricao",
                type:'POST',
                data:{comp_cod:codigo_comp},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;
                    if (result  === 'erro2') {

                        alert("Não existe esse componente !");
                        $("#codigo_comp").val(null);
                        $("#descricao_comp").val(null);
                        $("#codigo_comp").focus();
                        
                    } else if (result  === 'erro3') {

                        alert("Erro ao verificar os itens !");
                        $("#codigo_comp").val(null);
                        $("#descricao_comp").val(null);
                        $("#codigo_item").val(null);
                        $("#descricao_item").val(null);
                        $("#codigo_comp").focus();

                    }   else if (result  === 'erro4') {

                        alert("Não existe nenhum item cadastrado para esse componente");
                        $("#codigo_comp").val(null);
                        $("#descricao_comp").val(null);
                        $("#codigo_item").val(null);
                        $("#descricao_item").val(null);
                        $("#codigo_comp").focus();

                    } else {

                            $("#id_comp").val(json['id']);
                            $("#descricao_comp").val(json['descricao']);
                            $("#codigo_item").focus();
                            $("#codigo_item").removeAttr("readonly"); 

                        }


                }
            });
        }
    }

    function BuscarItemDescricao(codigo_item, id_comp) {

        var codigo_item = (codigo_item)
        var id_comp = (id_comp)

        if ( id_comp.length != 0) { 
            $.ajax({
                url: BASE+"Painel/BuscarItemDescricao",
                type:'POST',
                data:{item_cod:codigo_item,id_comp:id_comp},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == false) {

                            alert("O item não existe!");
                            $("#codigo_item").val(null);
                            $("#descricao_item").val(null);
                            $("#codigo_item").focus();
                            
                        } else {

                            $("#id_item").val(json['id']);
                            $("#descricao_item").val(json['descricao']);

                        }


                }
            });
        }
    }

    function IniciarServico(id_ordem){
        var id_proc = $('#id_proc').val();
        var id_item = $('#id_item').val();
        var id_ordem = (id_ordem);

        if ((id_proc.length != 0) && (id_item.length != 0)){
            
            $.ajax({
                url: BASE+"Painel/IniciarServico",
                type:'POST',
                data:{id_proc:id_proc,id_item:id_item,id_ordem:id_ordem},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == false) {

                            alert("Ocorreu algum erro ao enviar os dados !");
                            
                        } else {

                            if (result == true) {

                                alert ('Serviço Iniciado Com Sucesso !');
                                window.location.reload();

                            }else {
                                alert(result);
                            }

                        }

                }
            });


        }else {
            alert('Todos os campos deve estar preechido !')
        }
    }

    function SelecionaProc(id,descricao,codigo) {
        $("#id_proc").val(id);
            $("#descricao_proc").val(descricao);
                $("#codigo_proc").val(codigo);
                $("#codigo_comp").removeAttr("readonly");
                $("#codigo_proc").removeClass('is-invalid');
    
    };

    function SelecionaItens(id,descricao,codigo) {
    
        $("#id_item").val(id);
            $("#descricao_item").val(descricao);
                $("#codigo_item").val(codigo);
                $("#codigo_item").removeClass('is-invalid');
    };

    function SairPainel() {

        var r1 = confirm("Deseja realmente sair do painel de serviço !");
            
            if (r1 == true) {
                $.ajax({
                    url: BASE+"Painel/SairPainel",
                    type:'POST',
                    dataType:'json',
                    success:function(json) {
                        
                        var result = json;

                        if (result == true) {
                            window.location.assign(BASE+'Login');
                        }else {
                            alert ('Erro ao sair do painel de serviço');
                        }
        
        
                    }
                });

            }
        
    
    }


        