<?php 

//$dyn_www = "{$www}/colaboradores"; 
?>
<!-- Tabela  -->
<link rel="stylesheet" href="<?php echo $www;?>/tabela/demo_page.css">  
<link rel="stylesheet" href="<?php echo $www;?>/tabela/demo_table.css">  

<!--		<script type="text/javascript" language="javascript" src="<?php echo $www;?>/tabela/jquery.js"></script>-->
		<script type="text/javascript" language="javascript" src="<?php echo $www;?>/tabela/jquery.dataTables.js"></script>
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