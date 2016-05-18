<?php

/**
 * EmpresaCtrl.class [ Crontrole ]
 * Descricao: Fazer o controle da consultas da View com o DAO
 * @copyright (c) year, Armando JR. ELFISERVICE
 */
class EmpresaCtrl {
    private $empresaDAO;
    private $result;
    
    public function __construct() {
        $this->empresaDAO = new EmpresaDAO();
    }
    
    public function getResult() {
        return $this->result;
    }

    public function setResult($result) {
        $this->result = $result;
    }


    public function buscarEmpresa($campos, $termos){
//        $this->result = $this->empresaDAO->select($campos, $termos);
//                      if(!$this->getResult() == "" || !$this->getResult() == null){
//                       $dados = $this->getResult()[0];
//                          $this->setResult($dados) ;
//                     //  var_dump($this->getResult());
//                        extract($this->getResult());
//                        
//                      return new Empresa($id, $razao_social, $nome_fantasia, $cnpj, $cpf, $ie, $rg, $endereco, $bairro, $cep, $estado, $cidade, $tel, $cel, $email_tec, $email_adm, $mostrar);
//                      }else{
//                          return null;
//                      }
        
                $empresaDao = $this->empresaDAO->select($campos, $termos);
                      if(!$empresaDao == "" || !$empresaDao == null){
                       $dados = $empresaDao[0];
                          $this->setResult($dados) ;
                     //  var_dump($this->getResult());
                        extract($this->getResult());
                        
                      return new Empresa($id, $razao_social, $nome_fantasia, $cnpj, $cpf, $ie, $rg, $endereco, $bairro, $cep, $estado, $cidade, $tel, $cel, $email_tec, $email_adm, $mostrar);
                      }else{
                          return null;
                      }
    }
    

}
