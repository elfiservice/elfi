 <div>
	<h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> Novo -> Salvando</h2>
</div>
<hr>

<?php
//include_once "Config/config_sistema.php"; 
//Este código será executado somente se o nome de usuário é Postado
if (filter_has_var(INPUT_POST, "razao_social"))
    {
    
    $id_colab = $_SESSION['id'];
    $id_cliente = filter_input(INPUT_POST, 'id_cliente');
    $colaborador_orc =  $_SESSION['Login'];
    $ano_orc         = $_POST['ano_atual_orc'];
    $dataAdicionadoOrc = date('Y-m-d H:i:s');
//dados contratada
     $razao_social_contr   = $_POST['razao_social'];
     $cnpj_contr = Formatar::limpaCPF_CNPJ($_POST['cnpj']);
     $endereco_contr       = $_POST['endereco'];
     $bairro_contr         = $_POST['bairro'];
     $cidade_contr         = $_POST['city'];
     $cep_contr       = $_POST['cep'];
     $estado_contr         = $_POST['estado'];
     $telefone_contr            = $_POST['tel'];
     $celular_contr            = $_POST['cel'];
     $email_contr      = $_POST['email_orc'];
     
//Contato
     $contato_clint         = $_POST['contato_clint'];
     
//dados da Classificação da Atividade
     $atividade            = $_POST['atividade1'];
     $classificacao        = $_POST['classificacao1'];
     $quantidade           = $_POST['quantidade1'];
     $unidade              = $_POST['unidade1'];
     
//dados Descrição do Orçamento
     $descricao_servicos    = $_POST['descricao_servicos'];
     $descricao_servico_orc    = nl2br($descricao_servicos);
     
//dados das CONDIÇÔES
     $prazo_exec_orc          = $_POST['execucao_orc'];
     $validade_orc          = $_POST['validade_orc'];
     $pagamento_orc         = $_POST['pagamento_orc'];

//dados Observações
     $obs_orc   = nl2br($_POST['observacoes_servico']);
     
//dados Dúvidas
     $duvida_orc            = $_POST['duvida_orc'];      

//dados VAlor do orçamento

     
//     $vr_servco_orc    = $_POST['sum_vr_servico_orc'];
//     $vr_material_orc   = $_POST['sum_vr_material_orc'];
     
          $vr_servco_orc = Formatar::moedaBD($_POST['sum_vr_servico_orc']);
     $vr_material_orc = Formatar::moedaBD($_POST['sum_vr_material_orc']);
     //$total_orc             = number_format($_POST['totalSum'], 2, ',', '.');
      $total_orc             = $_POST['totalSum'];
     
     
//dados obra
if (isset ($_POST['razao_social2']))
    {

     $razao_social_obra = $_POST['razao_social2'];
    // $cnpj_obra         = $_POST['cnpj2'];
        $cnpj_obra = Formatar::limpaCPF_CNPJ($_POST['cnpj2']);
     $endereco_obra     = $_POST['endereco2'];
     $bairro_obra       = $_POST['bairro2'];
     $cidade_obra       = $_POST['city2'];
     $cep_obra          = $_POST['cep2'];
     $estado_obra       = $_POST['estado2'];
     $telefone_obra          = $_POST['tel2'];
     $celular_obra          = $_POST['cel2'];
     $email_obra    = $_POST['email_orc2'];
     
    } else {
     $razao_social_obra = "";
     $cnpj_obra         = "";
     $endereco_obra     = "";
     $bairro_obra       = "";
     $cidade_obra       = "";
     $cep_obra          = "";
     $estado_obra       = "";
     $telefone_obra          = "";
     $celular_obra          = "";
     $email_obra    = "";
        
    }     
     
    
    $OrcObjNovo = new Orcamento(
            "",
            $id_cliente,
            $id_colab,
            "", 
            $ano_orc, 
            $colaborador_orc, 
            "", 
            $razao_social_contr, 
            $cnpj_contr, 
            $endereco_contr, 
            $bairro_contr, 
            $cidade_contr, 
            $estado_contr, 
            $cep_contr, 
            $telefone_contr, 
            $celular_contr, 
            $email_contr, 
            $contato_clint, 
            $razao_social_obra, 
            $cnpj_obra, 
            $endereco_obra, 
            $bairro_obra, 
            $cidade_obra, 
            $estado_obra, 
            $cep_obra, 
            $telefone_obra, 
            $celular_obra, 
            $email_obra, 
            $atividade, 
            $classificacao, 
            $quantidade, 
            $unidade, 
            $descricao_servico_orc, 
            $prazo_exec_orc, 
            $validade_orc, 
            $pagamento_orc, 
            $obs_orc,
            $duvida_orc, 
            $vr_servco_orc, 
            $vr_material_orc, 
            "", 
            $total_orc, 
            "", 
            $dataAdicionadoOrc, 
            "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
     
    $orcCtrlNovo = new OrcamentoCtrl();
    $orcCtrlNovo->inserirOrcamento($OrcObjNovo);
    
    
    if ($orcCtrlNovo->getResult()){
        
        $nOrc = $OrcObjNovo->getNOrc();
        $anoOrc = $OrcObjNovo->getAnoOrc();
        $orcaCtrlInserido = new OrcamentoCtrl();
        $orcAdicionado = $orcaCtrlInserido->buscarOrcamentos("*", "WHERE n_orc = $nOrc AND ano_orc = $anoOrc");
      //  var_dump($orcAdicionado);
        ?>
 <script type="text/javascript" >
alert ("Orçamento adicionado com Sucesso!");
</script>


<p>
    <a href="#" class="bt_imprimir" onclick="window.open('orcamento/imprimir_orc.php?id_orc=<?= $orcAdicionado[0]['id']?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10');">
         Imprimir
</a>
</p>
<?php

echo "<div class=\"sucesso\">Adicionado o Orcamento Nº {$OrcObjNovo->getNOrc()}.{$OrcObjNovo->getAnoOrc()}</div>";
    }else{
        echo "<div class=\"erro\"> ERRO ao tentar inserir novo Orcamento!</div>";
    }
    
    


     
     
     
//         
//         	$sql_descricao_orc = mysql_query("SELECT * FROM orcamentos WHERE descricao_servico_orc = '$descricao_servicos' AND ano_orc = '$ano_atual_orc'") or die (mysql_error()); 
//		$descricao_orc_check = mysql_num_rows($sql_descricao_orc); 
//                
//                
//                if ($descricao_orc_check > 0)
//                {
//                  ?>
                    <!--script type="text/javascript" >
                        alert ("A descrição do serviço deste Orçamento já foi cadastrado no sistema esse ANO! \n  Orçamento NAO cadastrado.");
                                                exit();
                    </script>
                    
                    <meta http-equiv="refresh" content="0;url=javascript:history.back()" >
                    <a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a-->
                    <?php
//                } else{
//     
//        
//                        
//         	$sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die (mysql_error()); 
//		$linha_usuario = mysql_fetch_object($sql_nome_user);
//                
//                $nome_usuario = $linha_usuario->Login;
//                
  
//     ?>
                    
                    
                    
                    
                    <!--script type="text/javascript" >
alert ("Orçamento adicionado com Sucesso!");
</script>
    

<a href="imprimir_orc.php?id_orc=//<?php echo $id_orc; ?>" target="_blank">Imprimir</a><br>
<a href="tecnico.php" target="_self">Voltar</a-->

<!--meta http-equiv="refresh" content="1;url=javascript:history.back()" -->

<!--script language= "JavaScript">

location.href="imprimir_orc.php?id_orc=//<?php echo $id_orc; ?>"

</script-->
<?php
// /*    
//     header("location: financeiro.php"); // Shoot viewer back to the homepage of the site if they try to look here
//exit();
//          * 
//  */
//    }
  }
 
?>

