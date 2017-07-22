<section>
    <h2><?php include_once 'cliente/includes/nav_wizard.php'; ?> -> Excluir</h2>

    <hr>
    <?php
    $id_cliente = filter_input(INPUT_GET, 'id_cliente', FILTER_VALIDATE_INT);
    if (!empty($id_cliente)) {
        $clienteCtrl = new ClienteCtrl();
        $cliente = $clienteCtrl->buscarBD("*", "where id = '$id_cliente' AND mostrar = '1'");
        $cli = $cliente[0];
               
        if (empty($cliente)) {
            WSErro("Ops! Cliente não Encontrato!", WS_ERROR, "die");
        }
    } else {
        WSErro("Erro na URL !", WS_ALERT, "die");
    }

    if (filter_has_var(INPUT_POST, "excluir_cliente")) {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($dados["excluir_cliente"]) {
            $classFilha = get_class($cli);
            $clienteUp = new $classFilha($id_cliente);
            $clienteUp->setMostrar('0');
           if( $clienteCtrl->atualizarBD($clienteUp)){
               LogCtrl::inserirLog($userlogin->getId_colaborador(), "Cliente <b>{$cli->getRazaoSocial()}</b> <b><span>excluido</span></b> do Sistema", "tec");
               WSErro("OK! Cliente excluido do Sistema.", WS_ACCEPT, "die");
           }
        }
    }
    ?>



    <div
        STYLE="font-size: 16px; text-align: center; margin-top: 10px; color: red;">

    </div>
    <section>

        <h4 STYLE="font-size: 16px; margin-top: 10px; color: red;">Deseja realmente excluir esse Cliente ?</h4>

        <div id="demo">
            <form method="post" action="?id_menu=cliente/excluir_cliente&id_cliente=<?= $id_cliente ?>"  >

                <?php
                if ($cli instanceof ClientePJ) {
                    $cnpj_cpf = "<td class=\"label\">CNPJ:</td>
                            <td class=\"input\"><b>" . $cli->getCnpj() . "</b>
                            </td>";
                } else if ($cli instanceof ClientePF) {

                    $cnpj_cpf = "<td class=\"label\">CPF:</td>
                            <td class=\"input\"><b>   {$cli->getCpf()}</b>
                            </td>";

                    //var_dump($cli);
                } else {
                    WSErro("Ops! Erro no Objeto do Sistema!", WS_ERROR, "die");
                }
                ?>
                <table border="0">
                    <tr>
                        <td class="label">Cod / ID:</td>
                        <td class="input" COLSPAN="3"><b><?= $cli->getId(); ?></b></td>

                    </tr>
                    <tr>
                        <td class="label">Razão Social / Nome:</td>
                        <td class="input" COLSPAN="3"><b><?= $cli->getRazaoSocial(); ?></b></td>
                    </tr>
                    <tr>
                        <?= $cnpj_cpf; ?>
                    </tr>
                    <tr>
                        <td class="label">Endereço:</td>
                        <td class="input" COLSPAN="3"><b><?php echo "{$cli->getEndereco()}, {$cli->getBairro()}, {$cli->getBairro()}, {$cli->getCidade()} - {$cli->getEstado()}"; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">TEL:</td>
                        <td class="input"><b>	<?= $cli->getTel() . " / " . $cli->getCel(); ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <td colspan="2"></td>
                    </tr>
                </table>
                <hr>
                <input class="bt_vermelho" type="submit" value="Exluir" name="excluir_cliente" /> 
            </form>
        </div>
    </section>
</section>