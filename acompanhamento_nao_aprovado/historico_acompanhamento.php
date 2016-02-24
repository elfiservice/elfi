<?php
include "../checkuserlog.php";
include_once "../Config/config_sistema.php";

if (!isset($_SESSION['idx'])) {
	if (!isset($_COOKIE['idCookie'])) {

		//include_once '../conectar.php';
		//header("location: ../index.php");
		echo "Voc� n�o esta logado!";
	}
} else {
	
	$id_orc = "";
	if(isSet ($_GET['id_orc'])) {
	
		$id_orc = $_GET['id_orc'];
	}
	
	include_once '../includes/sql_dados_orc_por_id.php';
	//echo "$linha_orc->n_orc";

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
<head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Técnico</title>
        
		<meta name="description" content="">
		<meta name="author" content="Elfi Service">

		<meta name="viewport" content="width=device-width,initial-scale=1">
    	<link rel="stylesheet" href="">
    	
    	<?php include_once '../includes/tabela_no_head.php';?>
    	
</head>
<body>
<div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
<fieldset>
	<legend><b>Dados do Orçamento</b></legend>
	<div id="">
		<h3> Acompanhamento Orçamento Nº <?php echo $linha_orc->n_orc; ?> - Cliente: <?php echo $linha_orc->razao_social_contr; ?></h3>
			
		Nome de contato: <b><?php echo $linha_orc->contato_clint?></b> 
		<br>
		Telefone de contato: <b><?php echo $linha_orc->telefone_contr;?></b>
	</div>
</fieldset>	
<fieldset>
	<legend><b>Dados do Contato de hoje</b></legend>
	Data do contato: <b><?php echo date('d/m/Y');?></b>
    	
</fieldset>
	      
</body>
</html>
<?php }?>