<?php 

include '../classes/dao/OrcamentoDAO.class.php';
include '../classes/model/Orcamento.class.php';

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
	
	public function atualizarOrcamento($ocamentoObj){
		$arrayResultAtualizacao=[];
		if($ocamentoObj instanceof Orcamento){
			
			//$arrayCampoDB = ["n_orc","ano_orc","colaborador_orc","situacao_orc"];
			
			$arrayItensOrc = [
					"n_orc" => $ocamentoObj->getNOrc(),
					"ano_orc" => $ocamentoObj->getAnoOrc(),
					"colaborador_orc" => $ocamentoObj->getColabOrc(),
					"situacao_orc" => $ocamentoObj->getSituacaoOrc()
							
			];
			
						
			foreach ($arrayItensOrc as $campoDb=>$itemOrc){
				if(!$itemOrc == "" || !$itemOrc == null){
					//extract($itemArray);
					if($this->OrcDao->atualizarOrcamentoDao($ocamentoObj->getId(), $itemOrc, $campoDb)){
						$arrayResultAtualizacao[]=[$campoDb=>"OK, atualizado!"];
					}else{
						$arrayResultAtualizacao[]=[$campoDb=>"Erro ao tentar atualizar!!"];
					}
					
				}else{
					$arrayResultAtualizacao[]=[$campoDb=>"Campo vazio, nao atualizado."];
				}
			}
			
			
		}else{
			$arrayResultAtualizacao[]=["Erro, Objeto nao e valido!"];
		}
		
		return $arrayResultAtualizacao;
	}
	
	public function buscarOrcamentos($campos,$termos) {
		$orcamentosDao = $this->OrcDao->buscarOrcamentosDAO($campos, $termos);
		
		return $orcamentosDao;
		
	}
}

?>