<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.

        
 */
           include "checkuserlog.php";
        include_once "Config/config_sistema.php"; 

        $logOptions_col = $_GET['id_colaborador'];
        
        //echo "$logOptions_col";
        
	if ($logOptions_col == $logOptions_id) {
          
          
            
  			$consulta_colab = mysql_query("select * from colaboradores where id_colaborador = '$logOptions_col'");
			$linha_colab = mysql_fetch_object($consulta_colab);
                      
                     echo 'Colaborador: <B>'. $linha_colab->Login .'</B> em '.  date(' j \d\e F \d\e Y, \à\s H:i', strtotime($linha_colab->last_log_date));
        }else{
            
            echo ' Ocorreu algum problema durante seu Login no Sistema. Por favor <a href="logout.php">Saia</a> e entre novamente.';
            
        }


?>
