<?php
    class PainelController extends controller {

        public function Index() {
                
                $dados = array();
                
                $this->loadTemplateMecanico('Mecanico/Painel', $dados);

        }

        
        public function VerificarServico() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $id_usuario = trim ($_SESSION['sistema']['id']);
            $status_Aberto = "Aberto";
            $situacao_Ativo = "Ativo";

            if ($ModelPainel->VerificarServico($id_usuario,$status_Aberto,$situacao_Ativo)) {

                echo json_encode ('ServicoAberto');
                exit;

            } else {
                echo true;
                exit;
            }

        }

        public function VerificarOrdem(){
            $dados = array();
            $ModelPainel = new ModelPainel();
            
            if (isset($_POST['numero_os'])) {

                    $numero_os = $_POST['numero_os'];
                    $situacao_Ativo = 'Ativo';
                    $status_Aberto = 'Aberto';

                    if ($result = $ModelPainel->VerificarOrdem($numero_os, $situacao_Ativo, $status_Aberto)) {

                        echo json_encode ($result);
                            
                    } else {
                        echo json_encode ('erro');
                    }
                               
            } else {
                    echo false;
                    exit; 
            }
        }

        public function FecharServico() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $id_usuario = trim ($_SESSION['sistema']['id']);
            $status_Fechado = "Fechado";
            $situacao_Ativo = "Ativo";
            $status_Aberto = "Aberto";

            date_default_timezone_set('America/Sao_Paulo');
                $dataFechamento  = date('Y-m-d');
                $horaFechamento = date('H:i:s');

            if ($ModelPainel->FecharServico($id_usuario,$dataFechamento,$horaFechamento,$status_Fechado,$situacao_Ativo,$status_Aberto)) {

                echo true;
                exit;
                
            } else {
                echo false;
                exit;
            }

        }

        public function ConsultarServico() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $id_usuario = trim ($_SESSION['sistema']['id']);
            $status_Aberto = "Aberto";
            $situacao_Ativo = "Ativo";

            if ($dados = $ModelPainel->ConsultarServico($id_usuario,$status_Aberto,$situacao_Ativo)){
                echo json_encode($dados);
                exit;
            }else {
                echo json_encode("Status_Fechado");
                exit;
            }      

        } 

        public function BuscarDadosPainelServico() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $id_ordem = $_POST["id_ordem"];
            $situacao = "Ativo";
            $status = "Aberto";
            
            if ($BuscarDadosPainelServico = $ModelPainel->BuscarDadosPainelServico($id_ordem,$status,$situacao)){
                echo json_encode ($BuscarDadosPainelServico);
                exit;
            }else {
                echo false;
                exit;
            }

        }

        public function ListOrdemAberta() {
            $dados = array();
            $ModelPainel = new ModelPainel();
            $status = 'Aberto';
            $situacao = 'Ativo';

            $ResultDadosProcedimento = $ModelPainel->ListOrdemAberta($status,$situacao);

                echo json_encode ($ResultDadosProcedimento);
                exit;
         
        }

        public function ListProcedimento() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $ResultDadosProcedimento = $ModelPainel->ListProcedimento();

                echo json_encode ($ResultDadosProcedimento);
                exit;
         
        }

        public function ListComponente() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $ResultDadosComponente = $ModelPainel->ListComponente();

                echo json_encode ($ResultDadosComponente);
                exit;
         
        }

        public function ListItem() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $id_comp = $_POST["id_comp"];

            $ResultDadosItem = $ModelPainel->ListItem($id_comp);

                echo json_encode ($ResultDadosItem);
                exit;
         
        }

        public function BuscarProcDescricao() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $proc_cod = $_POST["proc_cod"];

            $ResultDadosProcDescricao = $ModelPainel->BuscarProcDescricao($proc_cod);

                echo json_encode ($ResultDadosProcDescricao);
                exit;
         

        }

        public function BuscarCompDescricao() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $comp_cod = $_POST["comp_cod"];

            $ResultDadosCompDescricao = $ModelPainel->BuscarCompDescricao($comp_cod);

            if ($ResultDadosCompDescricao === 2) {
                echo json_encode('erro2');
                exit;
            }else if ($ResultDadosCompDescricao === 3) {
                echo json_encode('erro3');
                exit;
            }else if ($ResultDadosCompDescricao === 4) {
                echo json_encode('erro4');
                exit;
            }   else echo json_encode ($ResultDadosCompDescricao);
                exit;
         

        }

        public function VerificarComponente() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $id_comp = $_POST["id_comp"];

            $ResultVerificarComponente = $ModelPainel->VerificarComponente($id_comp);

                echo json_encode ($ResultVerificarComponente);
                exit;
         
        }

        public function BuscarItemDescricao() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            $item_cod = $_POST["item_cod"];
            $id_comp = $_POST["id_comp"];

            $ResultDadosItemDescricao = $ModelPainel->BuscarItemDescricao($item_cod, $id_comp);

                echo json_encode ($ResultDadosItemDescricao);
                exit;
         
        }

        public function IniciarServico() {
            $dados = array();
            $ModelPainel = new ModelPainel();

            if ( (!empty ($_POST["id_proc"])) && (!empty ($_POST["id_item"])) ) {
               
                $id_usuario = trim ($_SESSION['sistema']['id']);
                $id_proc =  trim ( $_POST["id_proc"] ); 	
                $id_item =  trim ( $_POST["id_item"] ); 	
                $id_ordem = trim ( $_POST["id_ordem"] ); 	

                $status_Aberto = "Aberto";
                $situacao_Ativo = "Ativo";

                date_default_timezone_set('America/Sao_Paulo');
                $dataAbertura = date('Y-m-d');
                $horaAbertura = date('H:i:s');

                if ($result = $ModelPainel->IniciarServico($id_usuario,$id_proc,$id_item,$dataAbertura,$horaAbertura,$status_Aberto,$situacao_Ativo,$id_ordem)) {
                    echo true;    
                }else {  
                   echo json_encode ('Erro ao iniciar servico !');     
                } 
                
            } else {
                echo false;
                exit;
            }

        }

        public function SairPainel(){
            unset( $_SESSION["sistema"] );
            echo true;
            exit;
        }

    }