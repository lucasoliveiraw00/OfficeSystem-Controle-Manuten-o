var BASE = "http://localhost/OfficeSystem/";

function AlertExcluirCliente(id) {
    
    $.ajax({
        url: BASE+"Cliente/Verificar",
        type:'POST',
        dataType:'json',
        data:{id:id},
        success:function(json) {
            
            var result = json;

                if(result  == true) {

                    var r1 = confirm("Este cliente está ligado com outros registros, Deseja realmente excluir !");
                        if (r1 == true) {
                            ExcluirCliente(id);
                        }
                    
                } else {     

                    var r1 = confirm("Deseja realmente excluir esse registro !");
                        if (r1 == true) {
                            ExcluirCliente(id);
                        }

                }


        }
    });
    
}
function AlertExcluirCol(id) {

    $.ajax({
        url: BASE+"Colaborador/Verificar",
        type:'POST',
        dataType:'json',
        data:{id:id},
        success:function(json) {
            
            var result = json;

                if(result  == true) {

                    var r1 = confirm("Este colaborador está ligado com outros registros, Deseja realmente excluir !");
                        if (r1 == true) {
                            ExcluirCol(id);
                        }
                    
                } else {     

                    var r1 = confirm("Deseja realmente excluir esse registro !");
                        if (r1 == true) {
                            ExcluirCol(id);
                        }

                }


        }
    });
}
function AlertExcluirVeiculo(id) {

    $.ajax({
        url: BASE+"Veiculo/Verificar",
        type:'POST',
        dataType:'json',
        data:{id:id},
        success:function(json) {
            
            var result = json;

                if(result  == true) {

                    var r1 = confirm("Este veiculo está ligado com outros registros, Deseja realmente excluir !");
                        if (r1 == true) {
                            ExcluirVeiculo(id);
                        }
                    
                } else {     

                    var r1 = confirm("Deseja realmente excluir esse registro !");
                        if (r1 == true) {
                            ExcluirVeiculo(id);
                        }

                }


        }
    });
}
function AlertExcluirProcedimento(id) {
    
    $.ajax({
        url: BASE+"Procedimento/Verificar",
        type:'POST',
        dataType:'json',
        data:{id:id},
        success:function(json) {
            
            var result = json;

                if(result  == true) {

                    var r1 = confirm("Este procedimento está ligado com outros registros, Deseja realmente excluir !");
                        if (r1 == true) {
                            ExcluirProcedimento(id);
                        }
                    
                } else {     

                    var r1 = confirm("Deseja realmente excluir esse registro !");
                        if (r1 == true) {
                            ExcluirProcedimento(id);
                        }

                }


        }
    });
}
function AlertExcluirComponente(id) {
    
    $.ajax({
        url: BASE+"Componente/Verificar",
        type:'POST',
        dataType:'json',
        data:{id:id},
        success:function(json) {
            
            var result = json;

                if(result  == true) {

                    var r1 = confirm("Este componente está ligado com outros registros, Deseja realmente excluir !");
                        if (r1 == true) {
                            ExcluirComponente(id);
                        }
                    
                } else {     

                    var r1 = confirm("Deseja realmente excluir esse registro!");
                        if (r1 == true) {
                            ExcluirComponente(id);
                        }

                }


        }
    });
}
function AlertExcluirItem(id) {
    
    $.ajax({
        url: BASE+"Item/Verificar",
        type:'POST',
        dataType:'json',
        data:{id:id},
        success:function(json) {
            
            var result = json;

                if(result  == true) {

                    var r1 = confirm("Este item está ligado com outros registros, Deseja realmente excluir !");
                        if (r1 == true) {
                            ExcluirItem(id);
                        }
                    
                } else {     

                    var r1 = confirm("Deseja realmente excluir esse registro!");
                        if (r1 == true) {
                            ExcluirItem(id);
                        }

                }


        }
    }); 
}

function AlertExcluirApt(id) {
    var id = (id);
    var r = confirm("Deseja realmente excluir esse apontamento !");
    if (r == true) {
        window.location.assign(BASE+"Servico/Inativar/"+ id);
    }    
}

function AlertExcluirAptModal(id) {
    var id = (id);
    var r = confirm("Deseja realmente excluir esse apontamento !");
    if (r == true) {
        window.location.assign(BASE+"Servico/InativarModal/"+ id);
    }    
}

function AlertFecharApt(id) {
    var id = (id);
    var r = confirm("Deseja realmente fechar esse apontamento !");
    if (r == true) {
       window.location.assign(BASE+"Servico/FecharApontamento/"+ id);
    }    
}

 function AlertFecharAptModal(id) {
    var id = (id);
    var r = confirm("Deseja realmente fechar esse apontamento !");
    if (r == true) {
       window.location.assign(BASE+"Servico/FecharApontamentoModal/"+ id);
    }    
}

function AlertVerificarExcluirOrdem(id){

    var id  = (id);
    var r = confirm("Deseja realmente excluir essa ordem de serviço !");
    if (r == true) {
    
            $.ajax({
                url:"http://localhost/OfficeSystem/OrdemdeServico/VerificarExcluir",
                type:'POST',
                data:{id_Ordem:id},
                dataType:'json',
                success:function(json) {
                    
                    var result = json;

                        if(result  == false) {

                            alert("Ocorreu algum erro ao enviar os dados !");
                            
                        } else {

                            if (result == 1) {

                                var r1 = confirm("Existe Dados Ligados a Está Ordem de Serviço ! \nAo confimar a exclusão irá automaticamente inativar todos os dados ligado a esse registro !");
                                    if (r1 == true) {
                                        InativarOrdem(id);
                                    }

                            }   else if (result == 2) {
                               
                                    InativarOrdem(id);

                            }else {
                                alert(result);
                            }

                        }
                }
             });
        }
}