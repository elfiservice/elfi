<?php

include_once "../Config/config_sistema.php"; 


//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['clientID']))
    {
	
	$id_orc =		 $_POST['id_orc'];  
    $id_usuario =		 $_POST['usuario'];  
    $razao_social =		 $_POST['clientID'];
    $n_orc =			 $_POST['n_orc'];
   // $contato_clint =	 $_POST['contato_clint'];
    $atividade1 =		 $_POST['atividade1'];
    $classificacao1 =	 $_POST['classificacao1'];
	$novo_cliente =		 $_POST['novo_cliente'];   
	$prz_execucao =		 $_POST['prz_execucao'];   
	$data_aprovada =	 $_POST['data'];   
	$email_orc =	 $_POST['email_orc'];   
	
	// $data_aprovada = explode('/', $data_aprovada);
 	// $ano = $data_aprovada[2];
	// $mes = $data_aprovada[1];					
	// $dia = $data_aprovada[0];
	// $data_aprovada = "$ano-$mes-$dia";
	// $ano_da_aprovacao_orc = $ano;
     $data_inicio =		 $_POST['data_inicio'];   
	 $data_conclusao =		 $_POST['data_conclusao'];
	 //$feito_pos_entreg =		 $_POST['feito_pos_entreg'];
	 $nao_conformidade =		 $_POST['nao_conformidade'];
	 $obs_n_conformidad =		 $_POST['obs_n_conformidad'];
	 $obs_n_conformidad    = nl2br($obs_n_conformidad);
	 $client_insatisfeito =		 $_POST['client_insatisfeito'];

	 //dados Descrição do Orçamento
     $descricao_servicos    = $_POST['descricao_servicos'];
     $descricao_servicos    = nl2br($descricao_servicos);

	  $vr_proposta_aprovada = $_POST['vr_proposta_aprovada'];
	 
	 									// $data_hoje = date('Y-m-d');
										// $diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// // 24 horas * 60 Min * 60 seg = 86400
										// $days = ceil($diff/86400);
                

         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE id ='$id_orc'") or die (mysql_error()); 
		$n_orc_check = mysql_num_rows($sql_n_orc); 
		$linha_orc = mysql_fetch_object($sql_n_orc);
   
			$vr_orc = $linha_orc->vr_orc;
   
   
						
	if ($n_orc_check > 0)
	{					
						
						
        $sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die (mysql_error()); 
		$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $nome_usuario = $linha_usuario->Login;
                
				
		mysql_query("UPDATE acompanhamento SET colab = '$nome_usuario' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET cliente = '$razao_social' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET atividade = '$atividade1' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET classificacao = '$classificacao1' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET inf_servicos = '$descricao_servicos' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET novo_cliente = '$novo_cliente' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET n_orc = '$n_orc' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET prazo_exec = '$prz_execucao' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET data_aprovada = '$data_aprovada' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET email = '$email_orc' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET data_inicio = '$data_inicio' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET data_conclusao = '$data_conclusao' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));		
		//mysql_query("UPDATE acompanhamento SET feito_pos_entreg = '$feito_pos_entreg' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET nao_conformidade = '$nao_conformidade' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET obs_n_conformidad = '$obs_n_conformidad' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		mysql_query("UPDATE acompanhamento SET client_insatisfeito = '$client_insatisfeito' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		

		
//ENVIAR EMAIL QUANDO alterar valor proposta
if ($vr_orc <> $vr_proposta_aprovada) {


$email1 = "junior@elfiservice.com.br";
$email2 = "lana@elfiservice.com.br";


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
			<h2>Valor da Proposta Alterada  - ELFI</h2>
			
		</div>
	</td>
</tr>

  <tr>
    
    <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Cliente: <br>
		<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
			$razao_social
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
				$descricao_servicos
			</div>
		</div>
	</td>
</tr>	
<tr>
	 <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Valor da proposta Alterada: <br>
			<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
				Passou de : $vr_orc <br><br>
				Para: $vr_proposta_aprovada
			</div>
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


//mail($email_cliente,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);
mail($email1,"Valor da Proposta Alterada ELFI - sistema",$msg_body, $mailheaders);
mail($email2,"Valor da Proposta Alterada ELFI - sistema",$msg_body, $mailheaders);	

	

mysql_query("UPDATE acompanhamento SET vr_orc = '$vr_proposta_aprovada' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));	
	
}		
		
		
		
		
//ENVIAR EMAIL QUANDO POR DATA DE INICIO
if ($data_inicio <> "0000-00-00") {

	//mysql_query("UPDATE acompanhamento SET serv_concluido = 's' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

//ENVIAR EMAIL PRA ATIVAÇÃO DA CONTA COM IMAGEM E EM HTML

//$email_cliente = $email;
$email1 = "junior@elfiservice.com.br";
$email2 = "lana@elfiservice.com.br";
$email3 = "edson@elfiservice.com.br";
$email4 = "armando@elfiservice.com.br";

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
			<h2>Serviço PROGRAMADO  - ELFI</h2>
			
		</div>
	</td>
</tr>

  <tr>
    
    <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Cliente: <br>
		<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
			$razao_social
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
				$descricao_servicos
			</div>
		</div>
	</td>
</tr>	
<tr>
	 <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Data Programada para Inicio: <br>
			<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
				$data_inicio
			</div>
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


//mail($email_cliente,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);
mail($email1,"Data inicio de serviço ELFI - sistema",$msg_body, $mailheaders);
mail($email2,"Data inicio de serviço ELFI - sistema",$msg_body, $mailheaders);	
mail($email3,"Data inicio de serviço ELFI - sistema",$msg_body, $mailheaders);	
mail($email4,"Data inicio de serviço ELFI - sistema",$msg_body, $mailheaders);	
	
	
	
}



//ENVIAR EMAIL QUANDO POR DATA DA CONCLUSÃO - ORÇAMENTO CONLCUIDO	

if ($data_conclusao <> "0000-00-00") {

	mysql_query("UPDATE acompanhamento SET serv_concluido = 's' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

//ENVIAR EMAIL PRA ATIVAÇÃO DA CONTA COM IMAGEM E EM HTML

//$email_cliente = $email;
$email1 = "junior@elfiservice.com.br";
$email2 = "lana@elfiservice.com.br";
$email3 = "edson@elfiservice.com.br";
$email4 = "armando@elfiservice.com.br";

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
			<h2>Serviço CONCLUÍDO  - ELFI</h2>
			
		</div>
	</td>
</tr>

  <tr>
    
    <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Cliente: <br>
		<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
			$razao_social
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
				$descricao_servicos
			</div>
		</div>
	</td>
</tr>	
<tr>
	 <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Data conclusão: <br>
			<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
				$data_conclusao
			</div>
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


//mail($email_cliente,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);
mail($email1,"Conclusão de serviço ELFI - sistema",$msg_body, $mailheaders);
mail($email2,"Conclusão de serviço ELFI - sistema",$msg_body, $mailheaders);	
mail($email3,"Conclusão de serviço ELFI - sistema",$msg_body, $mailheaders);	
mail($email4,"Conclusão de serviço ELFI - sistema",$msg_body, $mailheaders);	
	
	
	
}





		 // Add user info into the database table for the main site table
     // $sql = mysql_query("INSERT INTO acompanhamento (colab, cliente, atividade, classificacao, inf_servicos, novo_cliente, n_orc, prazo_exec, data_aprovada, email, dias_d_aprovado, ano) 
     // VALUES('$nome_usuario','$razao_social', '$atividade1','$classificacao1', '$descricao_servicos', '$novo_cliente', '$n_orc', '$prz_execucao', '$data_aprovada', '$email_orc', '$days', '$ano_da_aprovacao_orc')")  
     // or die (mysql_error());         
         
     
    echo "Orçamento editado com Sucesso!";
     
     
     
     ?>
                    <script type="text/javascript" >
alert ("Orçamento editado com Sucesso!");
</script>
    
<a href="javascript:window.history.go(-2)">Voltar</a>
<!--a href="novo_orc_aprovado.php?id_orc=&msg_erro=#" target="_self">Voltar</a-->


<?php
 /*    
     header("location: financeiro.php"); // Shoot viewer back to the homepage of the site if they try to look here
exit();
          * 
  */
    }
  }
 
?>

