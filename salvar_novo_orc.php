<?php

include_once "Config/config_sistema.php"; 


//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['razao_social']))
    {

     $id_usuario            = $_POST['usuario'];


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
     $atividade1            = $_POST['atividade1'];
     $classificacao1        = $_POST['classificacao1'];
     $quantidade1           = $_POST['quantidade1'];
     $unidade1              = $_POST['unidade1'];
     
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
     $ano_atual_orc         = $_POST['ano_atual_orc']; 
     $consulta_ORC          = mysql_query("SELECT n_orc FROM orcamentos WHERE ano_orc = '$ano_atual_orc'") or die (mysql_error("Erro ao contar Quantidade de Orçamentos no BD!")); 
     $Quant_ORC_check       = mysql_num_rows($consulta_ORC); 
     
     if ($Quant_ORC_check == "" || $Quant_ORC_check == null) 
     {
         $numero_ORC = "1";
         
     } else {
         
         
         $numero_ORC = $Quant_ORC_check + 1;
     }
     
     
     
     
     
     
         
         	$sql_descricao_orc = mysql_query("SELECT * FROM orcamentos WHERE descricao_servico_orc = '$descricao_servicos' AND ano_orc = '$ano_atual_orc'") or die (mysql_error()); 
		$descricao_orc_check = mysql_num_rows($sql_descricao_orc); 
                
                
                if ($descricao_orc_check > 0)
                {
                  ?>
                    <script type="text/javascript" >
                        alert ("A descrição do serviço deste Orçamento já foi cadastrado no sistema esse ANO! \n  Orçamento NAO cadastrado.");
                                                exit();
                    </script>
                    
                    <meta http-equiv="refresh" content="0;url=javascript:history.back()" >
                    <a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
                    <?php
                } else{
     
        
                        
         	$sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die (mysql_error()); 
		$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $nome_usuario = $linha_usuario->Login;
                
         

    // Add user info into the database table for the main site table
     $sql = mysql_query("INSERT INTO orcamentos (n_orc, ano_orc, colaborador_orc, razao_social_contr, cnpj_contr, endereco_contr, bairro_contr, cidade_contr, estado_contr, cep_contr, telefone_contr, celular_contr, email_contr, atividade, classificacao, quantidade, unidade, descricao_servico_orc, prazo_exec_orc, validade_orc, pagamento_orc, obs_orc, duvida_orc, vr_servco_orc, vr_material_orc, vr_total_orc, data_adicionado_orc, razao_social_obra, cnpj_obra, endereco_obra, bairro_obra, estado_obra, cidade_obra, cep_obra, telefone_obra, celular_obra, email_obra, situacao_orc, contato_clint) 
     VALUES('$numero_ORC','$ano_atual_orc','$nome_usuario','$razao_social_contra','$cnpj_contra','$endereco_contra','$bairro_contra','$cidade_contra', '$estado_contra', '$cep_contra', '$tel_contra', '$cel_contra', '$email_orc_contra', '$atividade1', '$classificacao1', '$quantidade1', '$unidade1', '$descricao_servicos', '$execucao_orc', '$validade_orc', '$pagamento_orc', '$observacoes_servico', '$duvida_orc', '$sum_vr_servico_orc', '$sum_vr_material_orc','$total_orc',now(), '$razao_social_obra','$cnpj_obra','$endereco_obra', '$bairro_obra', '$estado_obra', '$cidade_obra', '$cep_obra', '$tel_obra', '$cel_obra', '$email_orc_obra','Aguardando aprovação','$contato_clint')")  
     or die (mysql_error("Ocorreu um erro ao tentar salvar dados da Obra no banco de dados."));         
         
     
     

     
     
    echo "Novo orçamento adicionado.";
     
//buscar ID Orc novo
	    $sql_id_orc_novo = mysql_query("SELECT * FROM orcamentos WHERE n_orc = '$numero_ORC' AND ano_orc = '$ano_atual_orc'") or die (mysql_error()); 
		$linha_id_orc = mysql_fetch_object($sql_id_orc_novo);
                
                $id_orc = $linha_id_orc->id;
	 
     
     
     ?>
                    <script type="text/javascript" >
alert ("Orçamento adicionado com Sucesso!");
</script>
    

<a href="imprimir_orc.php?id_orc=<?php echo $id_orc; ?>" target="_blank">Imprimir</a><br>
<a href="tecnico.php" target="_self">Voltar</a>

<!--meta http-equiv="refresh" content="1;url=javascript:history.back()" -->

<!--script language= "JavaScript">

location.href="imprimir_orc.php?id_orc=<?php echo $id_orc; ?>"

</script-->
<?php
 /*    
     header("location: financeiro.php"); // Shoot viewer back to the homepage of the site if they try to look here
exit();
          * 
  */
    }
  }
 
?>

