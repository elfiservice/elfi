<?php
 

        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 

		
				        $id_orc = "";
        if(isSet ($_GET['id_orc'])) {
        
             $id_orc = $_GET['id_orc'];
        } 
		
			$sql_nome_user = mysql_query("SELECT * FROM acompanhamento WHERE id = '$id_orc'") or die (mysql_error()); 
			$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $cliente = $linha_usuario->cliente;
				$atividade = $linha_usuario->atividade;
				$classificacao = $linha_usuario->classificacao;
				$inf_servicos = $linha_usuario->inf_servicos;
				$novo_cliente = $linha_usuario->novo_cliente;
				$n_orc = $linha_usuario->n_orc;
				$prazo_exec = $linha_usuario->prazo_exec;
				$email = $linha_usuario->email;
				$data_aprovada = $linha_usuario->data_aprovada;
				
				$data_inicio = $linha_usuario->data_inicio;
				$data_conclusao = $linha_usuario->data_conclusao;
				$feito_pos_entreg = $linha_usuario->feito_pos_entreg;
				$nao_conformidade = $linha_usuario->nao_conformidade;
				$obs_n_conformidad = $linha_usuario->obs_n_conformidad;
				$client_insatisfeito = $linha_usuario->client_insatisfeito;
				$vr_proposta_aprovada = $linha_usuario->vr_orc;
				
				
				
				

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

<script language="JavaScript" type="text/javascript">
   function mascaraData(campoData){
              var data = campoData.value;
              if (data.length == 2){
                  data = data + '/';
                  document.forms[0].data.value = data;
      return true;              
              }
              if (data.length == 5){
                  data = data + '/';
                  document.forms[0].data.value = data;
                  return true;
              }
         }
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



<a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
 <script language="JavaScript">
<!--

/***********************************************
* Required field(s) validation v1.10- By NavSurf
* Visit Nav Surf at http://navsurf.com
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function formCheck(formobj){
	// Enter name of mandatory fields
	var fieldRequired = Array("clientID", "n_orc", "email_orc", "descricao_servicos", "atividade1", "classificacao1", "novo_cliente", "data", "prz_execucao");
	// Enter field description to appear in the dialog box
	var fieldDescription = Array("Cliente", "Nº do orçamento", "Email","Descrição dos serviços", "Atividade do serviço", "Classificação", "se o cliente é novo", "Data da aprovação", "Prazo de execução");
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
                
                 
                
            <form name="clientForm" method="post" action="salvar_orc_editado.php" onsubmit="return formCheck(this);">       

            <fieldset>
            <legend><h3>Dados</h3></legend>
                <table border="0">
                                <tbody>

                                    <tr align="left">
                                        <td><label for="clientID">Cliente: </label></br>
                                            <select id="clientID" name="clientID">
                                                <option value="<?php echo $cliente; ?>"><?php echo $cliente; ?></option>
                                                    <?php
                                                            $sql = "SELECT razao_social
                                                                            FROM clientes
                                                                            ORDER BY razao_social";
                                                            $res = mysql_query( $sql );
                                                            while ( $row = mysql_fetch_assoc( $res ) ) {
                                                                    echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
                                                            }
                                                    ?>
                                                            
                                           </select>
                                            
                                        </td>

                                    </tr>
                                <tr align="left">
                                    
                                    <td><label for="n_orc">Nº Orçamento:</label></br>
                                    <input name="n_orc" id="n_orc" value="<?php echo $n_orc; ?>" size="10" maxlength="8">
                                    
                                    </td>
                                 
                                    
                                    
                                </tr> 
                                <tr align="left">
                                    
                                    <td><label for="novo_cliente">Novo cliente? :</label></br>
									<?php
								if ($novo_cliente == 's') {

									?>
                                    <input type="radio" name="novo_cliente" value="s" checked> Sim 
									<input type="radio" name="novo_cliente" value="n"> Não
                                 <?php
									} else {
									
									
?>								 	<input type="radio" name="novo_cliente" value="s" > Sim 
									<input type="radio" name="novo_cliente" value="n" checked> Não
                                    <?php
									}
									?>
									
									</td>
                                 
                                    
                                    
                                </tr> 	
								<tr align="left">
                                    
                                    <td><label for="prz_execucao">Prazo execução:</label></br>
										<input type="number" value="<?php echo $prazo_exec; ?>" name="prz_execucao" id="prz_execucao" size="3" maxlength="3">
                                    
                                    </td>
                                 
                                    
                                    
                                </tr> 
								<tr align="left">
                                    
                                    <td><label for="data_aprovada">Data Aprovado:</label></br>
										<input type="text" value="<?php echo $data_aprovada; ?>" name="data" id="data" maxlength="10" >
                                    
                                    </td>
									
									<td><label for="data_inicio">Data Inicio:</label></br>
										<input type="text" value="<?php echo $data_inicio; ?>" name="data_inicio" id="data_inicio" maxlength="10" >
                                    
                                    </td>
									
									<td><label for="data_aprovada">Data Conclusao:</label></br>
										<input type="text" value="<?php echo $data_conclusao; ?>" name="data_conclusao" id="data_conclusao" maxlength="10" >
                                    
                                    </td>
                                 
                                    
                                    
                               

                                    <td><label for="nao_conformidade">Não conformidades? :</label></br>
									<?php
								if ($nao_conformidade == 's') {

									?>
                                    <input type="radio" name="nao_conformidade" value="s" checked> Sim 
									<input type="radio" name="nao_conformidade" value="n"> Não
                                 <?php
									} else {
									
									
?>								 	<input type="radio" name="nao_conformidade" value="s" > Sim 
									<input type="radio" name="nao_conformidade" value="n" checked> Não
                                    <?php
									}
									?>
									
									</td>
								<td><label for="nao_conformidade">Cliente insatisfeito? :</label></br>
									<?php
								if ($client_insatisfeito == 's') {

									?>
                                    <input type="radio" name="client_insatisfeito" value="s" checked> Sim 
									<input type="radio" name="client_insatisfeito" value="n"> Não
                                 <?php
									} else {
									
									
?>								 	<input type="radio" name="client_insatisfeito" value="s" > Sim 
									<input type="radio" name="client_insatisfeito" value="n" checked> Não
                                    <?php
									}
									?>
									
									</td>
 								 </tr>

                                <tr align="left">
                                    
                                    <td><label for="email_orc">Email:</label></br>
                                    <input name="email_orc" value="<?php echo $email; ?>" id="email_orc" size="20" maxlength="255">
                                    
                                    </td>
                                 
                                    
                                    
                                </tr>                                
                                </tbody>
                </table>
           </fieldset>


		   
                 
           <fieldset>
            <legend><h3>Classificação da Atividade</h3></legend>
            
             <table border="0">
                                <tbody>



                               <tr align="left">
                                    <td><label for="atividade" size="20">Atividade</label>
                                    
                                            

                                            
                                    </td>

                                    <td><label for="classificacao">Classificação:</label>
                                     
                                    </td>
                                    
                                    
                                </tr>
                                <tr align="left">
                                    
                                    <td>
                                        <select id="" name="atividade1">
                                                <option name="" value="<?php echo $atividade; ?>" ><?php echo $atividade; ?> </option>
                                                    <?php
                                                            $sql = "SELECT *
                                                                            FROM orc_atividades
                                                                            ORDER BY atividade";
                                                            $res = mysql_query( $sql );
                                                            while ( $row = mysql_fetch_assoc( $res ) ) {
                                                                    echo '<option id="" value="'.utf8_encode($row['atividade']).'" >'. utf8_encode($row['atividade']).'</option>';
                                                             }
                                                    ?>
                                                       
                                         </select>
                                    
                                    </td>
                                     <td>
                                        <select id="" name="classificacao1">
                                                <option value="<?php echo $classificacao; ?>" ><?php echo $classificacao; ?></option>
                                                    <?php
                                                            $sql = "SELECT *
                                                                            FROM orc_classificacao_ativid
                                                                            ORDER BY classificacao";
                                                            $res = mysql_query( $sql );
                                                            while ( $row = mysql_fetch_assoc( $res ) ) {
                                                                    echo '<option id="" value="'.utf8_encode($row['classificacao']).'" >'.utf8_encode($row['classificacao']).'</option>';
                                                             }
                                                    ?>
                                                       
                                         </select>
                                    
                                    </td>
                                 
                                    
                                    
                                </tr>
                              
                                </tbody>
                </table>
            
           </fieldset>
                    
                    
          <fieldset>
              <legend><h3>Descrição dos Serviços</h3></legend>
            
            
                         <textarea onfocus="init();" rows="1" cols="100" style="height:1em;" id="text" name="descricao_servicos"><?php echo $inf_servicos; ?></textarea>
                  								
							</br>
									<label for="email_orc">OBS da não conformidade:</label></br>
									<textarea  rows="1" cols="100" style="height:1em;" id="text" name="obs_n_conformidad"><?php echo $obs_n_conformidad; ?></textarea>
							    
                         
          </fieldset>
                    
					
			          <fieldset>
              <legend><h3>Valor da Proposta</h3></legend>
            
            
                  <input name="vr_proposta_aprovada" id="vr_proposta_aprovada" value="<?php echo $vr_proposta_aprovada; ?>" size="15" maxlength="15">        
                  
          </fieldset>		

                  
               
                    
						<table border="0">
                            
                               <tr align="left">
                                    <td>
                                        

                                        <input type="submit" value="Salvar Orçamento" name="salvar_orc" />
                                        <input type="hidden" value="<?php echo date('Y'); ?>" name="ano_atual_orc" hidden="hidden" />
                                        <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
										<input type="hidden" name="id_orc" value="<?php echo $id_orc; ?>" readonly="readonly" />
                                     
                                    </td>

                                 
                                    
                                </tr>

                         </table>
                </form>
                
				
				
				
				
              </div>
			  <div class="thepet" style="text-align: center;">

					<form name="clientFormexcluir" method="post" action="excluir_orc.php" > 
					
						<input type="submit" value="EXCLUIR Orçamento" name="excluir_orc" />
						<input type="hidden" name="id_orc" value="<?php echo $id_orc; ?>" readonly="readonly" />
					
					</form>
			</div>
<?php
}

?>

</body>
</html>