<?php
 
//echo date('Y')+2 .'<br>';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 

        require '../Config/SistemConfig.php';
	
		$ano_orc = "";
        if(isSet ($_GET['ano_orc'])) {
        
             $ano_orc = $_GET['ano_orc'];
        } 
		
		$ano_orc_selec="";    
        if(isSet ($_POST['ano'])) {
        
             $ano_orc_selec = $_POST['ano'];
        } 


	

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
    <link rel="stylesheet" href="../estilos.css">
	

<!-- Tabela  -->
	<?php include_once '../includes/javascripts/tabela_no_head.php';?>
	
	
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


<div id="">
	<h3> Relatórios </h3>

</div>

     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="relatorios.php?ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>


            <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>

<TABLE border="1" class="" id="" >
<thead>
  <TR>

    <TH>MÊS</TH>
    <TH>ORC APROVADOR</TH>
    <TH>TOTAL ORC NO MêS</TH>
	<TH>% ORC APROVADOS NO MêS</TH>
	
  </TR>
  </thead>
  <tbody>
  
  

<?php

//$ano_orc = date('Y');

$total = 0;
$total_orc_feitos = 0;

for($i=1;$i<=12;$i++){

//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$i' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
					
					$mes_atual = date('m');
					if ($i > $mes_atual){
					
						$n_orc_feitos_no_mes = 0;
					
					} else {
//selecionar controles
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$i' AND ano = '$ano_orc'") or die (mysql_error()); 
					//$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					
					
					$linha = mysql_fetch_object($sql_n_orc);			

					$n_orc_feitos_no_mes = $linha->n_orc_feitos;
					

					
					}
					
					if($n_orc_feitos_no_mes == 0){
						$em_porcentagem = 0;
					} else {
					
					$em_porcentagem = ($n_linhas_orc_aprovados / $n_orc_feitos_no_mes) * 100;
					}
					
echo "<TR align=\"center\"><TD>".$i."</TD> <TD>".$n_linhas_orc_aprovados."</TD> <TD>".$n_orc_feitos_no_mes."</TD> <TD>".number_format($em_porcentagem, 2, '.', '')."%</TD> </TR>";

$total = $total + $n_linhas_orc_aprovados;
$total_orc_feitos = $total_orc_feitos + $n_orc_feitos_no_mes;
}



?>	



	</tbody>
</TABLE>	
	
<?php
echo "<br>Total propostas Aprovadas: ".$total." de ".$total_orc_feitos." feitas<br>";
?>	




	
	
<fieldset>
    <legend><h3>Principais Clientes</h3></legend>	
	
	
<TABLE class="display" id="example"  >
	<thead>
		<TR>

			<TH>Cliente</TH>
			<TH>No Serviços Executado</TH>
			

	
		</TR>
	</thead>
	<tbody>
<?php
       $sql = "SELECT * FROM clientes";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_cliente = $row['id'];
				$nome_cliente = $row['razao_social'];
				
				
				
				$sql = mysql_query("SELECT * FROM acompanhamento WHERE cliente = '$nome_cliente' AND ano='$ano_orc'");
				$total = mysql_num_rows($sql);
				//echo $total;

				
				
echo "<TR align=\"center\"><TD><a href=\"cliente.php?id=".$id_cliente."\">".$nome_cliente."</a></TD> <td>".$total."</td></TR>";		



}		
?>  
  
  
  
  
	</tbody>
</TABLE>
  


	
</fieldset>	

	
	
			<?php
} //fim do teste de Logado ou não

?>

</body>
</html>