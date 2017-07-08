<?php
require '../classes/Config.inc.php';

session_start();

$login = new Login();

if (!$login->checkLogin()) {
    WSErro("Você não esta Logado!", WS_ALERT);
} else {
    $userlogin = $login->getSession();
}

$id_orcamento = filter_input(INPUT_GET, 'id_orc', FILTER_VALIDATE_INT);
if (empty($id_orcamento)) {

    WSErro("Erro na URL!", WS_ALERT);
    die;
}

$empresaCtrl = new EmpresaCtrl();
$empresaDao = $empresaCtrl->buscarEmpresa("*", "WHERE id = 2");
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>

        <meta name="description" content="">
        <meta name="author" content="Elfi Service">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href=".css">    

    </head>

    <body>
        <div style="margin:20px 0px 20px 0px;">

            <?php
            $orcCtrl = new OrcamentoCtrl();
            $orcamento = $orcCtrl->buscarOrcamentoPorId("*", "WHERE id = '$id_orcamento' LIMIT 1");
            //   var_dump($orcamento);


            $n_orc = $orcamento->getNOrc();
            $ano_orc = $orcamento->getAnoOrc();
            $descricao_orc = $orcamento->getDesciServicoObra();
            $contato_contra = $orcamento->getContatoCliente();

//dados Contratante
            $razao_contra = $orcamento->getRazaoSocialContrat();
            $endereco_contr = $orcamento->getEnderecoContrat();
            $bairro_contr = $orcamento->getBairroContrat();
            $cidade_contr = $orcamento->getCidadeContrat();
            $estado_contr = $orcamento->getEstadoContrat();
            $cep_contrat = $orcamento->getCepContrat();
            $tel_contr = $orcamento->getTelContrat();
            $cel_contr = $orcamento->getCelContrat();
            $email_contr = $orcamento->getEmailContrat();

            $n_da_proposta = "$n_orc.$ano_orc";

            $razao_reduzida = Formatar::limita_texto("$razao_contra", 30);
            $descricao_reduzida = Formatar::limita_texto("$descricao_orc", 30);
            $title = "ORC - $n_orc ( $razao_reduzida - $descricao_reduzida )";

            $endereco_completo = "$endereco_contr - $bairro_contr - $cep_contrat - $cidade_contr-$estado_contr";


            if ($cel_contr == "" && $email_contr == "") {
                $contato_completo = "$contato_contra - $tel_contr";
            } else if ($cel_contr == "" && $email_contr <> "") {
                $contato_completo = "$contato_contra - $tel_contr - $email_contr";
            } else if ($cel_contr <> "" && $email_contr == "") {
                $contato_completo = "$contato_contra - $tel_contr - $cel_contr";
            } else {

                $contato_completo = "$contato_contra - $tel_contr - $cel_contr - $email_contr";
            }

//dados Obra
            $razao_obra = $orcamento->getRazaoSocialObra();
            $endereco_obra = $orcamento->getEnderecoObra();
            $bairro_obra = $orcamento->getBairroObra();
            $cidade_obra = $orcamento->getCidadeObra();
            $estado_obra = $orcamento->getEstadoObra();
            $tel_obra = $orcamento->getTelObra();
            $cel_obra = $orcamento->getCelObra();
            $email_obra = $orcamento->getEmailObra();

            $endereco_completo_obra = "$endereco_obra - $bairro_obra - $cidade_obra-$estado_obra";

            if ($cel_obra == "" && $email_obra == "") {
                $contato_completo_obra = "  - $tel_obra";
            } else if ($cel_obra == "" && $email_obra <> "") {
                $contato_completo_obra = "  - $tel_obra - $email_obra";
            } else if ($cel_obra <> "" && $email_obra == "") {
                $contato_completo_obra = "  - $tel_obra - $cel_obra";
            } else {

                $contato_completo_obra = "  - $tel_obra - $cel_obra - $email_obra";
            }

//at5v5dade
            $atividade = $orcamento->getAtividade();
            $classificacao = $orcamento->getClassificacao();
            $quantidade = $orcamento->getQuantidade();
            $unidade = $orcamento->getUnidade();

            $atividade_completo = "$atividade - $classificacao";

//valor da proposta
            if (strpos($orcamento->getVrServico(), ',')) {     //VERIFICA SE TEM , NA NUMERAÇÃO
                $vr_servco_orc = $orcamento->getVrServico();
            } else {
                $vr_servco_orc = number_format($orcamento->getVrServico(), '2', ',', '.');
            }

            if (strpos($orcamento->getVrMaterial(), ',')) {     //VERIFICA SE TEM , NA NUMERAÇÃO
                $vr_material_orc = $orcamento->getVrMaterial();
            } else {
                $vr_material_orc = number_format($orcamento->getVrMaterial(), '2', ',', '.');
            }

            $desconto_orc = $orcamento->getDesconto();
            $vr_total_orc = number_format($orcamento->getVrTotal(), '2', ',', '.');

            if ($desconto_orc == "" || $desconto_orc == null) {


                $valor_completo_orc = "Valor do serviço: R$ $vr_servco_orc &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Valor do material: R$ $vr_material_orc &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Valor total: R$ $vr_total_orc";
            } else {
                $valor_completo_orc = "Valor do serviço: R$ $vr_servco_orc  &nbsp;   Valor do material: R$ $vr_material_orc   &nbsp;  Valor do desconto: R$ $desconto_orc  &nbsp;   Valor total: R$ $vr_total_orc";
            }


//condições
            $prazo_exec_orc = $orcamento->getPrazoExec();
            $validade_orc = $orcamento->getValidade();
            $pagamento_orc = $orcamento->getPagamento();

            $prazo_validade_completo_orc = "Prazo para execução: $prazo_exec_orc dias &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Validade da proposta: $validade_orc dias";
            $pagamento_completo_orc = "Condições de pagamento: $pagamento_orc";

//Observações
            $obs_orc = $orcamento->getObs();

//duvidas
            $duvida_orc = $orcamento->getDuvida();
            ?>    


            <script>

                document.title = "<?php echo $title; ?>";
            </script>   


            <table border="0"    CELLPADDING="5" style="border-collapse: collapse"   >
                <tr bordercolor=""  >
                    <td colspan="" >
                        <img src="../imagens/logo_elfi.jpg" id="" />
                        <p style="font-size: 10px;"><?= $empresaDao->getRazao_social() ?></p>
                    </td>
                    <td align="center" colspan="8">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px; color: #3E4B95;">


                            Montagens e Manutenções de: Subestações, Transformadores, Grupo Geradores, Disjuntores Banco de Capacitores Fixo e Automático, Quadros de Comando, Força e Luz, S.P.D.A., Tratamento de Óleo Isolante pelo processo Termo-Vácuo, Comissionamento de Subestação, Termografia.
                            Desde 1993 trazendo soluções para sua empresa.
                        </div>
                    </td>
                    <td align="center" >
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 16px;">
                            <div >                                Proposta                            </div>
                            <b><?php echo $n_da_proposta; ?></b>
                        </div>
     </td>
  </tr>
  <tr  style = "border-style: solid; border-width: 1px;" >
                    <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                            Dados da Contratante
                        </div>
                    </td>
                </tr>
                <tr >
                    <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;" >
                            Razão social:
                        </div>
                    </td>
                    <Td colspan="4" width="1000">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $razao_contra; ?>
                        </div>
                    </td>
                    <td width="50"> <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            CNPJ:
                        </div></td>
                    <Td colspan="4" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?= $orcamento->getCnpjContrat(); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            Endereço:
                        </div>
                    </td>
                    <Td colspan="9" width="800">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $endereco_completo; ?>
                        </div>
                    </td>
                </tr>               
                <tr>
                    <td width="100">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            Contato:
                        </div>
                    </td>
                    <Td colspan="9" width="800">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $contato_completo; ?>
                        </div>
                    </td>
           </tr> 
                <?php
                if ($email_obra == "" && $razao_obra == "") {
                    ?>

                    <tr  style = "border-style: solid; border-width: 1px;" >
                        <td align="center" colspan="10">
                            <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                                Dados da Obra igual aos da Contratante
                            </div>
                        </td>
                    </tr>
                    <?php
                } else {
                    ?>
                    <tr style = "border-style: solid; border-width: 1px;" >
                        <td align="center" colspan="10">
                            <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                                Dados da Obra
                            </div>
                        </td>
                    </tr>
                    <tr >
                        <td width="100">
                            <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;" >
                                Razão social:
                            </div>
                        </td>
                        <Td colspan="4" width="1000">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                <?=  $razao_obra; ?>
                            </div>
                        </td>
                        <td width="50"> <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                CNPJ:
                            </div></td>
                        <Td colspan="4" width="1000">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                <?php echo $orcamento->getCnpjObra(); ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="100">
                            <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                Endereço:
                            </div>
                        </td>
                        <Td colspan="9" width="800">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                <?php echo $endereco_completo_obra; ?>
                            </div>
                        </td>
                    </tr>               
                    <tr>
                        <td width="100">
                            <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                Contato:
                            </div>
                        </td>
                        <Td colspan="9" width="800">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                <?php echo $contato_completo_obra; ?>
                            </div>
                        </td>
                    </tr>                 
                    <?php
                }
                ?>
                <tr  style = "border-style: solid; border-width: 1px;" >
                    <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                           Atividade / Classificação
                        </div>
                    </td>
                </tr>              
                <tr>
                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $atividade_completo; ?>
                        </div>
                    </td>
                </tr>                   
                <tr style = "border-style: solid; border-width: 1px;" >
                    <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                            Descrição dos Serviços
                        </div>
                    </td>
                </tr> 
                <tr>
                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $descricao_orc; ?>
                        </div>
                    </td>
                </tr>                 
                <tr style = "border-style: solid; border-width: 1px;" >
                    <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                            Valor da Proposta
                        </div>
                    </td>
                </tr>                 
                <tr>
                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $valor_completo_orc; ?>
                        </div>
                    </td>
                </tr>                
                <tr  style = "border-style: solid; border-width: 1px;" >
                    <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                            Condições
                        </div>
                    </td>
                </tr>                 
                <tr>
                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $prazo_validade_completo_orc; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $pagamento_completo_orc; ?>
                        </div>
                    </td>
                </tr> 
                <?php
                if ($obs_orc == "") {
                    
                } else {
                    ?>
                    <tr  style = "border-style: solid; border-width: 1px;" >
                        <td align="center" colspan="10">
                            <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                               Observações
                            </div>
                        </td>
                    </tr>                 
                    <tr>
                        <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                                <?php echo $obs_orc; ?>
                            </div>
                        </td>
                    </tr>     
                    <?php
                }
                ?>
                <tr style = "border-style: solid; border-width: 1px;" >
                    <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                            Dúvidas / Negociações
                        </div>
                    </td>
                </tr>                 
                <tr>
                    <Td colspan="10" width="">  <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <?php echo $duvida_orc; ?>
                        </div>
                    </td>
                </tr>                  
                <tr bordercolor="" style = "border-style: solid; border-width: 1px;" >
                    <td align="center" colspan="10">
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 13px;">
                            Assinaturas
                        </div>
                    </td>
                </tr>
                <tr>
                    <Td colspan="4" width="" align="center">  
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <br>
                            <br>
                            <br>
                            ________________________________________<br>         
                            Elfi / carimbo
                            <br>
                            <br>
                            <br>
                        </div>
                    </td>
                    <Td colspan="6" width="" align="center">  
                        <div style="font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            <br>
                            <br>
                            <br>
                            ________________________________________<br>         
                            De acordo / carimbo
                            <br>
                            <br>
                            <br>
                        </div>
                    </td>                    
                </tr>                 
                <tr>
                    <td colspan="10" width="" align="center">
                        <div>
                            <?php
                            if ($orcamento->getDataUltimaAlteracao() == "0000-00-00 00:00:00") {

                                echo "Fortaleza, Ce em  " . Formatar::formatarDataComHora($orcamento->getDataDoOrc());
                            } else {
                                echo "Fortaleza, Ce em  " . Formatar::formatarDataComHora($orcamento->getDataUltimaAlteracao());
                            }
                            ?>
                        </div>
                        <br>
                    </td>
                </tr>
                <tr>
                    <Td colspan="10" width="" align="center">  <div style="color: #3E4B95; font-family: 'lucida grande',tahoma,verdana,arial,sans-serif; font-size: 12px;">
                            CNPJ <?= Formatar::formatTelCnpjCpf($empresaDao->getCnpj()) ?> - <?= $empresaDao->getEndereco() ?> – <?= $empresaDao->getBairro() ?>  – <?= $empresaDao->getCidade() ?> -<?= $empresaDao->getEstado() ?>  – Fone: <?= Formatar::formatTelCnpjCpf($empresaDao->getTel()) ?> – Fax: (85) 3227.6068
                            CEP: <?= Formatar::formatTelCnpjCpf($empresaDao->getCep()) ?> – <?= $empresaDao->getEmail_tec() ?> – www.elfiservice.com.br
                        </div>
                    </td>
                </tr>                 
            </table>   
        </div>
    </body>
</html>