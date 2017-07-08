<?php ?>
<!-- Troca Local da Obra no OR�amento  -->
<?php require '../../includes/javascripts/trocar_local_obra_orc.php'; ?>
<!-- FIM  Troca Local da Obra no OR�amento  -->

<!-- Busca cliente para Auto Preenchimento  -->
<?php require '../../includes/javascripts/busca_cliente_auto_preenchimento.php'; ?>
<!-- FIM Busca cliente para Auto Preenchimento  -->


<!--  Auto Rize no Text Area do Descrição servicos e Observação Orçamento  -->
<!--  FIMM Auto Rize no Text Area do Descrição servicos e Observação Orçamento  -->


<!-- MAscaras em campos valores-->
<?php //require 'includes/javascripts/mascaras_campos_valores_monetario.php';  ?>
<!-- FIM  MAscaras em campos -->


<!--  SOMA campos  valores -->
<?php require '../../includes/javascripts/somar_valores_monetarios.php'; ?>
<!-- fim SOMA CAMPOS em campos -->

<!-- Teste Campos obrigatorios -->
<script language="JavaScript">


    /***********************************************
     * Required field(s) validation v1.10- By NavSurf
     * Visit Nav Surf at http://navsurf.com
     * Visit http://www.dynamicdrive.com/ for full source code
     ***********************************************/

    function formCheck(formobj) {
        // Enter name of mandatory fields
        var fieldRequired = Array("razao_social", "endereco", "city", "tel", "email_orc2", "descricao_servicos", "execucao_orc", "validade_orc", "pagamento_orc", "duvida_orc", "sum_vr_servico_orc", "atividade1", "classificacao1", "unidade1", "quantidade1", "contato_clint");
        // Enter field description to appear in the dialog box
        var fieldDescription = Array("Razão Social  do Contratante", "Endereço do Contratante", "Cidade do Contratante", "Telefone ou Celular do contratante", "Email da obra", "Descrição dos serviços", "Prazo de execução", "Validade do orçamento", "Condições de pagamento", "Dúvidas", "Valor do serviço", "Atividade do serviço", "Classificação", "Unidade", "quantidade", "Nome de contato do cliente");
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
<!-- Fim Teste Campos obrigatorios -->


<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> Novo</h2>
</div>
<hr>
<div class="" style="       ">

    <form name="clientForm" method="post" action="?id_menu=orcamento/incluir/salvar_novo_orc"
          onsubmit="return formCheck(this);">

        <fieldset>
            <legend>
                Contratante
            </legend>
            <table border="0">
                <tbody>

                    <tr align="left">
                        <td><label for="clientID">Cliente:</label></br> 
                            <select id="clientID" name="clientID">
                                <option value=""></option>
                                <?php
                                $clienteCtrl = new ClienteCtrl();
                                $clienteBd = $clienteCtrl->buscarBD("*", "WHERE mostrar = '1' ORDER BY razao_social");
                                foreach ($clienteBd as $cliente => $row) {
                                    echo '<option id="clientID" value="' . $row->getId() . '">' . $row->getRazaoSocial() . '</option>';
                                }
                                ?>

                            </select></td>
                    </tr>
                    <tr align="left">
                        <td><label for="razao_social">Razão Social:</label></br> <input
                                name="razao_social" id="razao_social" size="60" maxlength="255" readonly="readonly">
                        </td>

                        <td><label for="cnpj">CNPJ:</label></br> <input name="cnpj"
                                                                        id="cnpj" alt="" size="20" maxlength="255" readonly="readonly"></td>
                    </tr>
                    <tr align="left">
                        <td><label for="endereco">Endereço:</label></br> <input
                                name="endereco" id="endereco" size="60" maxlength="255" readonly="readonly"></td>
                    </tr>
                    <tr align="left">
                        <td><label for="bairro">Bairro:</label></br> <input
                                name="bairro" id="bairro" size="20" maxlength="255" readonly="readonly"></td>

                        <td><label for="city">Cidade:</label></br> <input name="city"
                                                                          id="city" size="20" maxlength="255" readonly="readonly"></td>
                        <td><label for="estado">Estado:</label></br> <input
                                name="estado" id="estado" size="20" maxlength="255" readonly="readonly"></td>

                    </tr>
                    <tr align="left">

                        <td><label for="cep">CEP:</label></br> <input name="cep"
                                                                      id="cep" size="20" maxlength="15" readonly="readonly"></td>
                        <td><label for="tel">Telefone:</label></br> <input name="tel"
                                                                           id="tel" size="20" maxlength="15" readonly="readonly"></td>
                        <td><label for="cel">Celular:</label></br> <input name="cel"
                                                                          id="cel" size="20" maxlength="15" readonly="readonly"></td>


                    </tr>
                    <tr align="left">

                        <td><label for="email_orc">Email:</label></br> <input
                                name="email_orc" id="email_orc" size="20" maxlength="255" readonly="readonly"></td>



                    </tr>
                </tbody>
            </table>
        </fieldset>

        <fieldset>
            <legend>
                <h3>Contato</h3>
            </legend>


            <input id="contato_clint" name="contato_clint" size="80"
                   maxlength="100" />


        </fieldset>



        <fieldset>
            <legend>
                <h3>Local da obra</h3>
            </legend>

            <div id="form_local_obra">
                <input onClick="return retira_form_obra()" name="submit"
                       type="submit" value="Os dados da contratante é o mesmo da Obra." />

                <table border="0">
                    <tbody>


                        <tr align="left">
                            <td><label for="razao_social2">Razão Social:</label></br> <input
                                    name="razao_social2" id="razao_social2" size="60"
                                    maxlength="255"></td>

                            <td><label for="cnpj2">CNPJ:</label></br> <input name="cnpj2"
                                                                             id="cnpj2" size="20" alt="cnpj" maxlength="22"></td>
                        </tr>
                        <tr align="left">
                            <td><label for="endereco2">Endereço:</label></br> <input
                                    name="endereco2" id="endereco2" size="60" maxlength="255"></td>
                        </tr>
                        <tr align="left">
                            <td><label for="bairro2">Bairro:</label></br> <input
                                    name="bairro2" id="bairro2" size="20" maxlength="255"></td>

                            <td><label for="city2">Cidade:</label></br> <input name="city2"
                                                                               id="city2" size="20" maxlength="255"></td>
                            <td><label for="estado2">Estado:</label></br> <input
                                    name="estado2" id="estado2" size="20" maxlength="255"></td>

                        </tr>
                        <tr align="left">

                            <td><label for="cep2">CEP:</label></br> <input name="cep2"
                                                                           id="cep2" alt="cep" size="20" maxlength="12"></td>
                            <td><label for="tel2">Telefone:</label></br> <input name="tel2"
                                                                                id="tel2" size="20" alt="phone" maxlength="15"></td>
                            <td><label for="cel2">Celular:</label></br> <input name="cel2"
                                                                               id="cel2" size="20" alt="cel" maxlength="15"></td>


                        </tr>
                        <tr align="left">

                            <td><label for="email_orc2">Email:</label></br> <input
                                    name="email_orc2" id="email_orc2" size="20" maxlength="255"></td>



                        </tr>
                    </tbody>
                </table>

            </div>
        </fieldset>

        <fieldset>
            <legend>
                <h3>Classificação da Atividade</h3>
            </legend>

            <table border="0">
                <tbody>



                    <tr align="left">
                        <td><label for="atividade" size="20">Atividade</label></td>

                        <td><label for="classificacao">Classificação:</label></td>

                        <td><label for="quantidade">Quantidade:</label></td>
                        <td><label for="unidade">Unidade:</label></td>

                    </tr>
                    <tr align="left">

                        <td><select id="" name="atividade1">
                                <option name="" value=""></option>
                                <?php
                                $OrcCtrl = new OrcamentoCtrl();
                                $listaAtivBd = $OrcCtrl->listaAtividades();
                                foreach ($listaAtivBd as $lista => $row) {
                                    echo '<option id="" value="' . utf8_encode($row ['atividade']) . '" >' . utf8_encode($row ['atividade']) . '</option>';
                                }
                                ?>

                            </select></td>
                        <td><select id="" name="classificacao1">
                                <option value=""></option>
                                <?php
                                $listaClassfBd = $OrcCtrl->listarClassificacao();
                                foreach ($listaClassfBd as $lista => $row) {
                                    echo '<option id="" value="' . utf8_encode($row ['classificacao']) . '" >' . utf8_encode($row ['classificacao']) . '</option>';
                                }
                                ?>

                            </select></td>
                        <td><input name="quantidade1" id="" size="10" maxlength="10"></td>
                        <td><select id="" name="unidade1">
                                <option value=""></option>
                                <?php
                                $listaUnidBd = $OrcCtrl->listarUnidades();
                                foreach ($listaUnidBd as $lista => $row) {
                                    echo '<option id="" value="' . utf8_encode($row ['unidade']) . '" >' . utf8_encode($row ['unidade']) . '</option>';
                                }
                                ?>

                            </select></td>
                    </tr>
                </tbody>
            </table>
        </fieldset>


        <fieldset>
            <legend>
                <h3>Descrição dos Serviços</h3>
            </legend>


            <textarea onfocus=""
                      style="height: 10em; width: 100%;" id="text" name="descricao_servicos"></textarea>


        </fieldset>

        <fieldset>
            <legend>
                <h3>Condições</h3>
            </legend>

            <table border="0">

                <tr align="left">
                    <td><label for="execucao_orc" size="20"> Prazo execução</label>

                    </td>

                    <td><label for="validade_orc">Validade</label></td>

                    <td><label for="pagamento_orc">Pagamento</label></td>

                </tr>
                <tr align="left">
                    <td><input name="execucao_orc" id="execucao_orc" size="5"
                               maxlength="3"> dias</td>

                    <td><input name="validade_orc" id="validade_orc" size="5"
                               maxlength="3"> dias</td>

                    <td><input name="pagamento_orc" id="pagamento_orc" size="80"
                               maxlength="80"></td>

                </tr>
            </table>

        </fieldset>


        <fieldset>
            <legend>
                <h3>Observações</h3>
            </legend>


            <textarea onfocus="init2();" rows="1" cols="100"
                      style="height: 5em; width: 100%;"  id="text2" name="observacoes_servico"></textarea>


        </fieldset>

        <fieldset>
            <legend>
                <h3>Em caso dúvida / Negociações</h3>
            </legend>

            <input name="duvida_orc" id="duvida_orc" size="50" maxlength="50">

        </fieldset>

        <fieldset>
            <legend>
                <h3>Valor</h3>
            </legend>

            <table border="0">

                <tr align="left">
                    <td><label for="vr_servico_orc" size="20"> Valor do serviço</label>

                    </td>

                    <td><label for="vr_material_orc">Valor do material</label></td>



                    <td><label for="total_orc">Total da proposta</label></td>

                </tr>
                <tr align="left">
                    <td><input  onchange="soma11()" name="sum_vr_servico_orc"
                                id="vr_servico_orc" alt="decimal"  ></td>

                    <td><input onchange="soma11()" name="sum_vr_material_orc"
                               id="vr_material_orc" alt="decimal" size="15" maxlength="15"></td>

                    <td>R$ <input type="text" name="totalSum" id="totalSum" value=""
                                  size="15" readonly="readonly" />
                    </td>


                </tr>
            </table>

        </fieldset>

        <table border="0">

            <tr align="left">
                <td><input type="submit" value="Salvar novo Orçamento" name="salvar_orc" /> 
                    <input type="hidden" value="<?php echo date('Y'); ?>" name="ano_atual_orc" hidden="hidden" /> 
                    <input  type="hidden"  id="id_cliente" name="id_cliente" value="<?php echo $row['id']; ?>"  hidden="hidden" /></td>



            </tr>

        </table>
    </form>

</div>	

