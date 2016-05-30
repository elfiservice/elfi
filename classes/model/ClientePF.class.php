<?php
//include 'Cliente.class.php';
class ClientePF extends Cliente {
	private	$cpf;
	
	public function ClientePF($id,$usuario,$razaoSocial, $nomeFantasia, $classificacao, $tipo, $data_inclusao, $cpf, $endereco, $bairro, $estado, $cidade, $cep, $tel, $cel, $emailTec){
		$this->setId($id);
		$this->setUsuarioQAdd($usuario);
		$this->setRazaoSocial($razaoSocial);
		$this->setNomeFantasia($nomeFantasia);
		$this->setClassificacao($classificacao);
		$this->setTipo($tipo);
		$this->setDataAdd($data_inclusao);
		$this->cpf = $cpf;
		$this->setEndereco($endereco);
		$this->setBairro($bairro);
		$this->setEstado($estado);
		$this->setCidade($cidade);
		$this->setCep($cep);
		$this->setTel($tel);
		$this->setCel($cel);
		$this->setEmailTec($emailTec);
		
	}
	
	
	public function getCpf() {
	         return $this->cpf;
	}
	
	public function setCpf($cpf) {
	         $this->cpf = $cpf;
	}
	
	
}

?>