<?php

$sql_user = mysql_query("SELECT * FROM colaboradores WHERE 	id_colaborador='$logOptions_id'") or die (mysql_error());
$linha_user = mysql_fetch_object($sql_user);
?>