<?php
include "checkuserlog.php";
require 'Config/SistemConfig.php';

include_once "Config/config_sistema.php";

if (! isset ( $_SESSION ['idx'] )) {
	if (! isset ( $_COOKIE ['idCookie'] )) {
		
		// include_once '../conectar.php';
		header ( "location: index.php" );
	}
} else {
	
	$dyn_www = $_SERVER ['HTTP_HOST'];
	
	$menu = "";
	if (isSet ( $_GET ['id_menu'] )) {
		
		$menu = $_GET ['id_menu'];
	}
	
	?>


<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Sistema ELFI | Técnico</title>

<meta name="description" content="">
<meta name="author" content="Elfi Service">

<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="estilos.css">

<!-- Mostra colaborador Logado -->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
// Chama aba Seu Estado
$(document).ready(function() {
	$("#colaborador_logado").load('colaborador_logado.php?id_colaborador=<?php echo $logOptions_id;?>');
});
</script>

<!-- Menus dorp down  -->
<?php include_once 'includes/javascripts/menu_dropdown.php';?>

<!-- Tabela  -->
<?php include_once 'includes/javascripts/tabela_no_head.php';?> 

</head>
<body>


	<div
		style="background: url(imagens/topo1.png) repeat-x; padding: 5px 0px 30px 0px;">
	</div>

	<h2 style="text-align: center;">Técnico</h2>
	<div style="">

		<div id="colaborador_logado"></div>

		<div style="float: right">
                <?php echo $logOptions;	?>
        </div>
	</div>
        
<?php
	$consulta_colab = mysql_query ( "select * from colaboradores where id_colaborador = '$logOptions_id'" );
	$linha_colab = mysql_fetch_object ( $consulta_colab );
	
	$tipo_conta = $linha_colab->tipo;
	
	if ($tipo_conta == "ad" || $tipo_conta == "tec" || $tipo_conta == "fi_tec" || $tipo_conta == "tec_rh" || $tipo_conta == "fi_tec_rh") 

	{
		?>
	   
	<div style="margin: 20px 0px 20px 0px;">
		<div class="barra_menu"
			style="background: #012B8B; text-align: center; padding: 5px 0px 0px 0px;">
		</div>

		<div id="menu_paginas">
			<ul>
				<!-- 				<li><a href="#" class="menuanchorclass myownclass" -->
				<!-- 					rel="tecnico_cliente">Cliente</a></li> -->
				<li><a href="tecnico.php?id_menu=cliente" class="" rel="">Cliente</a></li>
				<li><a href="tecnico.php?id_menu=orcamento" class="" rel="">Orcamentos</a></li>
<!-- 				<li><a href="#" class="menuanchorclass myownclass" -->
<!-- 					rel="tecnico_orcamento">Orçamento</a></li> -->
			</ul>
		</div>

		<div class="barra_menu"
			style="background: #012B8B; text-align: center; padding: 5px 0px 0px 0px;">
		</div>



	</div>



	<div style="margin: 20px 0px 20px 0px;">
            
<?php
		
		/* ------------ Manter Cliente --------------- */
		
		if ($menu == "cliente") {
			
			require_once 'cliente/manterCliente.php';
		}
		
		if ($menu == "novo_cliente") {
			include 'cliente/novo_cliente.php';
		}
		
		if ($menu == "salvar_novo_cliente") {
			require 'cliente/incluir/salvar_novo_cliente.php';
		}
		
		if ($menu == "editar_cliente") {
			
			include 'cliente/editar_cliente.php';
		}
		
		if ($menu == "salvar_editar_cliente") {
			require 'cliente/alterar/salvar_alteracao_cliente.php';
		}
		
		if ($menu == "excluir_cliente") {
			
			include 'cliente/excluir_cliente.php';
		}
		
		if ($menu == "salvar_excluir_cliente") {
			
			include 'cliente/excluir/salvar_excluir_cliente.php';
		}
		/* ------------ FIM Manter Cliente --------------- */
		
		/* ------------- Manter Orçamentos ----------------- */
		if ($menu == "orcamento") {
			
			//require 'orcamento/manterOrcamentos.php';
?>
			<iframe class="iframeStyle" 
					src="orcamento/manterOrcamentos.php?ano_orc=<?php echo date('Y'); ?>"></iframe>
<?php 
		}
		
		// Menu novo orçamento
		if ($menu == "editar_orcamento") {
			
			?>

                
               
          <iframe class="iframeStyle"
			src="iframes/visualizar_orcamentos.php?ano_orc=<?php echo date('Y'); ?>"></iframe>
            
                
           <?php
		}
		
		// Menu Acompanhamento
		if ($menu == "acompanhar_orc") {
			
			?>
			<h3>Acompanhamento Orçamento Aguaradando Aprovação</h3>
		<iframe class="iframeStyle"
			src="acompanhamento_nao_aprovado/acompanhar_orc_n_aprovados.php?ano_orc=<?php echo date('Y'); ?>"></iframe>
      
           <?php
		}
		
		?>		   
                
        </div>	
		
        
        
        
	<?php
	} else {
		
		echo "Acesso restrito.";
	}
	
	?>	

			
			<footer> </footer>

</body>
</html>
<?php } ?>