<?php
class RelatorioController extends controller {

    public function Veiculo(){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelCliente = new ModelCliente();
        $situacao = "Ativo";

        $linha = $ModelCliente->GetLista($situacao);

        $dados['linha']= $linha;
        
        $this->loadTemplateAdmin('Admin/Relatorios/Veiculo/Veiculo', $dados);
    } 
    
    public function teste(){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        // para teste
        
        $this->loadTemplateAdmin('Admin/Relatorios/Apontamento/teste', $dados);
    }


    public function ProprietarioVeiculo(){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelRelatorio = new ModelRelatorio();
                

        $id = $tipo  = "";

        if ( isset ( $_POST["id"] ) ) {
            $id = trim ( $_POST["id"] ); 	
        }

        if ( empty ( $id ) ) {
            echo '<script>alert("Preencha o Campo Proprietário");history.back();</script>';
            
        }else {
            $situacao = "Ativo";

            if($Result = $ModelRelatorio->GerarRlPrVl($id,$situacao)) {

                if($Total = $ModelRelatorio->RlPrVlToTotaldeVeiculo($id,$situacao)) {

                    if($Proprietario = $ModelRelatorio->RlPrVlToProprietario($id,$situacao)) {

                        $dados['result']= $Result;
                        $dados['total']= $Total;
                        $dados['proprietario']= $Proprietario;
                        $this->loadTemplateAdmin('Admin/Relatorios/Veiculo/Exibir', $dados);
                        
                    }else {
    
                        echo '<script>alert("Ocorreu algum erro ao carregar a pagina !");history.back();</script>';
        
                    }

                }else {

                    echo '<script>alert("Ocorreu algum erro ao carregar a pagina !");history.back();</script>';
    
                }

               } else {

                echo '<script>alert("Não existe nenhum veiculo cadastrado!");history.back();</script>';

               }
        }
        
        
    }

    public function Manutencao(){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelVeiculo = new ModelVeiculo();
        $situacao = "Ativo";

        $linha = $ModelVeiculo->GetListaVeiculo($situacao);

        $dados['linha']= $linha;
        
        $this->loadTemplateAdmin('Admin/Relatorios/Manutencao/Manutencao', $dados);
    }

    public function ManutencaoVeiculo(){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelRelatorio = new ModelRelatorio();
                

        $id = $tipo  = "";

        if ( isset ( $_POST["id"] ) ) {
            $id = trim ( $_POST["id"] ); 	
        }
        if ( isset ( $_POST["dataInicio"] ) ) {
            $dataInicio = trim ( $_POST["dataInicio"] ); 	
        } 
        if ( isset ( $_POST["dataFinal"] ) ) {
            $dataFinal = trim ( $_POST["dataFinal"] ); 	
        }

            //DEFININDO VALOR PARA O PARAMETRO
            $ResultValidaDataInicio = 1;
            $ResultValidaDataFinal = 1;
            $ValidaDataInicioFinal = 1;
            $VerificarDataInicioFinal = 1;

            $ResultValidaDataInicio = $this->ValidaDataInicio($dataInicio);

            $ResultValidaDataFinal = $this->ValidaDataFinal($dataFinal);

            $dataInicio = $this->FormataDataInicio($dataInicio);
            $dataFinal = $this->FormataDataFinal($dataFinal);

            $ValidaDataInicioFinal = $this->ValidaDataInicioFinal($dataInicio,$dataFinal);
            $VerificarDataInicioFinal = $this->VerificarDataInicioFinal($dataInicio,$dataFinal);

        if ( empty ( $id ) ) {
            echo '<script>alert("Preencha o Campo Veiculo");history.back();</script>';
            exit;
        }else if (empty($dataInicio) && !empty($dataFinal) ) {
        
            echo '<script>alert("Preencha o Campo Data Inicio !");history.back();</script>';
            exit;
        }else if ($ResultValidaDataInicio != 1) {
        
            echo "<script>alert('$ResultValidaDataInicio');history.back();</script>";
            exit;
        }else if ($ResultValidaDataFinal != 1) {
        
            echo "<script>alert('$ResultValidaDataFinal');history.back();</script>";
            exit;
        }else if ($ValidaDataInicioFinal != 1) {
        
            echo "<script>alert('$ValidaDataInicioFinal');history.back();</script>";
            exit;
        }else if ($VerificarDataInicioFinal != 1) {
        
            echo "<script>alert('$VerificarDataInicioFinal');history.back();</script>";
            exit;
        }else {
           

            $situacao = "Ativo";

            if ( ( empty($dataInicio) ) && ( empty($dataFinal) ) ) {

                if($Result = $ModelRelatorio->RlManutencao($id,$situacao)) {
                    $dadosveiculo = $ModelRelatorio->RlManutencaoVeiculo($id,$situacao);
                    $total = $ModelRelatorio->RlManutencaoVeiculoTotal($id,$situacao);

                    $dados['dadosveiculo']= $dadosveiculo;
                    $dados['result']= $Result;
                    $dados['total']= $total;
                    $this->loadTemplateAdmin('Admin/Relatorios/Manutencao/Exibir', $dados);
                    
                }else {

                    echo '<script>alert("Não existe nenhuma manutenção neste veiculo !");history.back();</script>';
                    exit;
                }

            } else if ( ( !empty($dataInicio) ) && ( !empty($dataFinal) ) ) {

                if($Result = $ModelRelatorio->RlManutencaoDataInicioFinal($id,$dataInicio,$dataFinal,$situacao)) {
                    $dadosveiculo = $ModelRelatorio->RlManutencaoVeiculo($id,$situacao);
                    $total = $ModelRelatorio->RlManutencaoVeiculoTotal($id,$situacao);

                    $dados['dadosveiculo']= $dadosveiculo;
                    $dados['result']= $Result;
                    $dados['total']= $total;
                    $this->loadTemplateAdmin('Admin/Relatorios/Manutencao/Exibir', $dados);
                    
                }else {

                    echo '<script>alert("Não existe nenhuma manutenção neste veiculo entre as datas informadas!");history.back();</script>';
                    exit;
                }

            } else if ( !empty ($dataInicio)) {
                date_default_timezone_set('America/Sao_Paulo');
                $dataAtual = date('Y-m-d');

                if($Result = $ModelRelatorio->RlManutencaoDataInicioAtual($id,$dataInicio,$dataAtual,$situacao)) {
                    $dadosveiculo = $ModelRelatorio->RlManutencaoVeiculo($id,$situacao);
                    $total = $ModelRelatorio->RlManutencaoVeiculoTotal($id,$situacao);

                    $dados['dadosveiculo']= $dadosveiculo;
                    $dados['result']= $Result;
                    $dados['total']= $total;
                    $this->loadTemplateAdmin('Admin/Relatorios/Manutencao/Exibir', $dados);
                    
                }else {

                    echo '<script>alert("Não existe nenhuma manutenção neste veiculo entre as datas informadas!");history.back();</script>';
                    exit;
                }

            } else {
                echo '<script>alert("Ocorreu algum erro ao buscar os dados !");history.back();</script>';
                exit;
            }
            
        }
        
        
    }

    public function Colaborador(){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelVeiculo = new ModelVeiculo();

        
        $this->loadTemplateAdmin('Admin/Relatorios/Colaborador/Colaborador', $dados);
    }

    public function ColaboradorDados(){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelRelatorio = new ModelRelatorio();
                

        $ativo  = "";

        if ( isset ( $_POST["ativo"] ) ) {
            $ativo = trim ( $_POST["ativo"] ); 	
        }

        if ( empty ( $ativo ) ) {
            echo '<script>alert("Preencha o Campo Ativo");history.back();</script>';
            
        }else {
           

            $situacao = "Ativo";
            $ativoSim = "Sim";
            $ativoNao = "Não";

            if ( $ativo == "Sim" ) {

                if($Result = $ModelRelatorio->RlColaborador($ativo,$situacao)) {
                    $total = $ModelRelatorio->RlColaboradorTotal($situacao);
                    $totalAtivoSim = $ModelRelatorio->RlColaboradorTotalAtivoSim($ativoSim,$situacao);
                    $totalAtivoNao = $ModelRelatorio->RlColaboradorTotalAtivoNao($ativoNao,$situacao);
                
                    $dados['result']= $Result;
                    $dados['total']= $total;
                    $dados['totalAtivoSim']= $totalAtivoSim;
                    $dados['totalAtivoNao']= $totalAtivoNao;
                    $this->loadTemplateAdmin('Admin/Relatorios/Colaborador/Exibir', $dados);
                    
                } else {

                    echo '<script>alert("Não existe nenhuma colaborador !");</script>';
    
                }

            } else if ( $ativo == "Não" ) {

                

                if($Result = $ModelRelatorio->RlColaborador($ativo,$situacao)) {
                    $total = $ModelRelatorio->RlColaboradorTotal($situacao);
                    $totalAtivoSim = $ModelRelatorio->RlColaboradorTotalAtivoSim($ativoSim,$situacao);
                    $totalAtivoNao = $ModelRelatorio->RlColaboradorTotalAtivoNao($ativoNao,$situacao);
                
                    $dados['result']= $Result;
                    $dados['total']= $total;
                    $dados['totalAtivoSim']= $totalAtivoSim;
                    $dados['totalAtivoNao']= $totalAtivoNao;
                    $this->loadTemplateAdmin('Admin/Relatorios/Colaborador/Exibir', $dados);
                    
                } else {

                    echo '<script>alert("Não existe nenhuma colaborador !");</script>';
    
                }
    
            

            } else if ( $ativo == "Todos" ) {
                
                if($Result = $ModelRelatorio->RlColaboradorTodos($situacao)) {
                    $total = $ModelRelatorio->RlColaboradorTotal($situacao);
                    $totalAtivoSim = $ModelRelatorio->RlColaboradorTotalAtivoSim($ativoSim,$situacao);
                    $totalAtivoNao = $ModelRelatorio->RlColaboradorTotalAtivoNao($ativoNao,$situacao);
                
                    $dados['result']= $Result;
                    $dados['total']= $total;
                    $dados['totalAtivoSim']= $totalAtivoSim;
                    $dados['totalAtivoNao']= $totalAtivoNao;
                    $this->loadTemplateAdmin('Admin/Relatorios/Colaborador/Exibir', $dados);
                    
                } else {

                    echo '<script>alert("Não existe nenhuma colaborador !");</script>';
    
                }
    
            } else {
                echo '<script>alert("Ocorreu algum erro ao buscar os dados !");</script>';
            }
            
        }
        
        
    }

    public function Producao(){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelServico = new ModelServico();
            $situacao = "Ativo";
            $ativo = "Sim";
            $cargo = "Mecânico";
            if ($ResultDadosCol = $ModelServico->GetListaColaborador($situacao,$cargo,$ativo)){     
                $dados['ResultDadosCol']= $ResultDadosCol;
                $this->loadTemplateAdmin('Admin/Relatorios/Producao/Producao', $dados);
            }else {
                echo '<script>alert("Não exite nenhum mecanico cadastrado !");</script>';
            }
    }

    public function ProducaoIndividual(){

        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelRelatorio = new ModelRelatorio();
                

        $id = $totaldias = $horasdiaria = "";
        if ( isset ( $_POST["id"] ) ) {  
            
            if ( isset ( $_POST["id"] ) ) {    
                $id = trim ( $_POST["id"] ); 
            } 
            if ( isset ( $_POST["tipo"] ) ) {
    
                $tipo = trim ( $_POST["tipo"] ); 	
            }
            if ( isset ( $_POST["totaldias"] ) ) {
    
                $totaldias = trim ( $_POST["totaldias"] ); 	
            }
            if ( isset ( $_POST["horasdiaria"] ) ) {
    
                $horasdiaria = trim ( $_POST["horasdiaria"] ); 	
    
            }if ( isset ( $_POST["dataInicio"] ) ) {
    
                $dataInicio = trim ( $_POST["dataInicio"] ); 	
    
            }if ( isset ( $_POST["dataFinal"] ) ) {
    
                $dataFinal = trim ( $_POST["dataFinal"] ); 	
    
            }
    
    
            if ( empty ( $id ) ) {
                echo '<script>alert("Preencha o Campo Colaborador");history.back();</script>';
                
            }else if ( empty ( $horasdiaria ) ) {
                echo '<script>alert("Preencha o Campo Horas de Produção");history.back();</script>';
                
            }else if ( empty ( $totaldias ) ) {
                echo '<script>alert("Preencha o Campo Dias de Produção");history.back();</script>';
                
            }else if ($totaldias > 32) {
                echo '<script>alert("Dias trabalhados não pode ser maior que 31 dias");history.back();</script>';
                
            }else if ($totaldias < 1) {
                echo '<script>alert("Dias trabalhados não pode ser menor que 1 dia");history.back();</script>';
                
            }else if (empty($dataInicio)) {
                echo '<script>alert("Preencha o Campo Data de Inicio !");history.back();</script>';
                
            }else if (empty($dataFinal)) {
                echo '<script>alert("Preencha o Campo Data Final !");history.back();</script>';
                
            }else {
    
                 //DEFININDO VALOR PARA O PARAMETRO
                 $ResultValidaDataFinal = 1;
     
                 $ResultValidaDataInicio = $this->ValidaDataInicio($dataInicio);
     
                 $ResultValidaDataFinal = $this->ValidaDataFinal($dataFinal);
                 
                 $dados['dataInicio']= $dataInicio;
                 $dados['dataFinal']= $dataFinal;

                 $dataInicio = $this->FormataDataInicio($dataInicio);
                 $dataFinal = $this->FormataDataFinal($dataFinal);
     
                 $ValidaDataInicioFinal = $this->ValidaDataInicioFinal($dataInicio,$dataFinal);
                 $VerificarDataInicioFinal = $this->VerificarDataInicioFinal($dataInicio,$dataFinal);
               
                if ($ResultValidaDataInicio != 1) {
            
                    echo "<script>alert('$ResultValidaDataInicio');history.back();</script>";
        
                }else if ($ResultValidaDataFinal != 1) {
                
                    echo "<script>alert('$ResultValidaDataFinal');history.back();</script>";
        
                }else if ($ValidaDataInicioFinal != 1) {
                
                    echo "<script>alert('$ValidaDataInicioFinal');history.back();</script>";
        
                }else if ($VerificarDataInicioFinal != 1) {
                
                    echo "<script>alert('$VerificarDataInicioFinal');history.back();</script>";
        
                } else {
    
                    $situacao = "Ativo";
                    $ativo = "Sim";
                    date_default_timezone_set('America/Sao_Paulo');
                    $dataAtual = date('Y-m-d');
    
                    if (!empty($dataInicio) && !empty($dataFinal)) {
                        if($Result = $ModelRelatorio->RlProducaoIndividual($id,$dataInicio,$dataFinal,$situacao)) {
                            $Resultdados = $ModelRelatorio->RlListProducaoIndividual($id,$dataInicio,$dataFinal,$situacao);
                            $dadosCol = $ModelRelatorio->RlColProducao($id,$situacao);
    
                            $ResultDias = 0;
                            $ResultHora = 0;
                            $ResultMinuto = 0;
                            $ResultSegundo = 0;
    
                            for ($i=0; $i < count($Result); $i++): 
                                foreach ($Result as $list): 
    
    
                                    $data1 = $list['dataAbertura'].' '.$list['horaAbertura'];
                                    $data2 = $list['dataFechamento'].' '.$list['horaFechamento'];
    
                                    $data1 = new DateTime($data1);
                                    $data2 = new DateTime($data2);
    
                                    $resultdados = $data1->diff($data2)->format("%d-%h-%i-%s");
    
    
    
                                        $resultdados = explode("-",$resultdados);
    
                                        $dias = $resultdados[0];
                                        $hora = $resultdados[1];
                                        $minuto = $resultdados[2];
                                        $segundo = $resultdados[3];
    
                                        $ResultDias += $dias;
                                        $ResultHora += $hora;
                                        $ResultMinuto += $minuto;
                                        $ResultSegundo +=  $segundo;
    
    
    
                                endforeach;
                                break; 
                            endfor;
                            

                            //Formatando o segundo maior que 60, passando o restante para minuto
                            if ($ResultSegundo > 60) {
    
                                $ResultSegundo = round($ResultSegundo / 60, 2);
    
                                $ResultSegundo = explode(".",$ResultSegundo);
            
                                $ResultMinuto += $ResultSegundo[0];

                                if (!empty($ResultSegundo[1])) {

                                    $ResultSegundo = $ResultSegundo[1];

                                } else {
                                    $ResultSegundo = 00;
                                }
            
                            }
    
                            //Formatando o minuto maior que 60, passando o restante para hora
                            if ($ResultMinuto > 60) {
                                $ResultMinuto = number_format($ResultMinuto / 60, 2, ',', ' ');
                                $ResultMinuto = explode(",",$ResultMinuto);
                                
                                $ResultHora += $ResultMinuto[0];

                                if (!empty($ResultMinuto[1])) {

                                    $ResultMinuto = $ResultMinuto[1];

                                } else {
                                    $ResultMinuto = 00;
                                }

                            }
                            
                            //Formatando horas por dia
                            if ($ResultHora > 24) {
                                $RDias = floor($ResultHora / 24);
                                $ResultHora =  $ResultHora - 24 * $RDias;
                                $ResultDias += $RDias;
                            }
    
                            $dados['ResultHora']= $ResultHora;
                            
                            // Multiplicando pra transformar em horas 24
                            $DiasEmHoras = $ResultDias * 24;
                            
                            $DiasEmHoras += $ResultHora ; 
                            
                            if ($ResultMinuto > 30) {
                                $DiasEmHoras += 1;
                            }
                            
                            $totalhoraespedas = $totaldias * $horasdiaria;
    
                            $horasprodutivas = $DiasEmHoras; 
                            $horasinprodutiva = $totalhoraespedas - $DiasEmHoras;
                        
                            $porcentagemprodutivas =  number_format($horasprodutivas * 100 / $totalhoraespedas, 2, ',', ' ');
                            
                            $porcentageminprodutiva = number_format($horasinprodutiva * 100 / $totalhoraespedas, 2, ',', ' ');
                        
                            $dados['dadosCol']= $dadosCol;
                            $dados['result']= $Resultdados;
                            $dados['totaldias']= $totaldias;
                            $dados['totalhoraespedas']= $totalhoraespedas;
                            $dados['horasdiaria']= $horasdiaria;
    
                            $dados['horasprodutivas']= $horasprodutivas;
                            $dados['horasinprodutiva']= $horasinprodutiva;
                            
                            $dados['porcentagemprodutivas']= $porcentagemprodutivas;
                            $dados['porcentageminprodutiva']= $porcentageminprodutiva;
    
                            $dados['ResultDias']= $ResultDias;
                            $dados['ResultHora']= $ResultHora;
                            $dados['ResultMinuto']= $ResultMinuto;
                            $dados['ResultSegundo']= $ResultSegundo;
    
                            
                        
                            $this->loadTemplateAdmin('Admin/Relatorios/Producao/ExibirIndividual', $dados);
                            
                        } else {
                            $dadosCol = $ModelRelatorio->RlColProducao($id,$situacao);

                            $ResultDias = 0;
                            $ResultHora = 0;
                            $ResultMinuto = 0;
                            $ResultSegundo =  0;
    
                            $totalhoraespedas = $totaldias * $horasdiaria;
    
                            $horasprodutivas = $ResultHora; 
                            $horasinprodutiva = $totalhoraespedas - $ResultHora;
                        
                            $porcentagemprodutivas =  number_format($horasprodutivas * 100 / $totalhoraespedas, 2, ',', ' ');
                            
                            $porcentageminprodutiva = number_format($horasinprodutiva * 100 / $totalhoraespedas, 2, ',', ' ');
                        
                            $dados['dadosCol']= $dadosCol;
                            $dados['totaldias']= $totaldias;
                            $dados['totalhoraespedas']= $totalhoraespedas;
                            $dados['horasdiaria']= $horasdiaria;
    
                            $dados['horasprodutivas']= $horasprodutivas;
                            $dados['horasinprodutiva']= $horasinprodutiva;
                            
                            $dados['porcentagemprodutivas']= $porcentagemprodutivas;
                            $dados['porcentageminprodutiva']= $porcentageminprodutiva;
    
                            $dados['ResultDias']= $ResultDias;
                            $dados['ResultHora']= $ResultHora;
                            $dados['ResultMinuto']= $ResultMinuto;
                            $dados['ResultSegundo']= $ResultSegundo;
                            $this->loadTemplateAdmin('Admin/Relatorios/Producao/ExibirIndividual', $dados);
                        }
                    } else {
                        echo '<script>alert("Erro !");history.back()</script>';
                        exit;
                    }
                }
            }  
          
        } else {
            echo '<script>alert("Erro !");history.back()</script>';
            exit;
        }
          
    }

    public function RlProducaoCalcularHorario($dataAbertura,$horaAbertura,$dataFechamento,$horaFechamento) {
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);

            $dataAbertura = explode("/",$dataAbertura);
            $dataAbertura =  $dataAbertura[2]."-".$dataAbertura[1]."-".$dataAbertura[0];

            $dataFechamento = explode("/",$dataFechamento);
            $dataFechamento =  $dataFechamento[2]."-".$dataFechamento[1]."-".$dataFechamento[0];
        
            $dataInicio = $dataAbertura.' '.$horaAbertura;
            $dataFinal = $dataFechamento.' '.$horaFechamento;

            $dataInicio = new DateTime($dataInicio);
            $dataFinal = new DateTime($dataFinal);

            $resultdados = $dataInicio->diff($dataFinal)->format("%d-%h-%i-%s");

                $resultdados = explode("-",$resultdados);

                $dias = $resultdados[0];
                $hora = $resultdados[1];
                $minuto = $resultdados[2];
                $segundo = $resultdados[3];

                $ResultHora = $dias * 24;
                    
                $hora += $ResultHora ; 

                return "Horas: ".$hora." Minutos: ". $minuto." Segundos: ". $segundo;
        
    
    }

    public function ProducaoGeral(){

        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        $dados = array();
        $ModelRelatorio = new ModelRelatorio();
                

        $id = $totaldias = $horasdiaria = "";
        if ( isset ( $_POST["dataInicio"] ) && isset ( $_POST["dataFinal"] ) ) {  
            
            if ( isset ( $_POST["totaldias"] ) ) {
    
                $totaldias = trim ( $_POST["totaldias"] ); 	
            }if ( isset ( $_POST["horasdiaria"] ) ) {
    
                $horasdiaria = trim ( $_POST["horasdiaria"] ); 	
    
            }if ( isset ( $_POST["dataInicio"] ) ) {
    
                $dataInicio = trim ( $_POST["dataInicio"] ); 	
    
            }if ( isset ( $_POST["dataFinal"] ) ) {
    
                $dataFinal = trim ( $_POST["dataFinal"] ); 	
    
            }
    
    
            if ( empty ( $horasdiaria ) ) {
                echo '<script>alert("Preencha o Campo Horas de Produção");history.back();</script>';
                
            }else if ( empty ( $totaldias ) ) {
                echo '<script>alert("Preencha o Campo Dias de Produção");history.back();</script>';
                
            }else if ($totaldias > 32) {
                echo '<script>alert("Dias trabalhados não pode ser maior que 31 dias");history.back();</script>';
                
            }else if ($totaldias < 1) {
                echo '<script>alert("Dias trabalhados não pode ser menor que 1 dia");history.back();</script>';
                
            }else if (empty($dataInicio)) {
                echo '<script>alert("Preencha o Campo Data de Inicio !");history.back();</script>';
                
            }else if (empty($dataFinal)) {
                echo '<script>alert("Preencha o Campo Data Final !");history.back();</script>';
                
            }else {
    
                 //DEFININDO VALOR PARA O PARAMETRO
                 $ResultValidaDataFinal = 1;
     
                 $ResultValidaDataInicio = $this->ValidaDataInicio($dataInicio);
     
                 $ResultValidaDataFinal = $this->ValidaDataFinal($dataFinal);

                 $dados['dataInicio']= $dataInicio;
                 $dados['dataFinal']= $dataFinal;

                 $dataInicio = $this->FormataDataInicio($dataInicio);
                 $dataFinal = $this->FormataDataFinal($dataFinal);
     
                 $ValidaDataInicioFinal = $this->ValidaDataInicioFinal($dataInicio,$dataFinal);
                 $VerificarDataInicioFinal = $this->VerificarDataInicioFinal($dataInicio,$dataFinal);
               
                if ($ResultValidaDataInicio != 1) {
            
                    echo "<script>alert('$ResultValidaDataInicio');history.back();</script>";
        
                }else if ($ResultValidaDataFinal != 1) {
                
                    echo "<script>alert('$ResultValidaDataFinal');history.back();</script>";
        
                }else if ($ValidaDataInicioFinal != 1) {
                
                    echo "<script>alert('$ValidaDataInicioFinal');history.back();</script>";
        
                }else if ($VerificarDataInicioFinal != 1) {
                
                    echo "<script>alert('$VerificarDataInicioFinal');history.back();</script>";
        
                } else {
    
                    $situacao = "Ativo";
                    $ativo = "Sim";
                    $cargo = "Mecânico";

                    date_default_timezone_set('America/Sao_Paulo');
                    $dataAtual = date('Y-m-d');

                    if (!empty($dataInicio) && !empty($dataFinal)) {
                        if( $dadosCol = $ModelRelatorio->RlProducaoGeralCol($cargo,$situacao,$ativo)) {
                  
                            $totalhoraespedas = $totaldias * $horasdiaria;
                            $valores = array();
                            
                            for ($i=0; $i < count($dadosCol) ; $i++) { 
                                foreach ($dadosCol as $listCol) {

                                    $id = $listCol['id_col'];
                                    $Result = $ModelRelatorio->RlProducaoGeral($id,$dataInicio,$dataFinal,$situacao);
                                    $ResultDias = 0;
                                    $ResultHora = 0;
                                    $ResultMinuto = 0;
                                    $ResultSegundo = 0;

                                    if (empty ($Result)) {
                                        
                                        $nome = $listCol['nome'];
                                        $matricula = $listCol['matricula'];

                                        $valores[] = $array = array('id' => $id, 'nome' => $nome, 'matricula' => $matricula, 'dias' => $ResultDias, 'horas' => $ResultHora, 'minutos' => $ResultMinuto, 'segundos' => $ResultSegundo);

                                    }else {

                                        foreach ($Result as $list) {

                                            if ($id == $list['id_col']){ 
                                                $data1 = $list['dataAbertura'];
                                                $data2 = $list['dataFechamento'];
                                                $id = $listCol['id_col'];
                                                $nome = $list['nome'];
                                                $matricula = $list['matricula']; 
    
                                                $data1 = explode("/",$data1);
                                                $data1 =  $data1[2]."-".$data1[1]."-".$data1[0];
                                                
                                                $data2 = explode("/",$data2);
                                                $data2 =  $data2[2]."-".$data2[1]."-".$data2[0];
                                                
                                                $data1 = $data1.' '.$list['horaAbertura'];
                                                $data2 = $data2.' '.$list['horaFechamento'];
    
                                                $data1 = new DateTime($data1);
                                                $data2 = new DateTime($data2);
                
                                                $resultdados = $data1->diff($data2)->format("%d-%h-%i-%s");
                
                                                    $resultdados = explode("-",$resultdados);
                
                                                    $dias = $resultdados[0];
                                                    $hora = $resultdados[1];
                                                    $minuto = $resultdados[2];
                                                    $segundo = $resultdados[3];
                
                                                    $ResultDias += $dias;
                                                    $ResultHora += $hora;
                                                    $ResultMinuto += $minuto;
                                                    $ResultSegundo +=  $segundo;
                                
                                            }
                                        
                                        }
                                        
                                        $valores[] = $array = array('id' => $id, 'nome' => $nome, 'matricula' => $matricula, 'dias' => $ResultDias, 'horas' => $ResultHora, 'minutos' => $ResultMinuto, 'segundos' => $ResultSegundo);
                                    
                                        
                                    }

                                   
                                }

                                break;
                            }
                                
                            $listvalores = array();

                            foreach ($valores as $list) {
                                $nome = $list['nome'];
                                $id = $list['id'];
                                $matricula = $list['matricula'];

                                $ResultDias = $list['dias'];
                                $ResultHora = $list['horas'];
                                $ResultMinuto = $list['minutos'];
                                $ResultSegundo = $list['segundos'];

                                //Formatando o segundo maior que 60, passando o restante para minuto
                                if ($ResultSegundo > 60) {
                                    
                                    $ResultSegundo = round($ResultSegundo / 60, 2);
                                    $ResultSegundo = explode(".",$ResultSegundo);
                                    $ResultMinuto += $ResultSegundo[0];

                                        if (!empty($ResultSegundo[1])) {

                                            $ResultSegundo = $ResultSegundo[1];

                                        } else {
                                            $ResultSegundo = 00;
                                        }
                                    }


                                //Formatando o minuto maior que 60, passando o restante para hora
                                if ($ResultMinuto > 60) {
                                    $ResultMinuto = number_format($ResultMinuto / 60, 2, ',', ' ');
                                    $ResultMinuto = explode(",",$ResultMinuto);
                                    
                                    $ResultHora += $ResultMinuto[0];

                                    if (!empty($ResultMinuto[1])) {

                                        $ResultMinuto = $ResultMinuto[1];

                                    } else {
                                        $ResultMinuto = 00;
                                    }
                                }

                                //Formatando horas por dia
                                if ($ResultHora > 24) {
                                    $RDias = floor($ResultHora / 24);
                                    $ResultHora =  $ResultHora - 24 * $RDias;
                                    $ResultDias += $RDias;
                                }

                                // Multiplicando pra transformar em horas 24
                                $DiasEmHoras = $ResultDias * 24;

                                $DiasEmHoras += $ResultHora ; 

                                if ($ResultMinuto > 30) {
                                    $DiasEmHoras += 1;
                                }

                                $totalhoraespedas = $totaldias * $horasdiaria;

                                $horasprodutivas = $DiasEmHoras; 
                                $horasimprodutiva = $totalhoraespedas - $DiasEmHoras;

                                $porcentagemprodutivas =  number_format($horasprodutivas * 100 / $totalhoraespedas, 2, ',', ' ');

                                $porcentagemimprodutivas = number_format($horasimprodutiva * 100 / $totalhoraespedas, 2, ',', ' ');


                                $listvalores[] = $array = array('id' => $id, 'nome' => $nome, 'matricula' => $matricula, 'horasprodutivas' => $horasprodutivas, 'horasimprodutiva' => $horasimprodutiva, 'porcentagemimprodutivas' => $porcentagemimprodutivas, 'porcentagemprodutivas' => $porcentagemprodutivas);

                            }
                            

                            $dados['totaldias']= $totaldias;
                            $dados['totalhoraespedas']= $totalhoraespedas;
                            $dados['horasdiaria']= $horasdiaria;

                            $dados['result']= $listvalores;

                          $this->loadTemplateAdmin('Admin/Relatorios/Producao/ExibirGeral', $dados);
                            
                        } else {
    
                            echo '<script>alert("Não existe nenhuma apontamento !");history.back()</script>';
                            exit;
                        }
                    } else {
                        echo '<script>alert("Erro !");history.back()</script>';
                        exit;
                    }
                }
            }  
          
        } else {
            echo '<script>alert("Erro !");history.back()</script>';
            exit;
        }
          
    }

    public function FormataDataInicio($dataInicio) {
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        if ( !empty ($dataInicio) ) {

            $dataInicio = explode("/",$dataInicio);
            return $dataInicio[2]."-".$dataInicio[1]."-".$dataInicio[0];

        } else {
            return $dataInicio;
        }
        
    }

    public function FormataDataFinal($dataFinal) {
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        if ( !empty ($dataFinal) ) {

            $dataFinal = explode("/",$dataFinal);
            return $dataFinal[2]."-".$dataFinal[1]."-".$dataFinal[0];

        } else {
            return $dataFinal;
        }
        
    }  
    
    public function ValidaDataInicio($dataInicio){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        
        if ( !empty ($dataInicio)) {
            $dataInicio = explode('/', $dataInicio);
            $checkdate = $dataInicio;

            if ( count ($dataInicio) == 3) {

                    $dataInicio = implode ($dataInicio);
                    $dataInicio = strlen ($dataInicio);
                    
                    if ($dataInicio <= 7) {
                        return "Data inicio invalida !";

                    }  else {
                        $d = $checkdate[0];
                        $m = $checkdate[1];
                        $y = $checkdate[2];
                    
                        $res = checkdate($m,$d,$y);

                        if ($res == 1){
                            
                            return true;

                        } else {

                            return "Data inicio inválida !";
                        }
                    }

            } else {
                return "Formato da data inicio inválido !";
            }
        } else {
            return true;
        }
    }

    public function ValidaDataFinal($dataFinal){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        
        if ( !empty ($dataFinal)) {
            $dataFinal = explode('/', $dataFinal);
            $checkdate = $dataFinal;

            if ( count ($dataFinal) == 3) {

                    $dataFinal = implode ($dataFinal);
                    $dataFinal = strlen ($dataFinal);
                    
                    if ($dataFinal <= 7) {
                        return "Data final invalida !";

                    }  else {
                        $d = $checkdate[0];
                        $m = $checkdate[1];
                        $y = $checkdate[2];
                    
                        $res = checkdate($m,$d,$y);

                        if ($res == 1){
                        
                            return true;

                        } else {

                            return "Data final inválida !";
                        }
                    }

            } else {
                return "Formato da data final inválido !";
            }
        } else {
            return true;
        }
    }

    public function ValidaDataInicioFinal($dataInicio,$dataFinal){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        
        if ( !empty ($dataInicio)) {
           
            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = date('Y-m-d');
                    
                if ($dataInicio > $dataAtual) {

                    return "Data inicio invalida, maior qua data atual !";

                }  else if (!empty ($dataInicio)) {

                    if ($dataFinal > $dataAtual) {

                        return "Data final invalida, maior qua data atual !";

                        } else {
                            return true;
                        }

                } else {
                    return true;
                }

        } else {
            return true;
        }
    }

    public function VerificarDataInicioFinal($dataInicio,$dataFinal){
        $this->VerificarLogin(); 
        $this->VerificarNivel(2);
        
        if ( ( !empty ($dataInicio) ) && ( !empty ($dataFinal) ) ) {
           
            if ($dataInicio > $dataFinal) {

                return "Data inicio maior qua data final !";

            }  else if ($dataFinal < $dataInicio) {

                return "Data final menor qua data inicio !";

            } else {
                return true;
            }

        } else {
            return true;
        }
    }

    
}