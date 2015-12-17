<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include "checkuserlog.php";

        include_once "Config/config_sistema.php"; 

        $dyn_www = $_SERVER['HTTP_HOST'];  

        $menu = $_GET['id_menu'];

?>




<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Financeiro</title>
        
	<meta name="description" content="">
	<meta name="author" content="Elfi Service">

	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="estilos.css">    

    <script src="js/jquery.min.js" type="text/javascript"></script>

	<!--
MAscaras em campos
-->
<script type="text/javascript" src="js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="js/maskedinput-1.1.2.pack.js"></script>

<script type="text/javascript">
$(document).ready(function(){

});
</script>
        
    
<script type="text/javascript">
// Chama aba Seu Estado
$(document).ready(function() {

$("#colaborador_logado").load('colaborador_logado.php?id_colaborador=<?php echo $logOptions_id;?>');

	$(function(){
		$.mask.addPlaceholder("~","[+-]");
		$("#telefone").mask("(99) 9999-9999");
		$("#cep").mask("99999-999");
		$("#data").mask("99/99/9999");
		$("#cpf").mask("999.999.999-99");
		$("#cnpj").mask("99.999.999/9999-99");
	});

});

</script>

<!-- Menus dorp down  -->

<link rel="stylesheet" type="text/css" href="js/menus/anylinkmenu.css" />

<script type="text/javascript" src="js/menus/menucontents.js"></script>

<script type="text/javascript" src="js/menus/anylinkmenu.js">

/***********************************************
* AnyLink JS Drop Down Menu v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Project Page at http://www.dynamicdrive.com/dynamicindex1/dropmenuindex.htm for full source code
***********************************************/

</script>

<script type="text/javascript">

//anylinkmenu.init("menu_anchors_class") //Pass in the CSS class of anchor links (that contain a sub menu)
anylinkmenu.init("menuanchorclass")

</script>
  

<!--
Inicio menu colaps (esconder ou mostrar) Vertical
-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

<script type="text/javascript" src="js/esconder_mostrar/ddaccordion.js">

/***********************************************
* Accordion Content script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
***********************************************/

</script>


<style type="text/css">
	.mypets{ /*header of 1st demo*/
	cursor: hand;
	cursor: pointer;
	padding: 2px 5px;

	}

	.openpet{ /*class added to contents of 1st demo when they are open*/
	border-bottom: 2px solid #012B8B;
	}
</style>

<script type="text/javascript">

//Initialize first demo:
ddaccordion.init({
	headerclass: "mypets", //Shared CSS class name of headers group
	contentclass: "thepet", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openpet"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script>
<!--
FINAL Inicio menu colaps (esconder ou mostrar) Vertical
-->


<!--
DESABILITAR CAMPOS COM CHECKBOX
-->
<script type="text/javascript" src="js/desabilitar/jquery-latest.js"></script>
<script type="text/javascript">
function toggleStatus() {
    if ($('#toggleElement').is(':checked')) {
        $('#elementsToOperateOn :input').attr('disabled', true);
    } else {
        $('#elementsToOperateOn :input').removeAttr('disabled');
    }   
}
</script>


    </head>
    <body>
	
        
        <div  style="background: url(imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
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
				include 'Config/config_sistema.php'; // Connect to the database
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
						
						$header = header("location: index.php"); 
						
						
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
        <form action="index.php" method="post" enctype="multipart/form-data" name="formlogin">
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
    
    			<h2 style="text-align: center;" >
			
				Administrativo / Financeiro
				
			</h2>
        
        
        <div style="">
            
            <div id="colaborador_logado">
                
            </div>
                 
            <div style="float: right">
                <?php
                echo $logOptions;
                ?>
            </div>
        </div>
        
   <?php
  			$consulta_colab = mysql_query("select * from colaboradores where id_colaborador = '$logOptions_id'");
			$linha_colab = mysql_fetch_object($consulta_colab);

                        $tipo_conta = $linha_colab->tipo;


    if ($tipo_conta == "ad" || $tipo_conta == "fi" || $tipo_conta == "fi_tec" || $tipo_conta == "fi_rh" || $tipo_conta == "fi_tec_rh")
        
    {
       ?>
	   
	   


        <div style="margin:20px 0px 20px 0px;">
            
            		  	<div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">
			
			</div>
    
           
            <div id="menu_paginas">
            <ul>
                <li><a href="#" class="menuanchorclass myownclass" rel="anylinkmenu3">Cadastro</a></li>
                <li><a href="#" class="menuanchorclass myownclass" rel="anylinkmenu_financeiro">Financeiro</a></li>
                <li><a href="#" class="menuanchorclass myownclass" rel="anylinkmenu_relatorio">Relatórios</a></li>
            </ul>
            </div>
            
                       <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">
			
			</div>
            
            
            
        </div>
        
        <div style="margin:20px 0px 20px 0px;">
            
            <?php
            
            
            
            if ($menu == "cliente")
            {
             
                echo "Cadastro Cliente aqui";
            
            ?>    
                <form method="post">
Telefone: <input type="text" name="telefone" id="telefone" />
<br>
<br>
CEP: <input type="text" name="cep" id="cep" />
<br>
<br>
Data: <input type="text" name="data" id="data" />
<br>
<br>
CPF: <input type="text" name="cpf" id="cpf" />
<br>
<br>
CNPJ: <input type="text" name="cnpj" id="cnpj" />
</form>
            
            
            <h3 class="mypets">Novo Cliente (clique aqui)</h3>
           
            <div class="thepet" style="text-align: center;">
                
       <form method="post" action="">       
                <p>
    Pessoa física: <input id="toggleElement" type="checkbox" name="toggle" onchange="toggleStatus()" />
    </p>
                
    
             <div id="elementsToOperateOn">
   
               CPF: <input type="text" name="cpf" id="cpf" /> <br />

            </div>
     CPF: <input type="text" name="cpf" id="cpf" /> 
        </form>
                
                
                
            </div>
            
            <h3 class="mypets">Visualizar   (clique aqui)</h3>
           
            <div class="thepet" style="text-align: center;">
                
                oi
                djçl
                
            </div>
                
           <?php  
                
                
                
                
                
                
                
            } //final do conteudo de Clientes
            ?>
            
            
            
        </div>
        



			
			
			<footer>
			

				
			</footer>
			
			
	<?php
        
    }else {
        
       echo "Acesso restrito.";
        
        
    }
		}
   
?>	
	   
    </body>
</html>
