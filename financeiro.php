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

<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/mascara/jquery.meio.mask.js" charset="utf-8"></script>
<script type="text/javascript" >
  (function($){
    // call setMask function on the document.ready event
      $(function(){
        $('input:text').setMask();
      }
    );
  })(jQuery);
</script>


        
    
<script type="text/javascript">
// Chama aba Seu Estado
$(document).ready(function() {

$("#colaborador_logado").load('colaborador_logado.php?id_colaborador=<?php echo $logOptions_id;?>');



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
		$('#elementsToOperateOn2 :input').removeAttr('disabled');
		
		
    } else {
        $('#elementsToOperateOn :input').removeAttr('disabled');
		$('#elementsToOperateOn2 :input').attr('disabled', true);
    }   
}
</script>

<script type="text/javascript">

function cpf() {
var planet = document.getElementById("cnpj_cpf");
planet.innerHTML = "CPF:  <input type=\"text\" id=\"cpf\" name=\"cpf\" alt=\"cpf\" /> <input onClick=\"return cnpj()\" name=\"submit\" type=\"submit\" value=\"CNPJ\"  />";
}

//window.onload = cara;

</script>
<script type="text/javascript">

function cnpj() {
var planet = document.getElementById("cnpj_cpf");
planet.innerHTML = "CNPJ:  <input type=\"text\" id=\"cnpj\" name=\"cnpj\" alt=\"cnpj\" /> <input onClick=\"return cpf()\" name=\"submit\" type=\"submit\" value=\"CPF\"  />";
}

//window.onload = cara;

</script>

<!-- Tabela  -->
<link rel="stylesheet" href="tabela/demo_page.css">  
<link rel="stylesheet" href="tabela/demo_table.css">  

		<script type="text/javascript" language="javascript" src="tabela/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="tabela/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>

<script type="text/javascript" src="http://www.shiguenori.com/jquery/jquery-1.3.1.js"></script>
<script type="text/javascript" src="js/validacao/jquery.validate.js"></script>
 
   <script> 
function isNUMB(c) 
 { 
 if((cx=c.indexOf(","))!=-1) 
  { 
  c = c.substring(0,cx)+"."+c.substring(cx+1); 
  } 
 if((parseFloat(c) / c != 1)) 
  { 
  if(parseFloat(c) * c == 0) 
   { 
   return(1); 
   } 
  else 
   { 
   return(0); 
   } 
  } 
 else 
  { 
  return(1); 
  } 
 }
function LIMP(c) 
 { 
 while((cx=c.indexOf("-"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("/"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(","))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("."))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("("))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(")"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(" "))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 return(c); 
 }

function VerifyCNPJ(CNPJ) 
 { 
 CNPJ = LIMP(CNPJ); 
 if(isNUMB(CNPJ) != 1) 
  { 
  return(0); 
  } 
 else 
  { 
  if(CNPJ == 0) 
   { 
   return(0); 
   } 
  else 
   { 
   g=CNPJ.length-2; 
   if(RealTestaCNPJ(CNPJ,g) == 1) 
    { 
    g=CNPJ.length-1; 
    if(RealTestaCNPJ(CNPJ,g) == 1) 
     { 
     return(1); 
     } 
    else 
     { 
     return(0); 
     } 
    } 
   else 
    { 
    return(0); 
    } 
   } 
  } 
 } 
function RealTestaCNPJ(CNPJ,g) 
 { 
 var VerCNPJ=0; 
 var ind=2; 
 var tam; 
 for(f=g;f>0;f--) 
  { 
  VerCNPJ+=parseInt(CNPJ.charAt(f-1))*ind; 
  if(ind>8) 
   { 
   ind=2; 
   } 
  else 
   { 
   ind++; 
   } 
  } 
  VerCNPJ%=11; 
  if(VerCNPJ==0 || VerCNPJ==1) 
   { 
   VerCNPJ=0; 
   } 
  else 
   { 
   VerCNPJ=11-VerCNPJ; 
   } 
 if(VerCNPJ!=parseInt(CNPJ.charAt(g))) 
  { 
  return(0); 
  } 
 else 
  { 
  return(1); 
  } 
 } 
 

  function FormataCGC(Formulario, Campo, TeclaPres) 
  { 
    var tecla = TeclaPres.keyCode; 
    var strCampo; 
    var vr; 
    var tam; 
    var TamanhoMaximo = 14; 
  
    eval("strCampo = document." + Formulario + "." + Campo); 
  
    vr = strCampo.value; 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace(",", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    tam = vr.length;

    if (tam < TamanhoMaximo && tecla != 8) 
    { 
      tam = vr.length + 1; 
    }

    if (tecla == 8) 
    { 
      tam = tam - 1; 
    }

    if (tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105) 
    { 
      if (tam <= 2) 
      { 
        strCampo.value = vr; 
      } 
       if ((tam > 2) && (tam <= 6)) 
       { 
         strCampo.value = vr.substr(0, tam - 2) + "-" + vr.substr(tam - 2, tam); 
       } 
       if ((tam >= 7) && (tam <= 9)) 
       { 
         strCampo.value = vr.substr(0, tam - 6) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 10) && (tam <= 12)) 
       { 
         strCampo.value = vr.substr(0, tam - 9) + "." + vr.substr(tam - 9, 3) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 13) && (tam <= 14)) 
       { 
         strCampo.value = vr.substr(0, tam - 12) + "." + vr.substr(tam - 12, 3) + "." + vr.substr(tam - 9, 3) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 15) && (tam <= 17)) 
       { 
         strCampo.value = vr.substr(0, tam - 14) + "." + vr.substr(tam - 14, 3) + "." + vr.substr(tam - 11, 3) + "." + vr.substr(tam - 8, 3) + "." + vr.substr(tam - 5, 3) + "-" + vr.substr(tam - 2, tam); 
      } 
    } 
  }

function TESTA() 
 { 
 if(VerifyCNPJ(document.forms[0].cnpj.value) == 1) 
  { 
  exit;
  } 
 else 
  { 
  alert("CNPJ não é válido!"); 
  
  } 
  
  if(VerifyCNPJ(document.forms[0].cnpj.value) == "")
      {
          exit;
      }else
          {
 document.forms[0].cnpj.focus(); 
 return; 
 }
 } 
</script>          
                
 <script language="Javascript">
function Contar(Campo){

if(Campo.value.length < 14)
alert('Atenção, número deve ser nesse formato: (##) ####-#### !');
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
            
            
 //Menu Clientes           
            if ($menu == "cliente")
            {
             
                //echo "Cadastro Cliente aqui";
            
                //include_once ("salvar_novo_cliente.php");
                
            ?>    
 
 <!-- Cadastrar novos Clientes -->  
 
 <script language="JavaScript">
<!--

/***********************************************
* Required field(s) validation v1.10- By NavSurf
* Visit Nav Surf at http://navsurf.com
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function formCheck(formobj){
	// Enter name of mandatory fields
	var fieldRequired = Array("razao_social", "nome_fantasia", "endereco", "bairro", "cod_estados", "cod_cidades", "phone");
	// Enter field description to appear in the dialog box
	var fieldDescription = Array("Razão Social", "Nome Fantasia", "Endereço", "Bairro", "Estado", "Cidade", "Telefone");
	// dialog message
	var alertMsg = "Por favor completar os campos:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == ""){
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
				if (obj.value == "" || obj.value == null){
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
 

 
            <h3 class="mypets">Novo Cliente (clique aqui)</h3>
           
            <div class="thepet" style="text-align: center;">
                
                 
                
                <form  method="post" action="salvar_novo_cliente.php" onsubmit="return formCheck(this);">       


                <table border="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <p>Pessoa física <input id="toggleElement" type="checkbox" name="tipo"  onchange="toggleStatus()" /></p>
                                        </th>
                                        <th COLSPAN="3">Classificação <select name="classificacao">
                                                            <option value="padrao">Padrão</option>
                                                            <option value="contrato">Contrato</option>
                                                        </select>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="label">Razão Social / Nome </td>
                                        <td class="input" COLSPAN="3"><input type="text" name="razao_social" value="" size="50px" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" /> </td>

                                    </tr>
                                    <tr>
                                        <td class="label">Nome Fantasia </td>
                                        <td class="input" COLSPAN="3"><input type="text" name="nome_fantasia" value="" size="50px" onkeyup="this.value = this.value.toUpperCase();"/></td>

                                    </tr>
                                    <tr>
                                        <td class="label">CNPJ</td>
                                        <td class="input">             
                                            <div id="elementsToOperateOn"><input type="text" id="cnpj" name="cnpj" alt="cnpj" onBlur="TESTA();" /></div>
                                            
                                        </td>
                                        <td class="label2">CPF</td>
                                        <td class="input2">
                                            <div id="elementsToOperateOn2"><input type="text" id="cpf" name="cpf" alt="cpf" disabled/><br /></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label">Inscrição Estadual</td>
                                        <td class="input">
                                            <input type="text" name="ie" alt="ie" id="ie" value="" size="10px" />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td class="label">Endereço</td>
                                        <td class="input" COLSPAN="3">
                                            <input type="text" name="endereco" value="" size="50px" maxlength="180" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                      
                                    </tr>
                                    <tr>
                                        <td class="label">Bairro</td>
                                        <td class="input" >
                                            <input type="text" name="bairro" value="" size="30px" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                        <td class="label2">CEP</td>
                                        <td class="input2">
                                            <input type="text" id="cep" name="cep" alt="cep" />
                                        </td>                                        
                                       
                                    </tr>
                                    <tr>
                                        <td class="label">Estado</td>
                                        <td class="input">
                                           <select name="cod_estados" id="cod_estados">
                                                <option value=""></option>
                                                    <?php
                                                            $sql = "SELECT cod_estados, sigla
                                                                            FROM estados
                                                                            ORDER BY sigla";
                                                            $res = mysql_query( $sql );
                                                            while ( $row = mysql_fetch_assoc( $res ) ) {
                                                                    echo '<option value="'.$row['cod_estados'].'">'.$row['sigla'].'</option>';
                                                            }
                                                    ?>
                                            </select>
                                        </td>
                                        <td class="label2">Cidade</td>
                                        <td class="input2">
                                            <span class="carregando">Aguarde, carregando...</span>
                                                <select name="cod_cidades" id="cod_cidades">
                                                        <option value="">-- Escolha um estado --</option>
                                                </select>

                                                <script src="http://www.google.com/jsapi"></script>
                                                <script type="text/javascript">
                                                  google.load('jquery', '1.3');
                                                </script>		

                                                <script type="text/javascript">
                                                $(function(){
                                                        $('#cod_estados').change(function(){
                                                                if( $(this).val() ) {
                                                                        $('#cod_cidades').hide();
                                                                        $('.carregando').show();
                                                                        $.getJSON('cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
                                                                                var options = '<option value=""></option>';	
                                                                                for (var i = 0; i < j.length; i++) {
                                                                                        options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                                                                                }	
                                                                                $('#cod_cidades').html(options).show();
                                                                                $('.carregando').hide();
                                                                        });
                                                                } else {
                                                                        $('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
                                                                }
                                                        });
                                                });
                                                </script>
                                        </td>                                      
                                    </tr>
                                    <tr>
                                        <td class="label">TEL</td>
                                        <td class="input">
                                            <input type="text" id="phone" name="phone" alt="phone" onchange="Contar(this)" />
                                        </td>
                                        <td class="label2">CEL</td>
                                        <td class="input2">
                                            <input type="text" id="cel" name="cel" alt="cel" onchange="Contar(this)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">FAX</td>
                                        <td class="input">
                                             <input type="text" id="fax" name="fax" alt="fax" onchange="Contar(this)" />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label">Email Técnico</td>
                                        <td class="input">
                                             <input type="email" id="email_tec" name="email_tec"  />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    
                                    </tr>
                                    <tr>
                                        <td class="label">Email Financ./Admin.</td>
                                        <td class="input">
                                             <input type="email" id="email_admin" name="email_admin"  />
                                        </td>  
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <input type="submit" value="Salvar" name="salvar_novo_cliente"  />
                                            <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
                                            
                                        </td>
                                      
                                    </tr>                                    
                                </tbody>
                            </table>

		
                </form>
                
            <!--p id="cnpj_cpf">CNPJ:  <input type="text" id="cnpj" name="cnpj" alt="cnpj" /> 

            <input onClick="return cpf()" name="submit" type="submit" value="CPF"  />
            </p-->
				
                
         </div>
            
<!-- Visualizar Clientes -->             
            <h3 class="mypets">Visualizar   (clique aqui)</h3>
           
            <div class="thepet" style="text-align: center;">
                
                  
                
                <iframe width="1000px" height="350px" frameborder="2" src="visualizar_clientes.php"></iframe>
                
                
            </div>
                
           <?php  
                
                
            } //final do conteudo de Clientes
            ?>
            
            
            
        </div>
        
        
        <div style="margin:20px 0px 20px 0px;">
            
            <?php
            
            
 //Menu Clientes           
            if ($menu == "fornecedor")
            {
             
                //echo "Cadastro Cliente aqui";
            
                //include_once ("salvar_novo_cliente.php");
                
            ?>    
 
 <!-- Cadastrar novos Clientes -->  
 
 <script language="JavaScript">
<!--

/***********************************************
* Required field(s) validation v1.10- By NavSurf
* Visit Nav Surf at http://navsurf.com
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function formCheck(formobj){
	// Enter name of mandatory fields
	var fieldRequired = Array("razao_social", "nome_fantasia", "endereco", "bairro", "cod_estados", "cod_cidades", "phone");
	// Enter field description to appear in the dialog box
	var fieldDescription = Array("Razão Social", "Nome Fantasia", "Endereço", "Bairro", "Estado", "Cidade", "Telefone");
	// dialog message
	var alertMsg = "Por favor completar os campos:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == ""){
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
				if (obj.value == "" || obj.value == null){
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
 

 
            <h3 class="mypets">Novo Fornecedor (clique aqui)</h3>
           
            <div class="thepet" style="text-align: center;">
                
                 
                
                <form  method="post" action="salvar_novo_fornecedor.php" onsubmit="return formCheck(this);">       


                <table border="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <p>Pessoa física <input id="toggleElement" type="checkbox" name="tipo"  onchange="toggleStatus()" /></p>
                                        </th>
                                        <th COLSPAN="3">Classificação <select name="classificacao">
                                                            <option value="padrao">Padrão</option>
                                                            <option value="contrato">Contrato</option>
                                                        </select>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="label">Razão Social / Nome </td>
                                        <td class="input" COLSPAN="3"><input type="text" name="razao_social" value="" size="50px" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" /> </td>

                                    </tr>
                                    <tr>
                                        <td class="label">Nome Fantasia </td>
                                        <td class="input" COLSPAN="3"><input type="text" name="nome_fantasia" value="" size="50px" onkeyup="this.value = this.value.toUpperCase();"/></td>

                                    </tr>
                                    <tr>
                                        <td class="label">CNPJ</td>
                                        <td class="input">             
                                            <div id="elementsToOperateOn"><input type="text" id="cnpj" name="cnpj" alt="cnpj" onBlur="TESTA();" /></div>
                                            
                                        </td>
                                        <td class="label2">CPF</td>
                                        <td class="input2">
                                            <div id="elementsToOperateOn2"><input type="text" id="cpf" name="cpf" alt="cpf" disabled/><br /></div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="label">Inscrição Estadual</td>
                                        <td class="input">
                                            <input type="text" name="ie" alt="ie" id="ie" value="" size="10px" />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td class="label">Endereço</td>
                                        <td class="input" COLSPAN="3">
                                            <input type="text" name="endereco" value="" size="50px" maxlength="180" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                      
                                    </tr>
                                    <tr>
                                        <td class="label">Bairro</td>
                                        <td class="input" >
                                            <input type="text" name="bairro" value="" size="30px" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                        <td class="label2">CEP</td>
                                        <td class="input2">
                                            <input type="text" id="cep" name="cep" alt="cep" />
                                        </td>                                        
                                       
                                    </tr>
                                    <tr>
                                        <td class="label">Estado</td>
                                        <td class="input">
                                           <select name="cod_estados" id="cod_estados">
                                                <option value=""></option>
                                                    <?php
                                                            $sql = "SELECT cod_estados, sigla
                                                                            FROM estados
                                                                            ORDER BY sigla";
                                                            $res = mysql_query( $sql );
                                                            while ( $row = mysql_fetch_assoc( $res ) ) {
                                                                    echo '<option value="'.$row['cod_estados'].'">'.$row['sigla'].'</option>';
                                                            }
                                                    ?>
                                            </select>
                                        </td>
                                        <td class="label2">Cidade</td>
                                        <td class="input2">
                                            <span class="carregando">Aguarde, carregando...</span>
                                                <select name="cod_cidades" id="cod_cidades">
                                                        <option value="">-- Escolha um estado --</option>
                                                </select>

                                                <script src="http://www.google.com/jsapi"></script>
                                                <script type="text/javascript">
                                                  google.load('jquery', '1.3');
                                                </script>		

                                                <script type="text/javascript">
                                                $(function(){
                                                        $('#cod_estados').change(function(){
                                                                if( $(this).val() ) {
                                                                        $('#cod_cidades').hide();
                                                                        $('.carregando').show();
                                                                        $.getJSON('cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
                                                                                var options = '<option value=""></option>';	
                                                                                for (var i = 0; i < j.length; i++) {
                                                                                        options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                                                                                }	
                                                                                $('#cod_cidades').html(options).show();
                                                                                $('.carregando').hide();
                                                                        });
                                                                } else {
                                                                        $('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
                                                                }
                                                        });
                                                });
                                                </script>
                                        </td>                                      
                                    </tr>
                                    <tr>
                                        <td class="label">TEL</td>
                                        <td class="input">
                                            <input type="text" id="phone" name="phone" alt="phone" onchange="Contar(this)" />
                                        </td>
                                        <td class="label2">CEL</td>
                                        <td class="input2">
                                            <input type="text" id="cel" name="cel" alt="cel" onchange="Contar(this)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">FAX</td>
                                        <td class="input">
                                             <input type="text" id="fax" name="fax" alt="fax" onchange="Contar(this)" />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label">Email Técnico</td>
                                        <td class="input">
                                             <input type="email" id="email_tec" name="email_tec"  />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    
                                    </tr>
                                    <tr>
                                        <td class="label">Email Financ./Admin.</td>
                                        <td class="input">
                                             <input type="email" id="email_admin" name="email_admin"  />
                                        </td>  
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <input type="submit" value="Salvar" name="salvar_novo_cliente"  />
                                            <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
                                            
                                        </td>
                                      
                                    </tr>                                    
                                </tbody>
                            </table>

		
                </form>
                
            <!--p id="cnpj_cpf">CNPJ:  <input type="text" id="cnpj" name="cnpj" alt="cnpj" /> 

            <input onClick="return cpf()" name="submit" type="submit" value="CPF"  />
            </p-->
				
                
         </div>
            
<!-- Visualizar Clientes -->             
            <h3 class="mypets">Visualizar   (clique aqui)</h3>
           
            <div class="thepet" style="text-align: center;">
                
                  
                
                <iframe width="1000px" height="350px" frameborder="2" src="visualizar_fornecedores.php"></iframe>
                
                
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
