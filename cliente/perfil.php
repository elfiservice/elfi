<?php
include "../checkuserlog.php";
include_once "../Config/config_sistema.php";
include_once "../classes/model/Usuario.class.php";
include_once "../classes/controller/OrcamentosCtrl.class.php";
include_once "../classes/controller/ClienteCtrl.class.php";

if (!isset($_SESSION['idx'])) { 			//TESTE para saber se esta LOGADO!
	if (!isset($_COOKIE['idCookie'])) {

		//header("location: ../index.php");
		echo "Você não esta Logado!!";
	}
} else {
	
	$id_cliente = "";
	if(isSet ($_GET['id_cliente'])) {
	
		$id_cliente = $_GET['id_cliente'];
	}
	
	$tipo_cliente = "";
	if(isSet ($_GET['tipo_cliente'])) {
	
		$tipo_cliente = $_GET['tipo_cliente'];
	}
	
	//$usuario_logado = new Usuario($logOptions_id);
	$orc_ctrl = new OrcamentoCtrl();
	$cliente = new ClienteCtrl();
	$clienteFinal = $cliente->selecionarCliente($id_cliente, $tipo_cliente);


?>
<!doctype html>
<html class="no-js" lang="pt"> <!--<![endif]-->
<head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Perfil Usuario</title>
        
		<meta name="description" content="">
		<meta name="author" content="Elfi Service">

		<meta name="viewport" content="width=device-width,initial-scale=1">
    	<link rel="stylesheet" href="../estilos.css">
    	
    	<?php include_once '../includes/tabela_no_head.php';?>
    	
</head>
<body>
<div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
<fieldset>
	<legend><b>Dados do Cliente: <?php echo $clienteFinal->getRazaoSocial();?></b></legend>
		<table>
			<tr>
				<td>Email:</td>
				<td><?php echo $clienteFinal->getEmailTec();?></td>
			</tr>
			<tr>
				<td>CNPJ/CPF:</td>
				<td><?php if($tipo_cliente == "PJ"){ echo $clienteFinal->getCnpj(); }else{echo $clienteFinal->getCpf();}; ?></td>
			</tr>

			
		</table>
		
		
		
		
</fieldset>
</body>
</html>



<?php 

}//fecha o else do $_SESSION

?>