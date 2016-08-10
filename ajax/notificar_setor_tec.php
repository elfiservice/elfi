<?php
    require '../classes/Config.inc.php';
    session_start();

$notCtrl = new NotificacaoCtrl();
$userlogin = $_SESSION['userlogin'];
echo "<span class=\"w3-badge w3-red bt-notificacao\">". $notCtrl->notificar($userlogin->getId_colaborador(), "tec") . "</span>";
//$jSon ['result'] =  $notCtrl->notificar(1, "tec");
//
//echo json_encode($jSon);
