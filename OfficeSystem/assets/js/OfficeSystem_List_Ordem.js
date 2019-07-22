
//URL PADRAO

var BASE = "http://localhost/OfficeSystem/";

//FUNCAO LIMPAR TABELA ORDEM DE SERVICO
    function LimparListaOrdem() {
        var html = '';
        $("#ResultDados").html(html);

    }

//FUNCAO LISTAR ORDEM DE SERVICO ABERTA
    function ListarOrdemDeSevicoAberta() {
        var status = 'Aberto';
        var situacao = 'Ativo';
            
                $.ajax({
                    url: BASE+"OrdemDeServico/ListOrdemAberta",
                    type:'POST',
                    data:{status_Aberto:status,situacao_Ativo:situacao},
                    dataType:'json',
                    success:function(json) {
                        //console.log(json);

                        var arr = json;

                        if(arr.length === 0) {
                            alert("Não possui nenhuma ordem de serviço aberta !");
                            
                        } else {
                            var html = '';

                            html += '<span class=\"pointer hover-btn-limpar btn-limpar\" title=\"Limpar\" onclick=\"LimparListaOrdem();\"><img src=\"'+BASE+'assets/icons/png/exit-table.png\"></span>';
                    
                            html += '<table id=\"example1\" class=\"table table-hover\">';
                            html += '<thead>';
                            html += '<tr>';
                            html += '<th>Numero da Ordem</th>';
                            html += '<th>Cliente</th>';
                            html += '<th>Veiculo</th>';
                            html += '<th>Palca</th>';
                            html += '<th>Abertura</th>';
                            html += '<th class=\"text-center\">Status Prazo</th>';
                            html += '<th class=\"text-center\">Opções</th>';
                            html += '</tr>';
                            html += '</thead>';
                            html += '<tbody">';

                            for(var i in json) {
                            
                                html += '<tr class=\"pointer\">';
                                html += '<td>'+json[i].numero_os+'</td>';
                                html += '<td>'+json[i].nome+'</td>';
                                html += '<td>'+json[i].modelo+'</td>';
                                html += '<td>'+json[i].placa+'</td>';
                                html += '<td>'+json[i].dataAbertura+' '+json[i].horaAbertura+'</td>';

                                if (json[i].status_prazo == "Normal") {
                                    html +='<td class=\"text-center\"><span class=\"badge badge-info\">'+json[i].status_prazo+'</span></td>';
                                }else if (json[i].status_prazo == "ProximoVen") {
                                    html +='<td class=\"text-center\"><span class=\"badge badge-warning\">'+json[i].status_prazo+'</span></td>';
                                }else if (json[i].status_prazo == "Vencido") {
                                    html +='<td class=\"text-center\"><span class=\"badge badge-danger\">'+json[i].status_prazo+'</span></td>';
                                }
                               
                                html += '<td class=\"text-center\"><a class=\"btn hover-btn-limpar btn-margin-list \" title=\"Exibir Ordem de Serviço\" href=\"'+BASE+'OrdemDeServico/Exibir/'+json[i].id+'\" ><img class=\"icone-opcoes-ordsem\" src=\"'+BASE+'assets/icons/png/search.png\"></a>';
                                html += '<a class=\"btn hover-btn-limpar btn-sm \" title=\"Fechar Ordem de Serviço\" onclick=\"FecharOrdemDeServico('+json[i].id+')\"><img class=\"icone-opcoes-ordsem\"  src=\"'+BASE+'assets/icons/png/iconfecharordem.png\"></a></td>';
                            }

                            html += '</tbody>';
                            html += '</table>';
                        

                            $(document).ready( function () {
                                $('#example1').DataTable();
                            } );
                            $("#ResultDados").html(html);
                        }
                    
                    }
                });  
            
    }

 //FUNCAO LISTAR ORDEM DE SERVICO FECHADA
    function ListarOrdemDeSevicoFechada() {
        var status = 'Fechado';
        var situacao = 'Ativo';
            
                $.ajax({
                    url: BASE+"OrdemDeServico/ListOrdemFechada",
                    type:'POST',
                    data:{status_Fechado:status,situacao_Ativo:situacao},
                    dataType:'json',
                    success:function(json) {
                        //console.log(json);

                        var arr = json;

                        if(arr.length === 0) {
                            alert("Não possui nenhuma ordem de serviço Fechada !");
                            
                        } else {
                            var html = '';

                            html += '<span class=\"pointer hover-btn-limpar btn-limpar\" title=\"Limpar\" onclick=\"LimparListaOrdem();\"><img src=\"'+BASE+'assets/icons/png/exit-table.png\"></span>';
                    
                            html += '<table id=\"example1\" class=\"table table-hover\">';
                            html += '<thead>';
                            html += '<tr>';
                            html += '<th>Numero da Ordem</th>';
                            html += '<th>Cliente</th>';
                            html += '<th>Veiculo</th>';
                            html += '<th>Palca</th>';
                            html += '<th>Data de Abertura</th>';
                            html += '<th>Data de Fachamento</th>';
                            html += '<th class=\"text-center\">Status</th>';
                            html += '<th class=\"text-center\">Opções</th>';
                            html += '</tr>';
                            html += '</thead>';
                            html += '<tbody">';

                            for(var i in json) {
                            
                                html += '<tr class=\"pointer\">';
                                html += '<td>'+json[i].numero_os+'</td>';
                                html += '<td>'+json[i].nome+'</td>';
                                html += '<td>'+json[i].modelo+'</td>';
                                html += '<td>'+json[i].placa+'</td>';
                                html += '<td>'+json[i].dataAbertura+'</td>';
                                html += '<td>'+json[i].dataFechamento+'</td>';
                                html +='<td class=\"text-center\"><span class=\"badge badge-secondary\">'+json[i].status+'</span></td>';
                                html += '<td class=\"text-center\"><a class=\"btn hover-btn-limpar btn-margin-list \" title=\"Exibir Ordem de Serviço\" href=\"'+BASE+'OrdemDeServico/Exibir/'+json[i].id+'\" ><img class=\"icone-opcoes-ordsem\" src=\"'+BASE+'assets/icons/png/search.png\"></a>';
                            }

                            html += '</tbody>';
                            html += '</table>';
                        

                            $(document).ready( function () {
                                $('#example1').DataTable();
                            } );

                            $("#ResultDados").html(html);
                        }
                    
                    }
                });  
    }




    