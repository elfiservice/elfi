<?php
    require '../classes/Config.inc.php';
    require '../checkuserlog.php';
$notCtrl = new NotificacaoCtrl();
echo $notCtrl->notificar($_SESSION['id'], "tec");
//$jSon ['result'] =  $notCtrl->notificar(1, "tec");
//
//echo json_encode($jSon);
