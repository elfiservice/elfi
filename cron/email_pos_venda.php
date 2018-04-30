<?php

include '../classes/Config.inc.php';

$ano_orc = date('Y');
   $OrcCtrl = new OrcamentoCtrl();

$anosOrcamentosArr = $OrcCtrl->buscarOrcamentos("DISTINCT ano_orc", "ORDER BY ano_orc DESC");

$count = 0;
$countErr = 0;
$echoResult = "";
foreach ($anosOrcamentosArr as $orc => $l) {

    $ano_orc = $l['ano_orc'];

    $orcamentos = $OrcCtrl->buscarOrcamentos("*", "WHERE ano_orc = '$ano_orc' AND situacao_orc = 'concluido' AND serv_concluido = 's' AND feito_pos_entreg = 'n' ORDER BY id  DESC");

    if(empty($orcamentos)){
        $echoResult .= "Não tem Orçamentos para o Ano de {$ano_orc}<br>";
    }else{
        $echoResult .= "Orçamentos para o Ano de {$ano_orc}<br>";
        foreach ($orcamentos as $row) {

            $data_inicial = $row ['data_conclusao'];
            $data_final = date('y-m-d');
            $dias = Formatar::diffDuasDatas($data_inicial, $data_final);

            if (!$row ['email_contr'] == null) {

                for ($dia = 10; $dia <= 365; $dia = $dia + 10) {
                    // echo $dia . ' == ' . $dias . '<br>';
                    if ($dia == $dias) {
                        $echoResult .=  $dia . ' == ' . $dias . " enviar - ";

                        //$emailTo = array(EMAIL_ADMIN);
                        $emailTo = array($row['email_contr'], $row['email_obra']);
                        $assunto = "Lembrete preenchimento Pesquisa";

                        $textoCorpo = "Olá, <b>{$row ['razao_social_contr']}</b> a proposta de Nº <b>{$row ['n_orc']}.{$row ['ano_orc']}</b> foi <b>concluida</b> à <b>{$dias} dias.</b> <br>"
                                . "Por favor, nos dê seu parecer sobre nosso atendimento, será de grande ajuda para o desenvolvimento de nossa parceria.<br><br>"
                                . "Apenas acesse o Link abaixo ou copie e cole no navegar:<br>"
                                . "<a href=\"{$www}/modulos/tecnico/orcamento/aprovados/pesquisa_pos_venda.php?ido={$row ['id']}&idc={$row ['id_cliente']}\" >"
                                . "{$www}/modulos/tecnico/orcamento/aprovados/pesquisa_pos_venda.php?ido={$row ['id']}&idc={$row ['id_cliente']} </a> <br>";

                        $emailCopiaOculta = array();
                        //$emailCopiaOculta = array(EMAIL_ADMIN);
                        $email2 = new EmailGenerico($emailTo, $assunto, $textoCorpo, array(), $emailCopiaOculta);
                        
                        $textoNomeClienteEOrc = "{$row ['razao_social_contr']} ORC {$row ['n_orc']}";
                        if ($email2->enviarEmailSMTP()) {
                            $echoResult .=  "{$textoNomeClienteEOrc} - OK<br>";
                            $count++;
                            $f = fopen("registro_email_pos_venda.txt", "a+", 0);
                            $linha = "Email enviado em: " . date('d/m/Y H:i') . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . " Email: " . $row ['email_contr'] . "\r\n";
                            fwrite($f, $linha, strlen($linha));
                            fclose($f);
                        } else {
                            $echoResult .=  "{$textoNomeClienteEOrc} - <span style='color: red'> ERROr </span> <br>";
                            $countErr++;
                        }
                    }
                }
            } else {
                $f = fopen("registro_email_pos_venda.txt", "a+", 0);
                $linha = "Email NÃO enviado em: " . date('d/m/Y H:i') . " para " . $row ['razao_social_contr'] . " Orc N. " . $row ['n_orc'] . "/" . $row ['ano_orc'] . "\r\n";
                fwrite($f, $linha, strlen($linha));
                fclose($f);
            }
        }
    }
}

$msgToLog = "Enviado email(s) para {$count} Cliente(s) com Pesquisa de pos-venda(satisfação) não respondidas - ocorreram {$countErr} erros.";
$echoResult .= "<br>" . $msgToLog;

$emailToAdmin = new EmailGenerico(array(EMAIL_ADMIN), "Relatório Pesquisa de pos-venda(satisfação) não respondidas", $echoResult, array(), array(), 1);

if ($emailToAdmin->enviarEmailSMTP()) {
    echo "email com relatorio enviado para " . EMAIL_ADMIN . "<br>";
} else {
    echo "ERROr ao tentar enviar email com relatorio enviado para " . EMAIL_ADMIN . "<br>";
}
echo $echoResult;


LogCtrl::inserirLog(0, $msgToLog, "tec");
