<?php

/**
 * PesquisaPosVendaDAO.class [ DAO ]
 * Responsavel por fazer a persistencia no BDados
 * @copyright (c) year, Armando JR. ELFISERVICE
 */
class PesquisaPosVendaDAO {
    
            public function insert($camposBd, $valores, $tabela = "pesquisa_pos_venda"){
            $insert = new Insert();
            $insert->ExecInsert($tabela, $camposBd, $valores);
            return $insert->getResultado();
            
        }
}
