<?php

include './classes/Config.inc.php';
session_start();

$login = new Login();
if (!$login->checkLogin()) {
    header("Location: conectar.php");
} else {
    $userlogin = $login->getSession();
}

LogCtrl::inserirLog($userlogin->getId(), "Colaborador saiu do sistema", $userlogin->getTipo());

$login->destroySession();
header("Location: conectar.php");

