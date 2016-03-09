<?php
include "../checkuserlog.php";
include_once "../Config/config_sistema.php";
include_once "../classes/Usuario.class.php";

if (!isset($_SESSION['idx'])) { 			//TESTE para saber se esta LOGADO!
	if (!isset($_COOKIE['idCookie'])) {

		//header("location: ../index.php");
		echo "Voc� n�o esta Logado!!";
	}
} else {
	
	$id_user = "";
	if(isSet ($_GET['id_user'])) {
	
		$id_user = $_GET['id_user'];
	}
	
	$user_logado =  Usuario::buscaUser($id_user);
	//echo $user_logado->getEmail();
	//$user = new Usuario($id_user, "", "", "", "", "", "", "");
	//$userLogado = $user->buscaUser($user->getId());
	//echo $userLogado->getLogin();	
	
	//if($logOptions_id == $id_user){ //mostrar a pagina do user logado
		//} else{}//mostrar pagina do id do user N�O logado

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
<head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Perfil Usuario</title>
        
		<meta name="description" content="">
		<meta name="author" content="Elfi Service">

		<meta name="viewport" content="width=device-width,initial-scale=1">
    	<link rel="stylesheet" href="">
    	
    	<?php include_once '../includes/tabela_no_head.php';?>
    	
</head>
<body>
<div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
<fieldset>
	<legend><b>Dados do Usuario: <?php echo $user_logado->getLogin();?></b></legend>
		<table>
			<tr>
				<td>Email:</td>
				<td><?php echo $user_logado->getEmail();?></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td><?php if($logOptions_id == $id_user){echo $user_logado->getCpf();}?></td>
			</tr>
			<tr>
				<td>Ultimo Log:</td>
				<td><?php echo $user_logado->getUltDataLogado();?></td>
			</tr>
			
		</table>
		
		
		
		
</fieldset>
</body>
</html>



<?php 

}//fecha o else do $_SESSION

?>