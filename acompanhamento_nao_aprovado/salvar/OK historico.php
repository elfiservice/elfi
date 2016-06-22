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
	$id_usuario 		= $_POST['id_usuario'];
	$id_orc 			= $_POST['id_orc'];
	
	// Adiciona no BD 
	mysql_query("INSERT INTO historico_orc_n_aprovado (id_orc, dia_do_contato, 	id_colab, colab_elfi, contato_cliente, tel_cliente,	conversa)
				VALUES('$id_orc','$data_hj','$id_usuario','$colab_elfi','$contato_cliente','$tel_cliente','$conversado')")
				or die (mysql_error("Houve um erro ao tentar Adicionar no BD."));
	
	mysql_query("UPDATE orcamentos SET data_ultimo_cont_cliente = '$data_hj' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações (tabela Orcamentos)"));
	mysql_query("UPDATE orcamentos SET 	colab_ultimo_contato_client = '$colab_elfi' WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações (tabela Orcamentos)"));

?>
		<script type="text/javascript" >
		alert ("Historico adicionado com Sucesso!");
		document.write('<a href="' + document.referrer + '">Voltar</a>');
		</script>
<?php 
}else{
?>
<a href="javascript:history.go(-1)">Voltar</a>
<?php }?>

