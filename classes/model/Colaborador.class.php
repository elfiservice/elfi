<?php
//require 'Usuario.class.php';
class Colaborador extends Usuario {

    private $cpf;
    private $tipo;
    private $email;
    
    function __construct($pId, $pLogin, $pSenha, $cpf, $tipo, $email, $pUltDataLogado, $pEmailAtivado) {
        $this->cpf = $cpf;
        $this->tipo = $tipo;
        $this->email = $email;
        $this->setId($pId);
        $this->setLogin($pLogin);
        $this->setSenha($pSenha);
        $this->setUltDataLogado($pUltDataLogado);
        $this->setEmailAtivado($pEmailAtivado);
        
        
    }
    
    function getCpf() {
        return $this->cpf;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getEmail() {
        return $this->email;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setEmail($email) {
        $this->email = $email;
    }




}
