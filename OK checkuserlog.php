<?php

session_start();

error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//-----------------------------------------------------------------------------------------------------------------------------------
include_once "Config/config_sistema.php"; 

//require './classes/Config.inc.php';



$dyn_www = $_SERVER['HTTP_HOST'].'/site ELFI/colaboradores'; 
//$dyn_www = $_SERVER['HTTP_HOST'].'/colaboradores'; 
//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
$logOptions = ''; // Initialize the logOptions variable that gets printed to the page
// If the session variable and cookie variable are not set this code runs



if (!isset($_SESSION['idx'])) { 
  if (!isset($_COOKIE['idCookie'])) {
     $logOptions =  'Você não ta logado';

	$mostraremail = "";
	$mostraraniver = "";
	 $logOptions_id = "";
	 
	 /*'<div style="width:120px; background-color:#F0F2F9; border:1px solid #569ABC; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;"><a href="http://' . $dyn_www . '/register.php">Register Account</a></div> <br>
	 
	 <div style="width:50px; background-color:#F0F2F9; border:1px solid #569ABC; border-radius: 10px; -moz-border-radius: 10px; -webkit-border-radius: 10px;"><a href="http://' . $dyn_www . '/login.php">LogIn</a></div>';
	*/ 
	 
   }
}
// Se ID de sess�o estiver definida para logado usu�rio sem cookies Lembre-me conjunto de recursos
if (isset($_SESSION['idx'])) { 
    
	$decryptedID = base64_decode($_SESSION['idx']);
	$id_array = explode("p3h9xfn8sq03hs2234", $decryptedID);
	$logOptions_id = $id_array[1];
    $logOptions_username = $_SESSION['Login'];
    $logOptions_username = substr('' . $logOptions_username . '', 0, 15); // reduzir o nome de usu�rio de comprimento se demasiado longo
	$messages = "messages";
//inicio teste para identificar numero mensagens n�o lidas
//$sql2 = mysql_query("SELECT * FROM private_messages WHERE to_id='$logOptions_id' AND opened='0'"); // 
//$existCount2 = mysql_num_rows($sql2);
//if ($existCount2 == 0) $existCount2 = "";
//fim do teste Mens. nao lidas	
	// Check if this user has any new PMs and construct which envelope to show
	//$sql_pm_check = mysql_query("SELECT id FROM private_messages WHERE to_id='$logOptions_id' AND opened='0' LIMIT 1");
	//$num_new_pm = mysql_num_rows($sql_pm_check);
	//if ($num_new_pm > 0) {
		//$PM_envelope = '<a href="http://' . $dyn_www . '/pm_inbox.php?pg='.$messages.'&user='.$logOptions_username.'">Messages <span style="color:red;">'.$existCount2.'</span></a>';     //<img src="imagens/pm2.gif" width="18" height="11" alt="PM" />
	//} else {
		//$PM_envelope = '<a href="http://' . $dyn_www . '/pm_inbox.php?pg='.$messages.'&user='.$logOptions_username.'">Messages</a>';    //<img src="imagens/pm1.gif" width="18" height="11" alt="PM" />
	//}
    // Ready the output for this logged in user             <li>'. $PM_envelope . ' </li>
    $logOptions = '	<div id="menu">
		 <ul>
		 	<li><a href="http://' . $dyn_www . '" >Painel Central</a></li>
                        <li><a href="http://' . $dyn_www . '/configuracao.php?id_menu=#" >Configuração</a></li>                            

			<li><a href="http://' . $dyn_www . '/logout.php">Sair</a></li>
		 </ul>
	</div>';
$mostraremail = "a";
$mostraraniver = "a";

} else if (isset($_COOKIE['idCookie'])) {// Se o cookie da identifica��o est� ajustado, mas nenhuma identifica��o da sess�o est� ajustada ainda, n�s ajustamos a abaixo e o material da actualiza��o
	
	$decryptedID = base64_decode($_COOKIE['idCookie']);
	$id_array = explode("nm2c0c4y3dn3727553", $decryptedID);
	$userID = $id_array[1]; 
	$userPass = $_COOKIE['passCookie'];
	// Get their user first name to set into session var
    $sql_uname = mysql_query("SELECT Login FROM colaboradores WHERE id_colaborador='$userID' AND Senha='$userPass' LIMIT 1");
	$numRows = mysql_num_rows($sql_uname);
	if ($numRows == 0) {
		echo 'Something appears wrong with your stored log in credentials. <a href="logout.php">Log in again here please</a>';
		exit();
	}
    while($row = mysql_fetch_array($sql_uname)){ 
	    $username = $row["Login"];
	}

    $_SESSION['id'] = $userID; // now add the value we need to the session variable
	$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$userID");
    $_SESSION['Login'] = $username;

    $logOptions_id = $userID;
    $logOptions_uname = $username;
    $logOptions_uname = substr('' . $logOptions_uname . '', 0, 15); 
    ///////////          Update Last Login Date Field       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    mysql_query("UPDATE colaboradores SET last_log_date = now() WHERE id_colaborador = '$logOptions_id'"); 
    // Ready the output for this logged in user
    // Check if this user has any new PMs and construct which envelope to show
	/*
	$sql_pm_check = mysql_query("SELECT id FROM private_messages WHERE to_id='$logOptions_id' AND opened='0' LIMIT 1");
	$num_new_pm = mysql_num_rows($sql_pm_check);
	if ($num_new_pm > 0) {
		$PM_envelope = '<a href="pm_inbox.php"><img src="imagens/pm2.gif" width="18" height="11" alt="PM" /></a>';
	} else {
		$PM_envelope = '<a href="pm_inbox.php"><img src="imagens/pm1.gif" width="18" height="11" alt="PM" /></a>';
	}
	*/
	// Ready the output for this logged in user        <li>'. $PM_envelope . ' </li>
    $logOptions = '	<div id="menu">
		 <ul>
                 
		 	<li><a href="http://' . $dyn_www . '" >Painel Central</a></li>
                        <li><a href="http://' . $dyn_www . '/configuracao.php?id_menu=#" >Configuração</a></li>  
			<li><a href="http://' . $dyn_www . '/logout.php">Sair</a></li>
		 </ul>
	</div>';
	
	$mostraremail = "a";
	$mostraraniver = "a";
}


/*	<div class="dc">
<a href="#" onclick="return false">Account &nbsp; <img src="../images/darr.gif" width="10" height="5" alt="Account Options" border="0"/></a>
<ul>
<li><a href="http://' . $dyn_www . '/edit_profile.php">Account Options</a></li>
<li><a href="http://' . $dyn_www . '/pm_inbox.php">Inbox Messages</a></li>
<li><a href="http://' . $dyn_www . '/pm_sentbox.php">Sent Messages</a></li>
</ul>
</div>
	*/

?>

