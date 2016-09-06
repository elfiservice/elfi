<?php

/**
 * Estados.class [ Model ]
 * Modelar a entidade de Estados, TABELA estados
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Estados {

    private $cod_estados;
    private $sigla;
    private $nome;

    public function __construct($cod_estados = NULL, $sigla = NULL, $nome = NULL) {
        $this->cod_estados = $cod_estados;
        $this->sigla = $sigla;
        $this->nome = $nome;
    }
    
    public function getCod_estados() {
        return $this->cod_estados;
    }

    public function getSigla() {
        return $this->sigla;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setCod_estados($cod_estados) {
        $this->cod_estados = $cod_estados;
    }

    public function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }



}
