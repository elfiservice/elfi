<?php 
include_once "../../Config/config_sistema.php";
if (isset ($_POST['colab_elfi']))
{

	$data_hj 			= date('Y-m-d H:m:s');
	$colab_elfi 		= $_POST['colab_elfi'];
	$contato_cliente 	= $_POST['contato_cliente'];
	$tel_cliente 		= $_POST['tel_cliente'];
	$conversado 		= $_POST['conversado'];
	$conversado    		= nl2br($conversado);
	$id_historico 		= $_POST['id_historico'];
	$id_orc 			= $_POST['id_orc'];

	mysql_query("UPDATE historico_orc_n_aprovado SET dia_da_edicao = '$data_hj' WHERE id ='$id_historico' AND id_orc ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	mysql_query("UPDATE historico_orc_n_aprovado SET colab_elfi = '$colab_elfi' WHERE id ='$id_historico' AND id_orc ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	mysql_query("UPDATE historico_orc_n_aprovado SET contato_cliente = '$contato_cliente' WHERE id ='$id_historico' AND id_orc ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	mysql_query("UPDATE historico_orc_n_aprovado SET tel_cliente = '$tel_cliente' WHERE id ='$id_historico' AND id_orc ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
	mysql_query("UPDATE historico_orc_n_aprovado SET conversa = '$conversado' WHERE id ='$id_historico' AND id_orc ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));

	?>
			<script type="text/javascript" >
			alert ("Historico alterado com Sucesso!");
			//document.write('<a href="' + document.referrer + '">Voltar</a>');
			</script>
			<a href="javascript:history.go(-2)">Voltar</a>
	<?php 
	}else{
	?>
	<a href="javascript:history.go(-1)">Voltar</a>
<?php 
}

?>