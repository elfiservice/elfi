
 <div>
	<h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> Editar -> Salvando</h2>
</div>
<hr>
    <?php


//include_once "../../Config/config_sistema.php"; 


//Este código será executado somente se o nome de usuário é Postado
//var_dump(filter_has_var(INPUT_POST, "razao_social"));

if (filter_has_var(INPUT_POST, "razao_social"))
    {
    
    //echo $_POST['cnpj'];
   // $cnpj_contrato = ;
    $cnpj_contrato = Formatar::limpaCPF_CNPJ($_POST['cnpj']);
    
        //dados obra
    if (filter_has_var(INPUT_POST, "razao_social2"))
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
    //dados Descrição do Orçamento
     $descricao_servicos    = $_POST['descricao_servicos'];
     $descricao_servicos    = nl2br($descricao_servicos);
     
     //dados Observações
     $observacoes_servico   = nl2br($_POST['observacoes_servico']);
     
     $total_orc             = number_format($_POST['totalSum'], 2, ',', '.');
     
     $data_ultima_alteracao = date('Y-m-d H:i:s') ;
        
        $orcamentoObj = new Orcamento(
                $_POST['id_orc_editado'], 
                "", 
                "", 
                $_SESSION['Login'], 
                "", 
                $_POST['razao_social'], 
                $cnpj_contrato, 
                $_POST['endereco'], 
                $_POST['bairro'], 
                $_POST['city'], 
                $_POST['estado'], 
                $_POST['cep'], 
                $_POST['tel'], 
                $_POST['cel'], 
                $_POST['email_orc'], 
                $_POST['contato_clint'], 
                $razao_social_obra, 
                $cnpj_obra, 
               $endereco_obra, 
                $bairro_obra, 
                $cidade_obra, 
                $estado_obra, 
                $cep_obra, 
                $tel_obra, 
                $cel_obra, 
                $email_orc_obra, 
                $_POST['atividade1'],  
                $_POST['classificacao1'], 
                $_POST['quantidade1'], 
                $_POST['unidade1'], 
                $descricao_servicos, 
                $_POST['execucao_orc'], 
                $_POST['validade_orc'],
                $_POST['pagamento_orc'], 
                $observacoes_servico, 
                $_POST['duvida_orc'], 
                $_POST['sum_vr_servico_orc'], 
                $_POST['sum_vr_material_orc'], 
                "", 
                $total_orc, 
                "", 
                "", 
                $data_ultima_alteracao, "", "", "", "", "", "", "", "", "", "", "", "", "", "","");
    
       // var_dump($orcamentoObj);
           
        $orcSaveCtrl = new OrcamentoCtrl();
        
       $result = $orcSaveCtrl->atualizarOrcamento($orcamentoObj);
    //  var_dump($result);

    echo "Resultado desta operação: <b> {$result['resultado']}</b><br>";
//    foreach ($result as $campo => $dado){
//        if(!$dado == "" || !$dado == null){
//            
//           echo "<b>{$campo}</b> para <b>{$dado}</b> <br>";
//        }
//    }
//     
  
     
     ?>
                    <script type="text/javascript" >
alert ("Orçamento de ID Nº <?=  $orcamentoObj->getId() ?> : <?=  $result['resultado']?>");
</script>
    

<a href="tecnico.php" target="_self">Voltar</a>

<?php
    
  }else{
      echo "Sem POST";
  }
 
?>

