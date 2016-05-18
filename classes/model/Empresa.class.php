<?php

/**
 * Empresa.class.php [ TIPO ]
 * Descricao: manipular a Empresa Gestor do Sistema
 * @copyright (c) year, Armando JR. ELFISERVICE
 */
class Empresa {

    private $id;
    private $razao_social;
    private $nome_fantasia;
    private $cnpj;
    private $cpf;
    private $ie;
    private $rg;
    private $endereco;
    private $bairro;
    private $cep;
    private $estado;
    private $cidade;
    private $tel;
    private $cel;
    private $email_tec;
    private $email_adm;
    private $mostrar;

    public function __construct($id, $razao_social, $nome_fantasia, $cnpj, $cpf, $ie, $rg, $endereco, $bairro, $cep, $estado, $cidade, $tel, $cel, $email_tec, $email_adm, $mostrar) {
        $this->id = $id;
        $this->razao_social = $razao_social;
        $this->nome_fantasia = $nome_fantasia;
        $this->cnpj = $cnpj;
        $this->cpf = $cpf;
        $this->ie = $ie;
        $this->rg = $rg;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->tel = $tel;
        $this->cel = $cel;
        $this->email_tec = $email_tec;
        $this->email_adm = $email_adm;
        $this->mostrar = $mostrar;
    }

    public function getId() {
        return $this->id;
    }

    public function getRazao_social() {
        return $this->razao_social;
    }

    public function getNome_fantasia() {
        return $this->nome_fantasia;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getIe() {
        return $this->ie;
    }

    public function getRg() {
        return $this->rg;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getTel() {
        return $this->tel;
    }

    public function getCel() {
        return $this->cel;
    }

    public function getEmail_tec() {
        return $this->email_tec;
    }

    public function getEmail_adm() {
        return $this->email_adm;
    }

    public function getMostrar() {
        return $this->mostrar;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRazao_social($razao_social) {
        $this->razao_social = $razao_social;
    }

    public function setNome_fantasia($nome_fantasia) {
        $this->nome_fantasia = $nome_fantasia;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setIe($ie) {
        $this->ie = $ie;
    }

    public function setRg($rg) {
        $this->rg = $rg;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function setCel($cel) {
        $this->cel = $cel;
    }

    public function setEmail_tec($email_tec) {
        $this->email_tec = $email_tec;
    }

    public function setEmail_adm($email_adm) {
        $this->email_adm = $email_adm;
    }

    public function setMostrar($mostrar) {
        $this->mostrar = $mostrar;
    }


    
}
