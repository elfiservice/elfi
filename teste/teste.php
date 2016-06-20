<?php
require './../classes/Config.inc.php';
    include "./../checkuserlog.php";

                $consulta_orc = mysql_query("select * from orcamentos");
		$linhaass = mysql_num_rows($consulta_orc);
										
		while($row =mysql_fetch_array($consulta_orc))
			
                     { 

                    if(strpos($row['vr_total_orc'], ',')){     //VERIFICA SE TEM , NA NUMERAÇÃO
                        $id = $row['id'];
                        $vr_material_orc = $row['vr_total_orc']. " - ". Formatar::moedaBD($row['vr_total_orc']) ." - {$id}<br>";
                        
                        $vr_material =  Formatar::moedaBD($row['vr_total_orc']);
                        mysql_query("UPDATE orcamentos SET vr_total_orc = '$vr_material' WHERE id = $id");
                    }     
                    echo $vr_material_orc;
                     }

