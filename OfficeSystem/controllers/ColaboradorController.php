<?php
class ColaboradorController extends controller {

        public function index() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);

                $ModelColaborador = new ModelColaborador();
                $situacao = "Ativo";
                if ( $listDados = $ModelColaborador->GetLista($situacao)) {

                        $dados['listDados']= $listDados;

                    }else {
                        echo '<script>alert("Ocorreu um Erro ao Listar !");location.href="'.BASE.'Dashboard";</script>';
            
                }

		$this->loadTemplateAdmin('Admin/Colaborador/Listar', $dados);
        }
        
        public function Cadastro() {
                $this->VerificarLogin(); 
                $this->VerificarNivel(1);

                $dados = array();
                $ModelColaborador = new ModelColaborador();

                $getMatricula = $ModelColaborador->GetMatricula();

                $cont = $getMatricula['id'];
                $cont = $cont + 1;
                $dados['cont'] = $cont;

		        $this->loadTemplateAdmin('Admin/Colaborador/Cadastro', $dados);
         }
    
        public function Adicionar(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(1);

                $dados = array();
                $ModelColaborador = new ModelColaborador();
                
                $nome = $email = $telefone = $celular = $matricula = $senha =  $cargo = $ativo = $situacao = "";
                
                if ( isset ( $_POST["nome"] ) ) {
                        $nome = trim ( $_POST["nome"] ); 	
                }
                if ( isset ( $_POST["email"] ) ) {
                        $email = trim ( $_POST["email"] ); 	
                }
                if ( isset ( $_POST["telefone"] ) ) {
                        $telefone = trim ( $_POST["telefone"] ); 	
                }
                if ( isset ( $_POST["celular"] ) ) {
                        $celular = trim ( $_POST["celular"] ); 	
                }
                if ( isset ( $_POST["matricula"] ) ) {
                        $matricula = trim ( $_POST["matricula"] ); 	
                }
                if ( isset ( $_POST["senha"] ) ) {
                        $senha = trim ( $_POST["senha"] ); 	
                }
                if ( isset ( $_POST["cargo"] ) ) {
                        $cargo = trim ( $_POST["cargo"] ); 	
                }
                if ( isset ( $_POST["ativo"] ) ) {
                        $ativo = trim ( $_POST["ativo"] ); 	
                }


                if ( empty ( $nome ) ) {
                        echo '<script>alert("Preencha o Campo NOME");history.back();</script>';
                        
                }else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )  {
                        echo '<script>alert("Preencha o Campo E-mail");history.back();</script>';
                        
                }else if ( empty ( $celular ) ) {
                        echo '<script>alert("Preencha o Campo CELULAR");history.back();</script>'; 

                }else if ( empty ( $matricula ) ) {
                        echo '<script>alert("Preencha o Campo MATRICULA");history.back();</script>';
                
                }else if ( empty ( $senha ) ) {
                        echo '<script>alert("Preencha o Campo SENHA");history.back();</script>';
                }
                else if ( empty ( $cargo ) ) {
                        echo '<script>alert("Preencha o Campo CARGO");history.back();</script>';
                
                }else if ( empty ( $ativo ) ) {
                        echo '<script>alert("Preencha o Campo ATIVO");history.back();</script>';
                
                } else {
                               
                        $senha = password_hash($senha, PASSWORD_DEFAULT);
                        $situacao = "Ativo";
                        if ($ModelColaborador->ExistDados1($email, $matricula, $situacao)) {
                               
                                echo '<script>alert("Já existe um registro com mesmo e-mail !");history.back();</script>'; 

                        }else if ($ModelColaborador->Adicionar($nome, $email, $telefone, $celular, $matricula, $senha, $cargo, $ativo, $situacao )) {
                                
                                echo '<script>alert("Registro salvo com sucesso !");location.href="'.BASE.'Colaborador";</script>';

                        }else{
                                
                                echo '<script>alert("Ocorreu algum erro ao salvar !");history.back();</script>';

                        }
                        
                }

        }  

        public function Alterar(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                
                if (isset ($_SESSION["sistema"]["id"])) {
                    $ModelColaborador = new ModelColaborador();
                    $id = $_SESSION["sistema"]["id"];
                    $situacao = "Ativo";
                    if(isset($id) && !empty($id)) {
    
                            if ($infos = $ModelColaborador->GetCol($id,$situacao)) {
    
                                    $dados['infos'] = $infos;
                                    $this->loadTemplateAdmin('Admin/Colaborador/EditarUsuario', $dados);   
    
                            }else {
    
                                    echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Dashboard";</script>';
                            }
                    
                    } else {
                        echo '<script>alert("Dados Invalidos !");history.back();</script>';
                        exit;
                    }
                }else {
                    echo '<script>alert("Dados Invalidos !");history.back();</script>';
                    exit;
                }

        
        }

        public function AlterarDados($id) {
            $this->VerificarLogin();
            $this->VerificarNivel(2);

            $dados = array();
            $ModelColaborador = new ModelColaborador();
            if ($id === $_SESSION["sistema"]["id"]) {
                $nome = $email = $telefone = $celular = $id_usuario = $matricula = $senha =  $cargo = $ativo = "";
                
                if ( isset ( $_POST["nome"] ) ) {
                        $nome = trim ( $_POST["nome"] ); 	
                }
                if ( isset ( $_POST["email"] ) ) {
                        $email = trim ( $_POST["email"] ); 	
                }
                if ( isset ( $_POST["celular"] ) ) {
                        $celular = trim ( $_POST["celular"] ); 	
                }
                if ( isset ( $_POST["id_usuario"] ) ) {
                        $id_usuario = trim ( $_POST["id_usuario"] ); 	    
                }
                if ( isset ( $_POST["matricula"] ) ) {
                        $matricula = trim ( $_POST["matricula"] ); 	
                }
                if ( isset ( $_POST["senha"] ) ) {
                        $senha = trim ( $_POST["senha"] ); 	
                }
                if ( isset ( $_POST["telefone"] ) ) {
                        $telefone = trim ( $_POST["telefone"] ); 	
                }


                if ( empty ( $nome ) ) {
                        echo '<script>alert("Preencha o Campo NOME");history.back();</script>';
                        
                }else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )  {
                        echo '<script>alert("Preencha o Campo E-mail");history.back();</script>';
                        
                }else if ( empty ( $celular ) ) {
                        echo '<script>alert("Preencha o Campo CELULAR");history.back();</script>'; 

                }else if ( empty ( $matricula ) ) {
                        echo '<script>alert("Preencha o Campo MATRICULA");history.back();</script>';
                
                }else {

                        $situacao = "Ativo";

                        if ($ModelColaborador->ExistDados2($id, $email, $situacao)) {

                                echo '<script>alert("Já existi um registro com o mesmo e-mail !");history.back();</script>';
                                exit;
                        } else if ( ( $ativo == "Não" ) && ($id == $_SESSION['sistema']['id'])) {

                                echo "<script>alert('Este colaborador não pode ter o acesso bloqueado, pois está logado no sistema !');history.back();</script>";
                                exit;
                        

                        } else {

                            if ($ModelColaborador->EditarUsuario($nome, $email, $telefone, $celular, $senha, $id ,$id_usuario)) {
                                $this->AlterarSession($id_usuario,$matricula,$nome);
                                echo '<script>alert("Registro editado com sucesso !");location.href="'.BASE.'Dashboard";</script>';
                                exit;
                            } else {
        
                                echo '<script>alert("Erro ao editar !");history.back();</script>';
                                exit;
        
                            }
                        }
                                
                }

            }else {
                echo '<script>alert("Ocorreu Algum Erro !");location.href="'.BASE.'Dashboard";</script>';
            }
        
        }

        public function AlterarSession($id_usuario,$matricula,$nome) {
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);

                if ($id_usuario === $_SESSION["sistema"]["id"]) {
                    $cargo = $_SESSION["sistema"]["cargo"];
                    unset( $_SESSION["sistema"] );
        
                    $_SESSION["sistema"] = array( "id"=>$id_usuario, "matricula"=>$matricula, "nome"=>$nome, "cargo"=>$cargo );
                    
                }

        }
        

        public function Dados($id){
                $this->VerificarLogin(); 
                $this->VerificarNivel(1);

                $dados = array();
                $ModelColaborador = new ModelColaborador();
                $situacao = "Ativo";

                if ($id != $_SESSION["sistema"]["id"]) {
                    if(isset($id) && !empty($id)) {

                            if ($infos = $ModelColaborador->GetCol($id,$situacao)) {

                                    $dados['infos'] = $infos;
                                    $this->loadTemplateAdmin('Admin/Colaborador/Editar', $dados);

                            }else {

                                    echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Dashboard";</script>';
                            }
                    
                    } else {
                        header("Location: ".BASE."Colaborador/Listar");
                        exit;
                    }

                }else {
                    echo '<script>alert("Ocorreu Algum Erro !");location.href="'.BASE.'Dashboard";</script>';
                    exit;
                }
        }

        public function Exibir($id){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);

                $dados = array();
                $ModelColaborador = new ModelColaborador();
                $situacao = "Ativo";
                if(isset($id) && !empty($id)) {

                        if ($infos = $ModelColaborador->GetCol($id,$situacao)) {

                                $dados['infos'] = $infos;

                        }else {

                                echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Dashboard";</script>';
                        }
                
                } else {
                header("Location: ".BASE."Colaborador/Listar");
                exit;
                }

                $this->loadTemplateAdmin('Admin/Colaborador/Exibir', $dados);
        }

        public function Editar($id) {
                $this->VerificarLogin();
                $this->VerificarNivel(1);

                $dados = array();
                $ModelColaborador = new ModelColaborador();
                
                $nome = $email = $telefone = $celular = $id_usuario = $matricula = $senha =  $cargo = $ativo = "";
                
                if ($id != $_SESSION["sistema"]["id"]) {
                    if ( isset ( $_POST["nome"] ) ) {
                            $nome = trim ( $_POST["nome"] ); 	
                    }
                    if ( isset ( $_POST["email"] ) ) {
                            $email = trim ( $_POST["email"] ); 	
                    }
                    if ( isset ( $_POST["celular"] ) ) {
                            $celular = trim ( $_POST["celular"] ); 	
                    }
                    if ( isset ( $_POST["id_usuario"] ) ) {
                            $id_usuario = trim ( $_POST["id_usuario"] ); 	    
                    }
                    if ( isset ( $_POST["matricula"] ) ) {
                            $matricula = trim ( $_POST["matricula"] ); 	
                    }
                    if ( isset ( $_POST["senha"] ) ) {
                            $senha = trim ( $_POST["senha"] ); 	
                    }
                    if ( isset ( $_POST["cargo"] ) ) {
                            $cargo = trim ( $_POST["cargo"] ); 	
                    }
                    if ( isset ( $_POST["ativo"] ) ) {
                            $ativo = trim ( $_POST["ativo"] ); 	
                    }
                    if ( isset ( $_POST["telefone"] ) ) {
                        $telefone = trim ( $_POST["telefone"] ); 	
                    }


                    if ( empty ( $nome ) ) {
                            echo '<script>alert("Preencha o Campo NOME");history.back();</script>';
                            
                    }else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )  {
                            echo '<script>alert("Preencha o Campo E-mail");history.back();</script>';
                            
                    }else if ( empty ( $celular ) ) {
                            echo '<script>alert("Preencha o Campo CELULAR");history.back();</script>'; 

                    }else if ( empty ( $matricula ) ) {
                            echo '<script>alert("Preencha o Campo MATRICULA");history.back();</script>';
                    
                    }else if ( empty ( $cargo ) ) {
                            echo '<script>alert("Preencha o Campo CARGO");history.back();</script>';
                    
                    }else if ( empty ( $ativo ) ) {
                            echo '<script>alert("Preencha o Campo ATIVO");history.back();</script>';
                    
                    }else {

                            $situacao = "Ativo";

                            if ($ModelColaborador->ExistDados2($id, $email, $situacao)) {

                                    echo '<script>alert("Já existi um registro com o mesmo e-mail !");history.back();</script>';
            
                            } else if ( ( $ativo == "Não" ) && ($id == $_SESSION['sistema']['id'])) {

                                    echo "<script>alert('Este colaborador não pode ter o acesso bloqueado, pois está logado no sistema !');history.back();</script>";
                                    exit;
                            

                            } else {

                                if ($ModelColaborador->EditarDados($nome, $email, $telefone, $celular, $matricula, $senha, $cargo, $ativo, $id , $id_usuario)) {

                                    echo '<script>alert("Registro editado com sucesso !");location.href="'.BASE.'Colaborador";</script>';
                                    exit;
                                } else {
            
                                    echo '<script>alert("Erro ao editar !");history.back();</script>';
                                    exit;
                                }
                            }    

                    }
                } else {
                    echo '<script>alert("Ocorreu Algum Erro !");location.href="'.BASE.'Dashboard";</script>';
                    exit;
                }
        }

        public function Verificar(){
                $this->VerificarLogin();
                $this->VerificarNivel(1);

                $dados = array();
                $ModelColaborador = new ModelColaborador();
                
                $id = $_POST['id'];
                $situacao = "Ativo";

                $result = $ModelColaborador->Verificar($id,$situacao);

                echo json_encode ($result);
                exit;
        
        }

        public function Excluir(){
            $this->VerificarLogin(); 
            $this->VerificarNivel(1);
            
            $dados = array();
            $ModelColaborador = new ModelColaborador();
            
            $id = $_POST['id'];
            $situacao = "Inativo";
            $Ativo = "Não";

                 if ($id == $_SESSION['sistema']['id']) {
                        echo json_encode ('logado');
                        exit;
                } else {
                        $result = $ModelColaborador->Excluir($id,$Ativo,$situacao);
                        echo json_encode ($result);
                        exit;
                }
    
        }

}