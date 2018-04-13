<?php

/**
 * CRUDAbstract.class [ ABSTRACT ]
 * Responsavel por Padronizar o CRUD do sistema para cada Entidade
 * @copyright (c) 2018, Armando JR. ELFISERVICE
 */
abstract class CRUDAbstract {
   

    public function delete($termos, $tabela = self::Tabela) {
        
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
