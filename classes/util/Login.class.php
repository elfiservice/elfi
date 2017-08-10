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

    public function getSession() {
        return $_SESSION['userlogin'];
    }

    public function getError() {
        return $this->error;
    }

    public function getResult() {
        return $this->result;
    }

    public function destroySession() {
        session_destroy();
        unset($_SESSION['userlogin']);
    }
    
    
    ////////////////////
    //PRIVATES
    ///////////////////
    private function setLogin() {

        if (!$this->email || !$this->senha || !Check::email($this->email)) {
            $this->error = array('Informe seu Email e senha para efetuar o login!', WS_INFOR);
            $this->result = false;
        } else if (!$this->getUser()) {
            $this->error = array('Os dados informados não são compativeis!', WS_ALERT);
            $this->result = false;
        } else {
            $this->execute();
        } 
    }

    private function getUser() {
        $this->senha = md5($this->senha);

        $colabCtrl = new UsuarioCtrl();
        $colab = $colabCtrl->buscarBD("*", "WHERE Login='$this->email' AND Senha='$this->senha' ");

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

        $_SESSION['userlogin'] = $this->result;

        //DEVIDO ao SISTEMA de LOGIN ANTERIOR - Mantive essas variaveis na Sessao
        $_SESSION['id'] = $this->result->getId();
        $_SESSION['Login'] = $this->result->getLogin();

        $user = new Usuario($this->result->getId(), null, null, null, null, null, date('Y-m-d H:i:s'));
        $colabCtrl = new UsuarioCtrl();
        if ($colabCtrl->atualizarBD($user)) {
            $this->result->setLast_log_date(date('Y-m-d H:i:s'));
        }
        LogCtrl::inserirLog($this->result->getId(), "Colaborador logado", $this->result->getTipo());

        $this->error = array("Ola {$this->result->getLogin()}, seja bem vindo(a). Aguarde redirecionamento. ", WS_ACCEPT);
        $this->result = true;

    }

}
