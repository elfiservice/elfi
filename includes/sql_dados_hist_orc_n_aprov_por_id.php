<?php 
$sql_acompa_orc = mysql_query("SELECT * FROM historico_orc_n_aprovado WHERE id='$id_historico'") or die (mysql_error());
$linha_orc_n_aprovado = mysql_fetch_object($sql_acompa_orc);
?>