<?php

/**
 * Colaborador.class [ MODEL ]
 * Resp modelar Colaborador herdando de Usuario.class na tabela colaboradores
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Colaborador extends Usuario {

    private $cpf;
    private $tipo;
    private $Email;

    public function __construct($id_colaborador, $Login, $Senha, $cpf, $tipo, $last_log_date, $Email, $email_activated) {
        $this->setId_colaborador($id_colaborador);
        $this->setLogin($Login);
        $this->setSenha($Senha);
        $this->cpf = $cpf;
        $this->tipo = $tipo;
        $this->setLast_log_date($last_log_date);
        $this->Email = $Email;
        $this->setEmail_activated($email_activated);
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

}
