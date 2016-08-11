<?php

/**
 * Login.class [ utilitario ]
 * Resp por autenticar, validar, e checar usuario do sistema Login.
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Login extends Conexao {

    private $email;
    private $senha;
    private $error;
    private $result;

    public function exeLogin(array $dadosLogin) {
        $this->email = (string) strip_tags(trim($dadosLogin['login']));
        $this->senha = (string) strip_tags(trim($dadosLogin['senha']));

        $this->setLogin();
    }

    public function checkLogin() {
        if (empty($_SESSION['userlogin'])) {
            unset($_SESSION['userlogin']);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getError() {
        return $this->error;
    }

    public function getResult() {
        return $this->result;
    }

    //PRIVATESZ
    private function setLogin() {

        if (!$this->email || !$this->senha || !Check::email($this->email)) {
            $this->error = array('Informe seu Email e senha para efetuar o login!', WS_INFOR);
            $this->result = false;
        } else if (!$this->getUser()) {
            $this->error = array('Os dados informados não são compativeis!', WS_ALERT);
            $this->result = false;
        } else {

            $this->execute();

//                    // Create the idx session var
//                    $_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$id");
//                    // Create session var for their username
//                    $username = $row["Login"];
//                    $_SESSION['Login'] = $username;
            //mysql_query("UPDATE colaboradores SET last_log_date=now() WHERE id_colaborador = '$id' LIMIT 1");
        } // close while
        // Remember Me Section
//                if ($remember == "yes") {
//                    $encryptedID = base64_encode("g4enm2c0c4y3dn3727553$id");
//                    setcookie("idCookie", $encryptedID, time() + 60 * 60 * 24 * 100, "/"); // Cookie set to expire in about 30 days
//                    setcookie("passCookie", $pass, time() + 60 * 60 * 24 * 100, "/"); // Cookie set to expire in about 30 days
//                }
        // All good they are logged in, send them to homepage then exit script
//                $_SESSION['email'] = $email;
//                $_SESSION['pass'] = $pass;
//                                    $_SESSION['tipo_user'] = $row["tipo"];
//                include './classes/Config.inc.php';
//                LogCtrl::inserirLog($_SESSION['id'], "Colaborador logado", $_SESSION['tipo_user']);
//
//                $header = header("location: index.php");
    }

    private function getUser() {
        $this->senha = md5($this->senha);

        $colabCtrl = new ColaboradorCtrl();
        $colab = $colabCtrl->buscarBD("*", "WHERE Email='$this->email' AND Senha='$this->senha' ");

        if (!empty($colab)) {
            $this->result = $colab[0];
            return true;
        } else {
            return FALSE;
        }
    }

    private function execute() {
        if (!session_id()) {
            session_start();
        }
var_dump($this->result);

        $_SESSION['userlogin'] = $this->result;
        //var_dump($_SESSION['userlogin']);
        //die;
        //DEVIDO ao SISTEMA de LOGIN ANTERIOR - Mantive essas variaveis na Sessao
        $_SESSION['id'] = $this->result->getId_colaborador();
        $_SESSION['Login'] = $this->result->getLogin();
        
        $colab = new Colaborador($this->result->getId_colaborador(), null, null, null, null, date('Y-m-d H:i:s'), null, null);
        $colabCtrl = new ColaboradorCtrl();
         if($colabCtrl->atualizarBD($colab)){
            $this->result->setLast_log_date(date('Y-m-d H:i:s'));
         }
        LogCtrl::inserirLog($this->result->getId_colaborador(), "Colaborador logado", $this->result->getTipo());        

        //var_dump($this->result);
        $this->error = array("Ola {$this->result->getLogin()}, seja bem vindo(a). Aguarde redirecionamento. ", WS_ACCEPT);
        $this->result = true;
       // var_dump($_SESSION['userlogin']);
       // die;
    }

}
