<?php
$sql_acompa_orc = mysql_query("SELECT * FROM orcamentos WHERE id='$id_orc'") or die (mysql_error());
$linha_orc = mysql_fetch_object($sql_acompa_orc);
?>