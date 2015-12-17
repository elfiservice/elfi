<?php

include_once "../Config/config_sistema.php"; 



//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['clientID']))
    {

	
    $id_usuario = $_POST['usuario'];  
    
     $razao_social = $_POST['clientID'];
     $n_orc = $_POST['n_orc'];

     $contato_clint = $_POST['contato_clint'];

     $atividade1 = $_POST['atividade1'];

     $classificacao1 = $_POST['classificacao1'];
	 
	 	$novo_cliente = $_POST['novo_cliente'];   

	$prz_execucao = $_POST['prz_execucao'];   
	
	$data_aprovada = $_POST['data'];   
	$data_aprovada = explode('/', $data_aprovada);
 	$ano = $data_aprovada[2];
	$mes = $data_aprovada[1];					
	$dia = $data_aprovada[0];
	$data_aprovada = "$ano-$mes-$dia";
	
	 $ano_da_aprovacao_orc = $ano;
     $email_orc = $_POST['email_orc'];   
	 
	 //dados Descrição do Orçamento
     $descricao_servicos    = $_POST['descricao_servicos'];
     $descricao_servicos    = nl2br($descricao_servicos);

	   //$vr_proposta_aprovada = str_replace(',','.',$_POST['vr_proposta_aprovada']);
		

		
		 $vr_proposta_aprovada = $_POST['vr_proposta_aprovada'];
// $vr_proposta_aprovada = formataVlrMonetario($dblPreco);
			$vr_proposta_aprovada = str_replace(",", "", $vr_proposta_aprovada);

	 
	 
	 									$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
                
				$ano_hj = date('Y');

         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE n_orc='$n_orc' AND ano = '$ano_hj'") or die (mysql_error()); 
		$n_orc_check = mysql_num_rows($sql_n_orc); 				
				
                        
						
	if ($n_orc_check > 0)
                {
                  ?>
                    <script type="text/javascript" >
                        alert ("N. de orcamento ja cadastrada no sistema! \n  Orcamento NAO cadastrado.");
                                                exit();
                    </script>
                    
                    <meta http-equiv="refresh" content="0;url=javascript:history.back()" >
                    <a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
                    <?php
					
                 } else {					
						
						
        $sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die (mysql_error()); 
		$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $nome_usuario = $linha_usuario->Login;
                
         

    // Add user info into the database table for the main site table
     $sql = mysql_query("INSERT INTO acompanhamento (colab, cliente, atividade, classificacao, inf_servicos, novo_cliente, n_orc, prazo_exec, data_aprovada, email, dias_d_aprovado, ano, vr_orc) 
     VALUES('$nome_usuario','$razao_social', '$atividade1','$classificacao1', '$descricao_servicos', '$novo_cliente', '$n_orc', '$prz_execucao', '$data_aprovada', '$email_orc', '$days', '$ano_da_aprovacao_orc', '$vr_proposta_aprovada')")  
     or die (mysql_error());         
         
     
//enviar EMAIL

//ENVIAR EMAIL PRA ATIVAÇÃO DA CONTA COM IMAGEM E EM HTML

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
			<h2>Orçamento Aprovado</h2>
			
		</div>
	</td>
</tr>

  <tr>
    
    <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Cliente: 
					<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			$razao_social
		</div>
		</div>
	</td>

</tr>	
<tr>
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Atividade:
					<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			$atividade1
		</div>
		</div>
	</td>
	 <td>

	</td>	
</tr>
<tr>
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Classificação: 
					<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			$classificacao1
		</div>
		</div>
	</td>
	 <td>

	</td>	
</tr>
<tr>	
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Inf. de serviços:
					<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			$descricao_servicos
		</div>
		</div>
	</td>
	 <td>

	</td>	
</tr>
<tr>	
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Novo cliente? 
					<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			$novo_cliente
		</div>
		</div>
	</td>
	 <td>

	</td>	
</tr>
<tr>	
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Nº do orçamento:
					<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			$n_orc
		</div>
		</div>
	</td>
	 <td>

	</td>		
</tr>
<tr>	
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Prazo de execução: 	
					<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			$prz_execucao dia(s)
		</div>
		</div>
	</td>
	 <td>

	</td>	
</tr>
<tr>	
	<td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:#000;\">
			Data aprovado: 
					<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			$data_aprovada
		</div>
		</div>
	</td>
	 <td>

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

mail($email1,"Aprovacao Propostas ELFI - sistema",$msg_body, $mailheaders);
mail($email2,"Aprovacao Propostas ELFI - sistema",$msg_body, $mailheaders);	 
	 
	 
	 
	 
	 
	 
	 
	 
    echo "Orçamento adicionado com Sucesso!";
     
     
     
     ?>
                    <script type="text/javascript" >
alert ("Orçamento adicionado com Sucesso!");
</script>
    

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

