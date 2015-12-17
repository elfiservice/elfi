<?php
 
//echo date('Y')+2 .'<br>';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 


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

<!--
MAscaras em campos
-->

<script src="../js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/mascara/jquery.meio.mask.js" charset="utf-8"></script>
<script type="text/javascript" >
  (function($){
    // call setMask function on the document.ready event
      $(function(){
        $('input:text').setMask();
      }
    );
  })(jQuery);
</script>
<!--
FIM  MAscaras em campos
-->
	
	
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






 <script language="JavaScript">
<!--

/***********************************************
* Required field(s) validation v1.10- By NavSurf
* Visit Nav Surf at http://navsurf.com
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function formCheck(formobj){
	// Enter name of mandatory fields
	var fieldRequired = Array("razao_social", "contato_clint", "email_orc");
	// Enter field description to appear in the dialog box
	var fieldDescription = Array("Razão Social", "Nome de contato do cliente", "Email do cliente");
	// dialog message
	var alertMsg = "Por favor completar os campos:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == "" ){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			case "select-multiple":
				if (obj.selectedIndex == -1){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			case "text":
			case "textarea":
				if (obj.value == "" || obj.value == null || obj.value == "0,00"){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			default:
			}
			if (obj.type == undefined){
				var blnchecked = false;
				for (var j = 0; j < obj.length; j++){
					if (obj[j].checked){
						blnchecked = true;
					}
				}
				if (!blnchecked){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
			}
		}
	}

	if (alertMsg.length == l_Msg){
		return true;
	}else{
		alert(alertMsg);
		return false;
	}
}
// -->
</script>

            <div class="thepet" style="text-align: center;">
                
                 
                
            <form name="clientForm" method="post" action="salvar_novo_cliente.php" onsubmit="return formCheck(this);">       

            <fieldset>
            <legend><h3>Dados</h3></legend>
                <table border="0">
                                <tbody>


                                  <tr align="left">
                                      <td><label for="razao_social">Razão Social:</label></br>
                                        <input name="razao_social" id="razao_social" size="60" maxlength="255">
                                      </td>

                                      <td><label for="cnpj">CNPJ:</label></br>
                                        <input name="cnpj" id="cnpj" alt="" size="20" maxlength="255">
                                    </td>
                                </tr>
                                  <tr align="left">
                                    <td><label for="endereco">Endereço:</label></br>
                                    <input name="endereco" id="endereco" size="60" maxlength="255"></td>
                                  </tr>
                                  <!--tr align="left">
                                    <td><label for="bairro">Bairro:</label></br>
                                    <input name="bairro" id="bairro" size="20" maxlength="255">
                                    
                                    </td>
                                    
                                   <td><label for="city">Cidade:</label></br>
                                    <input name="city" id="city" size="20" maxlength="255">
                                    
                                    </td>
                                    <td><label for="estado">Estado:</label></br>
                                    <input name="estado" id="estado" size="20" maxlength="255">
                                    
                                    </td>
                                    
                                </tr-->
                                <tr align="left">
                                    
                                    <td><label for="cep">CEP:</label></br>
                                    <input name="cep" id="cep" size="20" maxlength="15">
                                    
                                    </td>
                                     <td><label for="tel">Telefone:</label></br>
                                    <input name="tel" id="tel" size="20" maxlength="15">
                                    
                                    </td>
                                     <td><label for="cel">Celular:</label></br>
                                    <input name="cel" id="cel" size="20" maxlength="15">
                                    
                                    </td>                                   
                                    
                                    
                                </tr>
                                <tr align="left">
                                    
                                    <td><label for="email_orc">Email:</label></br>
                                    <input name="email_orc" id="email_orc" size="20" maxlength="255">
                                    
                                    </td>
                                 
                                    
                                    
                                </tr>                                
                                </tbody>
                </table>
           </fieldset>

          <fieldset>
              <legend><h3>Contato</h3></legend>
            
            
                         <input id="contato_clint" name="contato_clint" size="80" maxlength="100" />
                         
                         
          </fieldset>                     
                    
                       <table border="0">
                            
                               <tr align="left">
                                    <td>
                                        

                                        <input type="submit" value="Salvar novo cliente" name="salvar_orc" />
                                        <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
                                     
                                    </td>

                                 
                                    
                                </tr>

                         </table>
                </form>
                
              </div>
<?php
}

?>

</body>
</html>