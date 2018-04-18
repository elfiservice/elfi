<?php

/**
 * Description of HistoricoClientes
 *
 * @author armandojunior
 */
class HistoricoClientesCtrl extends CRUDAbstractCtrl {
    
    private $clienteDao;

    public function HistoricoClientesCtrl() {
        $this->clienteDao = new HistoricoClientesDAO();
    }
    
    public function inserirBD($obj, $dao = null) {
        $daoResult = $this->clienteDao;
        if($dao) {
            $daoResult = $dao;
        }
        return parent::inserirBD($obj, $daoResult);
    }
    
    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($arrayDados) {
        $arrayObj = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            $arrayObj[] = new HistoricoClientes($id, $id_cliente, $alteracao, $data);
        }

        return $arrayObj;
    }

}
