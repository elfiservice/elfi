<?php

include_once "../Config/config_sistema.php"; 


				        $id_orc = "";
        if(isSet ($_GET['id_orc'])) {
        
             $id_orc = $_GET['id_orc'];
			 
			 echo "excluir Orçamento de ID = $id_orc";
			 
			 
			 mysql_query("DELETE FROM acompanhamento WHERE id ='$id_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
			 
			 
			 
			 ?>
			 
			                     <script type="text/javascript" >
alert ("Orçamento excluido com Sucesso!");
</script>
			 <?php
			 
			 
        }
		
		
		
		

//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['id_orc']))
    {
	
	$id_orc =		 $_POST['id_orc'];  
	
	    $sql_n_orc = mysql_query("SELECT * FROM acompanhamento WHERE id ='$id_orc'") or die (mysql_error()); 
		$linha_orc = mysql_fetch_object($sql_n_orc);
   
			$razao_social = $linha_orc->clientID;
			$n_orc = $linha_orc->n_orc;
	
	
echo "Quer excluir definitivamente o ORÇAMENTO Nº: $n_orc - $razao_social ?

<a href=\"excluir_orc.php?id_orc=$id_orc&resp=sim\" target=\"_self\">Sim</a>
--
<a href=\"#\" onclick=\"window.close() \" >Cancelar</a>


";
   
						
						
			
						


   
     


  }
 
?>

