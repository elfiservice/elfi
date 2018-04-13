<?php

/**
 * HistoricoClientesDAO.class [ DAO ]
 * Responsavel gerencia a PErsistencia para Tabela historico_clientes
 * @copyright (c) 2018, Armando JR. ELFISERVICE
 */
class HistoricoClientesDAO extends CRUDAbstract {
    
    const Tabela = 'historico_clientes';
    
    public function insert($camposBd, $valores, $tabela = self::Tabela) {
        return parent::insert($camposBd, $valores, $tabela);
    }

    public function select($campos, $termos, $tabela = self::Tabela) {
        return parent::select($campos, $termos, $tabela);
    }


}
