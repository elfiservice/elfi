<?php

/**
 * Colaborador.class [ MODEL ]
 * Resp modelar Colaborador herdando de Usuario.class na tabela colaboradores
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Colaborador {

    private $cpf;
    private $tipo;
    private $Email;

    public function __construct($cpf, $tipo, $Email) {
        $this->cpf = $cpf;
        $this->tipo = $tipo;
        $this->Email = $Email;
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
