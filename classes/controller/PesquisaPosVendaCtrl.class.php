<?php

/**
 * PesquisaPosVendaCtrl.class [ Controller ]
 * Responsavel por fazer o Controle da View com o BDados
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class PesquisaPosVendaCtrl {
    /**  @var PesquisaPosVendaDAO   */
    private $OrcDao;
    
    	public function __construct(){
	 	$this->OrcDao = new PesquisaPosVendaDAO();
	 }
         
                           public function inserirPesquisa($pesquisaObj){
                      $camposBd = "id_orc, id_cliente, confiabilidade, pontualidade, disponibilide, qualidade, normasseguranca, apresentacao, envolvimento, educacao, organizacao, competencia, orcamento, servico, satisfeito, outrosComentarios, data";
                     //echo$camposBd;
                      if($pesquisaObj instanceof PesquisaPosVenda){
                         
                        
                         $valores = "'{$pesquisaObj->getId_orc()}',"
                         . "'{$pesquisaObj->getId_cliente()}',"
                         . "'{$pesquisaObj->getConfiabilidade()}',"
                         . "'{$pesquisaObj->getPontualidade()}',"
                         . "'{$pesquisaObj->getDisponibilide()}',"
                         . "'{$pesquisaObj->getQualidade()}',"
                         . "'{$pesquisaObj->getNormasseguranca()}',"
                         . "'{$pesquisaObj->getApresentacao()}',"
                         . "'{$pesquisaObj->getEnvolvimento()}',"
                         . "'{$pesquisaObj->getEducacao()}',"
                         . " '{$pesquisaObj->getOrganizacao()}',"
                         . " '{$pesquisaObj->getCompetencia()}',"
                         . " '{$pesquisaObj->getOrcamento()}',"
                         . " '{$pesquisaObj->getServico()}',"
                         . " '{$pesquisaObj->getSatisfeito()}',"
                         . " '{$pesquisaObj->getOutrosComentarios()}',"
                         . " '{$pesquisaObj->getData()}' ";
                                   
                                 //var_dump($camposBd);
                                // var_dump($valores);
                                 
                                // var_dump($this->OrcDao->insert($camposBd, $valores, "orcamentos"));
                                         
                                 if($this->OrcDao->insert($camposBd, $valores)){
                                     return true;
                                 }else{
                                     return false;
                                 }
                                 
                      }else{
                          return false;
                      }
                      
                      
                  }
}
