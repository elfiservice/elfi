<?php
 
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 
		
		$days_em_exec = "";
		$days_de_atraso="";
		
        $mes = "";
        if(isSet ($_GET['mes'])) {
        
             $mes = $_GET['mes'];
        } 
		
		
		$ano_orc = "";
        if(isSet ($_GET['ano_orc'])) {
        
             $ano_orc = $_GET['ano_orc'];
        } 
		
		$ano_orc_selec="";    
        if(isSet ($_POST['ano'])) {
        
             $ano_orc_selec = $_POST['ano'];
        } 
		

		//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
		if (!isset($_SESSION['idx'])) { 
		  if (!isset($_COOKIE['idCookie'])) {

		  	
		  		echo "Você não esta logado!";
		  
		  	
		  	?>
		  		 <script type="text/javascript">
				//função usada para carregar o código
				function fecha() {
				//fechando a janela atual ( popup )
				window.close();
				//dando um refresh na página principal
				//opener.location.href=opener.location.href;
				/* ou assim:*/ 
				window.opener.location.reload();
				
				//document.location="Cores.htm"
				//fim da função
				}
				</script>
				<a href="javascript:void(0)" onclick="fecha()">fechar</a>
		  	<?php 
  }
} else {




?>


<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | TÃ©cnico</title>
        
	<meta name="description" content="">
	<meta name="author" content="Elfi Service">

	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="../estilos.css">
	
	<style type="text/css">
				#menu {
		float: ;
		 
		 }
		 

		#menu ul {
		 padding:0px 0px 0px 0px;
		 margin:-2px 0px 0px 0px;
		 float: left;
		 width: 100%;
		 list-style:none;
		 font: 11px verdana, arial, helvetica, sans-serif;

		 
		 }

		 #menu ul li {display: inline;}

		 #menu ul li a{
		 padding: 5px 10px;
		 margin: 0px 0px;
		 float:left;
		 /* visual do link */

		 
		text-decoration: none; 
		display: inline-block;
		 }

		 
		  #menu ul li a:hover  {


		 }
	
	</style>

<!-- Tabela  -->
<?php include_once '../includes/tabela_no_head.php';?>
	
	
</head>
<body>



        <div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
				</div>
<?php 

//Mes janeiro
if ($mes == "jan") {

	$n_do_mes = "01";
	
	include_once "../includes/acompanhamento_por_mes.php";

	}
?>

<?php //mes Fevereiro
if ($mes == "fev") {

$n_do_mes = "02";

include_once "../includes/acompanhamento_por_mes.php";

	}

	?>

<?php //mes MarÃ§o
if ($mes == "mar") {

$n_do_mes = "03";

include_once "../includes/acompanhamento_por_mes.php";

	}
?>

<?php //mes Abril
if ($mes == "abr") {

$n_do_mes = "04";

include_once "../includes/acompanhamento_por_mes.php";

	}
?>

<?php //mes Maio
if ($mes == "mai") {

$n_do_mes = "05";

include_once "../includes/acompanhamento_por_mes.php";
	}
?>


<?php  //mes Junho
if ($mes == "jun") {

$n_do_mes = "06";

include_once "../includes/acompanhamento_por_mes.php";
	}
?>


<?php //mes julho
if ($mes == "jul") {

$n_do_mes = "07";

include_once "../includes/acompanhamento_por_mes.php";
	}
?>


<?php //mes Agosto
if ($mes == "ago") {

$n_do_mes = "08";

include_once "../includes/acompanhamento_por_mes.php";
	}
?>


<?php //mes setembro
if ($mes == "set") {

$n_do_mes = "09";

include_once "../includes/acompanhamento_por_mes.php";
	}
?>


<?php //mes outubro
if ($mes == "out") {

$n_do_mes = "10";

include_once "../includes/acompanhamento_por_mes.php";
	}
?>


<?php  //mes Novembro
if ($mes == "nov") {

$n_do_mes = "11";

include_once "../includes/acompanhamento_por_mes.php";
	}
?>


<?php  //mes Dezembro
if ($mes == "dez") {

$n_do_mes = "12";

include_once "../includes/acompanhamento_por_mes.php";
	}
?>

<?php
}

?>

</body>
</html>