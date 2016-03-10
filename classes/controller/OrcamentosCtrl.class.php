<?php 

include '../classes/dao/OrcamentoDAO.class.php';

class OrcamentoCtrl{
	 private $OrcDao;
	 
	public function OrcamentoCtrl(){
	 	$this->OrcDao = new OrcamentoDAO();
	 }
	 
	public function nDeOrcPorUsuario($nomeUsuarioLogado){
		
		return $this->OrcDao->buscarOrcamentosPorUsuario($nomeUsuarioLogado);
	}
	
	public function nOrcNAprovadoPorUsuarioAcompanhando($nomeUsuarioLogado){
		return $this->OrcDao->buscarHistoricoOrcNAprovadosPorUser($nomeUsuarioLogado);
	}
	
	public function nOrcAprovadoPorUsuarioAcompanhando($nomeUsuarioLogado){
		return $this->OrcDao->buscarHistoricoOrcAprovadoPorUser($nomeUsuarioLogado);
	}
	
	public function nOrcUsuarioAcompanhando($nomeUsuarioLogado){
		return $this->OrcDao->burcarNOrcAcompanhando($nomeUsuarioLogado);
	}
	
	
}

?>