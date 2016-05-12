<?php
if (isset ( $_GET ['id_cliente'] )) {
	$id_cliente = $_GET ['id_cliente'];
	?>
	<div>
		<h2><a href="tecnico.php?id_menu=cliente">Clientes</a> -> Excluir -> Excluindo</h2>
	</div>
	<hr>
	
	<?php	
	
	if (isset ( $_POST ['razao_social'] )) {
		$razaoSocial = $_POST ['razao_social'];
		
		
		mysql_query("UPDATE clientes SET mostrar = '0' WHERE id ='$id_cliente' AND razao_social='$razaoSocial'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
?>
<script>
	alert ("Cliente excluido com sucesso!");
</script>
<a href="tecnico.php?id_menu=cliente" target="_self">Voltar</a>
<?php 		
		
	}
}else{
	echo"<b> Cliente n�o identificado. </b>";
}