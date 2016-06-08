<?php


class Update extends Conexao{
	

	private $select;
	private $sql;
	private $resultado;
	private $conexao;
	private $query;
	
	public function ExecUpdate($tabela, $camposDados, $termos, $parseString=null) {
	
		$this->select = "UPDATE {$tabela} SET {$camposDados} {$termos}";
		$this->executar();
	}
	
	public function getResultado(){
		return $this->resultado;
	}
	
	private function  conectarBD(){
		$this->conexao = parent::conectarMysqli();
	
	}
	
	private function executar(){
		$this->conectarBD();
	
		//$this->sql = mysql_query($this->select);
                $this->sql = $this->conexao->query($this->select);
		if($this->sql){
			$this->resultado=true;
		}else{
			$this->resultado=false;
		}
	
	
	}
	
	
	
}