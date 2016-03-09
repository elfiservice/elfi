<?php

class Usuario{
	
	private $id;
	private $login;
	private $senha;
	private $cpf;
	private $tipo;
	private $ultima_data_logado;
	private $email_ativado;
	private $email;
	

	
	public function __construct($pId, $pLogin, $pSenha, $pCpf, $pTipo, $pUlti_data_logado, $pEmail, $pEmail_ativado){
		
		$this->id = $pId;
		$this->login = $pLogin;
		$this->senha = $pSenha;
		$this->cpf = $pCpf;
		$this->tipo = $pTipo;
		$this->ultima_data_logado = $pUlti_data_logado;
		$this->email = $pEmail;
		$this->email_ativado = $pEmail_ativado;
		
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function setId($pId){
		return $this->id = $pId;
	}
	
	public function getLogin(){
		return $this->login;
	}
	
	public function setLogin($pLogin){
		return $this->login = $pLogin;
	}
	
	public function getSenha(){
		return $this->senha;
	}
	
	public function setSenha($pSenha){
		return $this->senha = $pSenha;
	}
	
	public function getCpf(){
		return $this->cpf;
	}
	
	public function setCpf($pCpf){
		return $this->cpf = $pCpf;
	}
	
	public function getTipo(){
		return $this->tipo;
	}
	
	public function setTipo($pTipo){
		return $this->tipo = $pTipo;
	}
	
	public function getUltDataLogado(){
		return $this->ultima_data_logado;
	}
	
	public function setUltDataLogado($pUltDataLogado){
		return $this->ultima_data_logado = $pUltDataLogado;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($pEmail){
		return $this->email = $pEmail;
	}
	
	public function getEmailAtivado(){
		return $this->email_ativado;
	}
	
	public function setEmailAtivado($pEmailAtivado){
		return $this->email_ativado = $pEmailAtivado;
	}	
	
	
	public static function buscaUser($id) {
		$sql_user = mysql_query("SELECT * FROM colaboradores WHERE 	id_colaborador='$id'") or die (mysql_error());
		$linha_user = mysql_fetch_object($sql_user);
		$user = new Usuario($linha_user->id_colaborador, 
							$linha_user->Login,
							$linha_user->Senha,
							$linha_user->cpf,
							$linha_user->tipo,
							$linha_user->last_log_date,
							$linha_user->Email,
							$linha_user->email_activated);
		
		return $user;
	}
	
}

?>