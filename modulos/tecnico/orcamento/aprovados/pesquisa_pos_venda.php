<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Técnico | Pesquisa</title>

        <meta name="description" content="">
        <meta name="author" content="Elfiservice">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../../estilos.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <style>
            .linhaPontuacao{
                margin-left: 210px;
            }

            .conteinerListaItens{
                float: left; 
                width: 210px; 
                border: 0px solid black;
                margin-right: 30px;
            }
            li{
                margin-top: 2px;
            }
            .itensRadio {
                margin-top: 2px;
                padding-left: 0px;
            }

            .radioItem{
                margin-right: 60px;

            }

            .container-fluid{
                padding-bottom: 10px;   
            }

            input[type=radio]{


            }
        </style>


    </head>
    <body>
        <?php
        //session_start();
        require '../../classes/Config.inc.php';
        $id_orc = filter_input(INPUT_GET, 'ido', FILTER_VALIDATE_INT);
        $id_cliente = filter_input(INPUT_GET, 'idc', FILTER_VALIDATE_INT);


        if ($id_orc && $id_cliente) {
            $orcamentoCtrl = new OrcamentoCtrl();
            $orcObj = $orcamentoCtrl->buscarOrcamentoPorId("*", "WHERE id = $id_orc AND id_cliente = $id_cliente AND feito_pos_entreg = 'n'");
           // var_dump($orcObj);
            if ($orcObj) {
                
            } else {
                WSErro("Orçamento não encontrado ou você já nos preencheu e enviou!", WS_ALERT);
                die();
            }
//            $id_orc = $_SESSION['ido'];
//            $id_cliente = $_SESSION['idc'];
//            echo "URL".$id_orc ." e ". $id_cliente ."<br>";
//            echo "URL".$_SESSION['ido']." e ". $_SESSION['idc'];
//                        $id_orc = $_SESSION['ido'];
//            $id_cliente = $_SESSION['idc'];
        } else {
            WSErro("Erro na URL!", WS_ERROR);
            die();
        }

        if (filter_has_var(INPUT_POST, '1confiabilidade')) {
            // echo "ARUI!";
            $confiabilidade = filter_input(INPUT_POST, '1confiabilidade');
            $pontualidade = filter_input(INPUT_POST, '1pontualidade');
            $disponibilide = filter_input(INPUT_POST, '1disponibilide');
            $qualidade = filter_input(INPUT_POST, '1qualidade');
            $normasseguranca = filter_input(INPUT_POST, '1normasseguranca');

            $apresentacao = filter_input(INPUT_POST, '2apresentacao');
            $envolvimento = filter_input(INPUT_POST, '2envolvimento');
            $educacao = filter_input(INPUT_POST, '2educacao');

            $organizacao = filter_input(INPUT_POST, '3organizacao');
            $competencia = filter_input(INPUT_POST, '3competencia');

            $orcamento = filter_input(INPUT_POST, '4orcamento');
            $servico = filter_input(INPUT_POST, '4servico');

            $satisfeito = filter_input(INPUT_POST, '5satisfeito');

            $outrosComentarios = filter_input(INPUT_POST, '6outrosComentarios');

            $data = date('Y-m-d H:i:s');
            
            $pesquisaObj = new PesquisaPosVenda("", $id_orc, $id_cliente, $confiabilidade, $pontualidade, $disponibilide, $qualidade, $normasseguranca, $apresentacao, $envolvimento, $educacao, $organizacao, $competencia, $orcamento, $servico, $satisfeito, $outrosComentarios, $data);
            $pesquisaCtrl = new PesquisaPosVendaCtrl();

            if ($pesquisaCtrl->inserirPesquisa($pesquisaObj)) {
                $mensagem = WSErro("Salvo com sucesso, Obrigado, sua avaliação é muito importante para nós. Estamos sempre trabalhando para melhor atendê-lo!", WS_ACCEPT);
                
                LogCtrl::inserirLog(0, "O Cliente <b>{$orcObj->getRazaoSocialContrat()}</b>, proposta <a target=\"_blank\" href=\"?id_menu=orcamento/historico_completo_orc&id_orc={$id_orc}\" ><b>N. {$orcObj->getNOrc()}</b></a> respondeu a Pesquisa <b>Pós-venda</b>", "tec");
                
                $orcamentoObj = new Orcamento($id_orc, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "s", "", "", "", "", "", "");
                $orcamentoCtrl->atualizarOrcamento($orcamentoObj);
                //enviar Email confirmando o Envio da Pesquisa e agradecendo o Cliente.
               // $listaEmailTo = array($orcObj->getEmailContrat(), $orcObj->getEmailObra());
                $listaEmailTo = array("elfiservice@hotmail.com");
                               
                 $email = new EmailGenerico($listaEmailTo, "Recebemos sua pesquisa", "Olá, <b>{$orcObj->getRazaoSocialContrat()}</b> a proposta de Nº <b>{$orcObj->getNOrc()}.{$orcObj->getAnoOrc()}</b> recebemos a sua pesquisa. ", array(), array());
                         if($email->enviarEmailSMTP()){
                             //WSErro("Enviado email informando Alteração para {$orcObj->getEmailContrat()}, informando a Data de Inicio!", WS_ALERT);
                         } else{
                             //WSErro("Houve um erro ao tentar Enviar email informando Alteração para {$orcObj->getEmailContrat()}, informando a Data de Inicio!", WS_ERROR);
                         }    
            } else {
                $mensagem = WSErro("Houve algum problema ao tentar salvar, por favor tente novamente! Grato.", WS_ALERT);
            }
            exit();
        }
        ?>
        
        <!-- Teste Campos obrigatorios -->
        <script language="JavaScript">


            /***********************************************
             * Required field(s) validation v1.10- By NavSurf
             * Visit Nav Surf at http://navsurf.com
             * Visit http://www.dynamicdrive.com/ for full source code
             ***********************************************/

            function formCheck(formobj) {
                // Enter name of mandatory fields
                var fieldRequired = Array("1confiabilidade", "1pontualidade", "1disponibilide", "1qualidade", "1normasseguranca", "2apresentacao", "2envolvimento", "2educacao", "3organizacao", "3competencia", "4orcamento", "4servico", "5satisfeito");
                // Enter field description to appear in the dialog box
                var fieldDescription = Array("Confiabilidade", "Pontualidade", "Disponibilidade", "Qualidade", "Atend. Normas de Segurança", "Apresentação", "Envolvimento", "Educação", "Organização", "Competencia", "Orçamento", "Serviço", "Se esta Satisfeito em geral?");
                // dialog message
                var alertMsg = "Por favor completar todos campos quem tem ( * ):\n";

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
        <!-- Fim Teste Campos obrigatorios -->
        <header>

            <fieldset class="container-fluid">
                <legend><span class="bt_vermelho">ELFI </span></legend>
                <h2>Pesquisa de Entrega de Serviço</h2>
                <h4>Estamos em constante desenvolvimento e gostariamos que fosse com você.</h4>
            </fieldset>
        </header>
        <article>
            <fieldset class="container-fluid">
                <legend><span class="bt_vermelho">Dados da Proposta </span></legend>
                <p>Nº: <b><?= $orcObj->getNOrc() . "." . $orcObj->getAnoOrc() ?></b></p>
                <p>Descrição do serviço:</p>
                <p><b><?= Formatar::limita_texto($orcObj->getDesciServicoObra(), 400)?></b></p>
                
            </fieldset>
        </article>
        <section>
            <form name="clientForm" method="post" action="pesquisa_pos_venda.php?ido=<?= $id_orc ?>&idc=<?= $id_cliente ?>" onsubmit="return formCheck(this);">       
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">1. Informações sobre o Desempenho * </span></legend>
                        <div class="linhaPontuacao"> 
                            <ul class="list-inline">
                                <li>Ruim/Regular</li>
                                <li>Bom/Ótimo</li>
                            </ul>
                        </div>
                        <div>

                            <div class="conteinerListaItens">
                                <ul class="list-group-item-heading">
                                    <li>Confiabilidade:</li>
                                    <li>Pontualidade: </li>
                                    <li>Disponibilidade</li>
                                    <li>Qualidade</li>
                                    <li>Atendimento às normas de segurança</li>
                                </ul>
                            </div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1confiabilidade" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1confiabilidade" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1pontualidade" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1pontualidade" value="1">   &ensp;
                                    </label>
                                </div>  
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1disponibilide" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1disponibilide" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1qualidade" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1qualidade" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1normasseguranca" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1normasseguranca" value="1">   &ensp;
                                    </label>
                                </div>

                            </div>
                        </div>


                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">2. Informações sobre o Atendimento * </span></legend>
                        <div class="linhaPontuacao"> 
                            <ul class="list-inline">
                                <li>Ruim/Regular</li>
                                <li>Bom/Ótimo</li>
                            </ul>
                        </div>
                        <div>

                            <div class="conteinerListaItens">
                                <ul class="list-group-item-heading">
                                    <li>Apresentação</li>
                                    <li>Envolvimento </li>
                                    <li>Educação</li>

                                </ul>
                            </div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="2apresentacao" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="2apresentacao" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="2envolvimento" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="2envolvimento" value="1">   &ensp;
                                    </label>
                                </div>  
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="2educacao" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="2educacao" value="1">   &ensp;
                                    </label>
                                </div>


                            </div>
                        </div>
                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">3. Informações sobre Andamento dos Serviços * </span></legend>
                        <div class="linhaPontuacao"> 
                            <ul class="list-inline">
                                <li>Ruim/Regular</li>
                                <li>Bom/Ótimo</li>
                            </ul>
                        </div>
                        <div>

                            <div class="conteinerListaItens">
                                <ul class="list-group-item-heading">
                                    <li>Organização</li>
                                    <li>Competência Técnica </li>
                                </ul>
                            </div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="3organizacao" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="3organizacao" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="3competencia" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="3competencia" value="1">   &ensp;
                                    </label>
                                </div>  
                            </div>
                        </div>
                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">4. Informações sobre o atendimento aos prazos estabelecidos * </span></legend>
                        <div class="linhaPontuacao"> 
                            <ul class="list-inline">
                                <li>Ruim/Regular</li>
                                <li>Bom/Ótimo</li>
                            </ul>
                        </div>
                        <div>

                            <div class="conteinerListaItens">
                                <ul class="list-group-item-heading">
                                    <li>Entrega do Orçamento</li>
                                    <li>Serviço realizado </li>
                                </ul>
                            </div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="4orcamento" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="4orcamento" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="4servico" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="4servico" value="1">   &ensp;
                                    </label>
                                </div>  
                            </div>
                        </div>
                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">5. Em geral você esta Satisfeito com a ELFI? *  </span></legend>

                        <div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="5satisfeito" value="1" > Sim
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="5satisfeito" value="0">   Não
                                    </label>
                                </div>

                            </div>
                        </div>
                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">6. OUTROS COMENTÁRIOS:   </span></legend>



                        <div class="itensRadio">
                            <textarea style="height: 10em; width: 100%;" id="text" name="6outrosComentarios"></textarea> 
                        </div>



                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid text-center">
                        <legend><span class="bt_vermelho"> </span></legend>


                        <input type="submit" value="Salvar e Enviar" name="salvar" /> 
                    </fieldset>
                </article>

            </form>
        </section>

    </body>
</html>
