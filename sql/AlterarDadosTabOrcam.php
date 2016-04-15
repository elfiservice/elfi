<?php

include_once "../Config/config_sistema.php";

$count = 0;

$sql = "SELECT * FROM orcamentos";
$res = mysql_query( $sql );
while ( $row = mysql_fetch_assoc( $res ) ) {
		
		
	$endereco_contr = $row['endereco_contr'];
	$razao_social_contr = $row['razao_social_contr'];
	$id = $row['id'];
	$n_orc = "SA ".$row['n_orc'];

	
	$count++;
	
	if ($endereco_contr == "" || $endereco_contr== null){
	
	mysql_query("UPDATE orcamentos SET n_orc = '$n_orc' WHERE id ='$id' AND endereco_contr=''")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		echo $count." - ".$id." - ". $razao_social_contr ."FOi Alterado<br>";
	}else{
	
			echo $count." - ".$id." - ". $razao_social_contr ."N�O foi alterado<br>";
	}
}
echo "fim";
?>