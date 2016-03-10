<?php

class UsuarioDAO{
	
	public function UsuarioDAO(){
		
	}
	
	public function buscarUsuario($id){
		$sql_user = mysql_query("SELECT * FROM colaboradores WHERE 	id_colaborador='$id'") or die (mysql_error());
		$linha_user = mysql_fetch_object($sql_user);
		return $linha_user;
	}
}
?>