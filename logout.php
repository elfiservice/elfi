<?php
session_start();
include './classes/Config.inc.php';
// Force script errors and warnings to show on page in case php.ini file is set to not display them
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//-----------------------------------------------------------------------------------------------------------------------------------

//$userlogin = $_SESSION['userlogin'];
//var_dump($_SESSION);
//        exit();
//        LogCtrl::inserirLog("", "Colaborador saiu do sistema", "");

// Unset all of the session variables
        session_destroy();
        unset($_SESSION['userlogin']);
    header("Location: index.php?exe=logoff");
// If it's desired to kill the session, also delete the session cookie
//if (isset($_COOKIE['idCookie'])) {
//    setcookie("idCookie", '', time()-42000, '/');
//	setcookie("passCookie", '', time()-42000, '/');
//}
// Destroy the session variables

// Check to see if their session is in fact destroyed
//if(!session_is_registered('username')){ 
//header("location: index.php"); // << makes the script send them to any page we set
//} else {
//print "<h2>Could not log you out, sorry the system encountered an error.</h2>";
//exit();
//} 
?> 