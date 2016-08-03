<?php

require './../classes/Config.inc.php';
include "./../checkuserlog.php";
//
//                $consulta_orc = mysql_query("select * from orcamentos");
//		$linhaass = mysql_num_rows($consulta_orc);
//										
//		while($row =mysql_fetch_array($consulta_orc))
//			
//                     { 
//
//                    if(strpos($row['vr_total_orc'], ',')){     //VERIFICA SE TEM , NA NUMERAÇÃO
//                        $id = $row['id'];
//                        $vr_material_orc = $row['vr_total_orc']. " - ". Formatar::moedaBD($row['vr_total_orc']) ." - {$id}<br>";
//                        
//                        $vr_material =  Formatar::moedaBD($row['vr_total_orc']);
//                        mysql_query("UPDATE orcamentos SET vr_total_orc = '$vr_material' WHERE id = $id");
//                    }     
//                    echo $vr_material_orc;
//                     }



//$setor = "tec";
//$logCtrl = new LogCtrl();
//$logs = $logCtrl->buscarBD("*", "WHERE ( id_colab != '1' ) AND (setor LIKE '%ad%' OR setor LIKE '%".$setor."%') ");
//
//var_dump($logs);
//$countNotf = 0;
//foreach ($logs as $key => $campo) {
//
//    $arrIdsColabs = explode(',', $campo->getVisualizado());
//    $flag = TRUE;
//    foreach ($arrIdsColabs as $key => $id_colab_visual) {
//      
//        if ($id_colab_visual == $_SESSION['id']) {
//            $flag = FALSE;
//        }
//    }
//    
//    if($flag == TRUE){
//        $countNotf++;
//    }
//    
//}
//
//echo $countNotf;

$notCtrl = new NotificacaoCtrl();
echo $notCtrl->notificar($_SESSION['id'], "tec");

exit;

foreach ($logs as $key => $campo) {

    $arrIdsColabs = explode(',', $campo->getVisualizado());
    $flag = TRUE;
    foreach ($arrIdsColabs as $key => $id_colab_visual) {
      
        if ($id_colab_visual == $_SESSION['id']) {
            $flag = FALSE;
        }
    }
    
    if($flag == TRUE){
        $arrIdsColabs[] = $_SESSION['id'];
        
        //$countNotf++;
    }
    
    $visualizadas = implode(',', $arrIdsColabs);
    
    var_dump($visualizadas);
}



