<?php

class Update extends Conexao {

    private $select;
    private $sql;
    private $resultado;
    
    /**
     *
     * @var mysqli
     */
    private $conexao;
 

    public function ExecUpdate($tabela, $camposDados, $termos, $parseString = null) {

        $this->select = "UPDATE {$tabela} SET {$camposDados} {$termos}";
        //$this->select = "UPDATE historico_orc_n_aprovado SET  id_orc = '716', contato_cliente = 'asdf', tel_cliente = 'adsf', conversa = 'sad fasd fasd'  WHERE id = 45 AND id_orc = 716";

        $this->executar();
    }

    public function getResultado() {
        return $this->resultado;
    }
    
            /**
     * <b>GetRowCount</b> retorna o numero de linhas da atualziação
     * @return int
     */
    public function getRowCount() {
        return $this->conexao->affected_rows;
    }

    private function conectarBD() {
        $this->conexao = parent::getConn();
    }

    private function executar() {
        $this->conectarBD();
        //$this->sql = mysql_query($this->select);
        $this->sql = $this->conexao->query($this->select);

        if ($this->sql) {

            $this->resultado = true;
        } else {
            $this->resultado = false;
        }
    }

}
