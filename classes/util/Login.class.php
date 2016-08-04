<?php

/**
 * Login.class [ MODEL ]
 * Resp por autenticar, validar, e checar usuario do sistema Login.
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Login {
    private $level;
    private $email;
    private $senha;
    private $error;
    private $result;
    
    public function __construct($level) {
        $this->level = (int)$level;
    }
    
    public function exeLogin(array $userData) {
        $this->email = (string) strip_tags(trim($userData['user']));
        $this->senha = (string) strip_tags(trim($userData['pass']));
        $this->setLogin();
    }

    public function getError() {
        return $this->error;
    }

    public function getResult() {
        return $this->result;
    }
    
    public function checkLogin() {
        if(empty($_SESSION['userlogin']) || $_SESSION['userlogin']['user_level'] < $this->level){
            unset($_SESSION['userlogin']);
            return FALSE;
        }else{
            return TRUE;
        }
    }



    private function setLogin() {
        if(!$this->email || !$this->senha || !Check::email($this->email)){
            $this->error = array('Informe seu Email e senha para efetuar o login!', WS_INFOR);
            $this->result = false;
        }else if(!$this->getUser()){
            $this->error = array('Os dados informados não são compativeis!', WS_ALERT);
            $this->result = false;
        }else if($this->result['user_level'] < $this->level){
            $this->error = array("{$this->result['user_name']}, você nao tem permissao para acessar a esta area.", WS_ERROR);
            $this->result = false;
        }else{
            
            $this->execute();
        }
    }
    
    private function getUser() {
        $this->senha = md5($this->senha);
        
        $read = new Read();
        $read->exeRead("ws_users", "WHERE user_email = :email AND user_password = :pass", "email={$this->email}&pass={$this->senha}");
        if($read->getResult()){
            $this->result = $read->getResult()[0];
            return true;
             }else{
                 return FALSE;
             }
    }
            
    private function execute() {
        if(!session_id()){
            session_start();
        }
        $_SESSION['userlogin'] = $this->result;
        $this->error = array("Ola {$this->result['user_name']}, seja bem vindo(a). Aguarde redirecionamento. ", WS_ACCEPT);
        $this->result = true;
    }
    
}
