<?php
 
//echo date('Y')+2 .'<br>';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 
        require '../Config/SistemConfig.php';
	$ano_atual = date('Y');   

	
	    $id_historico = "";
        if(isSet ($_GET['id_historico'])) {
        
             $id_historico = $_GET['id_historico'];
        } 
	
		$sql_acompa_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id='$id_historico'") or die (mysql_error()); 
		$linha = mysql_fetch_object($sql_acompa_orc);
                
                $id_orc_acomp = $linha->id_acompanhamento;
				$descricao = $linha->descricao;
				$data_hj = date('Y-m-d');


				
				
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
	


<!-- Tabela  -->
<?php include_once '../includes/javascripts/tabela_no_head.php';?> 
	
	
	</head>
<body>
<a href="javascript:window.history.go(-1)" target="_self">Voltar</a>
<div id="">
	<h3> Editando HistÃ³rico </h3>

</div>

            <fieldset>
            <legend><h3>Dados</h3></legend>
				<form action="salvar_historico_editado.php" method="post" enctype="multipart/form-data" name="formAgenda">
				Data: 	<?php echo $data_hj; ?>

				<label for="email_orc">DescriÃ§Ã£o:</label></br>
				<textarea  rows="3" cols="100" id="text" name="descricao_historico"><?php echo $descricao; ?></textarea>
				
				<p>			    
				<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
                 <input type="hidden" value="<?php echo $data_hj; ?>" name="dia_hoje" hidden="hidden" />
                 <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
				<input type="hidden" name="id_orc_acomp" value="<?php echo $id_orc_acomp; ?>" readonly="readonly" />
				<input type="hidden" name="id_historico" value="<?php echo $id_historico; ?>" readonly="readonly" />
				</p>				
				</form>
			
			</fieldset>
			
			
            

</body>
</html>

<?php 
	}
	
?>