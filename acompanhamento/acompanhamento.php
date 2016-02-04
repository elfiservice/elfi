<?php
 
        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 
		
		$days_em_exec = "";
		$days_de_atraso="";
		
        $mes = "";
        if(isSet ($_GET['mes'])) {
        
             $mes = $_GET['mes'];
        } 
		
		
		$ano_orc = "";
        if(isSet ($_GET['ano_orc'])) {
        
             $ano_orc = $_GET['ano_orc'];
        } 
		
		$ano_orc_selec="";    
        if(isSet ($_POST['ano'])) {
        
             $ano_orc_selec = $_POST['ano'];
        } 
		

		//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
		if (!isset($_SESSION['idx'])) { 
		  if (!isset($_COOKIE['idCookie'])) {

		  	
		  		echo "Voc� n�o esta logado!";
		  
		  	
		  	?>
		  		 <script type="text/javascript">
				//fun��o usada para carregar o c�digo
				function fecha() {
				//fechando a janela atual ( popup )
				window.close();
				//dando um refresh na p�gina principal
				//opener.location.href=opener.location.href;
				/* ou assim:*/ 
				window.opener.location.reload();
				
				//document.location="Cores.htm"
				//fim da fun��o
				}
				</script>
				<a href="javascript:void(0)" onclick="fecha()">fechar</a>
		  	<?php 
  }
} else {

 //Mes janeiro
if ($mes == "jan") {

$n_do_mes = "01";


?>


<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
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
		float: ;
		 
		 }
		 

		#menu ul {
		 padding:0px 0px 0px 0px;
		 margin:-2px 0px 0px 0px;
		 float: left;
		 width: 100%;
		 list-style:none;
		 font: 11px verdana, arial, helvetica, sans-serif;

		 
		 }

		 #menu ul li {display: inline;}

		 #menu ul li a{
		 padding: 5px 10px;
		 margin: 0px 0px;
		 float:left;
		 /* visual do link */

		 
		text-decoration: none; 
		display: inline-block;
		 }

		 
		  #menu ul li a:hover  {


		 }
	
	</style>

<!-- Tabela  -->
<link rel="stylesheet" href="../tabela/demo_page.css">  
<link rel="stylesheet" href="../tabela/demo_table.css">  

		<script type="text/javascript" language="javascript" src="../tabela/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../tabela/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>
	
	
</head>
<body>



        <div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
				</div>
				
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>

<?php //mes Fevereiro
if ($mes == "fev") {

$n_do_mes = "02";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}

	?>

<?php //mes Março
if ($mes == "mar") {

$n_do_mes = "03";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>

<?php //mes Abril
if ($mes == "abr") {

$n_do_mes = "04";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>

<?php //mes Maio
if ($mes == "mai") {

$n_do_mes = "05";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>


<?php  //mes Junho
if ($mes == "jun") {

$n_do_mes = "06";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>


<?php //mes julho
if ($mes == "jul") {

$n_do_mes = "07";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>


<?php //mes Agosto
if ($mes == "ago") {

$n_do_mes = "08";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>


<?php //mes setembro
if ($mes == "set") {

$n_do_mes = "09";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>


<?php //mes outubro
if ($mes == "out") {

$n_do_mes = "10";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>


<?php  //mes Novembro
if ($mes == "nov") {

$n_do_mes = "11";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>


<?php  //mes Dezembro
if ($mes == "dez") {

$n_do_mes = "12";


?>
     <fieldset>
            <legend><h3>Busca por ano</h3></legend>
	<div>
		<form action="acompanhamento.php?mes=jan&ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano from acompanhamento ORDER BY ano DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				
				?>
				<option value="<?php echo $l['ano']; ?>"><?php echo $l['ano']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	</fieldset>
	     <fieldset>
            <legend><h3>Indicadores e Dados</h3></legend>
	<div>
		<form action="salvar_n_orc.php" method="post" enctype="multipart/form-data" name="formAgenda">
		<?php
		         	$sql_n_orc = mysql_query("SELECT * FROM controle_n_orc WHERE mes = '$n_do_mes' AND ano = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_feitos = mysql_num_rows($sql_n_orc); 
					$linha = mysql_fetch_object($sql_n_orc);
                
					if($n_linhas_orc_feitos > 0) {
				
						$total_orc_feitos = $linha->n_orc_feitos;
						} else {$total_orc_feitos = "0";}
		?>
		
			Nº de orçamentos feitos:	
			<input type="text" name="n_de_orc_feitos" value="<?php echo $total_orc_feitos; ?>" id="n_de_orc_feitos"  />
			<input type="hidden" name="mes" value="<?php echo $n_do_mes; ?>" readonly="readonly" />			
			<input type="hidden" name="ano" value="<?php echo $ano_orc; ?>" readonly="readonly" />				
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Salvar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	
	<div>
				<?php
//consulta Nºde ORC aprovados no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc'") or die (mysql_error()); 
					$n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_aprovados;
				
//consulta Nº de ORC aprovados CONCLUIDOS no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND data_conclusao <> '0000-00-00'") or die (mysql_error()); 
					$n_linhas_orc_concluidos = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_concluidos;				
				
				$produtividade_bd = ($n_linhas_orc_concluidos / $n_linhas_orc_aprovados ) * 100;	
				$produtividade = $produtividade_bd.' %';
				mysql_query("UPDATE controle_n_orc SET produtividade = '$produtividade_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $produtividade;

//consulta Nº de ORC aprovados CONCLUIDOS com ATRASO NA CONCLUSAO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND dias_ultrapassad <> '0'") or die (mysql_error()); 
					$n_linhas_orc_ultrap = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_ultrap;
				
				$pontualidade_entrega_bd = (1-($n_linhas_orc_ultrap / $n_linhas_orc_aprovados)) * 100;
				$pontualidade_entrega = $pontualidade_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pontual_entrega = '$pontualidade_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pontualidade_entrega;

//consulta Nº de ORC aprovados CONCLUIDOS com POS-entrega no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND feito_pos_entreg = 's'") or die (mysql_error()); 
					$n_linhas_orc_pos_entrg = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_pos_entrg;				

				$pos_entrega_bd = ($n_linhas_orc_pos_entrg / $n_linhas_orc_aprovados ) * 100;	
				$pos_entrega = $pos_entrega_bd.' %';
				mysql_query("UPDATE controle_n_orc SET pos_entrega = '$pos_entrega_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $pos_entrega;				
				
//consulta Nº de ORC aprovados CONCLUIDOS com nao-conformidades no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND nao_conformidade = 's'") or die (mysql_error()); 
					$n_linhas_orc_n_conforme = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_conforme_bd = ($n_linhas_orc_n_conforme / $n_linhas_orc_aprovados ) * 100;	
				$n_conforme = $n_conforme_bd.' %';
				mysql_query("UPDATE controle_n_orc SET nao_conforme = '$n_conforme_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_conforme;	

//consulta total ORC feitos no mes 
				

				$acompanhamento_orc_bd = ($n_linhas_orc_aprovados / $total_orc_feitos ) * 100;	
				$acompanhamento_orc = $acompanhamento_orc_bd.' %';
				mysql_query("UPDATE controle_n_orc SET acompanh_proposta = '$acompanhamento_orc_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $acompanhamento_orc;	

//consulta Nº de novos clientes  no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND novo_cliente = 's'") or die (mysql_error()); 
					$n_linhas_novo_cliente = mysql_num_rows($sql_n_orc); 
					mysql_query("UPDATE controle_n_orc SET novos_clientes = '$n_linhas_novo_cliente' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				    //echo $n_linhas_novo_cliente;					

//consulta Nº de ORC aprovados CONCLUIDOS com INSATISFAÇÃO no mes 
		         	$sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' AND client_insatisfeito = 's'") or die (mysql_error()); 
					$n_linhas_orc_insatisfeito = mysql_num_rows($sql_n_orc); 
				//echo $n_linhas_orc_n_conforme;				

				$n_insatisfeito_bd = ($n_linhas_orc_insatisfeito / $n_linhas_orc_aprovados ) * 100;	
				$n_insatisfeito = $n_insatisfeito_bd.' %';
				mysql_query("UPDATE controle_n_orc SET insatisfacao = '$n_insatisfeito_bd' WHERE mes = '$n_do_mes' AND ano = '$ano_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
				//echo $n_insatisfeito;					
				
				?>
	
	<TABLE  class="display" id="">
<thead>
 <TR>
    <TH>Indicadores</TH>
    <TH></TH>
</tr>
</thead>
<tbody>
<tr>
	<td>
		Produtividade
	</td>
	<td>
		<?php echo number_format($produtividade_bd, 2, '.', '').' %'; ?> dos serviços foram executados conforme foi planejado
	</td>
</tr>
<tr>
	<td>
		Pontualidade Entrega
	</td>
	<td>
		<?php echo number_format($pontualidade_entrega_bd, 2, '.', '').' %'; ?> dos serviços foram entregues dentro do prazo estabelecido na proposta
	</td>
</tr>
<tr>
	<td>
		Nível de atendimento (Pós-entrega)
	</td>
	<td>
		<?php echo number_format($pos_entrega_bd, 2, '.', '').' %';  ?> dos serviços foram realizados um acompanhamento após a conclusão dos serviços
	</td>
</tr>
<tr>
	<td>
		Padrão Qualidade (serviços não conformes)
	</td>
	<td>
		<?php echo number_format($n_conforme_bd, 2, '.', '').' %';  ?> de serviços não conformes ou que apresentaram problemas e retrabalhos
	</td>
</tr>
<tr>
	<td>
		Acompanhamento Propostas
	</td>
	<td>
		<?php echo number_format($acompanhamento_orc_bd, 2, '.', '').' %'; ?> de propostas aprovadas no mês
	</td>
</tr>
<tr>
	<td>
		Novos Clientes
	</td>
	<td>
		<?php echo $n_linhas_novo_cliente; ?> cliente(s) novo(s) no mês
	</td>
</tr>
<tr>
	<td>
		Insatisfação do Cliente
	</td>
	<td>
		<?php echo number_format($n_insatisfeito_bd, 2, '.', '').' %'; ?> de clientes insatisfeitos no Mês
	</td>
</tr>




</tbody>
</table>
	
	
	
	
	
	</div>
	
	
	
	
   </fieldset>
   
	     <fieldset>
            <legend><h3>Orçamentos Aprovados</h3></legend>   
<TABLE  class="display" id="example">
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
	<TH>Dias de aprovado</TH>
	<TH>Dias de Execução</TH>
	<TH>Dias ultrapassados na Execução</TH>	
	
	<TH>Serviço Concluido?</TH>
	<TH>Feito Pos-entrega?</TH>
	<TH>Não Conformidade?</TH>
	<TH>OBS não conformidade</TH>
	<TH>Cliente insatisfeito?</TH>
  </TR>
  </thead>
  <tbody>
 
<?php
       $sql = "SELECT * FROM acompanhamento WHERE MONTH(data_aprovada) = '$n_do_mes' AND YEAR(data_aprovada) = '$ano_orc' ORDER BY id";
        $res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
                //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';
				
				$id_orc = $row['id'];
				$praz_exec = $row['prazo_exec'];
				$data_aprovada = $row['data_aprovada'];
				
					 					$data_hoje = date('Y-m-d');
										$diff =  strtotime($data_hoje) - strtotime($data_aprovada);
										// 24 horas * 60 Min * 60 seg = 86400
										$days = ceil($diff/86400);
$data_inicio = $row['data_inicio'];			
$data_conclusao = $row['data_conclusao'];							
if($data_inicio <> "0000-00-00"){										
						if($data_conclusao == "0000-00-00"){	
										$diff =  strtotime($data_hoje) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
										
						} else {
										$diff =  strtotime($data_conclusao) - strtotime($data_inicio);
										// 24 horas * 60 Min * 60 seg = 86400
										$days_em_exec = ceil($diff/86400);
										$days_em_exec = $days_em_exec.' dia(s)';
						
						
						}
}else {
									$days_em_exec = "-";	
}
				
if($data_conclusao == "0000-00-00"){	
//dias de execução - prazo de execu.
									
									$days_de_atraso = "-";	
} else if (($days_em_exec - $praz_exec )> 0 ){

	$days_de_atraso_bd = ($days_em_exec - $praz_exec);
	$days_de_atraso = $days_de_atraso_bd .' dia(s)';

	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

} else {
	$days_de_atraso_bd = 0;
	$days_de_atraso = $days_de_atraso_bd .' dias';  
	mysql_query("UPDATE acompanhamento SET dias_ultrapassad = '$days_de_atraso_bd' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	
	}
			
			
			
		$serv_concluido =	$row['serv_concluido'];
		$feito_pos_entreg = $row['feito_pos_entreg'];
if($serv_concluido == "s" && $feito_pos_entreg == "n" ) {

	$feito_pos_entreg = $row['feito_pos_entreg']. " <br><a href=\"pos_entrega.php?id_orc=".$row['id']."&msg_erro=#\" target=\"_self\">enviar Pos-Entrega</a>";

} else {
	$feito_pos_entreg = $row['feito_pos_entreg'];
}			
			
		 		$id_orc = $row['id'];	
				//echo $id_orc;
		        $sql_n_orc = mysql_query("SELECT * FROM historico_orc_aprovado WHERE id_acompanhamento = '$id_orc'");
				$n_orc_check = mysql_num_rows($sql_n_orc); 			
			
?>
  <TR>
		<td><a href="editar_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#" target="_self">editar</a>
		<a href="#" onclick="window.open('hitorico_orc_aprovado.php?id_orc=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">historico (<?php echo $n_orc_check; ?>)</a></td>
	    <Td><?php echo $row['cliente']; ?></Td>
		<TD><?php echo $row['atividade']; ?></TD>
		<TD><?php echo $row['classificacao']; ?></TD>
		<TD><?php echo $row['inf_servicos']; ?></TD>
		<TD><?php echo $row['novo_cliente']; ?></TD>
		<TD><?php echo $row['n_orc']; ?></TD>
		<TD><?php echo $row['prazo_exec']; ?></TD>
		<TD><?php echo $data_aprovada; ?></TD>
		<TD><?php echo $row['data_inicio']; ?></TD>
		<TD><?php echo $row['data_conclusao']; ?></TD>
		<TD><?php echo $days.' dia(s)'; ?></TD>
		<TD><?php echo $days_em_exec; ?> </TD>
		<TD><?php echo $days_de_atraso; ?></TD>

		<TD><?php echo $row['serv_concluido']; ?></TD>
		<TD><?php echo $feito_pos_entreg; ?></TD>
		<TD><?php echo $row['nao_conformidade']; ?></TD>
		<TD><?php echo $row['obs_n_conformidad']; ?></TD>
		<TD><?php echo $row['client_insatisfeito']; ?></TD>
	
		

    </TR>
<?php			
				
			}	
				
        
?>
  


    

</tbody>

  
  
</TABLE>
 </fieldset>


<?php
	}
?>

<?php
}

?>

</body>
</html>