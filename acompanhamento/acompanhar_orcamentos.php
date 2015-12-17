<?php
 
//echo date('Y')+2 .'<br>';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 

	$ano_atual = date('Y');   


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

		<script type="text/javascript"  src="../tabela/jquery.js"></script>
		<script type="text/javascript"  src="../tabela/jquery.dataTables.js"></script>
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
        <div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
				</div>

    <?php


		//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
		//$logOptions = ''; // Initialize the logOptions variable that gets printed to the page
		// If the session variable and cookie variable are not set this code runs
		if (!isset($_SESSION['idx'])) { 
		  if (!isset($_COOKIE['idCookie'])) {

		// Initialize some vars

		$link_estado = "";
		$errorMsg = '';
		$email = '';
		$pass = '';
		$remember = '';
		if (isset($_POST['email'])) {
			
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			if (isset($_POST['remember'])) {
				$remember = $_POST['remember'];
			}
			$email = stripslashes($email);
			$pass = stripslashes($pass);
			$email = strip_tags($email);
			$pass = strip_tags($pass);
			
			// error handling conditional checks go here
			if ((!$email) || (!$pass)) { 

				$errorMsg = 'Preencha por favor ambos os campos';


			} else { // Error handling is complete so process the info if no errors
				include '../Config/config_sistema.php'; // Connect to the database
				$email = mysql_real_escape_string($email); // After we connect, we secure the string before adding to query
				//$pass = mysql_real_escape_string($pass); // After we connect, we secure the string before adding to query
				$pass = md5($pass); // Add MD5 Hash to the password variable they supplied after filtering it
				// Make the SQL query
				$sql = mysql_query("SELECT * FROM colaboradores WHERE Email='$email' AND Senha='$pass' ") or die (mysql_error()); 
				$login_check = mysql_num_rows($sql);
				// If login check number is greater than 0 (meaning they do exist and are activated)
				if($login_check > 0){ 
						while($row = mysql_fetch_array($sql)){
							
							// Pleae note: Adam removed all of the session_register() functions cuz they were deprecated and
							// he made the scripts to where they operate universally the same on all modern PHP versions(PHP 4.0  thru 5.3+)
							// Create session var for their raw id
							$id = $row["id_colaborador"];   
							$_SESSION['id'] = $id;
							// Create the idx session var
							$_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$id");
							// Create session var for their username
							$username = $row["Login"];
							$_SESSION['Login'] = $username;

							mysql_query("UPDATE colaboradores SET last_log_date=now() WHERE id_colaborador = '$id' LIMIT 1");
				
						} // close while
			
						// Remember Me Section
						if($remember == "yes"){
							$encryptedID = base64_encode("g4enm2c0c4y3dn3727553$id");
							setcookie("idCookie", $encryptedID, time()+60*60*24*100, "/"); // Cookie set to expire in about 30 days
							setcookie("passCookie", $pass, time()+60*60*24*100, "/"); // Cookie set to expire in about 30 days
						} 
						// All good they are logged in, send them to homepage then exit script
						
							$_SESSION['email'] = $email;
							$_SESSION['pass'] = $pass;
						
						$header = header("location: acompanhar_orcamentos.php"); 
						
						
						exit();
			
				} else { // Run this code if login_check is equal to 0 meaning they do not exist
					$errorMsg = "Dados incorretos, por favor tente novamente";

				}


			} // Close else after error checks

			
		} //Close if (isset ($_POST['uname'])){
        ?>
        

		<div >
			
			<h2 style="text-align: center;" >
			
				Acesso ao Sistema Integrado da ELFI SERVICE para os Colaboradores	
				
			</h2>
		
		</div>
        <form action="acompanhar_orcamentos.php" method="post" enctype="multipart/form-data" name="formlogin">
						<table align="center">
						
							<tr style = "vertical-align: top;">
								<td COLSPAN="2" height = "20" style = "padding: 0 0 0 11px;">
									<span style="font: 11px verdana, arial, helvetica, sans-serif; color: red; width:0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;"> <?php echo $errorMsg; ?> </span>
								</td>
							</tr>
							<tr>
								<td style = "padding: 0 0 0 11px;">
									<span style=" color:#012B8B; font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;  text-align: center;">Email </span>
								</td>
								
								<td style = "padding: 0 0 0 11px;">
									<span style=" color:#012B8B; font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;  text-align: right;">Senha </span>
								</td>
							</tr>
							
							<tr>
								<td style = "padding: 0 0 0 11px;">
									<label for="textfield"></label>
									<input name="email" type="text" id="email" maxlength="200" style=" width: 169px; border:1px dotted #ffffff;  background-color: #F0F2F9" />
								</td>
								<td style = "padding: 0 0 0 11px;">
									<label for="label"></label>
									<input name="pass" type="password" id="pass" maxlength="16"  style=" width: 169px; border:1px dotted #ffffff; background-color: #F0F2F9" />
								</td>
								<td style = "padding: 0 0 0 11px;">
								<label for="Submit"></label>
								<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Entrar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
								</td>								
							</tr>						
							
							<tr>
								<td style = "padding: 0 0 0 11px;">
									<input name="remember" type="checkbox" id="remember" value="yes" />
									<span style=" color:#012B8B; font: 11px 'lucida grande',tahoma,verdana,arial,sans-serif; text-align: right;">Mantenha-me conectado</span>
								</td>
								<td style = "padding: 0 0 0 11px;">
									<a href="senha.php" class="style3" style="cursor:pointer; color:#012B8B; font: 11px 'lucida grande',tahoma,verdana,arial,sans-serif;">Esqueceu sua Senha?</a>
								</td>
							</tr>
						</table>
								
	
	

	</form>

       <?php
  }
} else {

?>				
				
<div id="menu">
<ul>

	<li><a href="#" onclick="window.open('novo_orc_aprovado.php?id_orc=&msg_erro=', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	Novo orc. aprovado
	</a>
	</li>
	<li><a href="#" onclick="window.open('relatorios.php?ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	Relatórios
	</a>
	</li>
	<li><a href="#" onclick="window.open('link_pesquisa_satisfacao.php?mes=fev&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	Link Pesquisa
	</a>
	</li>
	<li><a href="#" onclick="window.open('email_situacao_orc.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	Enviar Situação Orc.
	</a>
	</li>
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	JAN
	</a>
	</li>
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=fev&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	FEV
	</a>
	</li>
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=mar&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	MAR
	</a>
	</li>
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=abr&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	ABR
	</a>
	</li>
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=mai&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	MAI
	</a>
	</li>
	
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=jun&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	JUN
	</a>
	</li>
	
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=jul&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	JUL
	</a>
	</li>
	
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=ago&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	AGO
	</a>
	</li>
	
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=set&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	SET
	</a>
	</li>
	
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=out&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	OUT
	</a>
	</li>
	
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=nov&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	NOV
	</a>
	</li>
	
	<li><a href="#" onclick="window.open('acompanhamento.php?mes=dez&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
	DEZ
	</a>
	</li>
</ul>
</div>

<div id="situacao_orc">

            <fieldset>
            <legend><b>Programados</b></legend>
			
<TABLE  class="display" id="example2">
<thead>
  <TR>
  <TH></TH>
    <TH>Cliente</TH>
    <TH>Atividade</TH>
    <TH>Classificação</TH>
    <TH>Inf. dos serviços</TH>
	
	<TH>Novo Cliente</TH>
	<TH>Nº do Orçamento</TH>
	<TH>Prazo de Execução</TH>
	<TH>Data Aprovada</TH>
	<TH>Data Inicio</TH>
	<TH>Data conclusão</TH>
	
  </TR>
  </thead>
  <tbody>
			
<?php
		$data_hj = date('Y-m-d');
       $sql = "SELECT * FROM acompanhamento WHERE data_inicio > '$data_hj' AND data_conclusao = '0000-00-00' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		 
				$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 
				
				
		 
?>
	  <TR>
		<td><a href="#" onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">editar</a><br>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $row['data_aprovada']; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		
	</tr>


<?php
}
?>

	</tbody>
</TABLE>
            </fieldset>	


            <fieldset>
            <legend><h3>Em Execução</h3></legend>
			
<TABLE  class="display" id="example">
<thead>
  <TR>
  <TH></TH>
    <TH>Cliente</TH>
    <TH>Atividade</TH>
    <TH>Classificação</TH>
    <TH>Inf. dos serviços</TH>
	
	<TH>Novo Cliente</TH>
	<TH>Nº do Orçamento</TH>
	<TH>Prazo de Execução</TH>
	<TH>Data Aprovada</TH>
	<TH>Data Inicio</TH>
	<TH>Data conclusão</TH>
	
  </TR>
  </thead>
  <tbody>
			
<?php
       $sql = "SELECT * FROM acompanhamento WHERE data_inicio <= '$data_hj' AND data_inicio <> '0000-00-00' AND data_conclusao = '0000-00-00' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		 				$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 
		 
		 
?>
	  <TR>
		<td><a href="#" onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">editar</a><br>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $row['data_aprovada']; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		
	</tr>


<?php
}
?>

	</tbody>
</TABLE>
            </fieldset>
			
			
            <fieldset>
            <legend><h3>Aguardando Programação</h3></legend>
			
<TABLE  class="display" id="example3">
<thead>
  <TR>
  <TH></TH>
    <TH>Cliente</TH>
    <TH>Atividade</TH>
    <TH>Classificação</TH>
    <TH>Inf. dos serviços</TH>
	
	<TH>Novo Cliente</TH>
	<TH>Nº do Orçamento</TH>
	<TH>Prazo de Execução</TH>
	<TH>Data Aprovada</TH>
	<TH>Data Inicio</TH>
	<TH>Data conclusão</TH>
	
  </TR>
  </thead>
  <tbody>
			
<?php
       $sql = "SELECT * FROM acompanhamento WHERE data_inicio = '0000-00-00' AND data_conclusao = '0000-00-00' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		 				$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 
		 
?>
	  <TR>
		<td><a href="#" onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">editar</a><br>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $row['data_aprovada']; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		
	</tr>


<?php
}
?>

	</tbody>
</TABLE>
            </fieldset>			
            
</div>
<?php
}

?>


</body>
</html>