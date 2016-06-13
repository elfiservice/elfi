
<?php
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 
		
		require '../classes/Config.inc.php';
		
		
// $email1 = "junior@elfiservice.com.br";
// $email2 = "lana@elfiservice.com.br";
// $email3 = "edson@elfiservice.com.br";
// $email4 = "armando@elfiservice.com.br";
// $email5 = "samuel@elfiservice.com.br";

// $emails = array(
// 'junior@elfiservice.com.br',
// 'lana@elfiservice.com.br',
// 'edson@elfiservice.com.br',
// 'armando@elfiservice.com.br',
// 'samuel@elfiservice.com.br');
$emails = array(
'junior@elfiservice.com.br');

foreach ($emails as $email) {



$texto = "
<style>
table.bordasimples {border-collapse: collapse;}

table.bordasimples tr td {border:1px solid #000080;}
</style>
<html> 
<body>
<div id=\"situacao_orc\">

            <fieldset>
            <legend><h3><span  style=\"color: red;\">Programados</span></h3></legend>

";
			

		$data_hj = date('Y-m-d');
       $sql = "SELECT * FROM orcamentos WHERE data_inicio > '$data_hj' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id";
        $res = mysql_query( $sql );        
       
	// var_dump(mysql_fetch_row ( $res ) );
        //$row = mysql_fetch_assoc( $res );
        //var_dump(mysql_fetch_assoc( $res ));

		if($row == 0){
			$texto .= "<b>Sem resgistros.</b>";
		}else{
			var_dump($row);
			$texto .= "
						<table  class=\"bordasimples\" id=\"example2\">
<thead>
  <tr>
  
    <th>Cliente</th>
    <th>Atividade</th>
    <th>Classificação</th>
    <th>Inf. dos serviços</th>
	
	<th>Novo Cliente</th>
	<th>Nº do Orçamento</th>
	<th>Prazo de Execução</th>
	<th>Data Aprovada</th>
	<th>Data Inicio</th>

	
  </tr>
  </thead>
  <tbody>
			";
		}
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		 
				// $id_orc = $row['id'];	
				// //echo $id_orc;
		        // $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				// $n_orc_check = mysql_num_rows($sql_n_orc); 
				
				
		 

$texto .= "	

  <tr>
	    <td>". $row['razao_social_contr']."</td>
		<td>".$row['atividade']."</td>
		<td>". $row['classificacao']."</td>
		<td>". Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200)."</td>
		<td>".$row['novo_cliente']."</td>
		<td>".$row['n_orc'] . "." . $row['ano_orc']."</td>
		<td>".$row['prazo_exec_orc']."</td>
		<td>".date('d/m/Y', strtotime($row['data_aprovada']))."</td>
		<td>".date('d/m/Y', strtotime($row['data_inicio']))."</td>

		
	</tr>";



}


$texto .= "	  
	</tbody>
</table>
            </fieldset>	


            <fieldset>
            <legend><h3><span  style=\"color: red;\">Em Execução</span></h3></legend>

";

       $sql = "SELECT * FROM orcamentos WHERE data_inicio <= '$data_hj' AND data_inicio <> '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id";
        $res = mysql_query( $sql );
				//$row = mysql_fetch_assoc( $res );
                              
		if(mysql_fetch_row ( $res ) == false){
			$texto .= "<b>Sem resgistros.</b>";
		}else{
			//var_dump($row);
			$texto .= "
						<table  class=\"bordasimples\" id=\"example2\">
<thead>
  <tr>
  
    <th>Cliente</th>
    <th>Atividade</th>
    <th>Classificação</th>
    <th>Inf. dos serviços</th>
	
	<th>Novo Cliente</th>
	<th>Nº do Orçamento</th>
	<th>Prazo de Execução</th>
	<th>Data Aprovada</th>
	<th>Data Inicio</th>

	
  </tr>
  </thead>
  <tbody>
			";
		}
                
//                $row = mysql_fetch_assoc( $res );
//		var_dump($row); 
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		//var_dump($row); 				// $id_orc = $row['id'];	
				// //echo $id_orc;
		        // $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				// $n_orc_check = mysql_num_rows($sql_n_orc); 
		 
$texto .= "	


	  <tr>
	    <Td>". $row['razao_social_contr']."</Td>
		<td>".$row['atividade']."</td>
		<td>". $row['classificacao']."</td>
		<td>". Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200)."</td>
		<td>".$row['novo_cliente']."</td>
		<td>".$row['n_orc'] . "." . $row['ano_orc']."</td>
		<td>".$row['prazo_exec_orc']."</td>
		<td>".date('d/m/Y', strtotime($row['data_aprovada']))."</td>
		<td>".date('d/m/Y', strtotime($row['data_inicio']))."</td>

		
	</tr>";


}

$texto .= "	
	</tbody>
</table>
            </fieldset>
			
			
            <fieldset>
            <legend><h3> <span  style=\"color: red;\"> Aguardando Programação </span></h3></legend>

			
";
  

       $sql = "SELECT * FROM orcamentos WHERE data_inicio = '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id";
        $res = mysql_query( $sql );
				$row = mysql_fetch_assoc( $res );
		if($row == 0){
			$texto .= "<b>Sem resgistros.</b>";
		}		else{
			
			$texto .= "
						<table  class=\"bordasimples\" id=\"example2\">
<thead>
  <tr>
  
    <th>Cliente</th>
    <th>Atividade</th>
    <th>Classificação</th>
    <th>Inf. dos serviços</th>
	
	<th>Novo Cliente</th>
	<th>Nº do Orçamento</th>
	<th>Prazo de Execução</th>
	<th>Data Aprovada</th>
	<th>Data Inicio</th>

	
  </tr>
  </thead>
  <tbody>
			";
		}
         while ( $row = mysql_fetch_assoc( $res ) ) {
		 
		 				// $id_orc = $row['id'];	
				// //echo $id_orc;
		        // $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				// $n_orc_check = mysql_num_rows($sql_n_orc); 

$texto .= "	
				
	  <tr>
	    <td>". $row['razao_social_contr']."</td>
		<td>".$row['atividade']."</td>
		<td>". $row['classificacao']."</td>
		<td>". Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200)."</td>
		<td>".$row['novo_cliente']."</td>
		<td>".$row['n_orc'] . "." . $row['ano_orc']."</td>
		<td>".$row['prazo_exec_orc']."</td>
		<td>".date('d/m/Y', strtotime($row['data_aprovada']))."</td>
		<td>--</td>

		
	</tr>";



}

$texto .= "	
	</tbody>
</table>
            </fieldset>			
            
</div>

</body>
</html>

";

$msg_body = "--$limitador\r\n";
$msg_body .= "Content-type: text/html; charset=utf-8\r\n";
$msg_body .= "$texto";
$msg_body .= "--$limitador--\r\n";


//mail($email_cliente,"Pós entrega de serviço ELFI - sistema",$msg_body, $mailheaders);
//mail($email,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);
// mail($email2,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);
// mail($email3,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);
// mail($email4,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);	
// mail($email5,"Situacao Orçamentos ELFI - sistema",$msg_body, $mailheaders);	




if(mail($email,"Situacao Orcamentos ELFI - sistema",$msg_body, $mailheaders)){
	
	echo "Email para {$email} enviado com SUCESSO!<br>";
}else{
	echo "Algo deu ERRADO ao tentar enviar Email para {$email}<br>";
}











?>



<?php
}
?>
                        <script type="text/javascript" >
alert ("Processo Concluido!");
</script>
<a href="javascript:window.close()">FECHAR</a>
