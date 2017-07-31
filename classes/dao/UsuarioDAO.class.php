<?php
/**
 * UsuarioDAO.class [ DAO ]
 * Responsavel gerencia a PErsistencia para Tabela usuario
 * @copyright (c) 2017, Armando JR. ELFISERVICE
 */
class UsuarioDAO implements CRUD{

    const Tabela = 'usuario';
    
    public function delete($termos, $tabela = self::Tabela) {
        return FALSE;
    }

    public function insert($camposBd, $valores, $tabela = self::Tabela) {
        $insert = new Insert();
        $insert->ExecInsert($tabela, $camposBd, $valores);
        return $insert->getResultado();
    }

    public function select($campos, $termos, $tabela = self::Tabela) {
        $read = new Read();
        $read->ExecRead($campos, $tabela, $termos);
        return $read->getResultado();        
    }

    public function update($camposDados, $termos, $tabela = self::Tabela) {
        $update = new Update();
        $update->ExecUpdate($tabela, $camposDados, $termos);
        return $update->getResultado();        
    }

}
