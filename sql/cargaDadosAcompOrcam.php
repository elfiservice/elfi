<?php

include_once "../Config/config_sistema.php";

$count = 0;

$sql = "SELECT * FROM acompanhamento";
$res = mysql_query( $sql );
while ( $row = mysql_fetch_assoc( $res ) ) {
		
		
	$colab = $row['colab'];
	$cliente = $row['cliente'];
	$atividade = $row['atividade'];
	$classificacao = $row['classificacao'];
	$inf_servicos = $row['inf_servicos'];
	$inf_servicos_nova   = str_replace('\'', '"', $inf_servicos);
	
	$novo_cliente = $row['novo_cliente'];
	$n_orc = $row['n_orc'];
	$prazo_exec = $row['prazo_exec'];
	$data_aprovada = $row['data_aprovada'];
	$ano = $row['ano'];
	$email = $row['email'];
	$data_inicio = $row['data_inicio'];
	$data_conclusao = $row['data_conclusao'];
	$dias_d_aprovado = $row['dias_d_aprovado'];
	$dias_d_exec = $row['dias_d_exec'];
	$dias_ultrapassad = $row['dias_ultrapassad'];
	$serv_concluido = $row['serv_concluido'];
	$feito_pos_entreg = $row['feito_pos_entreg'];
	$nao_conformidade = $row['nao_conformidade'];
	$obs_n_conformidad = $row['obs_n_conformidad'];
	$client_insatisfeito = $row['client_insatisfeito'];
	$vr_orc = $row['vr_orc'];
	$vr_orc2 = $row['vr_orc'];
	
	$count++;
	
	$sql = mysql_query("INSERT INTO orcamentos (
			colaborador_orc, 
			razao_social_contr, 
			atividade, 
			classificacao, 
			descricao_servico_orc, 
			novo_cliente, 
			n_orc, 
			prazo_exec_orc, 
			data_aprovada, 
			ano_orc, 
			email_contr, 
			data_inicio, 
			data_conclusao,
			dias_d_aprovado,
			dias_d_exec,
			dias_ultrapassad,
			serv_concluido,
			feito_pos_entreg,
			nao_conformidade,
			obs_n_conformidad,
			client_insatisfeito,
			vr_servco_orc,
			vr_total_orc,
			situacao_orc)
			VALUES(
			'$colab',
			'$cliente', 
			'$atividade',
			'$classificacao', 
			'$inf_servicos_nova', 
			'$novo_cliente', 
			'$n_orc', 
			'$prazo_exec', 
			'$data_aprovada', 
			'$ano', 
			'$email', 
			'$data_inicio', 
			'$data_conclusao',
			'$dias_d_aprovado',
			'$dias_d_exec',
			'$dias_ultrapassad',
			'$serv_concluido',
			'$feito_pos_entreg',
			'$nao_conformidade',
			'$obs_n_conformidad',
			'$client_insatisfeito',
			'$vr_orc',
			'$vr_orc2',
			'Aprovado')")
			or die (mysql_error());
	
			echo $count - $colab, $cliente ."<br>";
	
}
echo "fim";
?>