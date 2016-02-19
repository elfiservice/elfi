<?php
include "../checkuserlog.php";

include_once "../Config/config_sistema.php";

$ano_atual = date ( 'Y' );

if (! isset ( $_SESSION ['idx'] )) {
	if (! isset ( $_COOKIE ['idCookie'] )) {
		
		// include_once '../conectar.php';
		header ( "location: ../index.php" );
	}
} else {
	
	?>


<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="pt">
<!--<![endif]-->
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
	float:;
}

#menu ul {
	padding: 0px 0px 0px 0px;
	margin: -2px 0px 0px 0px;
	float: left;
	width: 100%;
	list-style: none;
	font: 11px verdana, arial, helvetica, sans-serif;
}

#menu ul li {
	display: inline;
}

#menu ul li a {
	padding: 5px 10px;
	margin: 0px 0px;
	float: left;
	/* visual do link */
	text-decoration: none;
	display: inline-block;
}

#menu ul li a:hover {
	
}
</style>

<!-- Tabela  -->
<link rel="stylesheet" href="../tabela/demo_page.css">
<link rel="stylesheet" href="../tabela/demo_table.css">

<script type="text/javascript" src="../tabela/jquery.js"></script>
<script type="text/javascript" src="../tabela/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
			
						$(document).ready(function() {
				$('#example2').dataTable();
			} );

						$(document).ready(function() {
				$('#example3').dataTable();
			} );			
		</script>


</head>
<body>

	<div
		style="background: url(../imagens/topo1.png) repeat-x; padding: 5px 0px 30px 0px;">
	</div>
	<div id="menu">
		<ul>

			<li><a href="../tecnico.php"> Voltar </a></li>
			<li><a href="#"
				onclick="window.open('relatorios.php?ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					Relatórios </a></li>
			<li><a href="#"
				onclick="window.open('link_pesquisa_satisfacao.php?mes=fev&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					Link Pesquisa </a></li>
			<li><a href="#"
				onclick="window.open('email_situacao_orc.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					Enviar Situação Orc. </a></li>
			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					JAN </a></li>
			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=fev&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					FEV </a></li>
			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=mar&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					MAR </a></li>
			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=abr&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					ABR </a></li>
			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=mai&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					MAI </a></li>

			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=jun&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					JUN </a></li>

			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=jul&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					JUL </a></li>

			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=ago&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					AGO </a></li>

			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=set&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					SET </a></li>

			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=out&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					OUT </a></li>

			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=nov&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					NOV </a></li>

			<li><a href="#"
				onclick="window.open('acompanhamento.php?mes=dez&ano_orc=<?php echo $ano_atual; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
					DEZ </a></li>
		</ul>
	</div>

	<div id="situacao_orc">

		<fieldset>
			<legend>
				<b>Programados</b>
			</legend>

			<TABLE class="display" id="example2">
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
				<tbody>
			
<?php
	$data_hj = date ( 'Y-m-d' );
	$sql = "SELECT * FROM orcamentos WHERE data_inicio > '$data_hj' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id";
	$res = mysql_query ( $sql );
	while ( $row = mysql_fetch_assoc ( $res ) ) {
		
		$id_orc = $row ['id'];
		// echo $id_orc;
		$sql_n_orc = mysql_query ( "SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'" );
		$n_orc_check = mysql_num_rows ( $sql_n_orc );
		
		?>
	  <TR>
						<td><a href="#"
							onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">atualizar</a><br>
							<a href="#"
							onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
						<Td><?php echo $row['razao_social_contr']; ?></Td>
						<TD><?php echo $row['atividade']; ?></TD>
						<TD><?php echo $row['classificacao']; ?></TD>
						<TD><?php echo $row['descricao_servico_orc']; ?></TD>
						<TD><?php //echo $row['novo_cliente']; ?></TD>
						<TD><?php echo $row['n_orc'].".".$row['ano_orc']; ?></TD>
						<TD><?php echo $row['prazo_exec_orc']; ?></TD>
						<TD><?php echo $row['data_aprovada']; ?></TD>
						<TD><?php echo $row['data_inicio']; ?></TD>
						<TD><?php echo $row['data_conclusao']; ?></TD>

					</tr>


<?php
	}
	?>

	</tbody>
			</TABLE>
		</fieldset>


		<fieldset>
			<legend>
				<b>Em Execução</b>
			</legend>

			<TABLE class="display" id="example">
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
				<tbody>
			
<?php
	$sql = "SELECT * FROM orcamentos WHERE data_inicio <= '$data_hj' AND data_inicio <> '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado' ORDER BY id";
	$res = mysql_query ( $sql );
	while ( $row = mysql_fetch_assoc ( $res ) ) {
		
		$id_orc = $row ['id'];
		// echo $id_orc;
		$sql_n_orc = mysql_query ( "SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'" );
		$n_orc_check = mysql_num_rows ( $sql_n_orc );
		
		?>
	  <TR>
						<td><a href="#"
							onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">atualizar</a><br>
							<a href="#"
							onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
						<Td><?php echo $row['razao_social_contr']; ?></Td>
						<TD><?php echo $row['atividade']; ?></TD>
						<TD><?php echo $row['classificacao']; ?></TD>
						<TD><?php echo $row['descricao_servico_orc']; ?></TD>
						<TD><?php //echo $row['novo_cliente']; ?></TD>
						<TD><?php echo $row['n_orc'].".".$row['ano_orc']; ?></TD>
						<TD><?php echo $row['prazo_exec_orc']; ?></TD>
						<TD><?php echo $row['data_aprovada']; ?></TD>
						<TD><?php echo $row['data_inicio']; ?></TD>
						<TD><?php echo $row['data_conclusao']; ?></TD>

					</tr>


<?php
	}
	?>

	</tbody>
			</TABLE>
		</fieldset>


		<fieldset>
			<legend>
				<b>Aguardando Programação</b>
			</legend>

			<TABLE class="display" id="example3">
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
				<tbody>
			
<?php
	$sql = "SELECT * FROM orcamentos WHERE data_inicio = '0000-00-00' AND data_conclusao = '0000-00-00' AND situacao_orc = 'Aprovado'  ORDER BY id";
	$res = mysql_query ( $sql );
	while ( $row = mysql_fetch_assoc ( $res ) ) {
		
		$id_orc = $row ['id'];
		// echo $id_orc;
		$sql_n_orc = mysql_query ( "SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'" );
		$n_orc_check = mysql_num_rows ( $sql_n_orc );
		
		?>
	  <TR>
						<td><a href="#"
							onclick="window.open('editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">atualizar</a><br>
							<a href="#"
							onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
						<Td><?php echo $row['razao_social_contr']; ?></Td>
						<TD><?php echo $row['atividade']; ?></TD>
						<TD><?php echo $row['classificacao']; ?></TD>
						<TD><?php echo $row['descricao_servico_orc']; ?></TD>
						<TD><?php //echo $row['novo_cliente']; ?></TD>
						<TD><?php echo $row['n_orc'].".".$row['ano_orc']; ?></TD>
						<TD><?php echo $row['prazo_exec_orc']; ?></TD>
						<TD><?php echo $row['data_aprovada']; ?></TD>
						<TD><?php echo $row['data_inicio']; ?></TD>
						<TD><?php echo $row['data_conclusao']; ?></TD>

					</tr>


<?php
}
?>

	</tbody>
			</TABLE>
		</fieldset>

	</div>

</body>
</html>
<?php
}

?>

