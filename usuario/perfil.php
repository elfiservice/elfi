<?php
include "../checkuserlog.php";
include_once "../Config/config_sistema.php";
include_once "../classes/model/Usuario.class.php";
include_once "../classes/controller/OrcamentosCtrl.class.php";

if (!isset($_SESSION['idx'])) { 			//TESTE para saber se esta LOGADO!
	if (!isset($_COOKIE['idCookie'])) {

		//header("location: ../index.php");
		echo "Você não esta Logado!!";
	}
} else {
	
	$id_user = "";
	if(isSet ($_GET['id_user'])) {
	
		$id_user = $_GET['id_user'];
	}
	
	$usuario_logado = new Usuario($id_user);
	$orc_ctrl = new OrcamentoCtrl();


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
	<legend><b>Dados do Usuario: <?php echo $usuario_logado->getLogin();?></b></legend>
		<table>
			<tr>
				<td>Email:</td>
				<td><?php echo $usuario_logado->getEmail();?></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td><?php if($logOptions_id == $id_user){echo $usuario_logado->getCpf();}?></td>
			</tr>
			<tr>
				<td>Ultimo Log:</td>
				<td><?php echo $usuario_logado->getUltDataLogado();?></td>
			</tr>
			<tr>
				<td>Nº de Orçamentos feitos:</td>
				<td><?php echo $orc_ctrl->nDeOrcPorUsuario($usuario_logado->getLogin());?></td>
			</tr>
			<tr>
				<td>Nº de Orçamentos que esta acompanhando:</td>
				<td><?php echo $orc_ctrl->nOrcUsuarioAcompanhando($usuario_logado->getLogin());?></td>
			</tr>
			<tr>
				<td>Nº de Hitoricos em Orçamentos Não Aprovados:</td>
				<td><?php echo $orc_ctrl->nOrcNAprovadoPorUsuarioAcompanhando($usuario_logado->getLogin());?></td>
			</tr>
			<tr>
				<td>Nº de Historicos em Orçamentos Aprovados:</td>
				<td><?php echo $orc_ctrl->nOrcAprovadoPorUsuarioAcompanhando($usuario_logado->getLogin());?></td>
			</tr>
			
		</table>
		
		
		
		
</fieldset>
</body>
</html>



<?php 

}//fecha o else do $_SESSION

?>