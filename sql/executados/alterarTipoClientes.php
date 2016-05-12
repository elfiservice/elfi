<?php
include_once "../../Config/config_sistema.php";

$count = 0;

$sql = "SELECT * FROM clientes";
$res = mysql_query( $sql );
while ( $row = mysql_fetch_assoc( $res ) ) {
	
	

	$id_cliente = $row['id'];
	$tipoCliente = $row['tipo'];
	$cliente = $row['razao_social'];
	$novoTipo = "PJ";
	
	if ($tipoCliente == "" || $tipoCliente == null || $tipoCliente == "Pessoa Juridica"){
		
		mysql_query("UPDATE clientes SET tipo = '$novoTipo' WHERE id ='$id_cliente' AND cpf=''")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
		echo $count." - ".$id_cliente." - ". $cliente ." foi alterado para ".$novoTipo."<br>";
	}
	
	$count++;
	
}