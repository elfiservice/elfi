<?php

include_once "../../Config/config_sistema.php";

$count = 0;

$sql = "SELECT * FROM acompanhamento";
$res = mysql_query( $sql );
while ( $row = mysql_fetch_assoc( $res ) ) {


	$id_acompanhamento = $row['id'];
	$n_orc_acompanhamento = $row['n_orc'];
	$n_orc_acompanhamento = "SA ".$n_orc_acompanhamento;
	$cliente = $row['cliente'];
	
	$sql2 = "SELECT * FROM orcamentos WHERE n_orc='$n_orc_acompanhamento'";
	$res2 = mysql_query( $sql2 );
	while ( $row2 = mysql_fetch_assoc( $res2 ) ) {
	
	
		$id_orcamento = $row2['id'];
		$n_orcamento = $row2['n_orc'];
	
	}
	
	mysql_query("UPDATE historico_orc_aprovado SET id_acompanhamento = '$id_orcamento' WHERE id_acompanhamento ='$id_acompanhamento'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	echo "Id do orc = ".$id_orcamento." N Orcamento = ".$n_orcamento." - id do acompanhamento = ".$id_acompanhamento. " Orc Acomp = ".$n_orc_acompanhamento."<br>";
}

?>