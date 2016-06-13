<?php

include_once "../Config/config_sistema.php"; 

if (isset ($_POST['cliente']))
    {

	$id_orc = $_POST['id_orc'];
    $cliente = $_POST['cliente'];  
    $n_orc = $_POST['n_orc'];
    $email = $_POST['email'];
	$id_usuario = $_POST['usuario'];

 
	 //dados Descrição do Orçamento
     $descricao    = $_POST['descricao'];
     $descricao    = nl2br($descricao);

                

				
						
        $sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die (mysql_error()); 
		$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $nome_usuario = $linha_usuario->Login;
                
     
         
		 
		mysql_query("UPDATE acompanhamento SET inf_servicos = '$descricao' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));	
		mysql_query("UPDATE acompanhamento SET feito_pos_entreg = 's' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));		 		
		mysql_query("UPDATE acompanhamento SET email = '$email' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));		 
	
     
//enviar EMAIL

		// $sql_acompa_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id='$id_orc_acomp'") or die (mysql_error()); 
		// $linha = mysql_fetch_object($sql_acompa_orc);
                
                // $id_orc = $linha->id_acompanhamento;


		// $sql_acompa_orc = mysql_query("SELECT * FROM acompanhamento WHERE id='$id_orc_acomp'") or die (mysql_error()); 
		// $linha = mysql_fetch_object($sql_acompa_orc);
                
                // $cliente = $linha->cliente;
				// $inf_servicos = $linha->inf_servicos;
				// $n_orc = $linha->n_orc;

//ENVIAR EMAIL PRA ATIVAÇÃO DA CONTA COM IMAGEM E EM HTML

$email_cliente = $email;
$email1 = "junior@elfiservice.com.br";
$email2 = "lana@elfiservice.com.br";
//$email3 = "edson@elfiservice.com.br";
//$email4 = "armando@elfiservice.com.br";

$imagem_nome="";
$arquivo=fopen($imagem_nome,'r');
$contents = fread($arquivo, filesize($imagem_nome));
$encoded_attach = chunk_split(base64_encode($contents));
fclose($arquivo);
$limitador = "_=======". date('YmdHms'). time() . "=======_";

$mailheaders = "From: junior@elfiservice.com.br\r\n";
$mailheaders .= "MIME-version: 1.0\r\n";
$mailheaders .= "Content-type: multipart/related; boundary=\"$limitador\"\r\n";
$cid = date('YmdHms').'.'.time();

$texto="
<html>
<body>

<table width=\"auto\" align=\"center\" style=\"margin: 0 auto;\">

  <tr>
    
    <td>
		<div style=\" padding: 10px 10px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;   border:1px solid #DDD;\">
			<h2>Pós-entrega serviço ELFI</h2>
			
		</div>
	</td>
</tr>

  <tr>
    
    <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Cliente: <br>
		<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
			$cliente
		</div>	
		</div>
	</td>
	    <td>
		
			
		
	</td>
</tr>	
<tr>	
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Nº do orçamento: <br>
			<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
				$n_orc
			</div>
		</div>
	</td>
	 <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			
		</div>
	</td>		
</tr>
<tr>	
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Inf. de serviços: <br>
			<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
				$descricao
			</div>
		</div>
	</td>
</tr>
<tr>	
	 <td>
		<div style=\" padding: 10px 5px; font: 12px verdana, arial, helvetica, sans-serif; \">
				<br>
				A ELFI esta com um Sistema de Qualidade e gostaríamos que você, nosso cliente e parceiro, venha conosco.
				<br><br>
				Acesse o Link no nosso SITE abaixo e responda a nossa pesquisa de satisfação para o serviço Executado.
				<br><br>
				http://elfiservice.eco.br/pesquisa_satisfacao_elfi.php
				<br><br>
				A Elfi agradece.
		</div>
	</td>	
</tr>


</table>



</body>
</html>
";

$msg_body = "--$limitador\r\n";
$msg_body .= "Content-type: text/html; charset=utf-8\r\n";
$msg_body .= "$texto";
$msg_body .= "--$limitador\r\n";
$msg_body .= "Content-type: image/jpeg; name=\"$imagem_nome\"\r\n";
$msg_body .= "Content-Transfer-Encoding: base64\r\n";
$msg_body .= "Content-ID: <$cid>\r\n";
$msg_body .= "\n$encoded_attach\r\n";
$msg_body .= "--$limitador--\r\n";


mail($email_cliente,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);
mail($email1,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);
mail($email2,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);	
//mail($email3,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);	
//mail($email4,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);	 
	 
	 
	 
	 
	 
	 
	 
	 
    echo "Pós entrega enviada com Sucesso!";
     
     
     
     ?>
                    <script type="text/javascript" >
alert ("Pos entrega enviada com Sucesso!");
</script>
    

<a href="javascript:window.close();">Fechar</a>


<?php
 /*    
     header("location: financeiro.php"); // Shoot viewer back to the homepage of the site if they try to look here
exit();
          * 
  */
    
  }
 
?>
