<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HistoricoClientes
 *
 * @author armandojunior
 */
class HistoricoClientes extends CRUDAbstractCtrl {
    
    private $clienteDao;

    public function HistoricoClientes() {
        $this->clienteDao = new HistoricoClientesDAO();
    }
    
    public function inserirBD($obj) {
        return parent::inserirBD($obj, $this->clienteDao);
    }

}
