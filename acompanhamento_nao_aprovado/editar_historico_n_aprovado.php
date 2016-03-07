<?php 
include "../checkuserlog.php";
include_once "../Config/config_sistema.php";

if (!isset($_SESSION['idx'])) { //testa se a sess�o existe
	if (!isset($_COOKIE['idCookie'])) {

		//include_once '../conectar.php';
		//header("location: ../index.php");
		echo "Você não esta logado!";
	}
} else {
	
		$ano_atual = date('Y');
	
		$id_historico = "";
		if(isSet ($_GET['id_historico']) && $_GET['id_historico'] <> null) {
			$id_historico = $_GET['id_historico'];

		}else{
			echo"Ocorreu um erro na requisição do parametro id_historico!";
			exit;
		}

		
		include_once '../includes/sql_dados_hist_orc_n_aprov_por_id.php';
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
</head>
<body>
<div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>
<a href="javascript:window.history.go(-1)" target="_self">Voltar</a>
<div id="">
	<h3> Editando Histórico Orçamento não Aprovado</h3>

</div>

<fieldset>
	<legend><h3>Dados</h3></legend>
		<form action="salvar/historico_editado.php" method="post" enctype="multipart/form-data" name="formEditarOrcNAprovado">
			<table>
				<tr>
					<td>Data do contato:</td>
					<td><b><?php echo date('d/m/Y à\s H:m', strtotime($linha_orc_n_aprovado->dia_do_contato));?></b></td>
				</tr>
				<tr>
					<td>Colaborador ELFI: </td>
					<td><input type="text" value="<?php echo $linha_orc_n_aprovado->colab_elfi; ?>" name="colab_elfi" readonly="readonly" /></td>
				</tr>
				<tr>
					<td>Contato no Cliente:</td>
					<td><input type="text" value="<?php echo $linha_orc_n_aprovado->contato_cliente; ?>" name="contato_cliente"  /></td>
				</tr>
				<tr>
					<td>Telefone do Cliente:</td>
					<td><input type="text" value="<?php echo $linha_orc_n_aprovado->tel_cliente; ?>" name="tel_cliente"  /></td>
				</tr>
				<tr>
					<td>Conversado:</td>
					<td><textarea  rows="3" cols="50" id="text" name="conversado"><?php echo strip_tags($linha_orc_n_aprovado->conversa); ?></textarea></td>
				</tr>
			</table>			
			
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="salvar" value="Salvar" id="salvar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
        	
        	<input type="hidden" name="id_usuario" value="<?php echo $logOptions_id;  ?>" readonly="readonly" />
			<input type="hidden" name="id_orc" value="<?php echo $linha_orc_n_aprovado->id_orc; ?>" readonly="readonly" />
			<input type="hidden" name="id_historico" value="<?php echo $linha_orc_n_aprovado->id; ?>" readonly="readonly" />				
		</form >
</fieldset>
</body>
</html>



<?php }?>