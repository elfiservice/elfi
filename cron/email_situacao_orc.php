
<?php
require '../classes/Config.inc.php';

$orcCtrl = new OrcamentoCtrl();


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

$orcObj = $orcCtrl->buscarOrcamentos("*", "WHERE data_inicio > '$data_hj' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id");
if (!$orcObj) {
    $texto .= "<b>Sem resgistros.</b>";
} else {
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

    foreach ($orcObj as $row) {
        $texto .= "	

  <tr>
	    <td>" . $row['razao_social_contr'] . "</td>
		<td>" . $row['atividade'] . "</td>
		<td>" . $row['classificacao'] . "</td>
		<td>" . Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200) . "</td>
		<td>" . $row['novo_cliente'] . "</td>
		<td>" . $row['n_orc'] . "." . $row['ano_orc'] . "</td>
		<td>" . $row['prazo_exec_orc'] . "</td>
		<td>" . date('d/m/Y', strtotime($row['data_aprovada'])) . "</td>
		<td>" . date('d/m/Y', strtotime($row['data_inicio'])) . "</td>

		
	</tr>";
    }
}

$texto .= "	  
	</tbody>
</table>
            </fieldset>	


            <fieldset>
            <legend><h3><span  style=\"color: red;\">Em Execução</span></h3></legend>

";


$orcObj = $orcCtrl->buscarOrcamentos("*", "WHERE data_inicio <= '$data_hj' AND data_inicio <> '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id");
if (!$orcObj) {
    $texto .= "<b>Sem resgistros.</b>";
} else {
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

    foreach ($orcObj as $row) {

        $texto .= "	


	  <tr>
	    <Td>" . $row['razao_social_contr'] . "</Td>
		<td>" . $row['atividade'] . "</td>
		<td>" . $row['classificacao'] . "</td>
		<td>" . Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200) . "</td>
		<td>" . $row['novo_cliente'] . "</td>
		<td>" . $row['n_orc'] . "." . $row['ano_orc'] . "</td>
		<td>" . $row['prazo_exec_orc'] . "</td>
		<td>" . date('d/m/Y', strtotime($row['data_aprovada'])) . "</td>
		<td>" . date('d/m/Y', strtotime($row['data_inicio'])) . "</td>

		
	</tr>";
    }
}

$texto .= "	
	</tbody>
</table>
            </fieldset>
			
			
            <fieldset>
            <legend><h3> <span  style=\"color: red;\"> Aguardando Programação </span></h3></legend>

			
";

$orcObj = $orcCtrl->buscarOrcamentos("*", "WHERE data_inicio = '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id");
if (!$orcObj) {
    $texto .= "<b>Sem resgistros.</b>";
} else {

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

    foreach ($orcObj as $row) {

        $texto .= "	
				
	  <tr>
	    <td>" . $row['razao_social_contr'] . "</td>
		<td>" . $row['atividade'] . "</td>
		<td>" . $row['classificacao'] . "</td>
		<td>" . Formatar::limita_texto(strip_tags($row['descricao_servico_orc']), 200) . "</td>
		<td>" . $row['novo_cliente'] . "</td>
		<td>" . $row['n_orc'] . "." . $row['ano_orc'] . "</td>
		<td>" . $row['prazo_exec_orc'] . "</td>
		<td>" . date('d/m/Y', strtotime($row['data_aprovada'])) . "</td>
		<td>--</td>

		
	</tr>";
    }
}

$texto .= "	
	</tbody>
</table>
            </fieldset>			
            
</div>

</body>
</html>

";

$email = new EmailGenerico(array('junior@elfiservice.com.br'), "Situção Orçamentos Aprovados", $texto, array(), $listaEmails, 1);


if ($email->enviarEmailSMTP()) {

    echo "Emails enviados com SUCESSO!<br>";
} else {
    echo "Algo deu ERRADO";
}
?>

<script type="text/javascript" >
    alert("Processo Concluido!");
</script>
<a href="javascript:window.close()">FECHAR</a>
