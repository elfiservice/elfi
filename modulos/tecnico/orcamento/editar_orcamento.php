<!--  Busca cliente para Auto Preenchimento  -->
<?php require '../../includes/javascripts/busca_cliente_auto_preenchimento.php'; ?>

<!-- Troca Local da Obra no ORçamento  -->
<?php require '../../includes/javascripts/trocar_local_obra_orc.php'; ?>


<!--
MAscaras em campos
-->
<?php require '../../includes/javascripts/mascaras_campos_valores_monetario.php';  ?>


<!--
 SOMA campos
-->
<?php require '../../includes/javascripts/somar_valores_monetarios.php'; ?>

<?php
$orc = filter_input(INPUT_GET, 'id_orc', FILTER_VALIDATE_INT);
if ($orc) {  // TESTA SE o id_orc no link é VALIDO
    //BUSCAR Orçamento
    $OrcCtrl = new OrcamentoCtrl();
    $OrcBdCtrl = $OrcCtrl->buscarOrcamentos("*", "where id= $orc ");
    $OrcBd = $OrcBdCtrl[0];

    if (!$OrcBd) {
        WSErro("Orçamento não encontrado!", WS_ALERT);
        die();
    }
} else {
    WSErro("Erro na URL!", WS_ERROR);
    die();
}

$_SESSION['orcObjInicial'] = array($OrcBd); //envia objeto para pagina de Salvar a Edição do Orcamento

extract($OrcBd);

//echo $id;
//ALTERAR SITUAÇÃO ORC
if (filter_has_var(INPUT_GET, 'itens_situcao_orc')) {

    //$ident_orc = filter_input(INPUT_GET, 'id_orc',FILTER_VALIDATE_INT);
    $situacao_orc = $_POST['itens_situcao_orc'];
    $id_cliente = filter_input(INPUT_POST, 'id_cliente');
    $data_aprovada = "";
    if ($situacao_orc == "Aprovado" || $situacao_orc == "Contrato") {
        $data_aprovada = date('Y-m-d');
    } else {
        $data_aprovada = date('0000-00-00');
    }


    $data_ultima_alteracao = date('Y-m-d H:i:s');
    $nome_usuario = Formatar::prefixEmail($_SESSION['Login']);
    $id_user = $_SESSION['id'];
    $orcObj = new Orcamento($orc, $id_cliente, $id_user, "", "", $nome_usuario, $situacao_orc, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $data_ultima_alteracao, "", $data_aprovada, "", "", "", "", "", "", "", "", "", "", "", "", "");
    $orcCrtlObj = new OrcamentoCtrl();
    $resultAtualizOrcamento = $orcCrtlObj->atualizarOrcamento($orcObj);




    if ($resultAtualizOrcamento[0]) {

        $historicoNAproCtrl = new HistoricoOrcNaoAprovadoCtrl();
        $conversa = "Alterado situação do Orçamento para <b>{$situacao_orc}</b>";
        $histOrcNAproOb = new HistoricoOrcNaoAprovado("", $orc, $data_ultima_alteracao, $id_user, $nome_usuario, $contato_clint, $telefone_contr, $conversa);
        if (!$historicoNAproCtrl->inserirBD($histOrcNAproOb)) {

            WSErro("Não foi possível Atualizar no historico, favor informar ao Administrador do sistema.", WS_ALERT);
        }

        $dataHj = date('d/m/Y');
        $listaEmailClienteSituacaoOrc = array($orcObj->getEmailContrat(),$orcObj->getEmailObra());
        //$listaEmailClienteSituacaoOrc = array("junior@elfiservice.com.br");
        $assuntoEmail = "Alteração Situação do Orçamento";
        $textoCorpo = "<p>Olá, <b>{$OrcBd['razao_social_contr']}</b> a proposta de Nº <b>{$OrcBd['n_orc']}.{$OrcBd['ano_orc']}</b> foi alterada:</p> <p> A situação dela agora esta como: <b>\"{$situacao_orc}\"</b> em <b>{$dataHj }</b>. </p> ";
        $email = new EmailGenerico($listaEmailClienteSituacaoOrc, $assuntoEmail, $textoCorpo, array(), $listaEmails);

        if ($email->enviarEmailSMTP()) {
            WSErro("Orçamento <b>{$OrcBd['n_orc']}.{$OrcBd['ano_orc']}</b> foi Alterado para <b>\"{$situacao_orc}\"</b>! e Email enviado para o cliente <b>{$OrcBd['email_contr']}</b>!", WS_ACCEPT);
        } else {
            WSErro("Alterado! mas Email não foi Enviado.", WS_ALERT);
        }
    } else {
        PHPErro(WS_ERROR, "Não Alterado! e Email não foi Enviado.", __FILE__, __LINE__);
    }
}
?>

<div>
    <h2><?php include_once 'orcamento/includes/nav_wizard.php'; ?> -> Editar</h2>
</div>
<hr>	           


<div class="alinhamentoHorizontal" > 
    <ul >
        <li>
            <a href="#" class="bt_imprimir" onclick="window.open('orcamento/imprimir_orc.php?id_orc=<?php echo $orc; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10');">
                Imprimir
            </a>
        </li>
        <?php
        if (($situacao_orc == "Aguardando aprovação" || $_SESSION['id'] == $id_colab || $_SESSION['id'] == 1 ) && $situacao_orc != "concluido") {
            ?>        
            <li>
                <form name="alterar_situcao_orc" action="?ano_orc=<?php echo date('Y'); ?>&id_orc=<?php echo $id; ?>&id_menu=orcamento/editar_orcamento&itens_situcao_orc=" method="POST" enctype="multipart/form-data">
                    <select onchange="habilitaBtn()" name="itens_situcao_orc" id="itens_situcao_orc" class="formFieldsAno">
                        <option id="opcao" value=""><?php echo $situacao_orc; ?></option>
                        <?php include "includes/lista_situacao_orc.php"; ?>
                    </select>
                    <input type="submit" value="Alterar" name="alterar_situacao" id="salvar_situacao" disabled="disabled" />

                </form>
            </li>   
            <?php
        }
        ?>
    </ul>       
</div>
<hr>
<script type="text/javascript">
    var opInicial = document.getElementById("opcao").value;
    function habilitaBtn() {
        var opAposMudar = document.getElementById("itens_situcao_orc").value;


        if (opInicial !== opAposMudar)
        {
            if (document.getElementById('salvar_situacao').disabled) {
                document.getElementById('salvar_situacao').disabled = false;
            }
        }
        if (opInicial === opAposMudar) {
            if (!document.getElementById('salvar_situacao').disabled) {
                document.getElementById('salvar_situacao').disabled = true;
            }
        }
    }
</script>


<!-- Campos obrigatorios -->  




<?php
if ($situacao_orc != "Aprovado" && $situacao_orc != "Cancelado" && $situacao_orc != "Perdido" && $situacao_orc != "concluido") {
    ?>
    <script language="JavaScript">


        /***********************************************
         * Required field(s) validation v1.10- By NavSurf
         * Visit Nav Surf at http://navsurf.com
         * Visit http://www.dynamicdrive.com/ for full source code
         ***********************************************/

        function formCheck(formobj) {
            // Enter name of mandatory fields
            var fieldRequired = Array("razao_social", "endereco", "city", "tel", "razao_social2", "endereco2", "city2", "tel2", "descricao_servicos", "execucao_orc", "validade_orc", "pagamento_orc", "duvida_orc", "sum_vr_servico_orc", "atividade1", "classificacao1", "unidade1", "quantidade1", "contato_clint");
            // Enter field description to appear in the dialog box
            var fieldDescription = Array("Razão Social  do Contratante", "Endereço do Contratante", "Cidade do Contratante", "Telefone ou Celular do contratante", "Razão Social  da obra", "Endereço da obra", "Cidade da obra", "Telefone ou Celular da obra", "Descrição dos serviços", "Prazo de execução", "Validade do orçamento", "Condições de pagamento", "Dúvidas", "Valor do serviço", "Atividade do serviço", "Classificação", "Unidade", "quantidade", "Nome de contato do cliente");
            // dialog message
            var alertMsg = "Por favor completar os campos:\n";

            var l_Msg = alertMsg.length;

            for (var i = 0; i < fieldRequired.length; i++) {
                var obj = formobj.elements[fieldRequired[i]];
                if (obj) {
                    switch (obj.type) {
                        case "select-one":
                            if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == "") {
                                alertMsg += " - " + fieldDescription[i] + "\n";
                            }
                            break;
                        case "select-multiple":
                            if (obj.selectedIndex == -1) {
                                alertMsg += " - " + fieldDescription[i] + "\n";
                            }
                            break;
                        case "text":
                        case "textarea":
                            if (obj.value == "" || obj.value == null || obj.value == "0,00") {
                                alertMsg += " - " + fieldDescription[i] + "\n";
                            }
                            break;
                        default:
                    }
                    if (obj.type == undefined) {
                        var blnchecked = false;
                        for (var j = 0; j < obj.length; j++) {
                            if (obj[j].checked) {
                                blnchecked = true;
                            }
                        }
                        if (!blnchecked) {
                            alertMsg += " - " + fieldDescription[i] + "\n";
                        }
                    }
                }
            }

            if (alertMsg.length == l_Msg) {
                return true;
            } else {
                alert(alertMsg);
                return false;
            }
        }

    </script>
    <div  class="" style="margin-top: 20px;">

        <form name="clientForm" method="post" action="?id_menu=orcamento/alterar/salvar_editar_orc" onsubmit="return formCheck(this);">       

            <fieldset class="fieldsetGeral">
                <legend ><b>Contratante</b></legend>
                <table border="0">
                    <tbody>

                        <tr align="left">
                            <td><label for="clientID">Cliente:</label></br>
                                <select id="clientID" name="clientID">
                                    <option value="<?php echo $id_cliente; ?>"><?php echo $razao_social_contr; ?></option>
                                    <?php
                                    $clienteCtrl = new ClienteCtrl();
                                    $clienteBd = $clienteCtrl->buscarBD("*", "WHERE mostrar = '1' ORDER BY razao_social");
                                    foreach ($clienteBd as $cliente => $row) {
                                        echo '<option id="clientID" value="' . $row->getId() . '">' . $row->getRazaoSocial() . '</option>';
                                    }
                                    ?>

                                </select>

                            </td>
                        </tr>
                        <tr align="left">

                            <td><label for="razao_social">Razão Social:</label></br>
                                <input name="razao_social" id="razao_social" size="60" maxlength="255" readonly>
                            </td>

                            <td><label for="cnpj">CNPJ:</label></br>
                                <input name="cnpj" id="cnpj" alt="" size="20" maxlength="255" readonly>
                            </td>
                        </tr>
                        <tr align="left">
                            <td><label for="endereco">Endereço:</label></br>
                                <input name="endereco" id="endereco" size="60" maxlength="255" readonly></td>
                        </tr>
                        <tr align="left">
                            <td><label for="bairro">Bairro:</label></br>
                                <input name="bairro" id="bairro" size="20" maxlength="255" readonly>

                            </td>

                            <td><label for="city">Cidade:</label></br>
                                <input name="city" id="city" size="20" maxlength="255" readonly>

                            </td>
                            <td><label for="estado">Estado:</label></br>
                                <input name="estado" id="estado" size="20" maxlength="255" readonly>

                            </td>

                        </tr>
                        <tr align="left">

                            <td><label for="cep">CEP:</label></br>
                                <input name="cep" id="cep" size="20" maxlength="15" readonly>

                            </td>
                            <td><label for="tel">Telefone:</label></br>
                                <input name="tel" id="tel" size="20" maxlength="15" readonly>

                            </td>
                            <td><label for="cel">Celular:</label></br>
                                <input name="cel" id="cel" size="20" maxlength="15" readonly>

                            </td>                                   


                        </tr>
                        <tr align="left">

                            <td><label for="email_orc">Email:</label></br>
                                <input name="email_orc" id="email_orc" size="20" maxlength="255" readonly>

                            </td>



                        </tr>                                
                    </tbody>
                </table>
            </fieldset>

            <fieldset class="fieldsetGeral">
                <legend><h3>Contato</h3></legend>


                <input id="contato_clint" name="contato_clint" size="80" maxlength="100" value="<?php echo $contato_clint; ?>" />


            </fieldset>                     



            <fieldset class="fieldsetGeral">
                <legend><h3>Local da obra</h3></legend>

                <div id="form_local_obra">
                    <input onClick="return retira_form_obra()" name="submit" type="submit" value="Os dados da contratante é o mesmo da Obra."  />

                    <table border="0">
                        <tbody>


                            <tr align="left">
                                <td><label for="razao_social2">Razão Social:</label></br>
                                    <input name="razao_social2" id="razao_social2" size="60" maxlength="255" value="<?php echo $razao_social_obra; ?>" >
                                </td>

                                <td><label for="cnpj2">CNPJ:</label></br>
                                    <input name="cnpj2" id="cnpj2" size="20" alt="cnpj" maxlength="22" value="<?php echo $cnpj_obra; ?>">
                                </td>
                            </tr>
                            <tr align="left">
                                <td><label for="endereco2">Endereço:</label></br>
                                    <input name="endereco2" id="endereco2" size="60" maxlength="255" value="<?php echo $endereco_obra; ?>"></td>
                            </tr>
                            <tr align="left">
                                <td><label for="bairro2">Bairro:</label></br>
                                    <input name="bairro2" id="bairro2" size="20" maxlength="255" value="<?php echo $bairro_obra; ?>">

                                </td>

                                <td><label for="city2">Cidade:</label></br>
                                    <input name="city2" id="city2" size="20" maxlength="255" value="<?php echo $cidade_obra; ?>">

                                </td>
                                <td><label for="estado2">Estado:</label></br>
                                    <input name="estado2" id="estado2" size="20" maxlength="255" value="<?php echo $estado_obra; ?>">

                                </td>

                            </tr>
                            <tr align="left">

                                <td><label for="cep2">CEP:</label></br>
                                    <input name="cep2" id="cep2" alt="cep"  size="20" maxlength="12" value="<?php echo $cep_obra; ?>">

                                </td>
                                <td><label for="tel2">Telefone:</label></br>
                                    <input name="tel2" id="tel2" size="20" alt="phone" maxlength="15" value="<?php echo $telefone_obra; ?>">

                                </td>
                                <td><label for="cel2">Celular:</label></br>
                                    <input name="cel2" id="cel2" size="20" alt="cel" maxlength="15" value="<?php echo $celular_obra; ?>">

                                </td>                                   


                            </tr>
                            <tr align="left">

                                <td><label for="email_orc2">Email:</label></br>
                                    <input name="email_orc2" id="email_orc2" size="20" maxlength="255" value="<?php echo $email_obra; ?>">

                                </td>



                            </tr>                                
                        </tbody>
                    </table>

                </div>
            </fieldset>                    

            <fieldset class="fieldsetGeral">
                <legend><h3>Classificação da Atividade</h3></legend>

                <table border="0">
                    <tbody>



                        <tr align="left">
                            <td><label for="atividade">Atividade</label>




                            </td>

                            <td><label for="classificacao">Classificação:</label>

                            </td>

                            <td><label for="quantidade">Quantidade:</label>

                            </td>
                            <td><label for="unidade">Unidade:</label>
                            </td>

                        </tr>
                        <tr align="left">

                            <td>
                                <select name="atividade1">
                                    <option name="" value="<?php echo $atividade; ?>" ><?php echo $atividade; ?> </option>
                                    <?php
                                    $listaAtivBd = $OrcCtrl->listaAtividades();
                                    foreach ($listaAtivBd as $lista => $row) {
                                        echo '<option id="" value="' . utf8_encode($row['atividade']) . '" >' . utf8_encode($row['atividade']) . '</option>';
                                    }
                                    ?>

                                </select>

                            </td>
                            <?php //echo  var_dump($clienteBd);  ?>
                            <td>
                                <select  name="classificacao1">
                                    <option value="<?php echo $classificacao; ?>" ><?php echo $classificacao; ?></option>
                                    <?php
                                    $listaClassfBd = $OrcCtrl->listarClassificacao();
                                    foreach ($listaClassfBd as $lista => $row) {
                                        echo '<option id="" value="' . utf8_encode($row['classificacao']) . '" >' . utf8_encode($row['classificacao']) . '</option>';
                                    }
                                    ?>

                                </select>

                            </td>
                            <td>
                                <input name="quantidade1"  size="10" maxlength="10" value="<?php echo $quantidade; ?>">

                            </td>  
                            <td>
                                <select name="unidade1">
                                    <option value="<?php echo $unidade; ?>" ><?php echo $unidade; ?></option>
                                    <?php
                                    $listaUnidBd = $OrcCtrl->listarUnidades();
                                    foreach ($listaUnidBd as $lista => $row) {
                                        echo '<option id="" value="' . utf8_encode($row['unidade']) . '" >' . utf8_encode($row['unidade']) . '</option>';
                                    }
                                    ?>

                                </select>

                            </td>                                    


                        </tr>

                    </tbody>
                </table>

            </fieldset>


            <fieldset class="fieldsetGeral">
                <legend><b>Descrição dos Serviços</b></legend>


                <textarea onfocus="" style="height: 10em; width: 100%;"  id="text" name="descricao_servicos"><?php echo strip_tags($descricao_servico_orc); ?></textarea>


            </fieldset>

            <fieldset class="fieldsetGeral">
                <legend><b>Condições</b></legend>

                <table border="0">

                    <tr align="left">
                        <td><label for="execucao_orc" > Prazo execução</label>

                        </td>

                        <td><label for="validade_orc">Validade</label>

                        </td>

                        <td><label for="pagamento_orc">Pagamento</label>

                        </td>

                    </tr>
                    <tr align="left">
                        <td>
                            <input name="execucao_orc" id="execucao_orc" size="5" maxlength="3" value="<?php echo $prazo_exec_orc; ?>"> dias
                        </td>

                        <td>
                            <input name="validade_orc" id="validade_orc" size="5" maxlength="3" value="<?php echo $validade_orc; ?>"> dias
                        </td>

                        <td>
                            <input name="pagamento_orc" id="pagamento_orc" size="80" maxlength="80" value="<?php echo $pagamento_orc; ?>">
                        </td>

                    </tr>
                </table>

            </fieldset>


            <fieldset class="fieldsetGeral">
                <legend><b>Observações</b></legend>


                <textarea onfocus="" style="height: 5em; width: 100%;" id="text2" name="observacoes_servico"><?php echo strip_tags($obs_orc); ?></textarea>


            </fieldset>                    

            <fieldset class="fieldsetGeral">
                <legend><b>Em caso dúvida / Negociações</b></legend>

                <input name="duvida_orc" id="duvida_orc" size="50" maxlength="50" value="<?php echo $duvida_orc; ?>">

            </fieldset>                    

            <fieldset class="fieldsetGeral">
                <legend><h3>Valor</h3></legend>

                <table border="0">

                    <tr align="left">
                        <td><label for="vr_servico_orc"> Valor do serviço</label>

                        </td>

                        <td><label for="vr_material_orc">Valor do material</label>

                        </td>



                        <td><label for="total_orc">Total da proposta</label>

                        </td>                                    

                    </tr>
                    <tr align="left">
                        <td>
                            <input  name="sum_vr_servico_orc" id="vr_servico_orc" alt="decimal" size="15" maxlength="15" value="<?php echo Formatar::moedaBR($vr_servco_orc); ?>"> 
                        </td>

                        <td>
                            <input name="sum_vr_material_orc" id="vr_material_orc" alt="decimal" size="15" maxlength="15" value="<?php echo Formatar::moedaBR($vr_material_orc); ?>"> 
                        </td>

                        <td>
                            R$

                            <input type="text" name="totalSum" id="totalSum" value="" size="15" readonly="readonly" />
                        </td>


                    </tr>
                </table>

            </fieldset>                     

            <table border="0">

                <tr align="left">
                    <td>


                        <input type="submit" value="Salvar" name="salvar_orc" />
                        <script type="text/javascript">
                            //a carregar o código  
                            function fecha() {
                                //opener.location.href=opener.location.href;   
                                // fechando a janela atual ( popup )  
                                //window.close();  
                                history.back();
                            }
                        </script>  
                        <input type="button" value="Cancelar"  onclick="fecha()" name="" />


                        <input type="hidden" value="<?php echo $orc; ?>" name="id_orc_editado" hidden="hidden" />
                        <input  type="hidden"  id="id_cliente" name="id_cliente" value="<?php echo $row['id']; ?>"   />

                    </td>



                </tr>

            </table>
        </form>

    </div>	  


    <?php
} else {

    echo "<div style=\"margin-top: 100px;\">";
    WSErro("Esse orçamento foi <b>{$situacao_orc}</b> pelo colaborador <b>{$colaborador_orc}</b>, não pode ser Editado.", WS_ALERT);
    echo "</div>";
}


	


