<?php

//phpinfo();
//echo phpversion();

class Read extends Conexao {

    private $select;
    private $sql;
    private $resultado;
    private $conexao;


    public function ExecRead($campo, $tabela, $termos, $parseString = null) {

        $this->select = "SELECT {$campo} FROM {$tabela} {$termos}";
        $this->executar();
    }

    public function getResultado() {
        return $this->resultado;
    }

    private function conectarBD() {
        $this->conexao = parent::getConn();
    }

    private function executar() {
        $this->conectarBD();

        //$this->sql = @mysql_query($this->select);
        $this->sql = $this->conexao->query($this->select);
        if ($this->sql) {
            if (mysqli_num_rows($this->sql) == 1) {
                $this->resultado[] = mysqli_fetch_assoc($this->sql);
            } else if (mysqli_num_rows($this->sql) > 1) {
                while ($linha = mysqli_fetch_assoc($this->sql)) {
                    $this->resultado[] = $linha;
                }
            }
        } else {
            $this->resultado[] = false;
        }
    }

}
