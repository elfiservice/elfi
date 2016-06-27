<?php

/**
 * PesquisaPosVenda [ Model ]
 * Entidade Pesquisa Pos Venda
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class PesquisaPosVenda {

    private $id;
    private $id_orc;
    private $id_cliente;
    private $confiabilidade;
    private $pontualidade;
    private $disponibilide;
    private $qualidade;
    private $normasseguranca;
    private $apresentacao;
    private $envolvimento;
    private $educacao;
    private $organizacao;
    private $competencia;
    private $orcamento;
    private $servico;
    private $satisfeito;
    private $outrosComentarios;
    private $data;
    
    public function __construct($id, $id_orc, $id_cliente, $confiabilidade, $pontualidade, $disponibilide, $qualidade, $normasseguranca, $apresentacao, $envolvimento, $educacao, $organizacao, $competencia, $orcamento, $servico, $satisfeito, $outrosComentarios, $data) {
        $this->id = $id;
        $this->id_orc = $id_orc;
        $this->id_cliente = $id_cliente;
        $this->confiabilidade = $confiabilidade;
        $this->pontualidade = $pontualidade;
        $this->disponibilide = $disponibilide;
        $this->qualidade = $qualidade;
        $this->normasseguranca = $normasseguranca;
        $this->apresentacao = $apresentacao;
        $this->envolvimento = $envolvimento;
        $this->educacao = $educacao;
        $this->organizacao = $organizacao;
        $this->competencia = $competencia;
        $this->orcamento = $orcamento;
        $this->servico = $servico;
        $this->satisfeito = $satisfeito;
        $this->outrosComentarios = $outrosComentarios;
        $this->data = $data;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

        public function getId() {
        return $this->id;
    }

    public function getId_orc() {
        return $this->id_orc;
    }

    public function getId_cliente() {
        return $this->id_cliente;
    }

    public function getConfiabilidade() {
        return $this->confiabilidade;
    }

    public function getPontualidade() {
        return $this->pontualidade;
    }

    public function getDisponibilide() {
        return $this->disponibilide;
    }

    public function getQualidade() {
        return $this->qualidade;
    }

    public function getNormasseguranca() {
        return $this->normasseguranca;
    }

    public function getApresentacao() {
        return $this->apresentacao;
    }

    public function getEnvolvimento() {
        return $this->envolvimento;
    }

    public function getEducacao() {
        return $this->educacao;
    }

    public function getOrganizacao() {
        return $this->organizacao;
    }

    public function getCompetencia() {
        return $this->competencia;
    }

    public function getOrcamento() {
        return $this->orcamento;
    }

    public function getServico() {
        return $this->servico;
    }

    public function getSatisfeito() {
        return $this->satisfeito;
    }

    public function getOutrosComentarios() {
        return $this->outrosComentarios;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setId_orc($id_orc) {
        $this->id_orc = $id_orc;
    }

    public function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function setConfiabilidade($confiabilidade) {
        $this->confiabilidade = $confiabilidade;
    }

    public function setPontualidade($pontualidade) {
        $this->pontualidade = $pontualidade;
    }

    public function setDisponibilide($disponibilide) {
        $this->disponibilide = $disponibilide;
    }

    public function setQualidade($qualidade) {
        $this->qualidade = $qualidade;
    }

    public function setNormasseguranca($normasseguranca) {
        $this->normasseguranca = $normasseguranca;
    }

    public function setApresentacao($apresentacao) {
        $this->apresentacao = $apresentacao;
    }

    public function setEnvolvimento($envolvimento) {
        $this->envolvimento = $envolvimento;
    }

    public function setEducacao($educacao) {
        $this->educacao = $educacao;
    }

    public function setOrganizacao($organizacao) {
        $this->organizacao = $organizacao;
    }

    public function setCompetencia($competencia) {
        $this->competencia = $competencia;
    }

    public function setOrcamento($orcamento) {
        $this->orcamento = $orcamento;
    }

    public function setServico($servico) {
        $this->servico = $servico;
    }

    public function setSatisfeito($satisfeito) {
        $this->satisfeito = $satisfeito;
    }

    public function setOutrosComentarios($outrosComentarios) {
        $this->outrosComentarios = $outrosComentarios;
    }



}
