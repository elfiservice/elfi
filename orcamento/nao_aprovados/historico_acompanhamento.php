<?php
include "./../../checkuserlog.php";
//include_once "../Config/config_sistema.php";
//require '../Config/SistemConfig.php';
require './../../classes/Config.inc.php';
if (!isset($_SESSION['idx'])) { //testa se a sessão existe
	if (!isset($_COOKIE['idCookie'])) {

		//include_once '../conectar.php';
		//header("location: ../index.php");
		echo "Você não esta logado!";
	}
} else {
	
	$id_orc = "";
	if(isSet ($_GET['id_orc'])) {
	
		$id_orc = $_GET['id_orc'];
	}
	
	include_once '../../includes/sql_dados_orc_por_id.php';
	include_once '../../includes/sql_dados_user_por_id.php';
	//echo "$linha_orc->n_orc";

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
                <link rel="stylesheet" href="../../estilos.css">
    	
    	<?php include_once '../../includes/javascripts/tabela_no_head.php';?>
    	
</head>
<body>
<div  style="background: url(../../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
 <div>
	<h2><a href="javascript:window.close()">Orçamento</a> -> Histórico Orçamento não Aprovado</h2>
</div>
<hr>
<fieldset>
	<legend><b>Dados do Orçamento</b></legend>
	<div id="">
		<h3> Acompanhamento Orçamento Nº <?php echo $linha_orc->n_orc; ?> - Cliente: <?php echo $linha_orc->razao_social_contr; ?></h3>
			
		Nome de contato: <b><?php echo $linha_orc->contato_clint?></b> 
		<br>
		Telefone de contato: <b><?php echo $linha_orc->telefone_contr;?></b>
	</div>
</fieldset>	
<fieldset>
	<legend><b>Dados do Contato de hoje</b></legend>
    <form action="salvar/historico.php" method="post" enctype="multipart/form-data" name="formH_acomp_n_aprovados">
		<table>
			<tr>
				<td>Data do contato:</td>
				<td><b><?php echo date('d/m/Y');?></b></td>
			</tr>
			<tr>
				<td>Colaborador ELFI: </td>
				<td><input type="text" value="<?php echo $linha_user->Login; ?>" name="colab_elfi" readonly="readonly" /></td>
			</tr>
			<tr>
				<td>Nome do contato:</td>
				<td><input type="text" value="" name="contato_cliente"  /></td>
			</tr>
			<tr>
				<td>Telefone do contato:</td>
				<td><input type="text" value="" name="tel_cliente"  /></td>
			</tr>
			<tr>
				<td>Conversado:</td>
				<td><textarea  style="height: 5em; width: 100%;" id="text" name="conversado"></textarea></td>
			</tr>
			<tr>
				<td><input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="salvar" value="Salvar" id="salvar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
				    <input type="hidden" name="id_usuario" value="<?php echo $linha_user->id_colaborador; ?>" readonly="readonly" />
					<input type="hidden" name="id_orc" value="<?php echo $linha_orc->id; ?>" readonly="readonly" />
				</td>
			</tr>
		</table>
	</form>				
</fieldset>
<fieldset>
	<legend><b>Historico de Contato com Cliente</b></legend>
	<TABLE  class="display" id="example2">
		<thead>
  			<TR>
  				<TH></TH>
    			<TH>Data</TH>
    			<TH>Colaborador ELFI</TH>
    			<TH>Contato Cliente</TH>
    			<TH>Telefone Cliente</TH>
    			<TH>Conversa</TH>
    		</TR>
  		</thead>
  		<tbody>
			
		<?php
			//$data_hj = date('Y-m-d');
       		$sql = "SELECT * FROM historico_orc_n_aprovado WHERE id_orc = '$linha_orc->id' ORDER BY id DESC";
        	$res = mysql_query( $sql );
         while ( $row = mysql_fetch_assoc( $res ) ) {
		?>
	  		<TR>
                                                                                <td><a class="bt_link bt_verde" href="#" onclick="window.open('editar_historico_n_aprovado.php?id_historico=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">editar</a>
					<br>
                                                                                <a class="bt_link bt_vermelho" href="#" onclick="window.open('excluir_historico_n_aprovado.php?id_historico=<?php echo $row['id']; ?>&msg_erro=#', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">excluir</a>
				</td>
	    		<Td><?php echo date('d/m/Y à\s H:m', strtotime($row['dia_do_contato'])); ?></Td>
				<TD><?php echo $row['colab_elfi']; ?></TD>
				<TD><?php echo $row['contato_cliente']; ?></TD>
				<TD><?php echo $row['tel_cliente']; ?></TD>
				<TD><?php echo $row['conversa']; ?></TD>
			</tr>
		<?php
			}
		?>
		</tbody>
	</TABLE>
</fieldset>
	      
</body>
</html>
<?php }?>