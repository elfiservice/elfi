<?php

abstract class Cliente {
	
	private	$id;
	private	$usuario;
	private	$razao_social;
	private	$nome_fantasia;
	private	$classificacao;
	private	$tipo;
	private	$data_inclusao;
	private	$endereco;
	private	$bairro;
	private	$estado;
	private	$cidade	;
	private	$cep;
	private	$tel;
	private	$cel;
	private	$email_tec;

	public function getId() {
	         return $this->id;
	}
	
	public function setId($id) {
	         $this->id = $id;
	}
	
	public function getUsuarioQAdd() {
	         return $this->usuario;
	}
	
	public function setUsuarioQAdd($usuario) {
	         $this->usuario = $usuario;
	}
	
	public function getRazaoSocial() {
	         return $this->razao_social;
	}
	
	public function setRazaoSocial($razao_social) {
	         $this->razao_social = $razao_social;
	}
	
	public function getNomeFantasia() {
	         return $this->nome_fantasia;
	}
	
	public function setNomeFantasia($nome_fantasia) {
	         $this->nome_fantasia = $nome_fantasia;
	}
	
	public function getClassificacao() {
	         return $this->classificacao;
	}
	
	public function setClassificacao($classificacao) {
	         $this->classificacao = $classificacao;
	}
	
	public function getTipo() {
	         return $this->tipo;
	}
	
	public function setTipo($tipo) {
	         $this->tipo = $tipo;
	}
	
	public function getDataAdd() {
	         return $this->data_inclusao;
	}
	
	public function setDataAdd($data_inclusao) {
	         $this->data_inclusao = $data_inclusao;
	}
	
	public function getEndereco() {
	         return $this->endereco;
	}
	
	public function setEndereco($endereco) {
	         $this->endereco = $endereco;
	}
	
	public function getBairro() {
	         return $this->bairro;
	}
	
	public function setBairro($bairro) {
	         $this->bairro = $bairro;
	}
	
	public function getEstado() {
	         return $this->estado;
	}
	
	public function setEstado($estado) {
	         $this->estado = $estado;
	}
	
	public function getCidade() {
	         return $this->cidade;
	}
	
	public function setCidade($cidade) {
	         $this->cidade = $cidade;
	}
	
	public function getCep() {
	         return $this->cep;
	}
	
	public function setCep($cep) {
	         $this->cep = $cep;
	}
	
	public function getTel() {
	         return $this->tel;
	}
	
	public function setTel($tel) {
	         $this->tel = $tel;
	}
	
	public function getCel() {
	         return $this->cel;
	}
	
	public function setCel($cel) {
	         $this->cel = $cel;
	}
	
	public function getEmailTec() {
	         return $this->email_tec;
	}
	
	public function setEmailTec($email_tec) {
	         $this->email_tec = $email_tec;
	}
	

	
}

?>