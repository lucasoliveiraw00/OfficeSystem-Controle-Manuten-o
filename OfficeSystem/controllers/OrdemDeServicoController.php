<?php
class OrdemDeServicoController extends controller {


        public function Index() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2); 
                $dados = array();
                $OrdemDeServico = new ModelOrdemDeServico();

                $totalOrdemAberta = $OrdemDeServico->GetTotalOrdemAberta();
                $totalOrdemFechada = $OrdemDeServico->GetTotalOrdemFechada();
              
                
                $dados['totalOrdemAberta'] = $totalOrdemAberta ['resultOrdemAberta'];
                $dados['totalOrdemFechada'] = $totalOrdemFechada ['resultOrdemFechada'];

            $this->loadTemplateAdmin('Admin/OrdemDeServico/Listar', $dados);
        }

	    public function Abrir() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelOrdemDeServico = new ModelOrdemDeServico();
                $situacao = "Ativo";
                $getNumeroOS = $ModelOrdemDeServico->GetNumeroOS();
                $cont = $getNumeroOS['numero_os'];
                $cont = $cont + 1;
               
                $linha = $ModelOrdemDeServico->GetProprietario($situacao);

                $dados['linha']= $linha;

                $dados['cont'] = $cont;
             

                $this->loadTemplateAdmin('Admin/OrdemDeServico/Abrir', $dados);
        }

        public function Prazo($status_prazo) {
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dados = array();
            $ModelOrdemDeServico = new ModelOrdemDeServico();
            $situacao = "Ativo";
            $status = "Aberto";

                if ($ResultDados = $ModelOrdemDeServico->DadosOrdemStatusPrazo($status_prazo,$status,$situacao)) {
                    $dados['Dados'] = $ResultDados;
                    $this->loadTemplateAdmin('Admin/OrdemDeServico/ExibirPrazo', $dados);
                }else {
                    echo '<script>alert("Não existe nenhuma ordem de serviço!");history.back();</script>';
                }

        }


         public function Editar($id) {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $OrdemDeServico = new ModelOrdemDeServico();

                $situacao = "Ativo";

                if (!empty ($id)) {

                    if ($ResultDados = $OrdemDeServico->GetDadosOrdem($id,$situacao)){

                        $resultprazo = $ResultDados->prazo;

                            $resultprazo = explode(" ",$resultprazo);

                            $dataprazo = $resultprazo[0];
                            $horaprazo = $resultprazo[1];
                            $dataprazo = explode("-",$dataprazo);
                            $dataprazo = $dataprazo[2].'/'.$dataprazo[1].'/'.$dataprazo[0];


                        if ($ResultDados->status == "Aberto") {
                            $dados['ResultDados'] = $ResultDados;

                            $DadosCliente = $OrdemDeServico->GetProprietario($situacao);

                            $dados['dataprazo']= $dataprazo;
                            $dados['horaprazo']= $horaprazo;
                            $dados['DadosCliente']= $DadosCliente;
                           $this->loadTemplateAdmin('Admin/OrdemDeServico/Editar', $dados);
                        }else {
                            $dados['dataprazo']= $dataprazo;
                            $dados['horaprazo']= $horaprazo;
                            $dados['ResultDados'] = $ResultDados;
                            $this->loadTemplateAdmin('Admin/OrdemDeServico/EditarOsFechada', $dados);
                        }
                    } else {

                        echo '<script>alert("Erro ao carregar os dados !");history.back();</script>';
                        
                    }

                }else {
                        echo '<script>alert("Erro ao carregar a pagina !");history.back();</script>';
                }
                
        }


        public function Adicionar() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelOrdemDeServico = new ModelOrdemDeServico();


                 $id_colaborador = $id_veiculo = $numero_os = $dataAbertura = $horaAbertura = $dataPrazo = $horaPrazo = $descricao = $status = $situacao  = "";

                if ( isset ( $_POST["id_colaborador"] ) ) {
                        $id_colaborador = trim ( $_POST["id_colaborador"] ); 	
                }
                if ( isset ( $_POST["id_veiculo"] ) ) {
                        $id_veiculo = trim ( $_POST["id_veiculo"] ); 	
                }
                if ( isset ( $_POST["numero_os"] ) ) {
                        $numero_os = trim ( $_POST["numero_os"] ); 	
                }
                if ( isset ( $_POST["dataPrazo"] ) ) {
                    $dataPrazo = trim ( $_POST["dataPrazo"] ); 	
                }
                if ( isset ( $_POST["horaPrazo"] ) ) {
                    $horaPrazo = trim ( $_POST["horaPrazo"] ); 	
                }
                if ( isset ( $_POST["descricao"] ) ) {
                        $descricao = trim ( $_POST["descricao"] ); 	
                }
                    

                if ( empty ( $id_colaborador ) ) {
                    echo '<script>alert("Preencha o Campo SOLICITANTE");history.back();</script>';
                        
                }else if ( empty ( $id_veiculo ) ) {
                    echo '<script>alert("Selecionar os dados do VEICULO");history.back();</script>';
                        
                }else if ( empty ( $numero_os ) ) {
                    echo '<script>alert("NUMERO DA ORDEM DE SERVIÇO EM BRANCO");history.back();</script>';
                        
                }else if ( empty ( $dataPrazo ) ) {
                    echo '<script>alert("Preencha o Campo Data");history.back();</script>';
                        
                }else if ( empty ( $horaPrazo ) ) {
                    echo '<script>alert("Preencha o Campo Hora");history.back();</script>';
                        
                }else if ($dataPrazo == "0") {
                    echo '<script>alert("Data inválida");history.back();</script>';
                    
                }else if ($horaPrazo === "0") {
                    echo '<script>alert("Hora  inválida");history.back();</script>';
    
                }else if ( empty ( $descricao ) ) {
                    echo '<script>alert("Preencha o Campo DESCRIÇÃO");history.back();</script>';
                        
                }else {
                        //PASSANDO O PARAMENTRO DATA PARA FUNÇÃO VALIDA DATA 
                        $ResultValidaDataPrazo = $this->ValidaDataPrazo($dataPrazo);
                        $ResultValidaHoraPrazo = $this->ValidaHoraPrazo($horaPrazo);

                        date_default_timezone_set('America/Sao_Paulo');
                        $dataAbertura = date('Y-m-d');
                        $horaAbertura = date('H:i:s');
                        $status = "Aberto";
                        $situacao = "Ativo";

                        if ($ResultValidaDataPrazo != 1) {
        
                                echo "<script>alert('$ResultValidaDataPrazo');history.back();</script>";
                                exit;
                        } else if ( $ResultValidaHoraPrazo != 1 ) {
                                   
                                echo "<script>alert('$ResultValidaHoraPrazo');history.back();</script>";
                                exit;
                        } else{

                            //PASSANDO O PARAMENTRO DATA ABERTURA PARA FUNÇÃO FORMATA DATA DE ABERTURA
                            $dataPrazo = $this->FormataData($dataPrazo);
                            $status_prazo = "Normal";

                            $ResultVerificarHoraDataPrazo = $this->VerificarHoraDataPrazo($dataPrazo,$horaPrazo);
                            $prazo = $dataPrazo.' '.$horaPrazo;

                            if ( $ResultVerificarHoraDataPrazo != 1 ) {
                            
                                echo "<script>alert('$ResultVerificarHoraDataPrazo');history.back();</script>";
                                exit;
                                  
                            } else if ($ModelOrdemDeServico->VerificarDadosOrdemDeServico($id_veiculo,$status,$situacao) ) {
                                echo "<script>alert('Já existe uma ordem de serviço aberta para este veiculo !');history.back();</script>";
                                exit;
                            }else if($ModelOrdemDeServico->Adicionar($id_veiculo,$id_colaborador,$numero_os,$dataAbertura,$horaAbertura,$prazo,$status_prazo,$descricao,$status,$situacao)) {
                           
                               echo '<script>alert("Registro salvo com sucesso !");location.href="'.BASE.'OrdemDeServico";</script>';
                               exit;
                            
                           } else {
    
                                echo '<script>alert("Erro ao salvar dados !");history.back();</script>';
                                exit;
                                }
                        }
                }
        }

        public function ValidaDataPrazo($dataPrazo){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                
                    $dataPrazo = explode('/', $dataPrazo);
                    $checkdate = $dataPrazo;
    
                    if ( count ($dataPrazo) == 3) {
    
                            $dataPrazo = implode ($dataPrazo);
                            $dataPrazo = strlen ($dataPrazo);
                            
                            if ($dataPrazo <= 7) {
                                return "Data invalida ! ";
    
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
                        return "Formato da data inválido !";
                    }
        }
    

        public function FormataData($dataPrazo) {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                if (!empty($dataPrazo)){
                    $dataPrazo = explode("/",$dataPrazo);
                    return $dataPrazo[2]."-".$dataPrazo[1]."-".$dataPrazo[0];
                }else {
                    return true;
                }
                
        }

        public function ValidaHoraPrazo($horaPrazo){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
    
                    $horaPrazo = explode(':', $horaPrazo);
    
                    if(count($horaPrazo) == 3){
    
                        $horaPrazo =  implode ($horaPrazo);
                        $horaPrazo = strlen($horaPrazo);
    
                        if ($horaPrazo <= 5) {
    
                            return "Hora invalida !";
    
                        } else {
                            return true;
                        }
    
                    } else {
                        return "Formato de hora é invalido !";
                    } 
    
        }

        public function VerificarHoraDataPrazo($dataPrazo,$horaPrazo){
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $ModelServico = new ModelServico();
            
                date_default_timezone_set('America/Sao_Paulo');
                $dataAtual = date('Y-m-d');
                $horaAtual = date('H:i:s');
                        
                if ($dataPrazo < $dataAtual) {
                    return "Data Invalida !\\nData é menor que a data de atual !";
                        
                } else if ($dataPrazo == $dataAtual && $horaPrazo <= $horaAtual) {
                            
                    return "Hora Invalida !\\nHorário é menor que o atual !";
                        
                } else {
                    return true;    
                }
              
        }

        
        public function EditarDados($id) {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $OrdemDeServico = new ModelOrdemDeServico();

                 $id_colaborador = $id_veiculo = $descricao = $status = "";

                if ( isset ( $_POST["id_colaborador"] ) ) {
                        $id_colaborador = trim ( $_POST["id_colaborador"] ); 	
                }
                if ( isset ( $_POST["id_veiculo"] ) ) {
                        $id_veiculo = trim ( $_POST["id_veiculo"] ); 	
                }
                if ( isset ( $_POST["descricao"] ) ) {
                        $descricao = trim ( $_POST["descricao"] ); 	
                }
                    

                if ( empty ( $id_colaborador ) ) {
                        echo '<script>alert("Preencha o Campo SOLICITANTE");history.back();</script>';
                        
                }else if ( empty ( $id_veiculo ) ) {
                        echo '<script>alert("Selecionar os dados do VEICULO");history.back();</script>';
                        
                }else if ( empty ( $descricao ) ) {
                        echo '<script>alert("Preencha o Campo DESCRIÇÃO");history.back();</script>';
                        
                } else {
                        $status = "Aberto";
                        $situacao = "Ativo";

                        if ($OrdemDeServico->VerificarDadosOrdemDeServicoEditar($id_veiculo,$id,$status,$situacao)) {

                            echo '<script>alert("Já existe uma ordem de serviço aberta para este veiculo !");history.back();</script>';
    
                        }   else {
                               if ($OrdemDeServico->Editar($id_veiculo,$id_colaborador,$descricao,$id)) {

                                    echo '<script>alert("Registro salvo com sucesso !");location.href="'.BASE.'OrdemDeServico/Exibir/'.$id.'";</script>';
             
                                } else {
             
                                    echo '<script>alert("Erro ao salvar dados !");history.back();</script>';
    
                                }

                            }
                
                }
        }


        public function VerificarDadosVeiculo() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $OrdemDeServico = new ModelOrdemDeServico();

                if (isset($_POST['id_proprietario'])) {
                        $id_proprietario = $_POST['id_proprietario'];

                        $Dadosveiculos = $OrdemDeServico->GetDadosVeiculo($id_proprietario);

                        echo json_encode($Dadosveiculos);
                        exit;
                }
                
        }

        public function BuscarDadosVeiculo() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $OrdemDeServico = new ModelOrdemDeServico();

                if (isset($_POST['id_proprietario'])) {
                        $id_proprietario = $_POST['id_proprietario'];

                        $Dadosveiculos = $OrdemDeServico->GetDadosVeiculo($id_proprietario);

                        echo json_encode($Dadosveiculos);
                        exit;
                }
                
        }

        public function ListOrdemAberta() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $OrdemDeServico = new ModelOrdemDeServico();

                if (isset($_POST['status_Aberto'])) {
                        $status_Aberto = $_POST['status_Aberto'];
                        $situacao_Ativo = $_POST['situacao_Ativo'];

                        $ResultDadosOrdemAberta = $OrdemDeServico->GetDadosOrdemAberta($status_Aberto, $situacao_Ativo);

                        echo json_encode($ResultDadosOrdemAberta);
                        exit;
                }
        }

        public function ListOrdemFechada() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $OrdemDeServico = new ModelOrdemDeServico();    

                if (isset($_POST['status_Fechado'])) {
                        $status_Fechado = $_POST['status_Fechado'];
                        $situacao_Ativo = $_POST['situacao_Ativo'];

                        $ResultDadosOrdemFechada = $OrdemDeServico->GetDadosOrdemFechada($status_Fechado, $situacao_Ativo);

                        echo json_encode($ResultDadosOrdemFechada);
                        exit;
                }
        }

        public function FecharOrdemDeServico() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $ModelOrdemDeServico = new ModelOrdemDeServico();
                $ModelServico = new ModelServico();


                if (isset($_POST['id_Ordem'])) {
 
                        date_default_timezone_set('America/Sao_Paulo');
                        $dataFechamento = date('Y-m-d');
                        $horaFechamento = date('H:i:s');

                        $id_Ordem = $_POST['id_Ordem'];
                        $status_Aberto = 'Aberto';
                        $status_Fechado = 'Fechado';
                        $situacao = "Ativo";
                        

                        if ($ModelOrdemDeServico->VerificarApontamentoOS($id_Ordem,$status_Aberto,$situacao)) {

                            echo json_encode ('Existe apontamento em aberto, nesta ordem de servico !');

                        } else {
                                if ($ModelOrdemDeServico->FecharOrdemDeServico($id_Ordem,$dataFechamento,$horaFechamento,$status_Fechado)) {
                                     echo true;
                                }else {
                                    echo json_encode ('Erro ao fechar a ordem de servico !');
                                } 
                        }
                                
                        
                }else {
                        echo false;
                        exit; 
                }
  
        } 


        public function VerificarExcluir(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(1);
                $dados = array();
                $ModelOrdemDeServico = new ModelOrdemDeServico();
                
                if (isset($_POST['id_Ordem'])) {
                        $id_Ordem = $_POST['id_Ordem'];
                        $status_Aberto = 'Aberto';
                        $situacao = "Ativo";
                        if ($ModelOrdemDeServico->VerificarApontamentoOS($id_Ordem,$status_Aberto,$situacao)) {

                                echo json_encode ('Existe apontamento em aberto nesta ordem de servico, Não será possivel excluir em quanto existe algum apotamento aberto !');
                                
                        } else {
                                if ($ModelOrdemDeServico->VerificarExistApt($id_Ordem,$situacao)){
                                        echo 1;
                                } else {
                                        echo 2;
                                } 
                        }
                                
                        
                } else {
                        echo false;
                        exit; 
                }
        }

        public function InativarOrdem(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(1);
                $ModelOrdemDeServico = new ModelOrdemDeServico();
                
                if (isset($_POST['id_Ordem'])) {
                        $id_Ordem = $_POST['id_Ordem'];
                        $situacao_Inativo = "Inativo";
                        $situacao = "Ativo";

                        if ($ModelOrdemDeServico->VerificarExistApt($id_Ordem,$situacao)) {
                                if ($ModelOrdemDeServico->InativarOrdemEservico($id_Ordem, $situacao_Inativo)) {

                                    echo true;
                                        
                                } else {
                                    
                                    echo json_encode ('Erro ao excluir a ordem de serviço!');
                                        
                                }
                        } else {

                                if ($ModelOrdemDeServico->InativarOrdem($id_Ordem, $situacao_Inativo)) {

                                    echo true;
                                        
                                } else {
                                    
                                    echo json_encode ('Erro ao excluir a ordem de serviço!');
                                        
                                }
                        } 
                                
                        
                } else {
                        echo false;
                        exit; 
                }
        }

        public function Exibir($id_Ordem) {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();

                $ModelOrdemDeServico = new ModelOrdemDeServico();

                if (!empty ( $id_Ordem ) ) {
                        $situacao_Ativo = "Ativo";
                        
                        if ($dadosOrdem = $ModelOrdemDeServico->BuscarDadosOrdemDeServico($id_Ordem, $situacao_Ativo )) {

                                $resultprazo = $dadosOrdem->prazo;

                                $resultprazo = explode(" ",$resultprazo);

                                $dataprazo = $resultprazo[0];
                                $horaprazo = $resultprazo[1];
                                $dataprazo = explode("-",$dataprazo);
                                $dataprazo = $dataprazo[2].'/'.$dataprazo[1].'/'.$dataprazo[0];
                                


                                if ( $dadosOrdem->status_os == "Aberto") {

                                        date_default_timezone_set('America/Sao_Paulo');
                                        $dataAtual = date('Y-m-d H:i:s');

                                        $ResultDataPrazo = new DateTime($dadosOrdem->prazo);
        
                                        $ResultDataAtual = new DateTime($dataAtual);
                                        
                                        $resultdados = $ResultDataAtual->diff($ResultDataPrazo)->format("%d-%h-%i-%s");
                                        
                                        $resultdados = explode("-",$resultdados);
                                        
                                        $dias = $resultdados[0];
                                        $hora = $resultdados[1];
                                        $minuto = $resultdados[2];
                                        $segundo = $resultdados[3];	

                                        $dados['dias'] = $dias;
                                        $dados['horas'] = $hora;
                                        $dados['minutos'] = $minuto;
                                        $dados['segundos'] = $segundo;

                                } 


                                $dados['dataprazo'] = $dataprazo;
                                $dados['horaprazo'] = $horaprazo;
                                $dados['dadosOrdem'] = $dadosOrdem;

                                $DadosListOrdemApontamento = $ModelOrdemDeServico->ListarDadosOrdemApontamento($id_Ordem, $situacao_Ativo);
                                       
                                $dados['DadosListOrdemApontamento'] = $DadosListOrdemApontamento;

                             

                                $dados['id_Ordem'] = $id_Ordem;
                
                                $this->loadTemplateAdmin('Admin/OrdemDeServico/Exibir', $dados);    
                        } else {
                                echo '<script>alert("Erro ao carregar os dados da pagina !");history.back();</script>';
                        }


                } else {
                        echo '<script>alert("Erro ao carregar a pagina !");history.back();</script>';                 
                }

        } 


        public function ExibirOrdemApontamento() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelOrdemDeServico = new ModelOrdemDeServico();
                $situacao = "Ativo";
                if (isset($_POST['id_servico'])) {
                        $id_servico = $_POST['id_servico'];

                        if ( $ExibirOrdemApontamento = $ModelOrdemDeServico->ExibirDadosOrdemApontamento($id_servico,$situacao)) {
                                echo json_encode($ExibirOrdemApontamento);
                                exit;
                        } else {
                                echo '<script>alert("Erro ao carregar os dados na pagina !");history.back();</script>'; 
                        }

                        
                }
        } 

        

}