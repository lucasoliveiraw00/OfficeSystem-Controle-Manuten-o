<?php
class ProcedimentoController extends controller {


	    public function index() {    
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelProcedimento = new ModelProcedimento();
                $situacao = "Ativo";

                if ( $listDados = $ModelProcedimento->GetLista($situacao)) {
                        $dados['listDados']= $listDados;
                    }else {
                        echo '<script>alert("Ocorreu um erro ao listar !");location.href="'.BASE.'Dashboard";</script>';
            
                }

                $this->loadTemplateAdmin('Admin/Manutencao/Procedimento/Listar', $dados);
        }

	    public function Cadastro() {     
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);

                $dados = array();
                $ModelProcedimento = new ModelProcedimento();
                
                $getCodigo = $ModelProcedimento->GetCodigo();

                $cont = $getCodigo['codigo'];
                $cont = $cont + 1;
                
                $dados['cont'] = $cont;

                $this->loadTemplateAdmin('Admin/Manutencao/Procedimento/Cadastro', $dados);
        }

        public function Adicionar(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelProcedimento = new ModelProcedimento();

                $codigo = $descricao = $ativo = "";
                
                if ( isset ( $_POST["codigo"] ) ) {
                        $codigo = trim ( $_POST["codigo"] ); 	
                }
                if ( isset ( $_POST["descricao"] ) ) {
                        $descricao = trim ( $_POST["descricao"] ); 	
                }
                
                if ( empty ( $codigo ) ) {
                        echo '<script>alert("Preencha o Campo CODIGO DO PROCEDIMENTO");history.back();</script>';
                        
                }else if ( empty ( $descricao ) ) {
                        echo '<script>alert("Preencha o Campo DESCRIÇÃO DO PROCEDIMENTO");history.back();</script>';
                        
                }else {
                        $situacao = "Ativo";
                
                        if ($ModelProcedimento->ExistDados1($descricao,$situacao)) {

                                echo '<script>alert("Já existi um registro com a mesmo procedimento veicular !");history.back();</script>';

                        } 
                        else if($ModelProcedimento->Cadastrar($codigo,$descricao,$situacao)) {

                                echo '<script>alert("Registro salvo com sucesso !");location.href="'.BASE.'Procedimento";</script>';

                        } else {

                                echo '<script>alert("Ocorreu erro ao savar !");history.back();</script>';

                        }

                }

        }

        public function Dados($id){
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dados = array();
            $Procedimento = new ModelProcedimento();
            $situacao = "Ativo";

            if(isset($id) && !empty($id)) {
                if ($infos = $Procedimento->GetProcedimento($id,$situacao)) {

                        $dados['infos'] = $infos;

                } else {
                    echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Procedimento";</script>';
                }
            } else {
                header("Location: ".BASE."Procedimento");
                exit;
            }
        
            $this->loadTemplateAdmin('Admin/Manutencao/Procedimento/Editar', $dados);
        }

        
        public function Editar($id){
            $this->VerificarLogin(); 
            $this->VerificarNivel(2);
            $dados = array();
            $Procedimento = new ModelProcedimento();

            $codigo = $descricao =  "";
            
            if ( isset ( $_POST["codigo"] ) ) {
                    $codigo = trim ( $_POST["codigo"] ); 	
            }
            if ( isset ( $_POST["descricao"] ) ) {
                    $descricao = trim ( $_POST["descricao"] ); 	
            }
            
            if ( empty ( $codigo ) ) {
                    echo '<script>alert("Preencha o Campo CODIGO DO PROCEDIMENTO");history.back();</script>';
                   
            }else if ( empty ( $descricao ) ) {
                    echo '<script>alert("Preencha o Campo DESCRIÇÃO DO PROCEDIMENTO");history.back();</script>';
                    
            }else {
                
                $situacao = "Ativo";

                 if ($Procedimento->ExistDados2($id,$descricao,$situacao)) {

                        echo '<script>alert("Já existi um registro com o mesmo procedimento veicular !");history.back();</script>';

                } else {
                       
                    
                        if($Procedimento->EditProcedimento($codigo,$descricao,$id)) {
                                
                                    echo '<script>alert("Registro editado com sucesso !");location.href="'.BASE.'Procedimento";</script>';

                                } else {

                                        echo '<script>alert("Ocorreu erro ao editar !");history.back();</script>';

                                }

                        }
                }
        }

        public function Verificar(){
            $this->VerificarLogin(); 
            $this->VerificarNivel(1); 
            $dados = array();
            $ModelProcedimento = new ModelProcedimento();
            
            $id = $_POST['id'];
            $situacao = "Ativo";

            $result = $ModelProcedimento->Verificar($id,$situacao);

            echo json_encode ($result);
            exit;
    
        }

        public function Excluir(){
            $this->VerificarLogin(); 
            $this->VerificarNivel(1);
            $dados = array();
            $ModelProcedimento = new ModelProcedimento();
                
            $id = $_POST['id'];
            $situacao = "Inativo";
            $result = $ModelProcedimento->Excluir($id,$situacao);

            echo json_encode ($result);
            exit;

        }

        
 }
    