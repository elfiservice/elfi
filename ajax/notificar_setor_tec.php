<?php
    require '../classes/Config.inc.php';
    session_start();

$notCtrl = new NotificacaoCtrl();
if(!empty($_SESSION['userlogin'])):
    $userlogin = $_SESSION['userlogin'];
else:
    ?>  
    <script language= "JavaScript">
        location.href="<?= WWW ?>/conectar.php";
    </script>
    <?php
    die;
endif;

echo "<span class=\"w3-badge w3-red bt-notificacao\">". $notCtrl->notificar($userlogin->getId_colaborador(), "tec") . "</span>";
//$jSon ['result'] =  $notCtrl->notificar(1, "tec");
//
//echo json_encode($jSon);
