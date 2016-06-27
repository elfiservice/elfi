<?php
class ClienteDAO {
	
	public function ClienteDAO() {
		
	}
	
	public function buscarCliente($id, $tipo){
		$sql = mysql_query("SELECT * FROM clientes WHERE id='$id' AND tipo='$tipo'") or die (mysql_error());
		$linha = mysql_fetch_object($sql);
		return $linha;
	}
	
	public function buscarClientePorRazaoSocial($razaoSocial){
		$sql = mysql_query("SELECT * FROM clientes WHERE razao_social ='$razaoSocial'") or die (mysql_error());
		$linha = mysql_fetch_object($sql);
		return $linha;
	}
	
	public function select($campo, $termos){
		$read = new Read();
		$read->ExecRead($campo, "clientes", $termos);
		return $read->getResultado();
	}
}
