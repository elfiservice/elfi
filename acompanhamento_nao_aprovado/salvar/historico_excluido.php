<?php
include_once "../../Config/config_sistema.php";
if (isset ($_POST['id_historico']))
{

	$id_historico 		= $_POST['id_historico'];
	$id_orc 			= $_POST['id_orc'];
	$id_usuario_logado 	= $_POST['id_usuario_logado'];
	$id_usuario_BD 		= $_POST['id_usuario_BD'];

	if ($id_usuario_logado == $id_usuario_BD){
	mysql_query("DELETE FROM historico_orc_n_aprovado WHERE id ='$id_historico' AND id_orc = '$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar excluir o historico"));
	?>
			<script type="text/javascript" >
			alert ("Historico excluido com Sucesso!");
			//document.write('<a href="' + document.referrer + '">Voltar</a>');
			</script>
			<a href="javascript:history.go(-2)">Voltar</a>
	<?php 
		}else{echo"Você não tem permissão para excluir este historico. <a href=\"javascript:history.go(-1)\">Voltar<\/a>";}
	}else{
	?>
	<a href="javascript:history.go(-1)">Voltar</a>
<?php 
}

?>