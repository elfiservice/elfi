<?php

/**
 * Usuario.class [ MODEL ]
 * Resp modelar os Usuarios do Sistema, fornecendo informações Basicas de Login
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Usuario {

    private $id;
    private $id_colaborador;
    private $Login;
    private $Senha;
    private $tipo;
    private $ativo;
    private $last_log_date;
    
    public function __construct($id = null, $id_colaborador = null, $Login = null, $Senha = null, $tipo = null, $ativo = null, $last_log_date = null) {
        $this->id = $id;
        $this->id_colaborador = $id_colaborador;
        $this->Login = $Login;
        $this->Senha = $Senha;
        $this->tipo = $tipo;
        $this->ativo = $ativo;
        $this->last_log_date = $last_log_date;
    }

        public function getId() {
        return $this->id;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getId_colaborador() {
        return $this->id_colaborador;
    }

    public function getLogin() {
        return $this->Login;
    }

    public function getSenha() {
        return $this->Senha;
    }

    public function getLast_log_date() {
        return $this->last_log_date;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }    

    public function setId_colaborador($id_colaborador) {
        $this->id_colaborador = $id_colaborador;
    }

    public function setLogin($Login) {
        $this->Login = $Login;
    }

    public function setSenha($Senha) {
        $this->Senha = $Senha;
    }

    public function setLast_log_date($last_log_date) {
        $this->last_log_date = $last_log_date;
    }
    

}
