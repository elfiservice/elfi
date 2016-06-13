<?php

include_once "../Config/config_sistema.php"; 


//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['mes']))
    {

    //$id_usuario = $_POST['usuario'];  
    
     $n_de_orc_feitos =	$_POST['n_de_orc_feitos'];
     $mes = 			$_POST['mes'];
     $ano = 			$_POST['ano'];

      
             
         	$sql_razao = mysql_query("SELECT * FROM controle_n_orc WHERE mes='$mes' AND ano = '$ano'") or die (mysql_error()); 
		$razao_check = mysql_num_rows($sql_razao); 
		
		if ($razao_check > 0)
		{
			mysql_query("UPDATE controle_n_orc SET n_orc_feitos = '$n_de_orc_feitos' WHERE mes ='$mes' AND ano = '$ano'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
		
		
		} else {
		
			$sql = mysql_query("INSERT INTO controle_n_orc (mes, ano, n_orc_feitos) 
				 VALUES('$mes','$ano', '$n_de_orc_feitos')")  
				 or die (mysql_error());  
		}
		
		  
     ?>
                    <script type="text/javascript" >
alert ("N. de orcamentos adicionado com Sucesso!");
</script>
    


<a href='javascript:history.back(1)'>Voltar</a>


<?php
		
		
}
	
?>
                