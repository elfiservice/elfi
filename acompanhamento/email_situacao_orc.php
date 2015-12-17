<?php
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 
		
		
$email1 = "junior@elfiservice.com.br";
$email2 = "lana@elfiservice.com.br";
$email3 = "edson@elfiservice.com.br";
$email4 = "armando@elfiservice.com.br";


$imagem_nome="";
$encoded_attach="";

// $arquivo=fopen($imagem_nome,'r');
// $contents = fread($arquivo, filesize($imagem_nome));
// $encoded_attach = chunk_split(base64_encode($contents));
// fclose($arquivo);
$limitador = "_=======". date('YmdHms'). time() . "=======_";

$mailheaders = "From: junior@elfiservice.com.br\r\n";
$mailheaders .= "MIME-version: 1.0\r\n";
$mailheaders .= "Content-type: multipart/related; boundary=\"$limitador\"\r\n";
$cid = date('YmdHms').'.'.time();

$texto = "
<html> 
<body>
<div id=\"situacao_orc\">

            <fieldset>
            <legend><h3>Programados</h3></legend>
			
<TABLE  class=\"display\" id=\"example2\" border=\"1\">
<thead>
  <TR>
  <TH></TH>
    <TH>Cliente</TH>
    <TH>Atividade</TH>
    <TH>Classificação</TH>
    <TH>Inf. dos serviços</TH>
	
	<TH>Novo Cliente</TH>
	<TH>Nº do Orçamento</TH>
	<TH>Prazo de Execução</TH>
	<TH>Data Aprovada</TH>
	<TH>Data Inicio</TH>
	<TH>Data conclusão</TH>
	
  </TR>
  </thead>
  <tbody>";
			

		$data_hj = date('Y-m-d');
       $sql = "SELECT * FROM acompanhamento WHERE data_inicio > '$data_hj' AND data_conclusao = '0000-00-00' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		 
				$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 
				
				
		 

$texto .= "	  <TR>
	    <Td>". $row['cliente']."</Td>
		<TD>".$row['atividade']."</TD>
		<TD>". $row['classificacao']."</TD>
		<TD>". $row['inf_servicos']."</TD>
		<TD>".$row['novo_cliente']."</TD>
		<TD>".$row['n_orc']."</TD>
		<TD>".$row['prazo_exec']."</TD>
		<TD>".$row['data_aprovada']."</TD>
		<TD>".$row['data_inicio']."</TD>
		<TD>".$row['data_conclusao']."</TD>
		
	</tr>";



}


$texto .= "	  
	</tbody>
</TABLE>
            </fieldset>	


            <fieldset>
            <legend><h3>Em Execução</h3></legend>
			
<TABLE  class=\"display\" id=\"example\" border=\"1\">
<thead>
  <TR>
  <TH></TH>
    <TH>Cliente</TH>
    <TH>Atividade</TH>
    <TH>Classificação</TH>
    <TH>Inf. dos serviços</TH>
	
	<TH>Novo Cliente</TH>
	<TH>Nº do Orçamento</TH>
	<TH>Prazo de Execução</TH>
	<TH>Data Aprovada</TH>
	<TH>Data Inicio</TH>
	<TH>Data conclusão</TH>
	
  </TR>
  </thead>
  <tbody>";

       $sql = "SELECT * FROM acompanhamento WHERE data_inicio <= '$data_hj' AND data_inicio <> '0000-00-00' AND data_conclusao = '0000-00-00' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		 				$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 
		 
$texto .= "	
	  <TR>
	    <Td>". $row['cliente']."</Td>
		<TD>".$row['atividade']."</TD>
		<TD>". $row['classificacao']."</TD>
		<TD>". $row['inf_servicos']."</TD>
		<TD>".$row['novo_cliente']."</TD>
		<TD>".$row['n_orc']."</TD>
		<TD>".$row['prazo_exec']."</TD>
		<TD>".$row['data_aprovada']."</TD>
		<TD>".$row['data_inicio']."</TD>
		<TD>".$row['data_conclusao']."</TD>
		
	</tr>";


}

$texto .= "	
	</tbody>
</TABLE>
            </fieldset>
			
			
            <fieldset>
            <legend><h3>Aguardando Programação</h3></legend>
			
<TABLE  class=\"display\" id=\"example3\" border=\"1\">
<thead>
  <TR>
  <TH></TH>
    <TH>Cliente</TH>
    <TH>Atividade</TH>
    <TH>Classificação</TH>
    <TH>Inf. dos serviços</TH>
	
	<TH>Novo Cliente</TH>
	<TH>Nº do Orçamento</TH>
	<TH>Prazo de Execução</TH>
	<TH>Data Aprovada</TH>
	<TH>Data Inicio</TH>
	<TH>Data conclusão</TH>
	
  </TR>
  </thead>
  <tbody>";
  

       $sql = "SELECT * FROM acompanhamento WHERE data_inicio = '0000-00-00' AND data_conclusao = '0000-00-00' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		 				$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 

$texto .= "					
	  <TR>
	    <Td>". $row['cliente']."</Td>
		<TD>".$row['atividade']."</TD>
		<TD>". $row['classificacao']."</TD>
		<TD>". $row['inf_servicos']."</TD>
		<TD>".$row['novo_cliente']."</TD>
		<TD>".$row['n_orc']."</TD>
		<TD>".$row['prazo_exec']."</TD>
		<TD>".$row['data_aprovada']."</TD>
		<TD>".$row['data_inicio']."</TD>
		<TD>".$row['data_conclusao']."</TD>
		
	</tr>";



}

$texto .= "	
	</tbody>
</TABLE>
            </fieldset>			
            
</div>

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
mail($email1,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);
mail($email2,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);
mail($email3,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);
mail($email4,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);	
















?>

                    <script type="text/javascript" >
alert ("Situação orçamentos enviado com Sucesso!");
</script>
    
<a href="javascript:window.close()">FECHAR</a>
