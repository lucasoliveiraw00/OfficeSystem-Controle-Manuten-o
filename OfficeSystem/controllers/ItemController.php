<?php
class ItemController extends controller {


         public function Cadastro($id_comp) {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelComponente = new ModelComponente();
                $ModelItem = new ModelItem();
                $situacao = "Ativo";

                if(isset($id_comp)) {

                        if ($dadosComp = $ModelComponente->DadosComponente($id_comp,$situacao )) {
                                
                                foreach ($dadosComp as $listDados) {
                                        $dados['id']=  $listDados['id'];
                                        $dados['Codigo']=  $listDados['codigo'];
                                        $dados['Nome']=    $listDados['descricao'];
                                } 
                                
                                if ( $Result = $ModelItem->BuscaGodigo($id_comp)) {

                                        if (!empty ($Result['codigo_MaxItem'])) {

                                                $dados['codigo_item'] =  $codigo_item = $Result['codigo_MaxItem'] + 1;
                
                                        } else {
                                                
                                                $dados['codigo_item'] = $codigo_item = $Result['codigo_MaxComp'] + 1;
                                        }   
                                } else {
                                      echo '<script>alert("Erro ao gerar o codigo Item");history.back();</script>';
                                }

                        }else {
                               echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Componente";</script>';  
        
                        }

                }else {
                        echo '<script>alert("Erro ao adquirir informação do componente !");history.back();</script>';
                                exit;
                }
             
            $this->loadTemplateAdmin('Admin/Manutencao/Item/Cadastro', $dados);
        } 

        public function Adicionar(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelItem = new ModelItem();

                $id_comp = $codigo = $descricao = "";
        
                if ( isset ( $_POST["id_comp"] ) ) {
                         $id_comp = trim ( $_POST["id_comp"] ); 	
                }
                if ( isset ( $_POST["codigo"] ) ) {
                        $codigo = trim ( $_POST["codigo"] ); 	
                }
                if ( isset ( $_POST["descricao"] ) ) {
                         $descricao = trim ( $_POST["descricao"] ); 	
                }
               
       
                if ( empty ( $id_comp ) ) {
                       echo '<script>alert("Preencha o Campo CODIGO DO COMPONENTE");history.back();</script>';
                
                }
                else if ( empty ( $codigo ) ) {
                       echo '<script>alert("Preencha o Campo CODIGO DO ITEM");history.back();</script>';
                
                }
                else if ( empty ( $descricao ) ) {
                       echo '<script>alert("Preencha o Campo DESCRIÇÃO DO ITEM");history.back();</script>';
                
                }else {
        
                        $situacao = "Ativo";
                        if ($ModelItem->ExistDados1($descricao,$situacao)) {

                               echo '<script>alert("Já existi um registro com o mesmo item veicular !");history.back();</script>';

                        } else if($ModelItem->Cadastrar($id_comp,$codigo,$descricao,$situacao)) {

                                echo '<script>alert("Registro salvo com sucesso !");location.href="'.BASE.'Componente/Exibir/'.$id_comp.'";</script>';
                
                        } else {

                                echo '<script>alert("Ocorreu um erro ao savar !");history.back();</script>';

                        }

                }
        }
    

        public function Dados($id){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelItem = new ModelItem();  
                $ModelComponente = new ModelComponente();
                $situacao = "Ativo";

                if(isset($id) && !empty($id)) {

                        if ($DadosItemComp = $ModelItem->DadosItemComp($id,$situacao)){

                                $dados['DadosItemComp'] = $DadosItemComp;
                                if ( $listDadosComp = $ModelComponente->GetLista($situacao)) {
                                        $dados['listDadosComp']= $listDadosComp;
                                }else {
                                      echo '<script>alert("Ocorreu Algum Erro de Busca !");history.back();</script>';
                   
                                }
                        }else {
                                echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Dashboard";</script>';
                        }
                
                } else {
                       echo '<script>alert("Ocorreu um erro ao carregar a pagina !");history.back();</script>';
                        exit;
                }

                $this->loadTemplateAdmin('Admin/Manutencao/Item/Editar', $dados);
        }

        public function Editar($id){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelItem = new ModelItem();  
                $ModelComponente = new ModelComponente();

                $id_comp = $codigo = $descricao =  "";
            
                if ( isset ( $_POST["id_comp"] ) ) {
                        $id_comp = trim ( $_POST["id_comp"] ); 
                }
                if ( isset ( $_POST["novo_id_comp"] ) ) {
                        $novo_id_comp = trim ( $_POST["novo_id_comp"] ); 
                }
                if ( isset ( $_POST["codigo"] ) ) {
                        $codigo = trim ( $_POST["codigo"] );    
                }if ( isset ( $_POST["descricao"] ) ) {
                        $descricao = trim ( $_POST["descricao"] ); 	
                }
        
                if ( empty ( $id_comp ) ) {
                   echo '<script>alert("Preencha o Campo CODIGO DO COMPONENTE");history.back();</script>';
                    
                }else if ( empty ( $descricao ) ) {
                   echo '<script>alert("Preencha o Campo DESCRIÇÃO DO ITEM");history.back();</script>';
                    
                }else {
                        $situacao = "Ativo";
                        if ($ModelItem->ExistDados2($id,$descricao,$situacao)) {

                               echo '<script>alert("Já existi um registro com o mesmo Item veicular !");history.back();</script>';
                
                        } else {

                                $ResultDadosItemComp = $ModelItem->VerificarGodigo($id);

                                if ($id_comp !== $ResultDadosItemComp['id_comp']) {

                                    if ( $Result = $ModelItem->BuscaGodigo($id_comp)) {

                                        if (!empty ($Result['codigo_MaxItem'])) {

                                            $codigo = $Result['codigo_MaxItem'] + 1;
                                                      
                                        } else {
                                                                
                                            $codigo = $Result['codigo_MaxComp'] + 1;
                                        }   
                                    } else {
                                        echo '<script>alert("Erro ao gerar o codigo Item");history.back();</script>';
                                    }
                                                        
                                    if ($ModelItem->EditarItem($id_comp,$codigo,$descricao,$id)) {
                                                
                                         echo '<script>alert("Registro editado com sucesso !");location.href="'.BASE.'Componente/Exibir/'.$id_comp.'";</script>';
                                                                
                                    } else {

                                        echo '<script>alert("Ocorreu um erro ao editar !");history.back();</script>';
                                    }
                                } else {
                                        if ($ModelItem->EditarItem($id_comp,$codigo,$descricao,$id)) {
                                        
                                            echo '<script>alert("Registro editado com sucesso !");location.href="'.BASE.'Componente/Exibir/'.$id_comp.'";</script>';
                                                        
                                        } else {

                                            echo '<script>alert("Ocorreu um erro ao editar !");history.back();</script>';

                                        }
                                }

                        }
                }
        }

        public function BuscarDadosItens(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelItem = new ModelItem();
                $situacao = "Ativo";
                if (isset($_POST['id_comp'])) {
                        $id_comp = $_POST['id_comp'];

                        $DadosItem = $ModelItem->GetDadosItens($id_comp,$situacao);

                        echo json_encode($DadosItem);
                        exit;
                }
    
        }

        public function Verificar(){
            $this->VerificarLogin(); 
            $this->VerificarNivel(1); 
            $dados = array();
            $ModelItem = new ModelItem();
            
            $id = $_POST['id'];
            $situacao = "Ativo";

            $result = $ModelItem->Verificar($id,$situacao);

            echo json_encode ($result);
            exit;
    
        }

        public function Excluir(){
                 $this->VerificarLogin(); 
            $this->VerificarNivel(1); 
                $dados = array();
                $ModelItem = new ModelItem();
                
                $id = $_POST['id'];
                $situacao = "Inativo";

                $result = $ModelItem->Excluir($id,$situacao);

                echo json_encode ($result);
                exit;

        }

 }
    