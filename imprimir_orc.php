<?php


        include "checkuserlog.php";

        include_once "Config/config_sistema.php"; 

        $dyn_www = $_SERVER['HTTP_HOST'];  

        $menu = "";
        if(isSet ($_GET['id_menu'])) {
        
             $menu = $_GET['id_menu'];
        } 
		
		        $id_orcamento = "";
        if(isSet ($_GET['id_orc'])) {
        
             $id_orcamento = $_GET['id_orc'];
        } 
        
        
        //$id_orcamento = "17";
        
        
        										function limita_texto($texto, $limite, $quebra = true) {    
											$tamanho = strlen($texto);     
											// Verifica se o tamanho do texto é menor ou igual ao limite    
											if ($tamanho <= $limite) {        
												$novo_texto = $texto;    
											// Se o tamanho do texto for maior que o limite    
											} else {        
												// Verifica a opção de quebrar o texto        
												if ($quebra == true) {            
													$novo_texto = trim(substr($texto, 0, $limite)).'...';        
												// Se não, corta $texto na última palavra antes do limite        
												} else {            
													// Localiza o útlimo espaço antes de $limite            
													$ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');            
													// Corta o $texto até a posição localizada            
													$novo_texto = trim(substr($texto, 0, $ultimo_espaco)).'...';        
													}    
											}     
											// Retorna o valor formatado    
											return $novo_texto;
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
        <title></title>
        
	<meta name="description" content="">
	<meta name="author" content="Elfi Service">

	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href=".css">    

    <script src="js/jquery.min.js" type="text/javascript"></script>


       
    
<script type="text/javascript">
// Chama aba Seu Estado
$(document).ready(function() {

$("#colaborador_logado").load('colaborador_logado.php?id_colaborador=<?php echo $logOptions_id;?>');


});

</script>

    </head>
    
    <body>
  
        

	

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

        

        
        <div style="margin:20px 0px 20px 0px;">
            
       
            
            
            <?php
                $consulta_orc = mysql_query("select * from orcamentos WHERE id = '$id_orcamento' LIMIT 1");
		$linhaass = mysql_num_rows($consulta_orc);
										
		while($row =mysql_fetch_array($consulta_orc))
			
                     {          
            
                    $n_orc          = $row['n_orc'];
                    $ano_orc        = $row['ano_orc'];
                    $descricao_orc  = $row['descricao_servico_orc'];
                    $contato_contra = $row['contato_clint'];
                    
             //dados Contratante
                    $razao_contra   = $row['razao_social_contr'];
                    $endereco_contr = $row['endereco_contr'];
                    $bairro_contr   = $row['bairro_contr'];
                    $cidade_contr   = $row['cidade_contr'];
                    $estado_contr   = $row['estado_contr'];
                    $tel_contr      = $row['telefone_contr'];
                    $cel_contr      = $row['celular_contr'];
                    $email_contr    = $row['email_contr'];
                   
                    
                    $n_da_proposta = "$n_orc.$ano_orc";
                    
                    $razao_reduzida     = limita_texto("$razao_contra", 30);
                    $descricao_reduzida = limita_texto("$descricao_orc", 30);
                    $title              = "ORC - $n_orc ( $razao_reduzida - $descricao_reduzida )";
                    
                    $endereco_completo = "$endereco_contr - $bairro_contr - $cidade_contr-$estado_contr";
                    
                    
                    if ($cel_contr == "" && $email_contr == "")
                    {
                        $contato_completo = "$contato_contra - $tel_contr";
                        
                    } else if ($cel_contr == "" && $email_contr <> "")
                    {
                        $contato_completo = "$contato_contra - $tel_contr - $email_contr";
                    } else if ($cel_contr <> "" && $email_contr == "")
                    {
                        $contato_completo = "$contato_contra - $tel_contr - $cel_contr";
                    } else 
                    {
                        
                         $contato_completo = "$contato_contra - $tel_contr - $cel_contr - $email_contr";
                    }
                    
              //dados Obra
                    $razao_obra   = $row['razao_social_obra'];
                    $endereco_obra = $row['endereco_obra'];
                    $bairro_obra   = $row['bairro_obra'];
                    $cidade_obra   = $row['cidade_obra'];
                    $estado_obra   = $row['estado_obra'];
                    $tel_obra      = $row['telefone_obra'];
                    $cel_obra      = $row['celular_obra'];
                    $email_obra    = $row['email_obra'];
                    
                    $endereco_completo_obra = "$endereco_obra - $bairro_obra - $cidade_obra-$estado_obra";
                    
                    if ($cel_obra == "" && $email_obra == "")
                    {
                        $contato_completo_obra = "  - $tel_obra";
                        
                    } else if ($cel_obra == "" && $email_obra <> "")
                    {
                        $contato_completo_obra = "  - $tel_obra - $email_obra";
                    } else if ($cel_obra <> "" && $email_obra == "")
                    {
                        $contato_completo_obra = "  - $tel_obra - $cel_obra";
                    } else 
                    {
                        
                         $contato_completo_obra = "  - $tel_obra - $cel_obra - $email_obra";
                    }                    
              
            //at5v5dade
                    $atividade      = $row['atividade'];
                    $classificacao  = $row['classificacao'];
                    $quantidade     = $row['quantidade'];
                    $unidade        = $row['unidade'];                    
                    
                    $atividade_completo = "$atividade - $classificacao";
                    
             //valor da proposta
                    $vr_servco_orc      = $row['vr_servco_orc'];
                    $vr_material_orc  = $row['vr_material_orc'];
                    $desconto_orc     = $row['desconto_orc'];
                    $vr_total_orc     = $row['vr_total_orc'];
                  
                    if ($desconto_orc == "" || $desconto_orc == null)
                        {
                    
                    
                    $valor_completo_orc = "Valor do serviço: R$ $vr_servco_orc &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Valor do material: R$ $vr_material_orc &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Valor total: R$ $vr_total_orc";
                        } else
                        {
                            $valor_completo_orc = "Valor do serviço: R$ $vr_servco_orc     Valor do material: R$ $vr_material_orc     Valor do desconto: R$ $desconto_orc     Valor total: R$ $vr_total_orc";
                        }
                        
                        
             //condições
                    $prazo_exec_orc     = $row['prazo_exec_orc'];
                    $validade_orc       = $row['validade_orc'];
                    $pagamento_orc      = $row['pagamento_orc'];                        

                    $prazo_validade_completo_orc = "Prazo para execução: $prazo_exec_orc dias &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Validade da proposta: $validade_orc dias";
                    $pagamento_completo_orc = "Condições de pagamento: $pagamento_orc";
                    
          //Observações
                    $obs_orc     = $row['obs_orc'];  
                    
          //duvidas
                    $duvida_orc     = $row['duvida_orc'];                      
                        
            ?>    
                    
            
              <script>
                
                document.title = "<?php echo $title; ?>";
            </script>   

            
            <table border="0"    CELLPADDING="5" style="border-collapse: collapse"   >
                <tr bordercolor=""  >
                    <td colspan="" >
                        <img src="imagens/logo_elfi.jpg" id="" />
                        
                    </td>
                    <td align="center" colspan="8">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px; color: #3E4B95;">
                            
                        
                            Montagens e Manutenções de: Subestações, Transformadores, Grupo Geradores, Disjuntores Banco de Capacitores Fixo e Automático, Quadros de Comando, Força e Luz, S.P.D.A., Tratamento de Óleo Isolante pelo processo Termo-Vácuo, Comissionamento de Subestação, Termografia.
 Desde 1993 trazendo soluções para sua empresa.
                        </div>
                        
                      
                        
                    </td>
                    <td align="center" colspan="">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 16px;">
                            <div >
                                Proposta
                            </div>
                            <b><?php echo $n_da_proposta; ?></b>
                            
                        </div>
                        
                        
                    </td>

                    
                </tr>

                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Dados da Contratante
                         
                        </div>
                        
                        
                    </td>

                </tr>
                <tr >
                   <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;" >
                  
                              Razão social:
                         
                        </div>
                    </td>
                    <Td colspan="4" width="1000">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $razao_contra;  ?>
                        </div>
                    </td>

                    <td width="50"> <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                    CNPJ:
                         </div></td>
                     <Td colspan="4" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $row['cnpj_contr'];  ?>
                        </div>
                    </td>
                    
                </tr>
                 <tr>
                   <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                  
                              Endereço:
                         
                        </div>
                    </td>
                    <Td colspan="9" width="800">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $endereco_completo;  ?>
                        </div>
                    </td>


                    
                </tr>               
                 <tr>
                   <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                  
                              Contato:
                         
                        </div>
                    </td>
                    <Td colspan="9" width="800">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $contato_completo;  ?>
                        </div>
                    </td>


                    
                </tr> 
    <?php            
         if ($razao_obra == ""){
             
    ?>
                        
                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Dados da Obra igual aos da Contratante
                         
                        </div>
                        
                        
                    </td>

                </tr>
                
                
    <?php
             
             
         } else {
             
             ?>
         
                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Dados da Obra
                         
                        </div>
                        
                        
                    </td>

                </tr>
                
<tr >
                   <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;" >
                  
                              Razão social:
                         
                        </div>
                    </td>
                    <Td colspan="4" width="1000">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $razao_obra;  ?>
                        </div>
                    </td>

                    <td width="50"> <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                    CNPJ:
                         </div></td>
                     <Td colspan="4" width="1000">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $row['cnpj_obra'];  ?>
                        </div>
                    </td>
                    
                </tr>
                 <tr>
                   <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                  
                              Endereço:
                         
                        </div>
                    </td>
                    <Td colspan="9" width="800">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $endereco_completo_obra;  ?>
                        </div>
                    </td>


                    
                </tr>               
                 <tr>
                   <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                  
                              Contato:
                         
                        </div>
                    </td>
                    <Td colspan="9" width="800">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $contato_completo_obra;  ?>
                        </div>
                    </td>


                    
                </tr>                 
          <?php
         }
          ?>
                
                
           
                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Atividade / Classificação
                         
                        </div>
                        
                        
                    </td>

                </tr>              
                 <tr>

                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $atividade_completo;  ?>
                        </div>
                    </td>


                    
                </tr>                   
           
                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Descrição dos Serviços
                         
                        </div>
                        
                        
                    </td>

                </tr> 
                 <tr>

                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $descricao_orc;  ?>
                        </div>
                    </td>


                    
                </tr>                 

                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Valor da Proposta
                         
                        </div>
                        
                        
                    </td>

                </tr>                 
                 <tr>

                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $valor_completo_orc;  ?>
                        </div>
                    </td>


                    
                </tr>                
                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Condições
                         
                        </div>
                        
                        
                    </td>

                </tr>                 
                 <tr>

                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $prazo_validade_completo_orc;  ?>
                        </div>
                    </td>

                    
                </tr>
                 <tr>

                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $pagamento_completo_orc;  ?>
                        </div>
                    </td>

                    
                </tr> 
                
 <?php
           if($obs_orc == ""){
               
               
           }else
           {
 
 ?>
                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Observações
                         
                        </div>
                        
                        
                    </td>

                </tr>                 
                 <tr>

                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $obs_orc;  ?>
                        </div>
                    </td>

                    
                </tr>     
    <?php
           }
    ?>
                

                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Dúvidas / Negociações
                         
                        </div>
                        
                        
                    </td>

                </tr>                 
                 <tr>

                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $duvida_orc;  ?>
                        </div>
                    </td>

                    
                </tr>                  
                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                     <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                  
                              Assinaturas
                         
                        </div>
                        
                        
                    </td>

                </tr>                 
                 <tr>

                    <Td colspan="4" width="" align="center">  
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <br>
                            <br>
                            <br>
                            ________________________________________<br>         
                            Elfi Service / carimbo
                            <br>
                            <br>
                            <br>
                        </div>
                    </td>
                    <Td colspan="6" width="" align="center">  
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <br>
                            <br>
                            <br>
                            ________________________________________<br>         
                            De acordo / carimbo
                            <br>
                            <br>
                            <br>
                        </div>
                    </td>                    

                    
                </tr>                 

                
                 <tr>

                    <Td colspan="10" width="" align="center">  <div style="color: #3E4B95; font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                          CNPJ 73.624.165/0001-08 - Rua Cap. Vasconcelos, 645 – Aerolândia – Fortaleza-CE – Fone: (85) 3227.6307 – Fax: (85) 3227.6068
CEP: 60.851-010 – elfi@elfiservice.com.br – www.elfiservice.com.br

                        </div>
                    </td>

                    
                </tr>                 
            </table>   
                 
                    
            <?php        
            
                }
            ?>
            
            
            
        </div>
        
        
  <?php
}
  ?>
        
        
        
    </body>
</html>