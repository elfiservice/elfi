<?php
//include 'Cliente.class.php';
class ClientePJ extends Cliente {
	

	private	$cnpj_cpf;
	private	$ie;
	private	$fax;
	private	$email_adm_fin;
	
	public function ClientePJ($id,$usuario,$razaoSocial, $nomeFantasia, $classificacao, $tipo, $data_inclusao, $cnpj, $ie, $endereco, $bairro, $estado, $cidade, $cep, $tel, $cel, $fax, $emailTec, $emailAdm) {
		$this->setId($id);
		$this->setUsuarioQAdd($usuario);
		$this->setRazaoSocial($razaoSocial);
		$this->setNomeFantasia($nomeFantasia);
		$this->setClassificacao($classificacao);
		$this->setTipo($tipo);
		$this->setDataAdd($data_inclusao);
		$this->setCnpj($cnpj);
		$this->setIe($ie);
		$this->setEndereco($endereco);
		$this->setBairro($bairro);
		$this->setEstado($estado);
		$this->setCidade($cidade);
		$this->setCep($cep);
		$this->setTel($tel);
		$this->setCel($cel);
		$this->setFax($fax);
		$this->setEmailTec($emailTec);
		$this->setEmailAdmFin($emailAdm);
		
		
		
	}
	
	public function getCnpj() {
	         return $this->cnpj_cpf;
	}
	
	public function setCnpj($cnpj_cpf) {
	         $this->cnpj_cpf = $cnpj_cpf;
	}
	
	public function getIe() {
	         return $this->ie;
	}
	
	public function setIe($ie) {
	         $this->ie = $ie;
	}
	
	public function getFax() {
	         return $this->fax;
	}
	
	public function setFax($fax) {
	         $this->fax = $fax;
	}
	
	public function getEmailAdmFin() {
	         return $this->email_adm_fin;
	}
	
	public function setEmailAdmFin($email_adm_fin) {
	         $this->email_adm_fin = $email_adm_fin;
	}
	
	
}

?>