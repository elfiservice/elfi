<?php

/**
 * ControleNOrcDAO.class [ DAO ]
 * Responsavel gerencia a PErsistencia para Tabela controle_n_orc
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class ControleNOrcDAO implements CRUD {

    private $camposBd;
const Tabela = 'controle_n_orc';

    public function __construct() {
        $this->tabela = "controle_n_orc";
        $this->camposBd = "id, mes, ano, n_orc_feitos, produtividade, pontual_entrega, pos_entrega, nao_conforme, acompanh_proposta, novos_clientes, insatisfacao";
    }

        public function delete($termos, $tabela = self::Tabela) {
        
    }

    public function getCamposBd() {
        return $this->camposBd;
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
