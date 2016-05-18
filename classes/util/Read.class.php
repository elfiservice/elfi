<?php
//phpinfo();
//echo phpversion();

class Read extends Conexao{
	
	private $select;
	private $sql;
	private $resultado;
	private $conexao;
	private $query;
	
	public function ExecRead($campo, $tabela, $termos, $parseString=null) {
		
		$this->select = "SELECT {$campo} FROM {$tabela} {$termos}";
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
		if(mysql_num_rows($this->sql) == 1){
			$this->resultado[]=mysql_fetch_assoc($this->sql);
		}else if(mysql_num_rows($this->sql) > 1){
			while($linha =  mysql_fetch_assoc($this->sql)){
				$this->resultado[]=$linha;
			}
		} 
                                }else{
                                    $this->resultado['erro']=false;
                                }
		
	}
	

	
}




