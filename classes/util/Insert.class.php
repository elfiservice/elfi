<?php
/**
 * Description of Insert
 *
 * @author Armando
 */
class Insert extends Conexao {
    
	private $select;
	private $sql;
	private $resultado;
	private $conexao;
	private $query;
	
	public function ExecInsert($tabela, $camposBd, $valores, $parseString=null) {
	
/* @var $camposBd type */
        $this->select = "INSERT INTO {$tabela} ({$camposBd})  VALUES ({$valores})";
		$this->executar();
	}
	
	public function getResultado(){
		return $this->resultado;
	}
	
	private function  conectarBD(){
		$this->conexao = parent::conectar();
	
	}
	
	private function executar(){
		$this->conectarBD();
	
		$this->sql = mysql_query($this->select);
	
		if($this->sql){
			$this->resultado=true;
		}else{
			$this->resultado=false;
		}
	
	
	}
	
	

}
