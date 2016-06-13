<?php

include_once "../Config/config_sistema.php"; 


//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['dia_hoje']))
    {

    $id_usuario = $_POST['usuario'];  
    
     $dia_hoje = $_POST['dia_hoje'];
     $id_orc = $_POST['id_orc'];

 
	 //dados Descrição do Orçamento
     $descricao_historico    = $_POST['descricao_historico'];
     $descricao_historico    = nl2br($descricao_historico);

                

				
						
        $sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die (mysql_error()); 
		$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $nome_usuario = $linha_usuario->Login;
                
         

    // Add user info into the database table for the main site table
     $sql = mysql_query("INSERT INTO historico_orc_aprovado (id_acompanhamento, data, descricao, colaborador) 
     VALUES('$id_orc','$dia_hoje', '$descricao_historico','$nome_usuario')")  
     or die (mysql_error());         
         
     
//enviar EMAIL

		$sql_acompa_orc = mysql_query("SELECT * FROM orcamentos WHERE id='$id_orc'") or die (mysql_error()); 
		$linha = mysql_fetch_object($sql_acompa_orc);
                
                $cliente = $linha->razao_social_contr;
				$inf_servicos = $linha->descricao_servico_orc;
				$n_orc = $linha->n_orc;

//ENVIAR EMAIL PRA ATIVAÇÃO DA CONTA COM IMAGEM E EM HTML

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
			<h2>Histórico Orçamento Aprovado</h2>
			
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
				$inf_servicos
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
		
		Histórico: <br>
			<div style=\" padding: 5px 5px; font: 12px verdana, arial, helvetica, sans-serif; color:red;\">	
<TABLE   border=\"1\">
<thead>
  <TR font: 12px verdana, arial, helvetica, sans-serif; color:red;>

    <TH>Data</TH>
    <TH>Descrição</TH>

	
  </TR>
  </thead>
  <tbody>";
			

		//$data_hj = date('Y-m-d');
       $sql = "SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc' ORDER BY id DESC";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
$texto .= "
	  <TR font: 12px verdana, arial, helvetica, sans-serif; color:red;>

	    <Td>".$row['data']."</Td>
		<TD>".$row['descricao']."</TD>


		
	</tr>";


}

$texto .= "
	</tbody>
</TABLE>
				
				
				
				
			</div>
		</div>
	</td>
	 <td>
		<div style=\" padding: 10px 5px; font: 11px verdana, arial, helvetica, sans-serif; color:red;\">
			
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

mail($email1,"Historico Propostas ELFI - sistema",$msg_body, $mailheaders);
mail($email2,"Historico Propostas ELFI - sistema",$msg_body, $mailheaders);	
mail($email3,"Historico Propostas ELFI - sistema",$msg_body, $mailheaders);	
mail($email4,"Historico Propostas ELFI - sistema",$msg_body, $mailheaders);	 
	 
	 
	 
	 
	 
	 
	 
	 
    echo "Historico adicionado com Sucesso!";
     
     
     
     ?>
<script type="text/javascript" >
alert ("Historico adicionado com Sucesso!");
</script>
    

<a href="javascript:window.history.go(-1)" target="_self">Voltar</a>


<?php
 /*    
     header("location: financeiro.php"); // Shoot viewer back to the homepage of the site if they try to look here
exit();
          * 
  */
    
  }
 
?>
