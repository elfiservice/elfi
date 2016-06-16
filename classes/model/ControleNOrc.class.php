<?php

/**
 * ControleNOrc.class [ MODEL ]
 * Modelar Controle de Numero de Orçamentos, indicadores diversos para Orçamentos Aprovados
 * @copyright (c) year, Armando JR. ELFISERVICE
 */
class ControleNOrc {
    private	$id;
private	$mes;
private	$ano;
private	$n_orc_feitos;
private	$produtividade	;
private	$pontual_entrega;
private	$pos_entrega;
private	$nao_conforme;
private	$acompanh_proposta;
private	$novos_clientes;
private	$insatisfacao;


public function __construct($id, $mes, $ano, $n_orc_feitos, $produtividade, $pontual_entrega, $pos_entrega, $nao_conforme, $acompanh_proposta, $novos_clientes, $insatisfacao) {
    $this->id = $id;
    $this->mes = $mes;
    $this->ano = $ano;
    $this->n_orc_feitos = $n_orc_feitos;
    $this->produtividade = $produtividade;
    $this->pontual_entrega = $pontual_entrega;
    $this->pos_entrega = $pos_entrega;
    $this->nao_conforme = $nao_conforme;
    $this->acompanh_proposta = $acompanh_proposta;
    $this->novos_clientes = $novos_clientes;
    $this->insatisfacao = $insatisfacao;
    
    
}

public function getId() {
    return $this->id;
}

public function getMes() {
    return $this->mes;
}

public function getAno() {
    return $this->ano;
}

public function getN_orc_feitos() {
    return $this->n_orc_feitos;
}

public function getProdutividade() {
    return $this->produtividade;
}

public function getPontual_entrega() {
    return $this->pontual_entrega;
}

public function getPos_entrega() {
    return $this->pos_entrega;
}

public function getNao_conforme() {
    return $this->nao_conforme;
}

public function getAcompanh_proposta() {
    return $this->acompanh_proposta;
}

public function getNovos_clientes() {
    return $this->novos_clientes;
}

public function getInsatisfacao() {
    return $this->insatisfacao;
}

public function setId($id) {
    $this->id = $id;
}

public function setMes($mes) {
    $this->mes = $mes;
}

public function setAno($ano) {
    $this->ano = $ano;
}

public function setN_orc_feitos($n_orc_feitos) {
    $this->n_orc_feitos = $n_orc_feitos;
}

public function setProdutividade($produtividade) {
    $this->produtividade = $produtividade;
}

public function setPontual_entrega($pontual_entrega) {
    $this->pontual_entrega = $pontual_entrega;
}

public function setPos_entrega($pos_entrega) {
    $this->pos_entrega = $pos_entrega;
}

public function setNao_conforme($nao_conforme) {
    $this->nao_conforme = $nao_conforme;
}

public function setAcompanh_proposta($acompanh_proposta) {
    $this->acompanh_proposta = $acompanh_proposta;
}

public function setNovos_clientes($novos_clientes) {
    $this->novos_clientes = $novos_clientes;
}

public function setInsatisfacao($insatisfacao) {
    $this->insatisfacao = $insatisfacao;
}


}
