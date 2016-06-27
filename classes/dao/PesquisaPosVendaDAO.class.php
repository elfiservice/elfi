<?php

/**
 * PesquisaPosVendaDAO.class [ DAO ]
 * Responsavel por fazer a persistencia no BDados
 * @copyright (c) year, Armando JR. ELFISERVICE
 */
class PesquisaPosVendaDAO implements CRUD {
    
    const Tabela = 'pesquisa_pos_venda';
    
    
            public function insert($camposBd, $valores, $tabela = self::Tabela){
            $insert = new Insert();
            $insert->ExecInsert($tabela, $camposBd, $valores);
            return $insert->getResultado();
            
        }

    public function delete($termos, $tabela) {
        
    }

    public function select($campos, $termos, $tabela = self::Tabela) {
        $read = new Read();
        $read->ExecRead($campos, $tabela, $termos);
        return $read->getResultado();
    }

    public function update($camposDados, $termos, $tabela) {
        
    }

}
