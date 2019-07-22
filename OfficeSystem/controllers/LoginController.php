<?php
class LoginController extends controller {

    public function VerificarAcessoAtivo(){

        if (!empty ($_SESSION)) {

            if( ( $_SESSION["sistema"]["cargo"] === 'Admin' ) || ( $_SESSION["sistema"]["cargo"] === 'Atendente' ) ) {
                header("Location: ".BASE."Dashboard");
                exit;
            }
            if( $_SESSION["sistema"]["cargo"] === 'Mecânico' ) {
                header("Location: ".BASE."Painel");
                exit;
            }

        }
        
    }

    public function index(){
        $this->VerificarAcessoAtivo();
        $dados = array();
        
        $this->loadView('Login/Login', $dados);
    }

    public function Verificar() {
        $this->VerificarAcessoAtivo();
        $dados = array();
        $dadoslogin = new ModelLogin();

       
        if ( $_POST ) {

                $login = $senha = "";

                if ( isset ( $_POST["login"] ) )
                    $login = trim ( $_POST["login"] );
                if ( isset ( $_POST["senha"] ) )
                    $senha = trim ( $_POST["senha"] );
        
                if ( empty ( $login ) ) {

                    echo '<script>alert("Preencha o Campo MATRICULA");history.back();</script>';
                    exit;
                } else if ( empty ( $senha ) )  {

                    echo '<script>alert("Preencha o Campo SENHA");history.back();</script>';
                    exit;
                }else {
                    $situacao = "Ativo";
                    $resultLogin = $dadoslogin->Login($login, $situacao);
                    
                
                    if ( empty ( $resultLogin->id ) ) {

                        echo '<script>alert("Matricula ou Senha Invalido(s) !");history.back();</script>';
                        exit;
                    } else if (!password_verify($senha, $resultLogin->senha )  ) {

                        echo '<script>alert("Matricula ou Senha Invalido(s) !");history.back();</script>';
                        exit;
                    }  else if ( $resultLogin->ativo != "Sim" ) {

                        echo '<script>alert("Usuário não está permitido acessa o sistema !");history.back();</script>';
                        exit;
                    }else {

                        $resultNome = $dadoslogin->BuscarUsuario($resultLogin->id, $situacao);
                    
                        
                        $_SESSION["sistema"] =
                        array(
                            "id"=>$resultLogin->id,
                            "matricula"=>$resultLogin->matricula,
                            "nome"=>$resultNome->nome,
                            "cargo"=>$resultLogin->cargo
                        );
                        

                        if ( $_SESSION["sistema"]["cargo"] == 'Admin' || $_SESSION["sistema"]["cargo"] == 'Atendente' ) {
                        
                            header("Location: ".BASE."Dashboard");
                            exit;
                        } else if ( $_SESSION["sistema"]["cargo"] == 'Mecânico' ) {

                            header("Location: ".BASE."Painel");
                            exit;
                        }else {
                            header("Location: ".BASE."Login");
                            exit;
                        }
                }
            }
        }else {
           header("Location: ".BASE."Login");
           exit;
        }
    }

    public function Sair(){
        unset( $_SESSION["sistema"] );
        header("Location: ".BASE."Login");
        exit;
    }

    public function Solicitar() {
        $this->VerificarAcessoAtivo();
        $dados = array();
        $this->loadView('Login/Solicitar', $dados);
    }

    public function VerificarDados() {
        $this->VerificarAcessoAtivo();
        $dados = array();
        $ModelLogin = new ModelLogin();
        $email = "";

        if (isset($_POST['email'])) {

            $email  = trim ( $_POST["email"] ); 

            if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false )   {

                if ($dados = $ModelLogin->VerificarEmail($email)) {
                   $id = $dados->id;
                    $email = $dados->email;
                    $nome = $dados->nome;

                    if ($ModelLogin->VerificarSolicitacao($id)) {
    
                        if ($token = $this->GerarToken($id, $email)) {

                            if ($ModelLogin->SalvarSolicitacao($id, $token)) {  
                        
                                $msg = $this->EnviarEmail($nome, $email, $token);
                                if ($msg != 1) {
                
                                    echo '<script>alert("'.$msg.'");location.href="'.BASE.'Login";</script>';
                                    exit;
                
                                }

                            }else {
                                echo "<script>alert('Ocorreu Algum Erro !');history.back();</script>";
                                exit;
                            }
    
                        }else {
                            echo "<script>alert('Ocorreu Algum Erro !');history.back();</script>";
                            exit;
                        }

                    }else {
                        echo "<script>alert('Ocorreu Algum Erro !');history.back();</script>";
                        exit;
                    }

                } else {
                    echo "<script>alert('E-mail invalido !');history.back();</script>";
                    exit;
                }

            }else {
                echo "<script>alert('E-mail invalido !');history.back();</script>";
                exit;
            }
            
        }else {
            echo "<script>alert('Ocorreu Algum Erro !');history.back();</script>";
            exit;
        }

    }

    private function GerarToken($id, $email) {
        $this->VerificarAcessoAtivo();
        if ($token = password_hash($id.'/'.$email, PASSWORD_ARGON2I)){
            return $token;
            exit;
        }else {
            return false;
            exit;
        }

    }

    private function EnviarEmail($nome, $email, $token) {
        $this->VerificarAcessoAtivo();
        $url = BASE.'login/Novo/'.$token;
        $to = $email;
        $subject  = 'Solicitação de Nova Senha';

        $message = '
            <html>
                <head>
                    <title>OfficeSystem</title>
                </head>
                <body>
                    <h1>Olá, '.$nome.' !</h1>
                    <br>
                    Aqui está o link para cadastrar uma nova senha de acesso !
                    <br><br>
                    '.$url.'
                    <br><br>
                    <h5>Obs: Office System - Controle de Manutenções.</h5>
   
                </body>
            </html>';

        $headers  = 'MIME-Version: 1.1' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: $email\n";

        $msg = mail($to, $subject , $message , $headers);

        if($msg){

            return "E-mail enviado com sucesso !";
            exit;
        } else {

            return "Erro ao enviar e-mail\n Tente novamente mais tarde!";
            exit;
        }

    }

    public function Novo() {
        $this->VerificarAcessoAtivo();
        $dados = array();
        $ModelLogin = new ModelLogin();
        $token = explode('/', $_SERVER["REQUEST_URI"], 5);
        $token = $token[4];

        if (!empty($token)){
            
            if ($ModelLogin->VerificarToken($token)) {

                $dados['token'] = $token;
        
                $this->loadView('Login/NovaSenha', $dados);
            }else {
               header("Location: ".BASE."Login");
               exit;
            }
            
        }else {
            header("Location: ".BASE."Login");
            exit;
        }

    }

    public function Confirmar() {
        $this->VerificarAcessoAtivo();
        $dados = array();
        $ModelLogin = new ModelLogin();
        $senha = $senha2 = $email = "";

        if(isset($_SESSION['sistema'])) {
            header("Location: ".BASE."Login");
        }
        if ( isset ( $_POST["email"] ) ) {
            $email = trim ( $_POST["email"] ); 	
        }
        if ( isset ( $_POST["senha"] ) ) {
            $senha = trim ( $_POST["senha"] ); 	
        }
        if ( isset ( $_POST["senha2"] ) ) {
            $senha2 = trim ( $_POST["senha2"] ); 	
        }
        if ( isset ( $_POST["token"] ) ) {
            $token = trim ( $_POST["token"] ); 	
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            echo "<script>alert('E-mail Invalido !');history.back();</script>";
            exit;	
        }
        else if ( empty ( $senha ) ) {
            echo "<script>alert('Preencher o Campo Senha !');history.back();</script>";
            exit;	
        }
        else if ( empty ( $senha ) ) {
            echo "<script>alert('Preencher o Campo Confirmar Senha !');history.back();</script>";
            exit; 	
        } 
        else if ($senha === $senha2) {

            if ($dados = $ModelLogin->BuscarDados($token)) {

                if ($email === $dados->email) {

                    $result = $dados->id.'/'.$dados->email;

                    if (password_verify($result, $token)) {
    
                        $senha = password_hash($senha, PASSWORD_ARGON2I);
    
                        if ($dados = $ModelLogin->AlterarPassword($dados->id, $senha)) {  
    
                            echo '<script>alert("Senha alterada com sucesso !");location.href="'.BASE.'Login";</script>';
                            exit;
    
                        } else {
                            echo "<script>alert('Ocorreu algum erro de verificação !');history.back();</script>";
                            exit;
                        }
    
                    } else {
                        echo "<script>alert('Dados invalidos !');history.back();</script>";
                        exit;
                    }

                } else {
                        echo "<script>alert('E-mail invalido !');history.back();</script>";
                        exit;
                }

            } else {
                echo "<script>alert('Ocorreu algum erro de verificação !');history.back();</script>";
                exit;
            }

        }else {
            echo "<script>alert('Senha digita não confere com a senha de confirmação !');history.back();</script>";
            exit; 
        }   

    }

}