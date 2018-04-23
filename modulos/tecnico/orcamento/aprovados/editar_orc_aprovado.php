<div>
    <h2><?php include_once 'orcamento/includes/nav_wizard.php'; ?> -><a href="?id_menu=orcamento/aprovados/acompanhar_orcamentos">Aprovados</a> -> Atualizar</h2>
</div>
<hr>
<!--
MAscaras em campos
-->
<?php require '../../includes/javascripts/mascaras_campos_valores_monetario.php';  ?>

<?php
$id_orc = filter_input(INPUT_GET, 'id_orc', FILTER_VALIDATE_INT);

if ($id_orc) {
    $orcamentoCtrl = new OrcamentoCtrl();
    $orcObj = $orcamentoCtrl->buscarOrcamentoPorId("*", "WHERE id = $id_orc");

    if ($orcObj) {
        // var_dump($orcObj);
    } else {
        WSErro("Orçamento não encontrado!", WS_ALERT);
        die();
    }
} else {
    WSErro("Erro na URL!", WS_ALERT);
    die();
}


//-----------------SALVA NO BD SE POSTADO ------------------------------//
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if ($form && $form['salvar_orc']) {
    $data_inicio = filter_input(INPUT_POST, 'data_inicio');
    $data_conclusao = filter_input(INPUT_POST, 'data_conclusao');
    $nao_conformidade = filter_input(INPUT_POST, 'nao_conformidade');
    $client_insatisfeito = filter_input(INPUT_POST, 'client_insatisfeito');
    $obs_n_conformidad = filter_input(INPUT_POST, 'obs_n_conformidad');
    $id_orc = filter_input(INPUT_POST, 'id_orc');
    $id_cliente = filter_input(INPUT_POST, 'id_cliente');
    $colaborador_ultim_alteracao = filter_input(INPUT_POST, 'id_colab'); //colaborador_ultim_alteracao na TAbela 
    $data_ultima_alteracao = date('Y-m-d H:i:s');
    $situacao_orc = "";
    $serv_concluido = 'n';
    

    // var_dump($data_inicio < $data_conclusao);

    if ($data_inicio == "00/00/0000" || $data_inicio == "") {
        $data_inicio = "0000-00-00";
    } else {
        $data = DateTime::createFromFormat('d/m/Y', $data_inicio);
        $data_inicio = $data->format('Y-m-d');
    }


    if ($data_conclusao == "00/00/0000" || $data_conclusao == "") {
        $data_conclusao = "0000-00-00";
        $dias_d_exec = "0";
        $dias_ultrapassad = "0";
    } else {
        $data = DateTime::createFromFormat('d/m/Y', $data_conclusao);
        $data_conclusao = $data->format('Y-m-d');
        $situacao_orc = "concluido";
        $serv_concluido = 's';
        $dias_d_exec = Formatar::diffDuasDatas($data_inicio, $data_conclusao);
        $praz_exec = $orcObj->getPrazoExec();
        if (($dias_d_exec - $praz_exec) > 0) {
            $dias_ultrapassad = $dias_d_exec - $praz_exec;
        }else{
            $dias_ultrapassad = "0";
        }
    }

    // echo $data_inicio."<br>";
    // echo $data_conclusao."<br>";
    //var_dump($data_inicio < $data_conclusao);

    if (($data_inicio < $data_conclusao) || ($data_inicio == "0000-00-00" && $data_conclusao == "0000-00-00") || ($data_inicio != "0000-00-00" && $data_conclusao == "0000-00-00")) {
        //salva
        if ($data_inicio == "0000-00-00" && $data_conclusao != "0000-00-00") {
            WSErro("Data inicial sem valor e a Data de Conclusão com Valor! Favor corrigir.", WS_ALERT);
            echo"<a href=\"javascript:window.history.go(-1)\" class=\"bt_imprimir\" > Voltar</a>";
            die();
        }
        $orcamento = new Orcamento($id_orc, "", "", $orcObj->getNOrc(), $orcObj->getAnoOrc(), "", $situacao_orc, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $data_ultima_alteracao, $colaborador_ultim_alteracao, "", $data_inicio, $data_conclusao, "", $dias_d_exec, $dias_ultrapassad, $serv_concluido, "", $nao_conformidade, $obs_n_conformidad, $client_insatisfeito, "", "", "");
        //var_dump($orcamento);
        if ($orcamentoCtrl->atualizarOrcamento($orcamento)) {
            WSErro("Orçamento atualizado com Sucesso!", WS_ACCEPT);
//enviar Email Qaundo APENAS DATA INICIO DO SERVIÇO----------------------------------------------------

            if ($data_inicio != "0000-00-00" && $data_conclusao == "0000-00-00") {
                $dataInicioBr = Formatar::formatarDataSemHora($data_inicio);
                $listaEmailCliente = array($orcObj->getEmailContrat(),$orcObj->getEmailObra());
                //$listaEmailCliente = array("junior@elfiservice.com.br");
                $textoCorpoDataInicio = "Olá, <b>{$orcObj->getRazaoSocialContrat()}</b> a proposta de Nº <b>{$orcObj->getNOrc()}.{$orcObj->getAnoOrc()}</b> foi alterada:<br> <p> Data de inicio agendada para: <b>{$dataInicioBr}</b> </p><br>Em breve entraremos em contato para acertar os detalhes. ";
                $email = new EmailGenerico($listaEmailCliente, "Proposta com Data programada", $textoCorpoDataInicio, array(), $listaEmails);
                if ($email->enviarEmailSMTP()) {
                    WSErro("Enviado email informando Alteração para <b>{$orcObj->getEmailContrat()}</b>, informando a Data de Inicio!", WS_ALERT);
                } else {
                    WSErro("Houve um erro ao tentar Enviar email informando Alteração para <b>{$orcObj->getEmailContrat()}</b>, informando a Data de Inicio!", WS_ERROR);
                }
                exit();
            } else if ($data_inicio != "0000-00-00" && $data_conclusao != "0000-00-00") {
                //enviar Email Qaundo DATA INICIO E CONCLUSÃO DO SERVIÇO----------------------------------------------------
                $dataInicioBr = Formatar::formatarDataSemHora($data_inicio);
                $dataConcluidoBr = Formatar::formatarDataSemHora($data_conclusao);
                //WWW/orcamento/aprovados/pesquisa_pos_venda.php?ido=2&idc=23
                $listaEmailClienteConcluido = array($orcObj->getEmailContrat(),$orcObj->getEmailObra());
                //$listaEmailClienteConcluido = array("junior@elfiservice.com.br");
                $textoCorpo = "Olá, <b>{$orcObj->getRazaoSocialContrat()}</b> a proposta de Nº <b>{$orcObj->getNOrc()}.{$orcObj->getAnoOrc()}</b> foi alterada:<br>"
                        . "<p> Ela foi marcada como <b>\"Concluída\"</b>, tendo seu inicio em <b>{$dataInicioBr}</b> e seu término em <b>{$dataConcluidoBr}</b> </p><br>"
                        . "Por favor, nos dê seu parecer sobre nosso atendimento, será de grande ajuda para o desenvolvimento de nossa parceria.<br><br>"
                        . "Apenas acesse o Link abaixo ou copie e cole no navegar:<br>"
                        . "<a href=\"{$www}/modulos/tecnico/orcamento/aprovados/pesquisa_pos_venda.php?ido={$id_orc}&idc={$id_cliente}\" >"
                        . "{$www}/modulos/tecnico/orcamento/aprovados/pesquisa_pos_venda.php?ido={$id_orc}&idc={$id_cliente} </a> <br>";
                $email = new EmailGenerico($listaEmailClienteConcluido, "Proposta Concluida!", $textoCorpo, array(), array("junior@elfiservice.com.br"));
                if ($email->enviarEmailSMTP()) {
                    WSErro("Enviado email informando Alteração para {$orcObj->getEmailContrat()}, informando Data da Conclusão!", WS_ALERT);
                } else {
                    WSErro("Houve um Erro ao tentar Enviar um email informando Alteração para {$orcObj->getEmailContrat()}, informando Data da Conclusão!", WS_ERROR);
                }
            }
        } else {
            WSErro("Ocorreu um Erro ao tentar Atualizar o cliente, favor repetir a operação. :(", WS_ERROR);
            die();
        }
    } else {
        WSErro("Data inicial maior que a Data de Conclusão! Favor corrigir.", WS_ALERT);
        echo"<a href=\"javascript:window.history.go(-1)\" class=\"bt_imprimir\" > Voltar</a>";
    }



    exit;
}
?>	



<script>
    function formCheck(formobj) {
        // Enter name of mandatory fields
        var fieldRequired = Array("clientID", "n_orc", "email_orc", "descricao_servicos", "atividade1", "classificacao1", "novo_cliente", "data", "prz_execucao");
        // Enter field description to appear in the dialog box
        var fieldDescription = Array("Cliente", "Nº do orçamento", "Email", "Descrição dos serviços", "Atividade do serviço", "Classificação", "se o cliente é novo", "Data da aprovação", "Prazo de execução");
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

<!-- VERIFICA SE DATA É VALIDA-->
<script language="JavaScript">
    //VALIDAÇÃO DA DATA 
    function VerificaData(digData, idData) {
        var bissexto = 0;
        var data = digData;
        var tam = data.length;

        var dia = data.substr(0, 2);
        var mes = data.substr(3, 2);
        var ano = data.substr(6, 4);
        if (tam === 10) {

            if ((ano > 1900) && (ano < 2100)) {
                switch (mes) {
                    case '01':
                    case '03':
                    case '05':
                    case '07':
                    case '08':
                    case '10':
                    case '12':
                        if (dia <= 31) {
                            //alert("A Data " + data + " OK!");
                            return true;
                        }
                        break;
                    case '04':
                    case '06':
                    case '09':
                    case '11':
                        if (dia <= 30) {

                            //alert("A Data " + data + " OK!");
                            return true;
                        }
                        break;
                    case '02':
                        /* Validando ano Bissexto / fevereiro / dia */
                        if ((ano % 4 === 0) || (ano % 100 === 0) || (ano % 400 === 0)) {
                            bissexto = 1;
                        }
                        if ((bissexto === 1) && (dia <= 29)) {
                            //alert("A Data " + data + " OK!");
                            return true;
                        }
                        if ((bissexto !== 1) && (dia <= 28)) {
                            //alert("A Data " + data + " OK!"); 
                            return true;
                        }
                        break;
                }
            }
        }


        if (ano === '0000' && mes === '00' && dia === '00') {

            return true;
        } else {
            alert("A Data " + data + " e invalida!");
            let inputData = document.getElementById(idData);
            inputData.value = "00/00/0000";
            inputData.focus();
        }
    }</script>


<div class="" style="">

    <form name="clientForm" method="post" action="?id_menu=orcamento/aprovados/editar_orc_aprovado&id_orc=<?= $orcObj->getId() ?>" onsubmit="return formCheck(this);">       

        <fieldset>
            <legend><b>Dados</b></legend>
            <table>
                <tbody>
                    <tr align="left">
                        <td><label for="clientID">Cliente: </label><br>
                            <?= $orcObj->getRazaoSocialContrat(); ?>                                            
                        </td>
                    </tr>
                    <tr align="left">
                        <td><label for="n_orc">Nº Orçamento:</label><br>
                            <?= $orcObj->getNOrc() . "." . $orcObj->getAnoOrc(); ?>
                        </td>
                    </tr> 
                    <tr align="left">
                        <td><label for="data_aprovada">Data Aprovado:</label><br>
                            <?= Formatar::formatarDataSemHora($orcObj->getDataAprovada()); ?>
                        </td>
                    </tr> 
                    <tr align="left">
                        <td><label for="clientID">Prazo Execução: </label><br>
                            <?= $orcObj->getPrazoExec() . " dia(s)."; ?>                                            
                        </td>

                        <td><label for="data_inicio">Data Inicio:</label><br>
                            <input type="text" alt="date" value="<?= ($orcObj->getDataInicio() == "0000-00-00" ? "00000000" : date('d/m/Y', strtotime($orcObj->getDataInicio())) ); ?>"  name="data_inicio" id="data_inicio" maxlength="10" onblur=" return VerificaData(this.value, this.id);" >
                        </td>

                        <td><label for="data_aprovada">Data Conclusao:</label><br>
                            <input type="text" alt="date"  value="<?= ($orcObj->getDataConclusao() == "0000-00-00" ? "00000000" : date('d/m/Y', strtotime($orcObj->getDataConclusao())) ); ?>" name="data_conclusao" id="data_conclusao" maxlength="10" onblur=" return VerificaData(this.value, this.id);" >
                        </td>

                        <td><label for="nao_conformidade">Não conformidades? :</label><br>
                            <?php
                            if ($orcObj->getNaoConformidade() == 's') {
                                ?>
                                <input type="radio" name="nao_conformidade" value="s" checked> Sim 
                                <input type="radio" name="nao_conformidade" value="n"> Não
                                <?php
                            } else {
                                ?>								 	
                                <input type="radio" name="nao_conformidade" value="s" > Sim 
                                <input type="radio" name="nao_conformidade" value="n" checked> Não
                                <?php
                            }
                            ?>

                        </td>
                        <td><label for="nao_conformidade">Cliente insatisfeito? :</label><br>
                            <?php
                            if ($orcObj->getClienteInsatisfeito() == 's') {
                                ?>
                                <input type="radio" name="client_insatisfeito" value="s" checked> Sim 
                                <input type="radio" name="client_insatisfeito" value="n"> Não
                                <?php
                            } else {
                                ?>								 	
                                <input type="radio" name="client_insatisfeito" value="s" > Sim 
                                <input type="radio" name="client_insatisfeito" value="n" checked> Não
                                <?php
                            }
                            ?>

                        </td>
                    </tr>

                </tbody>
            </table>
        </fieldset>

        <fieldset>
            <div  class="padding_padrao">
                <label >OBS da não conformidade:</label>
                <textarea   style="height: 50%; width: 100%;" id="text" name="obs_n_conformidad"><?= $orcObj->getObsNConformidade(); ?></textarea>
            </div>

        </fieldset>

        <div class="padding_padrao">
            <input type="submit" value="Atualizar Orçamento" name="salvar_orc" />

            <input type="hidden" value="<?php echo date('Y'); ?>" name="ano_atual_orc" hidden="hidden" />
            <input type="hidden" name="id_colab" value="<?php echo $_SESSION['id']; ?>" hidden="hidden"/>
            <input type="hidden" name="id_orc" value="<?php echo $orcObj->getId(); ?>" hidden="hidden" />
            <input type="hidden" name="id_cliente" value="<?php echo $orcObj->getId_cliente(); ?>" hidden="hidden" />
        </div>
    </form>

</div>