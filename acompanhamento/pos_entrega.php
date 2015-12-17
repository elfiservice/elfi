<?php
 
//echo date('Y')+2 .'<br>';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 

	$ano_atual = date('Y');   

	
	        $id_orc = "";
        if(isSet ($_GET['id_orc'])) {
        
             $id_orc = $_GET['id_orc'];
        } 
	
		$sql_acompa_orc = mysql_query("SELECT * FROM acompanhamento WHERE id='$id_orc'") or die (mysql_error()); 
		$linha = mysql_fetch_object($sql_acompa_orc);
                
                $id_orc = $linha->id;
				$cliente = $linha->cliente;
				$inf_servicos = $linha->inf_servicos;
				$n_orc = $linha->n_orc;
				$email = $linha->email;

//				$data_hj = date('Y-m-d');

	

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
<link rel="stylesheet" href="../tabela/demo_page.css">  
<link rel="stylesheet" href="../tabela/demo_table.css">  

		<script type="text/javascript" language="javascript" src="../tabela/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../tabela/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
			
						$(document).ready(function() {
				$('#example2').dataTable();
			} );

						$(document).ready(function() {
				$('#example3').dataTable();
			} );			
		</script>
	
	
	</head>
<body>
<a href="javascript:window.history.go(-1)" target="_self">Voltar</a>
<div id="">

</div>

            <fieldset>
            <legend><h3>Enviando Emai de Pós-entrega</h3></legend>
				<form action="enviar_pos_entrega.php" method="post" enctype="multipart/form-data" name="formAgenda">
					Cliente: 	<?php echo $cliente; ?> - Nº ORC: 	<?php echo $n_orc; ?>
					</br>
					Email para envio: <input type="text" name="email" value="<?php echo $email; ?>"  />	
					</br>
					<label for="email_orc">Descrição:</label></br>
					<textarea  rows="3" cols="100" id="text" name="descricao"><?php echo $inf_servicos; ?></textarea>
									</br></br>
					<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Enviar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
					 <input type="hidden" value="<?php echo $cliente; ?>" name="cliente" hidden="hidden" />
					 <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
					<input type="hidden" name="n_orc" value="<?php echo $n_orc; ?>" readonly="readonly" />
					<input type="hidden" name="id_orc" value="<?php echo $id_orc; ?>" readonly="readonly" />				
				</form>
			
			</fieldset>
			
			
            

</body>
</html>