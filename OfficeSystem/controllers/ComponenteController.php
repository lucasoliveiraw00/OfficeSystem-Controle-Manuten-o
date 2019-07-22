<?php
class ComponenteController extends controller {



	    public function index() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2); 
                $dados = array();
                $ModelComponente = new ModelComponente();
                $situacao = "Ativo";

                if ( $listDados = $ModelComponente->GetLista($situacao)) {
                         $dados['listDados']= $listDados;
                }else {
                        echo '<script>alert("Ocorreu um erro ao listar !");location.href="'.BASE.'Dashboard";</script>';
    
                }
                $this->loadTemplateAdmin('Admin/Manutencao/Componente/Listar', $dados);
        }

        public function Exibir($id) {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2); 
                $dados = array();
                $ModelComponente = new ModelComponente();
                $ModelItem = new ModelItem();
                $situacao = "Ativo";
                if (!empty ( $id )) {
                        
                        if ($listDadosComp = $ModelComponente->DadosComponente($id,$situacao)) {
                                
                                foreach ($listDadosComp as $GetDados) {
                                        $dados['id']=  $GetDados['id'];
                                        $dados['Codigo']=  $GetDados['codigo'];
                                        $dados['Nome']=    $GetDados['descricao'];
                                }

                                $listDadosItem = $ModelItem->DadosItem($id,$situacao);
                                $dados['listDadosItem'] = $listDadosItem;
                        }else {
                            echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Componente";</script>'; 
                        }

                }else {
                    echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Componente";</script>';
                }
                                
                $this->loadTemplateAdmin('Admin/Manutencao/Exibir', $dados);
        }


        public function Cadastro() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2); 
                $dados = array();
                $codigo = new ModelComponente();
    
                $getCodigo = $codigo->GetCodigo();
    
                $cont = $getCodigo['codigo'];
                $cont = $cont + 100;
               
                $dados['cont'] = $cont;
             
               
                 $this->loadTemplateAdmin('Admin/Manutencao/Componente/Cadastro', $dados);
        }

        public function Adicionar(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelComponente = new ModelComponente();

                $codigo = $descricao =  "";
            
                if ( isset ( $_POST["codigo"] ) ) {
                    $codigo = trim ( $_POST["codigo"] ); 	
                }
                if ( isset ( $_POST["descricao"] ) ) {
                    $descricao = trim ( $_POST["descricao"] ); 	
                }
               
                if ( empty ( $codigo ) ) {
                    echo '<script>alert("Preencha o Campo CODIGO DO COMPONENTE");history.back();</script>';
                    
                }else if ( empty ( $descricao ) ) {
                    echo '<script>alert("Preencha o Campo DESCRIÇÃO DO COMPONENTE");history.back();</script>';
                    
                }else {
                    $situacao = "Ativo";

                    if ($ModelComponente->ExistDados1($descricao,$situacao)) {

                        echo '<script>alert("Já existi um registro com o mesmo componente veicular !");history.back();</script>';

                    }
                     else if($ModelComponente->Cadastrar($codigo,$descricao,$situacao)) {

                        echo '<script>alert("Registro salvo com sucesso !");location.href="'.BASE.'Componente";</script>';
                    
                    } else {

                        echo '<script>alert("Ocorreu um erro ao savar !");history.back();</script>';

                        }

            }

        }

        public function Dados($id){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2); 
                $dados = array();
                $ModelComponente = new ModelComponente();
                $situacao = "Ativo";
                if(isset($id) && !empty($id)) {
                    
                        if ($infos = $ModelComponente->GetComponente($id,$situacao)){
                            $dados['infos'] = $infos;
                        }else {
                            echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Componente";</script>';  
                        }
                
                } else {
                        header("Location: ".BASE."Componente/listar");
                        exit;
                }
                
            $this->loadTemplateAdmin('Admin/Manutencao/Componente/Editar', $dados);
        }

        public function Editar($id){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2); 
                $dados = array();
                $ModelComponente = new ModelComponente();

                $codigo = $descricao = "";
            
                if ( isset ( $_POST["codigo"] ) ) {
                    $codigo = trim ( $_POST["codigo"] ); 	
                }
                if ( isset ( $_POST["descricao"] ) ) {
                    $descricao = trim ( $_POST["descricao"] ); 	
                }
           
                if ( empty ( $codigo ) ) {
                    echo '<script>alert("Preencha o Campo CODIGO DO COMPONENTE");history.back();</script>';
                    
                }else if ( empty ( $descricao ) ) {
                    echo '<script>alert("Preencha o Campo DESCRIÇÃO DO COMPONENTE");history.back();</script>';
                    
                }else {
                    $situacao = "Ativo";

                    if ($ModelComponente->ExistDados2($id, $descricao, $situacao)) {

                            echo '<script>alert("Já existi um registro com o mesmo componente veicular !");history.back();</script>';
            
                            } else {
                            
                                    if($ModelComponente->EditarComponente($codigo,$descricao,$id)) {

                                        echo '<script>alert("Registro editado com sucesso !");location.href="'.BASE.'Componente/Exibir/'.$id.'";</script>';
                                                    
                                    }else {

                                        echo '<script>alert("Ocorreu erro ao editar !");history.back();</script>';

                                    }

                            
                            }
            }
        }

        public function Verificar(){
            $this->VerificarLogin(); 
            $this->VerificarNivel(1); 
            $dados = array();
            $ModelComponente = new ModelComponente();
            
            $id = $_POST['id'];
            $situacao = "Ativo";

            $result = $ModelComponente->Verificar($id,$situacao);

            echo json_encode ($result);
            exit;
    
        }

        public function Excluir(){
            $this->VerificarLogin(); 
            $this->VerificarNivel(1); 
            $dados = array();
            $ModelComponente = new ModelComponente();
            
            $id = $_POST['id'];
            $situacao = "Inativo";

                $result = $ModelComponente->Excluir($id,$situacao);

                echo json_encode ($result);
                exit;

        }


 }
    