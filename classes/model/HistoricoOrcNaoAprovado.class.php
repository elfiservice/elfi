<?php

/**
 * HistoricoOrcNaoAprovado.class [ MODEL ]
 * Modelar dados da Tablea historico_orc_n_aprovado
 * @copyright (c) year, Armando JR. ELFISERVICE
 */
class HistoricoOrcNaoAprovado {

    private $id;
    private $id_orc;
    private $dia_do_contato;
    private $dia_da_edicao;
    private $id_colab;
    private $colab_elfi;
    private $contato_cliente;
    private $tel_cliente;
    private $conversa;
    private $mostrar;

    public function __construct($id, $id_orc, $dia_do_contato, $dia_da_edicao, $id_colab, $colab_elfi, $contato_cliente, $tel_cliente, $conversa, $mostrar) {
        $this->id = $id;
        $this->id_orc = $id_orc;
        $this->dia_do_contato = $dia_do_contato;
        $this->dia_da_edicao = $dia_da_edicao;
        $this->id_colab = $id_colab;
        $this->colab_elfi = $colab_elfi;
        $this->contato_cliente = $contato_cliente;
        $this->tel_cliente = $tel_cliente;
        $this->conversa = $conversa;
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

    public function getId_orc() {
        return $this->id_orc;
    }

    public function getDia_do_contato() {
        return $this->dia_do_contato;
    }

    public function getDia_da_edicao() {
        return $this->dia_da_edicao;
    }

    public function getId_colab() {
        return $this->id_colab;
    }

    public function getColab_elfi() {
        return $this->colab_elfi;
    }

    public function getContato_cliente() {
        return $this->contato_cliente;
    }

    public function getTel_cliente() {
        return $this->tel_cliente;
    }

    public function getConversa() {
        return $this->conversa;
    }



    public function setId_orc($id_orc) {
        $this->id_orc = $id_orc;
    }

    public function setDia_do_contato($dia_do_contato) {
        $this->dia_do_contato = $dia_do_contato;
    }

    public function setDia_da_edicao($dia_da_edicao) {
        $this->dia_da_edicao = $dia_da_edicao;
    }

    public function setId_colab($id_colab) {
        $this->id_colab = $id_colab;
    }

    public function setColab_elfi($colab_elfi) {
        $this->colab_elfi = $colab_elfi;
    }

    public function setContato_cliente($contato_cliente) {
        $this->contato_cliente = $contato_cliente;
    }

    public function setTel_cliente($tel_cliente) {
        $this->tel_cliente = $tel_cliente;
    }

    public function setConversa($conversa) {
        $this->conversa = $conversa;
    }


    
}
