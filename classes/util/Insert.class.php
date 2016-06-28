<?php

/**
 * Inseri no BD
 *
 * @author Armando 2016
 */
class Insert extends Conexao {

    private $select;
    private $sql;
    private $resultado;
    private $conexao;

    /**
     * Executa o INSERT
     * @param type $tabela = nome da Tabela a ser Afetada
     * @param type $camposBd = campos a serem afetadas 
     * @param type $valores = valores a serem inseridos
     * @param type $parseString = não utilizada
     */
    public function ExecInsert($tabela, $camposBd, $valores, $parseString = null) {
        $this->select = "INSERT INTO {$tabela} ({$camposBd})  VALUES ({$valores})";
        $this->executar();
    }

    /**
     * 
     * @return boolean
     */
    public function getResultado() {
        return $this->resultado;
    }

    private function conectarBD() {
        $this->conexao = parent::getConn();
    }

    private function executar() {
        $this->conectarBD();
        $this->sql = $this->conexao->query($this->select);

        if ($this->sql) {
            $this->resultado = true;
        } else {
            $this->resultado = false;
        }
    }

}
