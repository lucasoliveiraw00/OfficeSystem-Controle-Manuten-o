<?php
class VeiculoController extends controller {

	public function index() {
                $this->VerificarLogin();
                $this->VerificarNivel(2); 
                $dados = array();
                $ModelVeiculo = new ModelVeiculo();
                $situacao = "Ativo";

                if ( $listDados = $ModelVeiculo->GetListaVeiculo($situacao)) {
                        $dados['listDados']= $listDados;
                }else {
                        $dados['msg'] = '<script>alert("Ocorreu um erro ao listar !");location.href="'.BASE.'Dashboard";</script>';
        
                }
           
            $this->loadTemplateAdmin('Admin/Veiculo/Listar', $dados);
	}

        public function Cadastro() {
                $this->VerificarLogin();
                $this->VerificarNivel(2); 
                $dados = array();
                $ModelCliente = new ModelCliente();
                $ModelVeiculo = new ModelVeiculo();
                $situacao = "Ativo";

                $linha = $ModelCliente->GetLista($situacao);
    
                $dados['linha']= $linha;
                $this->loadTemplateAdmin('Admin/Veiculo/Cadastro', $dados);
            }

        
        public function Adicionar(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);

                $dados = array();
                $ModelVeiculo = new ModelVeiculo();

                
                $id_cliente = $modelo = $marca = $ano = $cor = $placa = $situacao = "";
                
                if ( isset ( $_POST["id_cliente"] ) ) {
                        $id_cliente = trim ( $_POST["id_cliente"] ); 	
                }
                if ( isset ( $_POST["modelo"] ) ) {
                        $modelo = trim ( $_POST["modelo"] ); 	
                }
                if ( isset ( $_POST["marca"] ) ) {
                        $marca = trim ( $_POST["marca"] ); 	
                }
                if ( isset ( $_POST["ano"] ) ) {
                        $ano = trim ( $_POST["ano"] ); 	
                }
                if ( isset ( $_POST["cor"] ) ) {
                        $cor = trim ( $_POST["cor"] ); 	
                }
                if ( isset ( $_POST["placa"] ) ) {
                        $placa = trim ( $_POST["placa"] ); 	
                }
        
                $ResultData = $this->ValidaData($ano);
               
                if ( empty ( $id_cliente ) ) {
                        echo '<script>alert("Preencha o Campo CODIGO CLIENTE");history.back();</script>';
                        
                }else if ( empty ( $modelo ) ) {
                        echo '<script>alert("Preencha o Campo MODELO");history.back();</script>';
                        
                }else if ( empty ( $marca ) ) {
                        echo '<script>alert("Preencha o Campo MARCA");history.back();</script>';
                
                }else if ( empty ( $ano ) ) {
                        echo '<script>alert("Preencha o Campo ANO");history.back();</script>';
        
                }else if ( empty ( $cor ) ) {
                        echo '<script>alert("Preencha o Campo COR");history.back();</script>';
        
                }else if ( empty ( $placa ) ) {
                        echo '<script>alert("Preencha o Campo PLACA");history.back();</script>';
        
                }else if ( $ResultData != 1 ) {
                        echo "<script>alert('$ResultData');history.back();</script>";
                        
                }else {
                        
                        $situacao = "Ativo";
                        if ($ModelVeiculo->ExistDados1($placa,$situacao)) {

                        echo '<script>alert("Já existe um veiculo com a mesma placa !");history.back();</script>';

                        }
                
                        else if($ModelVeiculo->Cadastrar($modelo,$marca,$ano,$cor,$placa,$id_cliente,$situacao)) {

                                echo '<script>alert("Registro salvo com sucesso !");location.href="'.BASE.'Veiculo";</script>';
                        
                        }else {

                                echo '<script>alert("Ocorreu erro ao savar !");history.back();</script>';

                        }

                }
            

        }

        public function Dados($id){
                $this->VerificarLogin();
                $this->VerificarNivel(2); 
                $dados = array();
                $ModelVeiculo = new ModelVeiculo();
                $ModelCliente = new ModelCliente();
                $situacao = "Ativo";

                if(isset($id) && !empty($id)) {

                        if ($infos = $ModelVeiculo->GetVeiculo($id,$situacao)){
                                $dados['infos'] = $infos;
                        }else {
                                echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Veiculo";</script>';
                        }
                        
                } else {
                        header("Location: ".BASE."Veiculo");
                        exit;
                }

                $linha = $ModelCliente->GetLista($situacao);
                $dados['linha']= $linha;

                $this->loadTemplateAdmin('Admin/Veiculo/Editar', $dados);
        }

        public function ValidaData($ano) {
                $this->VerificarLogin();
                $this->VerificarNivel(2);
                $ano = explode("/",$ano);

                date_default_timezone_set('America/Sao_Paulo');
                $anoAtual = date('Y');

                if ( count ($ano) === 2) {
                        $ano1 = (int)$ano[0];
                        $ano2 = (int)$ano[1];
                        $ano = implode ($ano);
                        $total = strlen ($ano);
                        if ($total <= 7) {
                               
                                return 'Ano de fabricaçao inválido !';
                                
                        }else {
                                if ($ano1 > $anoAtual){
                                        return 'Primeiro ano digitado é maior que ano atual !';
                                } else if ($ano2 > $anoAtual) {
                                        return 'Segundo ano digitado é maior que ano atual !';
                                } else if ($ano1 > $ano2) {
                                        return 'Primeiro ano digitado é maior que ano segundo ano !';
                                } else if ($ano2 < $ano1) {
                                        return 'Segundo ano digitado é menor que ano primeiro ano !';
                                }else if ($ano2 == $ano1) {
                                        return 'Primeiro ano digitado e o segundo ano são iguais!';
                                }  else {
                                        return true;
                                }    
                        }      
                       

                } else {
                         
                        $ano = implode ($ano);
                        $total = strlen ($ano);
    
                        if ($total <= 3) {

                                return "Ano de fabricaçao inválido !";
        
                        }else {
                               if ($ano > $anoAtual) {
                                       return 'Ano digitado é maior que ano atual !';
                                } else {
                                        return true;
                                }
                        }
                }
        }
        
        public function Editar($id){
                $this->VerificarLogin();
                $this->VerificarNivel(2); 
                
                $dados = array();
                $ModelVeiculo = new ModelVeiculo();

                $id_cliente = $modelo = $marca = $ano = $cor = $placa = "";
                
                if ( isset ( $_POST["id_cliente"] ) ) {
                        $id_cliente = trim ( $_POST["id_cliente"] ); 	
                }
                if ( isset ( $_POST["modelo"] ) ) {
                        $modelo = trim ( $_POST["modelo"] ); 	
                }
                if ( isset ( $_POST["marca"] ) ) {
                        $marca = trim ( $_POST["marca"] ); 	
                }
                if ( isset ( $_POST["ano"] ) ) {
                        $ano = trim ( $_POST["ano"] ); 	
                }
                if ( isset ( $_POST["cor"] ) ) {
                        $cor = trim ( $_POST["cor"] ); 	
                }
                if ( isset ( $_POST["placa"] ) ) {
                        $placa = trim ( $_POST["placa"] ); 	
                }
        
                $ResultData = $this->ValidaData($ano);

                if ( empty ( $id_cliente ) ) {
                        echo '<script>alert("Preencha o Campo CODIGO CLIENTE");history.back();</script>';
                        
                }else if ( empty ( $modelo ) ) {
                        echo '<script>alert("Preencha o Campo MODELO");history.back();</script>';
                        
                }else if ( empty ( $marca ) ) {
                        echo '<script>alert("Preencha o Campo MARCA");history.back();</script>';
                
                }else if ( empty ( $ano ) ) {
                        echo '<script>alert("Preencha o Campo ANO");history.back();</script>';
        
                }else if ( empty ( $cor ) ) {
                        echo '<script>alert("Preencha o Campo COR");history.back();</script>';
        
                }else if ( empty ( $placa ) ) {
                        echo '<script>alert("Preencha o Campo PLACA");history.back();</script>';
        
                }else if ( $ResultData != 1 ) {
                    echo "<script>alert('$ResultData');history.back();</script>";
                    
                } else{
                
                    $situacao = "Ativo";
                if ($ModelVeiculo->ExistDados2($id,$placa,$situacao)) {

                        echo '<script>alert("Já existi um veiculo com a mesma placa !");history.back();</script>';
        
                        } else {
                                
                            if($ModelVeiculo->EditVeiculo($modelo,$marca,$ano,$cor,$placa,$id_cliente,$id)) {

                                echo '<script>alert("Registro editado com sucesso !");location.href="'.BASE.'Veiculo";</script>';
                                
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
            $ModelVeiculo = new ModelVeiculo();
            
            $id = $_POST['id'];
            $situacao = "Ativo";

            $result = $ModelVeiculo->Verificar($id,$situacao);

            echo json_encode ($result);
            exit;
    
        }

        public function Excluir(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(1);
                $dados = array();
                $ModelVeiculo = new ModelVeiculo();
                
                $id = $_POST['id'];
                $situacao = "Inativo";

                $result = $ModelVeiculo->Excluir($id,$situacao);

                echo json_encode ($result);
                exit;

        }


	
}

