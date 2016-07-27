<?php

/**
 * Log [ MODEL ]
 * Modelar a entidade de LOG's, TABELA logs
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Log {

    private $id;
    private $data;
    private $id_colab;
    private $atividade;
    private $setor;
    private $visualizado;
    private $ip;
    private $mostrar;

    public function __construct($id = NULL, $data = NULL, $id_colab = NULL, $atividade = NULL, $setor = NULL, $visualizado = NULL, $ip = NULL, $mostrar = 1) {
        $this->id = $id;
        $this->data = $data;
        $this->id_colab = $id_colab;
        $this->atividade = $atividade;
        $this->setor = $setor;
        $this->visualizado = $visualizado;
        $this->ip = $ip;
        $this->mostrar = $mostrar;
    }

    public function getMostrar() {
        return $this->mostrar;
    }

    public function setMostrar($mostrar) {
        $this->mostrar = $mostrar;
    }

        
    public function getId() {
        return $this->id;
    }

    public function getData() {
        return $this->data;
    }

    public function getId_colab() {
        return $this->id_colab;
    }

    public function getAtividade() {
        return $this->atividade;
    }

    public function getSetor() {
        return $this->setor;
    }

    public function getVisualizado() {
        return $this->visualizado;
    }

    public function getIp() {
        return $this->ip;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setId_colab($id_colab) {
        $this->id_colab = $id_colab;
    }

    public function setAtividade($atividade) {
        $this->atividade = $atividade;
    }

    public function setSetor($setor) {
        $this->setor = $setor;
    }

    public function setVisualizado($visualizado) {
        $this->visualizado = $visualizado;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }


    
}
