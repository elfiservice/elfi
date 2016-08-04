<?php

/**
 * Usuario.class [ MODEL ]
 * Resp modelar os Usuarios do Sistema, fornecendo informações Basicas
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */

abstract  class Usuario {

    private $id_colaborador;
    private $Login;
    private $Senha;
    private $email_activated;
    private $last_log_date;

    public function getId_colaborador() {
        return $this->id_colaborador;
    }

    public function getLogin() {
        return $this->Login;
    }

    public function getSenha() {
        return $this->Senha;
    }

    public function getEmail_activated() {
        return $this->email_activated;
    }

    public function getLast_log_date() {
        return $this->last_log_date;
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

    public function setEmail_activated($email_activated) {
        $this->email_activated = $email_activated;
    }

    public function setLast_log_date($last_log_date) {
        $this->last_log_date = $last_log_date;
    }


}
