<?php

//include_once "../../Config/config_sistema.php"; 


//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['razao_social']))
    {

     $id_usuario            = $_POST['usuario'];
	$id_orc_editado            = $_POST['id_orc_editado'];
		
//dados contratada
     $razao_social_contra   = $_POST['razao_social'];
     $cnpj_contra           = $_POST['cnpj'];
     $endereco_contra       = $_POST['endereco'];
     $bairro_contra         = $_POST['bairro'];
     $cidade_contra         = $_POST['city'];
     $cep_contra            = $_POST['cep'];
     $estado_contra         = $_POST['estado'];
     $tel_contra            = $_POST['tel'];
     $cel_contra            = $_POST['cel'];
     $email_orc_contra      = $_POST['email_orc'];
     
//Contato
     $contato_clint         = $_POST['contato_clint'];
     
//dados da Classificação da Atividade
     $atividade  	        = $_POST['atividade1'];
     $classificacao        = $_POST['classificacao1'];
     $quantidade           = $_POST['quantidade1'];
     $unidade              = $_POST['unidade1'];
     
//dados Descrição do Orçamento
     $descricao_servicos    = $_POST['descricao_servicos'];
     $descricao_servicos    = nl2br($descricao_servicos);
     
//dados das CONDIÇÔES
     $execucao_orc          = $_POST['execucao_orc'];
     $validade_orc          = $_POST['validade_orc'];
     $pagamento_orc         = $_POST['pagamento_orc'];

//dados Observações
     $observacoes_servico   = nl2br($_POST['observacoes_servico']);
     
//dados Dúvidas
     $duvida_orc            = $_POST['duvida_orc'];      

//dados VAlor do orçamento

     
     $sum_vr_servico_orc    = $_POST['sum_vr_servico_orc'];
     $sum_vr_material_orc   = $_POST['sum_vr_material_orc'];
     $total_orc             = number_format($_POST['totalSum'], 2, ',', '.');
     
     

  
         
     

//dados obra
if (isset ($_POST['razao_social2']))
    {

     $razao_social_obra = $_POST['razao_social2'];
     $cnpj_obra         = $_POST['cnpj2'];
     $endereco_obra     = $_POST['endereco2'];
     $bairro_obra       = $_POST['bairro2'];
     $cidade_obra       = $_POST['city2'];
     $cep_obra          = $_POST['cep2'];
     $estado_obra       = $_POST['estado2'];
     $tel_obra          = $_POST['tel2'];
     $cel_obra          = $_POST['cel2'];
     $email_orc_obra    = $_POST['email_orc2'];
     
     
     
    } else {
     $razao_social_obra = "";
     $cnpj_obra         = "";
     $endereco_obra     = "";
     $bairro_obra       = "";
     $cidade_obra       = "";
     $cep_obra          = "";
     $estado_obra       = "";
     $tel_obra          = "";
     $cel_obra          = "";
     $email_orc_obra    = "";
        
    }     
     
//Número do ORC
     // $ano_atual_orc         = $_POST['ano_atual_orc']; 
     // $consulta_ORC          = mysql_query("SELECT n_orc FROM orcamentos WHERE ano_orc = '$ano_atual_orc'") or die (mysql_error("Erro ao contar Quantidade de Orçamentos no BD!")); 
     // $Quant_ORC_check       = mysql_num_rows($consulta_ORC); 
     
     // if ($Quant_ORC_check == "" || $Quant_ORC_check == null) 
     // {
         // $numero_ORC = "1";
         
     // } else {
         
         
         // $numero_ORC = $Quant_ORC_check + 1;
     // }
     
     
                        
         	$sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die (mysql_error()); 
		$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $nome_usuario = $linha_usuario->Login;
                
         


                        mysql_query("UPDATE orcamentos SET colaborador_orc = '$nome_usuario' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET razao_social_contr = '$razao_social_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
						mysql_query("UPDATE orcamentos SET cnpj_contr = '$cnpj_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET endereco_contr = '$endereco_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET bairro_contr = '$bairro_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET cidade_contr = '$cidade_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET estado_contr = '$estado_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET cep_contr = '$cep_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET telefone_contr = '$tel_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET celular_contr = '$cel_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET email_contr = '$email_orc_contra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET contato_clint = '$contato_clint' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
						mysql_query("UPDATE orcamentos SET razao_social_obra = '$razao_social_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
						mysql_query("UPDATE orcamentos SET cnpj_obra = '$cnpj_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
						mysql_query("UPDATE orcamentos SET endereco_obra = '$endereco_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE orcamentos SET bairro_obra = '$bairro_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
						mysql_query("UPDATE orcamentos SET cidade_obra = '$cidade_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  	 
						mysql_query("UPDATE orcamentos SET estado_obra = '$estado_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  	 						
						mysql_query("UPDATE orcamentos SET cep_obra = '$cep_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  	 						     
						mysql_query("UPDATE orcamentos SET telefone_obra = '$tel_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  	 						          
						mysql_query("UPDATE orcamentos SET celular_obra = '$cel_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  	 						          
						mysql_query("UPDATE orcamentos SET email_obra = '$email_orc_obra' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  	 						          
						
mysql_query("UPDATE orcamentos SET atividade = '$atividade' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  	 						          						
mysql_query("UPDATE orcamentos SET classificacao = '$classificacao' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  	 						          						
mysql_query("UPDATE orcamentos SET quantidade = '$quantidade' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  
mysql_query("UPDATE orcamentos SET unidade = '$unidade' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações")); 

mysql_query("UPDATE orcamentos SET descricao_servico_orc = '$descricao_servicos' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações")); 
mysql_query("UPDATE orcamentos SET prazo_exec_orc = '$execucao_orc' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações")); 
mysql_query("UPDATE orcamentos SET validade_orc = '$validade_orc' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações")); 
mysql_query("UPDATE orcamentos SET pagamento_orc = '$pagamento_orc' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações")); 

mysql_query("UPDATE orcamentos SET obs_orc = '$observacoes_servico' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));      
mysql_query("UPDATE orcamentos SET duvida_orc = '$duvida_orc' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));      

mysql_query("UPDATE orcamentos SET vr_servco_orc = '$sum_vr_servico_orc' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));      
mysql_query("UPDATE orcamentos SET vr_material_orc = '$sum_vr_material_orc' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));      
mysql_query("UPDATE orcamentos SET vr_total_orc = '$total_orc' WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));  

mysql_query("UPDATE orcamentos SET data_ultima_alteracao = now() WHERE id ='$id_orc_editado'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));      

     
    echo "Orçamento atualizado.";
     
     
     
     ?>
                    <script type="text/javascript" >
alert ("Orçamento atualizado com Sucesso!");
</script>
    

<!--a href="tecnico.php" target="_self">Voltar</a-->

<!--meta http-equiv="refresh" content="1;url=javascript:history.back()" -->

<script type="text/javascript">  

window.close();  
// dando um refresh na página principal  
 
// ou assim:  
window.opener.location.reload(); 


// função usada para carregar o código  
function fecha() {

//opener.location.href=opener.location.href;   
// fechando a janela atual ( popup )  
window.close();  
// dando um refresh na página principal  
 
// ou assim:  
window.opener.location.reload(); 

// document.location="Cores.htm"  
// fim da função  
}  
</script>  
  
<a href="javascript:void(0)" onclick="fecha()">fechar</a> 
<?php
 /*    
     header("location: financeiro.php"); // Shoot viewer back to the homepage of the site if they try to look here
exit();
          * 
  */
    
  }
 
?>

