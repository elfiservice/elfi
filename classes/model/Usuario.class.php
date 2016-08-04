<?php

//include '../classes/dao/UsuarioDAO.class.php';

class Usuario{
	
	private $id;
	private $login;
	private $senha;

	private $ultima_data_logado;
	private $email_ativado;

	

	
        
        
        
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
	

	
	public function getUltDataLogado(){
		return $this->ultima_data_logado;
	}
	
	public function setUltDataLogado($pUltDataLogado){
		return $this->ultima_data_logado = $pUltDataLogado;
	}
	

	

	
	public function getEmailAtivado(){
		return $this->email_ativado;
	}
	
	public function setEmailAtivado($pEmailAtivado){
		return $this->email_ativado = $pEmailAtivado;
	}	
	




            
        
	
}
