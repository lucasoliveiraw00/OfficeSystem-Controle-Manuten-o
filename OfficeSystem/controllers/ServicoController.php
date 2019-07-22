<?php
    class ServicoController extends controller {

        public function Iniciar($id) {
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dados = array();
            $ModelServico = new ModelServico();
            $ModelProcedimento = new ModelProcedimento();
            $ModelComponente = new ModelComponente();
            $ModelOrdemDeServico = new ModelOrdemDeServico();
            $situacao = "Ativo";
            $cargo = "Mecânico";
            $ativo = "Sim";
            
            if(isset($id) && !empty($id)) {

                if ($ModelServico->VerificaExitOS($id,$situacao)){
                    if ($dadosOrdem = $ModelOrdemDeServico->BuscarDadosOrdem($id,$situacao)){
                        if ($dadosOrdem->status == "Fechado")  {
                            echo  '<script>alert("Ordem de serviço se encontra fechada, esta indisponivel para novo serviço !");location.href="'.BASE.'OrdemDeServico/Exibir/'.$id.'";</script>';
                        }else {
                            $ResultDadosCol = $ModelServico->GetListaColaborador($situacao,$cargo,$ativo);           
                                $ResultDadosProcedimento = $ModelProcedimento->GetLista($situacao);
                                $ResultDadosComponente = $ModelComponente->GetLista($situacao);
                
                                    $dados['id']= $id;
                                    $dados['ResultDadosCol']= $ResultDadosCol;
                                    $dados['ResultDadosProcedimento'] = $ResultDadosProcedimento;
                                    $dados['ResultDadosComponente'] = $ResultDadosComponente;

                                    $this->loadTemplateAdmin('Admin/Servico/Cadastro', $dados);
                        }
                    } else {
                         echo  '<script>alert("Erro ao buscar os dados da ordem de serviço!");</script>';
                    }   
                }else {

                    echo '<script>alert("Erro ao carregar os dados da pagina !");history.back();</script>';  
                    exit;
                       
                }
              
            } else {
                echo '<script>alert("Erro ao carregar os dados da pagina !");history.back();</script>';  
                exit;
            }        
           

        }

        public function Editar($id) {
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dados = array();
            $ModelServico = new ModelServico();
            $ModelProcedimento = new ModelProcedimento();
            $ModelComponente = new ModelComponente();
            $situacao = "Ativo";
            $cargo = "Mecânico";
            if(isset($id) && !empty($id)) {
                if ($ResultDados = $ModelServico->GetDadosServico($id,$situacao)){  
                    $ResultDadosCol = $ModelServico->GetListaColaborador($situacao,$cargo,$situacao);
                    $ResultDadosProcedimento = $ModelProcedimento->GetLista($situacao);
                    $ResultDadosComponente = $ModelComponente->GetLista($situacao);

                        $dados['ResultDados'] = $ResultDados;
                        $dados['ResultDadosCol']= $ResultDadosCol;
                        $dados['ResultDadosProcedimento'] = $ResultDadosProcedimento;
                        $dados['ResultDadosComponente'] = $ResultDadosComponente; 
                        if ($ResultDados['status_os'] == 'Fechado') {
                            $this->loadTemplateAdmin('Admin/Servico/EditarOsFechada', $dados);
                        }else if ( !empty ($ResultDados['dataFechamento']) &&  !empty ($ResultDados['horaFechamento']) ) {
                            $this->loadTemplateAdmin('Admin/Servico/EditarSvFechado', $dados);
                        }else {
                            $this->loadTemplateAdmin('Admin/Servico/Editar', $dados);
                        }
                } else {
                    echo  '<script>alert("Erro ao carregar os dados da pagina !");history.back();</script>';  
                    exit;
                }

            } else {
                echo  '<script>alert("Erro ao carregar os dados da pagina !");history.back();</script>';  
                exit;
            }

        }

        public function Verificar($id){
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dados = array();
            $ModelServico = new ModelServico();
            $OrdemDeServico = new ModelOrdemDeServico();

            $id_col = $id_proc = $id_comp = $id_item = $dataAbertura = $horaAbertura = $dataFechamento = $horaFechamento = $status = "";
            
            if ( isset ( $_POST["id_col"] ) ) {
                    $id_col = trim ( $_POST["id_col"] ); 	
            }
            if ( isset ( $_POST["id_proc"] ) ) {
                    $id_proc = trim ( $_POST["id_proc"] ); 	
            }
            if ( isset ( $_POST["id_comp"] ) ) {
                    $id_comp = trim ( $_POST["id_comp"] ); 	
            }
            if ( isset ( $_POST["id_item"] ) ) {
                $id_item = trim ( $_POST["id_item"] ); 	
            }

            if ( empty ( $id_col ) ) {
                echo  '<script>alert("Preencha o Campo USUÁRIO");history.back();</script>';
                    
            }else if ( empty ( $id_proc ) ) {
                echo  '<script>alert("Preencha o Campo PROCEDIMNETO");history.back();</script>';
                    
            }else if ( empty ( $id_comp ) ) {
                echo  '<script>alert("Preencha o Campo COMPONENTE");history.back();</script>';
            
            }else if ( empty ( $id_item ) ) {
                echo  '<script>alert("Preencha o Campo ITEM");history.back();</script>';

            }else {

                date_default_timezone_set('America/Sao_Paulo');
                $dataAbertura = date('d/m/Y');
                $horaAbertura = date('H:i:s');
                $status = "Aberto";
                $situacao = "Ativo";

                    $dataAbertura = $this->FormataDataAbertura($dataAbertura);
                 
                    if  ($result = $ModelServico->VerificaServico($id_col,$status,$situacao)) {
        
                        echo  '<script>alert("Colaborador já possui um serviço em aberto na ordem de serviço Nª '.$result->numero_os.'.");history.back();</script>';
                                                
                    } else {

                            if ($dadosOrdem = $OrdemDeServico->BuscarDadosOrdem($id,$situacao)){

                                if (($dataAbertura >= $dadosOrdem->dataFechamento) && ($dadosOrdem->status == "Fechado"))  {
                                    echo  '<script>alert("Ordem de serviço se encontra fechada, esta indisponivel para novo serviço !");location.href="'.BASE.'OrdemDeServico/Exibir/'.$id.'";</script>';
                                }   else {

                                    if  ($ModelServico->Adicionar($id_col,$id_proc,$id_item,$dataAbertura,$horaAbertura,$status,$id,$situacao)) {
                    
                                            echo  '<script>alert("Serviço iniciado com sucesso !");location.href="'.BASE.'OrdemDeServico/Exibir/'.$id.'";</script>';
                                                            
                                    }   else {
                    
                                            echo  '<script>alert("Ocorreu erro ao inicia o serviço!");history.back();</script>';
                    
                                    }
                                   
                                }

                            } else {
                                echo  '<script>alert("Erro ao buscar os dados da ordem de serviço!");</script>';
                            }

        
        
                        }

            }

        }

        public function Dados($id){
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
                    
            $dados = array();
            $ModelServico = new ModelServico();

            $id_col = $id_proc = $id_comp = $id_item = $dataAbertura = $horaAbertura = $dataFechamento = $horaFechamento = "";
            
            if ( isset ( $_POST["id_col"] ) ) {
                    $id_col = trim ( $_POST["id_col"] ); 	
            }
            if ( isset ( $_POST["id_proc"] ) ) {
                    $id_proc = trim ( $_POST["id_proc"] ); 	
            }
            if ( isset ( $_POST["id_comp"] ) ) {
                    $id_comp = trim ( $_POST["id_comp"] ); 	
            }
            if ( isset ( $_POST["id_item"] ) ) {
                $id_item = trim ( $_POST["id_item"] ); 	
            }
            if ( isset ( $_POST["dataAbertura"] ) ) {
                    $dataAbertura = trim ( $_POST["dataAbertura"] ); 	
            }
            if ( isset ( $_POST["horaAbertura"] ) ) {
                    $horaAbertura = trim ( $_POST["horaAbertura"] ); 	
            }
            if ( isset ( $_POST["dataFechamento"] ) ) {
                    $dataFechamento = trim ( $_POST["dataFechamento"] ); 	
            }
            if ( isset ( $_POST["horaFechamento"] ) ) {
                    $horaFechamento = trim ( $_POST["horaFechamento"] ); 	 
            } 
            if ( isset ( $_POST["status"] ) ) {
                $status = trim ( $_POST["status"] ); 	
            }
        
            if ( empty ( $id_col ) ) {
                echo '<script>alert("Preencha o Campo USUÁRIO");history.back();</script>';
                    
            }else if ( empty ( $id_proc ) ) {
                echo  '<script>alert("Preencha o Campo PROCEDIMNETO");history.back();</script>';
                    
            }else if ( empty ( $id_comp ) ) {
                echo '<script>alert("Preencha o Campo COMPONENTE");history.back();</script>';
            
            }else if ( empty ( $id_item ) ) {
                echo '<script>alert("Preencha o Campo ITEM");history.back();</script>';

            }else if ($dataFechamento == "0") {
                echo '<script>alert("Data de fechamento inválida");history.back();</script>';
                
            }else if ($horaFechamento == "0") {
                echo '<script>alert("Data de fechamento inválida");history.back();</script>';

            } else {

                    
                    //DEFININDO VALOR PARA O PARAMETRO
                    $ResultValidaDataFechamento = 1;
                    $ResultValidaHoraFechamento = 1;
                    $ResultVerificarHoraDataFechamentoAbertura = 1;
                    $VerificarDisponibilidadeHorario = 1;

                    //PASSANDO O PARAMENTRO DATA PARA FUNÇÃO VALIDA DATA FECHAMENTO
                    $ResultValidaDataFechamento = $this->ValidaDataFechamento($dataFechamento);

                    //PASSANDO O PARAMENTRO DATA ABERTURA PARA FUNÇÃO FORMATA DATA DE ABERTURA
                    $dataAbertura = $this->FormataDataAbertura($dataAbertura);
                    
                    //PASSANDO O PARAMENTRO DATA FECHAMENTO PARA FUNÇÃO FORMATA DATA DE FECHAMENTO
                    $dataFechamento = $this->FormataDataFechamento($dataFechamento);

                    //PASSANDO O PARAMENTRO PARA FUNÇÃO VALIDA HORA DE FECHAMENTO
                    $ResultValidaHoraFechamento = $this->ValidaHoraFechamento( $horaFechamento );      
                 
                    //PASSANDO PARAMENTRO HORA E DATA PARA FUNÇÃO VERIFICAR HORA E DATA FECHAMNETO E ABERTURA
                    $ResultVerificarHoraDataFechamentoAbertura = $this->VerificarHoraDataFechamentoAbertura($dataFechamento,$horaFechamento,$dataAbertura,$horaAbertura,$id);
                      
                        if ($ResultValidaDataFechamento != 1) {
        
                            echo "<script>alert('$ResultValidaDataFechamento');history.back();</script>";
        
                        } else if ( $ResultValidaHoraFechamento != 1 ) {
                           
                            echo "<script>alert('$ResultValidaHoraFechamento');history.back();</script>";
                              
                        } else if ( $ResultVerificarHoraDataFechamentoAbertura != 1 ) {

                            echo "<script>alert('$ResultVerificarHoraDataFechamentoAbertura');history.back();</script>";
                          
                        } else {
                            
                            $situacao = "Ativo";
                            $VerificarDisponibilidadeHorario = $this->VerificarDisponibilidadeHorario($id,$id_col,$dataAbertura,$horaAbertura,$dataFechamento,$horaFechamento,$situacao);

                            if  (($result = $ModelServico->VerificaServico2($id,$id_col,$status,$situacao)) && ($status == "Aberto")) {
        
                                echo  '<script>alert("Colaborador já possui um serviço em aberto na ordem de serviço Nª '.$result->numero_os.'.");history.back();</script>';
                                                        
                            } else if ( $VerificarDisponibilidadeHorario != 1 ) {

                                echo "<script>alert('$VerificarDisponibilidadeHorario');history.back();</script>";
                              
                            } else {
                    
                                if  ($ModelServico->EditServico($id_col,$id_proc,$id_item,$dataFechamento,$horaFechamento,$status,$id)) {
        
                                    echo  '<script>alert("Serviço editado com sucesso !");history.go(-2);</script>';
                                                
                                }   else {
        
                                    echo  '<script>alert("Ocorreu erro ao editar !");history.go(-2);</script>';
        
                                    }
                            }
                        }

                }
            
        }

        public function VerificarDisponibilidadeHorario($id,$id_col,$dataAbertura,$horaAbertura,$dataFechamento,$horaFechamento,$situacao) {
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $ModelServico = new ModelServico();

            if ( !empty ($dataFechamento)) {

                if ($result = $ModelServico->DisponibilidadeHorario($id,$id_col,$situacao)) {

                    for ($i=0; $i < count($result); $i++) { 

                        foreach ($result as $list) {
                            
                            if ($id != $list['id']) {

                                if ($dataAbertura === $list['dataAbertura'] && $dataFechamento === $list['dataFechamento'] && $horaFechamento >= $list['horaAbertura']){
                                     
                                    echo "<script>alert('Usuário possui uma data e horário que coincide com a do fechamento!\\n Verifique a disponibilidade de horário do usuário! ');history.back();</script>";
                                    exit;

                                } else if ($dataAbertura === $list['dataAbertura'] && $list['dataFechamento'] >= $dataFechamento && $horaFechamento >= $list['horaAbertura']) {
                                        
                                    echo "<script>alert('Usuário possui uma data e horário que coincide com a do fechamento!\\n Verifique a disponibilidade de horário do usuário! ');history.back();</script>";
                                    exit;

                                }else if ($list['dataAbertura'] >= $dataAbertura && $list['dataFechamento'] <= $dataFechamento) {
                                            
                                    if ($list['dataAbertura'] <= $dataFechamento && $horaFechamento >= $list['horaAbertura']) {

                                        echo "<script>alert('Usuário possui uma data e horário que coincide com a do fechamento!\\n Verifique a disponibilidade de horário do usuário! ');history.back();</script>";
                                        exit;

                                    }   else if ($dataFechamento > $list['dataAbertura'] && $horaFechamento <= $list['horaAbertura'] ) {

                                        echo "<script>alert('Usuário possui uma data e horário que coincide com a do fechamento!\\n Verifique a disponibilidade de horário do usuário! ');history.back();</script>";
                                        exit;
                                            
                                    }   
  
                                }
                            }
                        }
                        return true;
                    }

                } else {
                    echo  'Ocorreu um erro ao verificar disponibilidade de horário!';
                }

            } else {
                return true;
            } 

        }

        public function ValidaDataFechamento($dataFechamento){
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            
            if ( !empty ($dataFechamento)) {
                $dataFechamento = explode('/', $dataFechamento);
                $checkdate = $dataFechamento;

                if ( count ($dataFechamento) == 3) {

                        $dataFechamento = implode ($dataFechamento);
                        $dataFechamento = strlen ($dataFechamento);
                        
                        if ($dataFechamento <= 7) {
                            return "Data de fechamento invalida ! ";

                        }  else {
                            $d = $checkdate[0];
                            $m = $checkdate[1];
                            $y = $checkdate[2];
                        
                            $res = checkdate($m,$d,$y);
    
                            if ($res == 1){
                            
                                return true;
    
                            } else {
    
                                return "Data inválida!";
                            }
                        }

                } else {
                    return "Formato da data de fechamento inválido !";
                }
            } else {
                return true;
            }
        }

        public function FormataDataAbertura($dataAbertura) {
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dataAbertura = explode("/",$dataAbertura);
            return $dataAbertura[2]."-".$dataAbertura[1]."-".$dataAbertura[0];
        }

        public function FormataDataFechamento($dataFechamento) {
                $this->VerificarLogin(); 
            $this->VerificarNivel(2);
                if ( !empty ($dataFechamento) ) {

                    $dataFechamento = explode("/",$dataFechamento);
                    return $dataFechamento[2]."-".$dataFechamento[1]."-".$dataFechamento[0];

                } else {
                    return $dataFechamento;
                }
                
        }

        public function ValidaHoraFechamento($horaFechamento){
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            if ( !empty ($horaFechamento)) {

                $horaFechamento = explode(':', $horaFechamento);

                if(count($horaFechamento) == 3){

                    $horaFechamento =  implode ($horaFechamento);
                    $horaFechamento = strlen($horaFechamento);

                    if ($horaFechamento <= 5) {

                        return "Hora de Fechamento invalida !";

                    } else {
                        return true;
                    }

                } else {
                    return "Formato de hora de Fechamento é invalido !";
                } 

            } else {
                return true;
            }

        }


        public function VerificarHoraDataFechamentoAbertura($dataFechamento,$horaFechamento,$dataAbertura,$horaAbertura,$id){
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $ModelServico = new ModelServico();
            
            if ( !empty ($dataFechamento && $horaFechamento)) {

                date_default_timezone_set('America/Sao_Paulo');
                $dataAtual = date('Y-m-d');
                $dataAtualPTBR = date('d/m/Y');
                $horaAtual = date('H:i:s');
                $status = "Aberto";
                $situacao = "Ativo";

                if ($ResultDados = $ModelServico->BuscarDadosOrdem($id,$situacao)) {
                    if  (!empty ($ResultDados->id)) {   
                        
                        
                        if ($dataAbertura < $ResultDados->dataAbertura) {
                                return "Data de Abertura Invalida !\\nData de abertura é menor que a data de abertura da ordem de serviço !";
                        
                        }   else if (($ResultDados->status == "Fechado") && ($dataAbertura > $ResultDados->dataFechamento)) {
                            
                                return "Data de Abertura Invalida !\\nData de abertura é maior que a data de fechamento da ordem de serviço !";
                        
                        }   else if ($dataFechamento < $dataAbertura) {
                            
                            return "Data de Fechamento Invalida !\\nData de fechamento é menor que a data de abertura de serviço !";
                    
                         }  else if ($dataAbertura > $dataFechamento) {
                            
                            return "Data de abertura Invalida !\\nData de abertura é maior que a data de fechamento de serviço !";
                    
                        }   else if (($ResultDados->status == "Fechado") && ($dataFechamento > $ResultDados->dataFechamento)) {
                            
                                return "Data de Fechamento Invalida !\\nData de fechamento é maior que a data de fechamento da ordem de serviço !";
                        
                        }   else if (($ResultDados->status == "Fechado") && ($dataAbertura == $ResultDados->dataFechamento) && ($horaAbertura >= $ResultDados->horaFechamento) ) {
                                        
                                return "Data e Horário Invalido !\\nData e horário de abertura e maior que a data e horário de fechamento da ordem de serviço !";
                                
                        }   else if ($dataFechamento > $dataAtual) {
                            
                                return "Data Invalida !\\nData de fechamento e maior que data atual ".$dataAtualPTBR." !";
                            
                        }   else if ( ($dataFechamento == $dataAtual) && ($horaFechamento >= $horaAtual) ) {

                                return "Data e Horário Invalido!\\nData e horário de fechamento e maior que data e horário atual: ".$dataAtualPTBR." -- ".$horaAtual.".";
                         
                        }   else if ( ($dataAbertura == $dataFechamento) && ($horaFechamento < $horaAbertura) ) {
                                        
                                return "Hora Invalida !\\nHorário de fechamento e menor que a hora de abertura do serviço !";
                                        
                        }   else if (($ResultDados->status == "Fechado") && ($dataFechamento == $ResultDados->dataFechamento) && ($horaFechamento >= $ResultDados->horaFechamento) ) {
                                        
                                return "Hora Invalida !\\nHorário de fechamento e maior que a hora de fechamento da ordem de serviço !";
                                    
                        }    else if ( ($dataAbertura == $dataFechamento) && ($horaAbertura == $horaFechamento) ) {
                                
                                return "Hora Invalida !\\nHorário e data de abertura coincide com horário e data de fechamento de serviço !";
                        
                        }   else {
                                return true;
                        }

                    } else {
                        return "Erro há alguns dados vazio na validação de abertura e fechamento !";
                    }
                
                } else {         
                    return "Ocorreu um erro ao carregar os dados verificação de abertura e fechamento !";
                }

            } else {
                return true;
            }
              
        }

        public function FecharApontamento($id) {
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dados = array();
            $ModelServico = new ModelServico();
        
            if(isset($id) && !empty($id)) { 
                    //DEFININDO OS PARAMENTRO DATA, HORA E STATUS
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataFechamento = date('d/m/Y');
                    $horaFechamento = date('H:i:s');
                    $status = "Fechado";

                     $dataFechamento = $this->FormataDataFechamento($dataFechamento);

                    if  ($ModelServico->FecharApontamento($dataFechamento,$horaFechamento,$status,$id)) {
        
                        echo  '<script>alert("Apontamento fechado com sucesso !");history.go(-2);</script>';
                                    
                    }   else {

                        echo  '<script>alert("Ocorreu erro ao fechar !");history.go(-2);</script>';

                        }
                 
               
            } else {
                echo  '<script>alert("Erro ao carregar os dados da pagina !");history.back();</script>';  
                exit;
            }        
           
        }

        public function FecharApontamentoModal($id) {
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dados = array();
            $ModelServico = new ModelServico();
        
            if(isset($id) && !empty($id)) { 
                    //DEFININDO OS PARAMENTRO DATA, HORA E STATUS
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataFechamento = date('d/m/Y');
                    $horaFechamento = date('H:i:s');
                    $status = "Fechado";

                     $dataFechamento = $this->FormataDataFechamento($dataFechamento);

                    if  ($ModelServico->FecharApontamento($dataFechamento,$horaFechamento,$status,$id)) {
        
                        echo  '<script>alert("Apontamento fechado com sucesso !");history.back();</script>';
                                    
                    }   else {

                        echo  '<script>alert("Ocorreu erro ao fechar !");history.back();</script>';

                        }
                 
               
            } else {
                echo  '<script>alert("Erro ao carregar os dados da pagina !");history.back();</script>';  
                exit;
            }        
           
        }

        public function Inativar($id){
            $this->VerificarLogin(); 
            $this->VerificarNivel(1);   
            $dados = array();
            $ModelServico = new ModelServico();
            
            $id = (int)$id;
            if ($id == 0) {

            echo  '<script>alert("Requisição Inválida !");history.go(-2);</script>';
            
            }

            if ( $ModelServico->VerificaApontamento($id)) {
                    
                    echo '<script>alert("O serviço não pode ser excluido, esta com serviço em aberto !");history.go(-2);</script>';

                    } else {
                        $situacao_Inativo = "Inativo";
                        if ($ModelServico->InativarApontamento($id, $situacao_Inativo)) {

                                    echo '<script>alert("Apontamento excluido com sucesso !");history.go(-2);</script>';

                            } else {

                                   echo '<script>alert("Ocorreu algum um erro ao excluir o registro !");history.go(-2);</script>';

                            }
                    }
        }

        public function InativarModal($id){
            $this->VerificarLogin(); 
            $this->VerificarNivel(1);   
            $dados = array();
            $ModelServico = new ModelServico();
            
            $id = (int)$id;
            if ($id == 0) {

            echo  '<script>alert("Requisição Inválida !");history.back();</script>';
            
            }

            if ( $ModelServico->VerificaApontamento($id)) {
                    
                    echo '<script>alert("O serviço não pode ser excluido, esta com serviço em aberto !");history.back();</script>';

                    } else {
                            $situacao_Inativo = "Inativo";
                            if ($ModelServico->InativarApontamento($id, $situacao_Inativo)) {

                                    echo '<script>alert("Apontamento excluido com sucesso !");history.back();</script>';

                            } else {

                                   echo '<script>alert("Ocorreu algum um erro ao excluir o registro !");history.back();</script>';

                            }
                    }


        }

    }
       