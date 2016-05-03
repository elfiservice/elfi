<?php

class ColaboradorCtrl{
	private $ColaboradorDao;
	
	public function __construct(){
	$this->ColaboradorDao = new ColaboradorDAO();
		
	}
	
	public function buscarColaborador($campos, $termos) {
		return $this->ColaboradorDao->select($campos, $termos);
	}
}