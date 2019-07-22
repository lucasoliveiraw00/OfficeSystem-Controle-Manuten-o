<?php
class ClienteController extends controller {

	public function index() {
                $this->VerificarLogin();
                $this->VerificarNivel(2);

                $dados = array();

                $ModelCliente = new ModelCliente();

                $situacao = "Ativo";
                
                if ( $listDados = $ModelCliente->GetLista($situacao)) {
                        $dados['listDados'] = $listDados;
                    }else {
                        echo '<script>alert("Ocorreu um Erro ao Listar !");location.href="'.BASE.'Dashboard";</script>';
            
                }

                $this->loadTemplateAdmin('Admin/Cliente/Exibir', $dados);
        }

        public function Cadastro() {
                $this->VerificarLogin();
                $this->VerificarNivel(2);
                $dados = array();

        
                $this->loadTemplateAdmin('Admin/Cliente/Cadastro', $dados);
        }

        public function Adicionar(){
                $this->VerificarLogin();
                $this->VerificarNivel(2);
                $dados = array();
                $c = new ModelCliente();
                

                $nome = $cpfcnpj = $dataNasc = $email = $telefone = $celular = $cep = $cidade = $estado = $bairro = $rua = $numEnd = $situacao = "";
                
                if ( isset ( $_POST["nome"] ) ) {
                        $nome = trim ( $_POST["nome"] ); 	
                }
                if ( isset ( $_POST["cpfcnpj"] ) ) {
                        $cpfcnpj = trim ( $_POST["cpfcnpj"] ); 	
                }
                if ( isset ( $_POST["dataNasc"] ) ) {
                        $dataNasc = trim ( $_POST["dataNasc"] ); 	
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
                if ( isset ( $_POST["cep"] ) ) {
                        $cep = trim ( $_POST["cep"] ); 	
                }
                if ( isset ( $_POST["cidade"] ) ) {
                        $cidade = trim ( $_POST["cidade"] ); 	
                }
                if ( isset ( $_POST["estado"] ) ) {
                        $estado = trim ( $_POST["estado"] ); 	
                }
                if ( isset ( $_POST["bairro"] ) ) {
                        $bairro = trim ( $_POST["bairro"] ); 	
                }
                if ( isset ( $_POST["rua"] ) ) {
                        $rua = trim ( $_POST["rua"] ); 	
                }
                if ( isset ( $_POST["numEnd"] ) ) {
                        $numEnd = trim ( $_POST["numEnd"] ); 	
                }

                            $ResultCPFCNPJ =  $this->ValidaCPFCNPJ($cpfcnpj);

                            $ResultData = $this->ValidaData($dataNasc);

                if ( empty ( $nome ) ) {
                        echo '<script>alert("Preencha o Campo NOME");history.back();</script>';
                        
                }else if ( empty ( $cpfcnpj ) ) {
                        echo '<script>alert("Preencha o Campo CPF/CNPJ");history.back();</script>';
                        
                }else if ( empty ( $dataNasc ) ) {
                        echo '<script>alert("Preencha o Campo DATA DE NASCIMENTO");history.back();</script>';
                
                }else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )  {
                        echo '<script>alert("Preencha o Campo E-mail");history.back();</script>';
                        
                }else if ( empty ( $celular ) ) {
                        echo '<script>alert("Preencha o Campo CELULAR");history.back();</script>';
                
                }else if ( empty ( $cep ) ) {
                        echo '<script>alert("Preencha o Campo CEP");history.back();</script>';
                
                }else if ( empty ( $cidade ) ) {
                        echo '<script>alert("Preencha o Campo CIDADE");history.back();</script>';
                
                }else if ( empty ( $estado ) ) {
                        echo '<script>alert("Preencha o Campo ESTADO");history.back();</script>';
                
                }else if ( empty ( $bairro ) ) {
                        echo '<script>alert("Preencha o Campo BAIRRO");history.back();</script>';
                
                }else if ( empty ( $rua ) ) {
                        echo '<script>alert("Preencha o Campo RUA");history.back();</script>';
                
                }else if ( empty ( $numEnd ) ) {
                        echo '<script>alert("Preencha o Campo NUMERO DE ENDEREÇO");history.back();</script>';
                
                }else if ( $ResultCPFCNPJ != 1 ) {
                        echo "<script>alert('$ResultCPFCNPJ');history.back();</script>";
                        
                }else if ( $ResultData != 1 ) {
                        echo "<script>alert('$ResultData');history.back();</script>";
                        
                } else {

                            $dataNasc = $this->FormataData($dataNasc);
                            $situacao = "Ativo";

                        if ($c->ExistDados1($cpfcnpj,$situacao)) {

                                 echo '<script>alert("Já existe um registro com os dados CPF/CNPJ");history.back();</script>';

                        } else if($c->Cadastrar($nome,$cpfcnpj,$dataNasc,$email,$telefone,$celular,$cep,$cidade,$estado,$bairro,$rua,$numEnd,$situacao)) {

                                 echo '<script>alert("Registro salvo com sucesso !");location.href="'.BASE.'Cliente";</script>';

                                } else {

                                 echo '<script>alert("Ocorreu erro ao savar !");history.back();</script>';

                                }

                }
        }

        public function ValidaCPFCNPJ($cpfcnpj) {
                $this->VerificarLogin();
                $this->VerificarNivel(2);
                $cpfcnpj = preg_replace( '/[^0-9]/is', '', $cpfcnpj );
                
                if (strlen($cpfcnpj)  <= 11) {

                        if (strlen($cpfcnpj) != 11) {
                        return "O CPF precisa ter ao menos 11 números !";
                        }

                        if (preg_match('/(\d)\1{10}/', $cpfcnpj)) {
                        return "CPF inválido !";
                        }

                        for ($t = 9; $t < 11; $t++) {
                        for ($d = 0, $c = 0; $c < $t; $c++) {
                                $d += $cpfcnpj{$c} * (($t + 1) - $c);
                        }
                        $d = ((10 * $d) % 11) % 10;
                        if ($cpfcnpj{$c} != $d) {
                                return "CPF inválido !";
                        }
                        }
                        return true;

                } else if (strlen($cpfcnpj) <= 14) {
                        
                        $cpfcnpj = preg_replace('/[^0-9]/', '', (string) $cpfcnpj);

                        if (strlen($cpfcnpj) != 14)
                        return "CNPJ precisa ter ao menos 14 números !";

                        if (preg_match('/(\d)\1{13}/', $cpfcnpj)) {
                                return "CNPJ inválido !";
                        }
                                
                        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
                        {
                                $soma += $cpfcnpj{$i} * $j;
                                $j = ($j == 2) ? 9 : $j - 1;
                        }
                        $resto = $soma % 11;
                        if ($cpfcnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
                                return "CNPJ inválido !";

                        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
                        {
                                $soma += $cpfcnpj{$i} * $j;
                                $j = ($j == 2) ? 9 : $j - 1;
                        }
                        $resto = $soma % 11;
                        if ($cpfcnpj{13} == ($resto < 2 ? 0 : 11 - $resto)) {
                            return true;
                        }else {
                            return "CNPJ inválido !";
                        }
                        

                }
        }
        
        public function ValidaData($dataNasc){
                $this->VerificarLogin();
                $this->VerificarNivel(2);
                $dataNasc = explode('/', $dataNasc);
                $checkdate = $dataNasc;
                $ValidaDataNasc = $dataNasc;
                
                if ( count ($dataNasc) == 3) {
                    
                  $dataNasc = implode ($dataNasc);
                  $dataNasc = strlen ($dataNasc);
    
    
                    if ($dataNasc <= 7) {
                            return "Data de nacimento invalida ! ";
    
                    }  else {
    
                        if(count($checkdate) == 3){
                            $dia = (int)$checkdate[0];
                            $mes = (int)$checkdate[1];
                            $ano = (int)$checkdate[2];
                        
                                if(checkdate($mes, $dia, $ano)){

                                    $ValidaDataNasc =  $ValidaDataNasc[2]."-".$ValidaDataNasc[1]."-".$ValidaDataNasc[0];
                                    date_default_timezone_set('America/Sao_Paulo');

                                    $dataAtual = date('Y-m-d');

                                    if ($ValidaDataNasc >= $dataAtual) {

                                        return "Data de nacimento é maior que data atual !";

                                    }else {

                                        return true;

                                    }
                                }else{
                                    return "Data de nacimento é inválida !";
                                }
    
                        }else {
                            return "Formato da data de nacimento inválido !";
                            }
                    } 
                } else {
                    return "Formato da data de nacimento inválido!";
                    } 
        }

       
        public function FormataData($dataNasc) {
                $this->VerificarLogin();
                $this->VerificarNivel(2);
                $dataNasc = explode("/",$dataNasc);
                return $dataNasc[2]."-".$dataNasc[1]."-".$dataNasc[0];
        }

        public function Dados($id){
                $this->VerificarLogin();
                $this->VerificarNivel(2);
                $dados = array();
                $ModelCliente = new ModelCliente();
                $situacao = "Ativo";

                if(isset($id) && !empty($id)) {

                        if ($infos = $ModelCliente->GetCliente($id,$situacao)) {
                            $dados['infos'] = $infos;
                        } else {
                            echo '<script>alert("Ocorreu Algum Erro de Busca !");location.href="'.BASE.'Cliente";</script>';
                        }

                } else {
                        header("Location: ".BASE."Cliente");
                        exit;
                }
        
                $this->loadTemplateAdmin('Admin/Cliente/Editar', $dados);
        }


        public function Editar($id){
                $this->VerificarLogin();
                $this->VerificarNivel(2);     
                $dados = array();

                $c = new ModelCliente();
                
                $nome = $cpfcnpj = $dataNasc = $email = $telefone = $celular = $cep = $cidade = $estado = $bairro = $rua = $numEnd = $situacao = "";
                
                if ( isset ( $_POST["nome"] ) ) {
                        $nome = trim ( $_POST["nome"] ); 	
                }
                if ( isset ( $_POST["cpfcnpj"] ) ) {
                        $cpfcnpj = trim ( $_POST["cpfcnpj"] ); 	
                }
                if ( isset ( $_POST["dataNasc"] ) ) {
                        $dataNasc = trim ( $_POST["dataNasc"] ); 	
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
                if ( isset ( $_POST["cep"] ) ) {
                        $cep = trim ( $_POST["cep"] ); 	
                }
                if ( isset ( $_POST["cidade"] ) ) {
                        $cidade = trim ( $_POST["cidade"] ); 	
                }
                if ( isset ( $_POST["estado"] ) ) {
                        $estado = trim ( $_POST["estado"] ); 	
                }
                if ( isset ( $_POST["bairro"] ) ) {
                        $bairro = trim ( $_POST["bairro"] ); 	
                }
                if ( isset ( $_POST["rua"] ) ) {
                        $rua = trim ( $_POST["rua"] ); 	
                }
                if ( isset ( $_POST["numEnd"] ) ) {
                        $numEnd = trim ( $_POST["numEnd"] ); 	
                }
                
                        $ResultCPFCNPJ =  $this->ValidaCPFCNPJ($cpfcnpj);

                        $ResultData = $this->ValidaData($dataNasc);
       

                if ( empty ( $nome ) ) {
                         echo '<script>alert("Preencha o Campo NOME");history.back();</script>';
                        
                }else if ( empty ( $cpfcnpj ) ) {
                         echo '<script>alert("Preencha o Campo CPF/CNPJ");history.back();</script>';
                        
                }else if ( empty ( $dataNasc ) ) {
                         echo '<script>alert("Preencha o Campo DATA DE NASCIMENTO");history.back();</script>';
                
                }else if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )  {
                         echo '<script>alert("Preencha o Campo E-mail");history.back();</script>';
                        
                }else if ( empty ( $celular ) ) {
                         echo '<script>alert("Preencha o Campo CELULAR");history.back();</script>';
                
                }else if ( empty ( $cep ) ) {
                         echo '<script>alert("Preencha o Campo CEP");history.back();</script>';
                
                }else if ( empty ( $cidade ) ) {
                         echo '<script>alert("Preencha o Campo CIDADE");history.back();</script>';
                
                }else if ( empty ( $estado ) ) {
                         echo '<script>alert("Preencha o Campo ESTADO");history.back();</script>';
                
                }else if ( empty ( $bairro ) ) {
                         echo '<script>alert("Preencha o Campo BAIRRO");history.back();</script>';
                
                }else if ( empty ( $rua ) ) {
                         echo '<script>alert("Preencha o Campo RUA");history.back();</script>';
                
                }else if ( empty ( $numEnd ) ) {
                         echo '<script>alert("Preencha o Campo NUMERO DE ENDEREÇO");history.back();</script>';
                
                }else if ( $ResultCPFCNPJ != 1 ) {
                         echo "<script>alert('$ResultCPFCNPJ');history.back();</script>";
                        
                }else if ( $ResultData != 1 ) {
                         echo "<script>alert('$ResultData');history.back();</script>";
                        
                } else {

                            $dataNasc = $this->FormataData($dataNasc);
                            $situacao = "Ativo";
                
                        if ($c->ExistDados2($id, $cpfcnpj, $situacao)) {

                                 echo '<script>alert("Já existe um registro com os dados CPF/CNPJ !");history.back();</script>';
        
                        } else {
      
                              if($c->Editar($nome,$cpfcnpj,$dataNasc,$email,$telefone,$celular,$cep,$cidade,$estado,$bairro,$rua,$numEnd,$situacao,$id)) {

                                  echo '<script>alert("Registro editado com sucesso !");location.href="'.BASE.'Cliente";</script>';

                                } else {

                                    echo '<script>alert("Ocorreu erro ao editar");history.back();</script>';

                                }
                        }
                }
        }

        public function Verificar(){
                $this->VerificarLogin(); 
                $this->VerificarNivel(2);
                $dados = array();
                $ModelCliente = new ModelCliente();
                
                $id = $_POST['id'];
                $situacao = "Ativo";

                $result = $ModelCliente->Verificar($id,$situacao);

                echo json_encode ($result);
                exit;
        
        }

        public function Excluir(){
            $this->VerificarLogin();
            $this->VerificarNivel(1); 
            $dados = array();
            $ModelCliente = new ModelCliente();
            
            $id = $_POST['id'];
            $situacao = "Inativo";

                $result = $ModelCliente->Excluir($id,$situacao);

                echo json_encode ($result);
                exit;
    
        }

}
