<?php

/**
 * ControleNOrcDAO.class [ DAO ]
 * Responsavel gerencia a PErsistencia para Tabela controle_n_orc
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class ControleNOrcDAO implements CRUD {

    private $tabela;
    private $camposBd;


    public function __construct() {
        $this->tabela = "controle_n_orc";
        $this->camposBd = "id, mes, ano, n_orc_feitos, produtividade, pontual_entrega, pos_entrega, nao_conforme, acompanh_proposta, novos_clientes, insatisfacao";
    }

        public function delete($termos, $tabela = "controle_n_orc") {
        
    }

    public function getCamposBd() {
        return $this->camposBd;
    }

        
    public function insert($camposBd, $valores, $tabela = NULL) {
        $tabelaInsert = ($tabela == NULL ? $this->tabela : $tabela);
        $insert = new Insert();
        $insert->ExecInsert($tabelaInsert, $camposBd, $valores);
        return $insert->getResultado();
    }

    public function select($campos, $termos, $tabela = NULL) {
        if ($tabela) {
            $this->tabela = $tabela;
        }
        $read = new Read();
        $read->ExecRead($campos, $this->tabela, $termos);
        return $read->getResultado();
    }

    public function update($camposDados, $termos, $tabela = NULL) {
                if ($tabela) {
            $this->tabela = $tabela;
        }
        $update = new Update();
        $update->ExecUpdate($this->tabela, $camposDados, $termos);
        return $update->getResultado();
    }

}
