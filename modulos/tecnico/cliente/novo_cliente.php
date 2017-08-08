<?php ?>
<!--
MAscaras em campos
-->
<?php require '../../includes/javascripts/mascaras_campos_valores_monetario.php'; ?>

<!--
DESABILITAR CAMPOS COM CHECKBOX
-->
<?php require '../../includes/javascripts/desabilCampoCheckBox.php'; ?>

<!-- TESTE do CNPJ e CPF -->
<?php require '../../includes/javascripts/testeCnpjeCpf.php'; ?>


<!-- TESTE campo Telefone -->
<?php require '../../includes/javascripts/testeTelefone.php'; ?>

<!-- Campos Obrigatorios a serem preenchidos -->
<script language="JavaScript">
    /***********************************************
     * Required field(s) validation v1.10- By NavSurf
     * Visit Nav Surf at http://navsurf.com
     * Visit http://www.dynamicdrive.com/ for full source code
     ***********************************************/
    function formCheck(formobj) {
        // Enter name of mandatory fields
        var fieldRequired = Array("razao_social", "nome_fantasia", "endereco", "bairro", "cod_estados", "cod_cidades", "phone");
        // Enter field description to appear in the dialog box
        var fieldDescription = Array("Razão Social", "Nome Fantasia", "Endereço", "Bairro", "Estado", "Cidade", "Telefone");
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
                        if (obj.value == "" || obj.value == null) {
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


<div>
    <h2><?php include_once 'cliente/includes/nav_wizard.php'; ?> -> Novo</h2>
</div>
<hr>


<?php
$clienteCtrl = new ClienteCtrl();
if (filter_has_var(INPUT_POST, "salvar_novo_cliente")) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    $dados['Login'] = Formatar::prefixEmail($userlogin->getLogin());
    $dados['id_colab_logado'] = $userlogin->getId();

    if ($clienteCtrl->inserirCliente($dados)) {
        WSErro($clienteCtrl->getResult()[0], $clienteCtrl->getResult()[1], "die");
    } else {
        WSErro($clienteCtrl->getResult()[0], $clienteCtrl->getResult()[1]);
    }
}
?>

<div class="" >
    <form method="post" action="?id_menu=cliente/novo_cliente" onsubmit="return formCheck(this);">
        <table>
            <tbody>
                <tr>
                    <td class="label ">Pessoa Física </td>
                    <td><input type="checkbox" value="PF" name="tipo" id="tipo" <?php if (isset($dados['tipo'])) {
    echo "checked";
} ?>  />               </td>
                </tr>
                <tr>
                    <td class="label">Razão Social / Nome</td>
                    <td class="input" COLSPAN="3"><input type="text" name="razao_social" value="<?php if (isset($dados['razao_social'])) {
    echo $dados['razao_social'];
} ?>" size="50" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" /></td>

                </tr>
                <tr>
                    <td class="label">Nome Fantasia</td>
                    <td class="input" COLSPAN="3"><input type="text" name="nome_fantasia" value="<?php if (isset($dados['nome_fantasia'])) {
    echo $dados['nome_fantasia'];
} ?>" size="50" onkeyup="this.value = this.value.toUpperCase();" /></td>
                </tr>
                <tr>
                    <td class="label j_label_tipo"></td>
                    <td><div class="j_tipo"></div></td>
                </tr>
                <tr>
                    <td class="label j_label_ie"></td>
                    <td><div class="j_ie"></div></td>                                     
                </tr>
            <script>
                var checkboxTypeCPF_CNPJ = $("#tipo");
                var fillTypeCPF_CNPJ = $(".j_tipo");
                var labelType = $(".j_label_tipo");
                var labelIE = $(".j_label_ie");
                var fillIE = $(".j_ie");
                var valueCPF = "";
                var valueCNPJ = "";
                var valueIE = "";
                var verificaTipo = function () {

                    if (checkboxTypeCPF_CNPJ.attr("checked")) {
                        labelType.html('CPF');
                        valueCNPJ = $(".input-cnpj").val();
                        valueIE = $(".input-ie").val();

                        fillTypeCPF_CNPJ.html('<input class="input-cpf" value="' + valueCPF + '" type="text" id="cpf" name="cpf" alt="cpf" onBlur="TESTA();" />');

                        labelIE.html('');
                        fillIE.html('');
                    } else {
                        labelType.html('CNPJ');
                        valueCPF = $(".input-cpf").val() || "";

                        fillTypeCPF_CNPJ.html('<input class="input-cnpj" value="' + valueCNPJ + '" type="text" id="cnpj" name="cnpj" alt="cnpj" onBlur="TESTA();" />');

                        labelIE.html('Inscrição Estadual');
                        fillIE.html('<input class="input-ie" type="text" name="ie" value="' + valueIE + '" alt="ie" id="ie" size="10" />');
                    }
                };
                verificaTipo();

                checkboxTypeCPF_CNPJ.on("click", verificaTipo);

            </script>               

            <tr>
                <td class="label">Endereço</td>
                <td class="input" COLSPAN="3"><input type="text" name="endereco"
                                                     value="<?php if (isset($dados['endereco'])) {
    echo $dados['endereco'];
} ?>" size="50" maxlength="180"
                                                     onkeyup="this.value = this.value.toUpperCase();" /></td>
            </tr>
            <tr>
                <td class="label">Bairro</td>
                <td class="input"><input type="text" name="bairro" value="<?php if (isset($dados['bairro'])) {
    echo $dados['bairro'];
} ?>"
                                         size="30" maxlength="90"
                                         onkeyup="this.value = this.value.toUpperCase();" /></td>
                <td class="label2">CEP</td>
                <td class="input2"><input type="text" id="cep" name="cep" alt="cep" value="<?php if (isset($dados['cep'])) {
    echo $dados['cep'];
} ?>" /></td>
            </tr>
            <tr>
                <td class="label">Estado</td>
                <td class="input">
                    <select name="cod_estados" id="cod_estados">
                        <option value=""> </option>
<?php
$estados = $clienteCtrl->buscarEstado("cod_estados, sigla", "ORDER BY sigla");
foreach ($estados as $row) {

    echo '<option value="' . $row['cod_estados'] . '">' . $row['sigla'] . '</option>';
}
?>
                    </select>
                </td>
                <td class="label2">Cidade</td>
                <td class="input2"><span class="carregando">Aguarde,
                        carregando...</span> <select name="cod_cidades"
                                                 id="cod_cidades">
                        <option value="">-- Escolha um estado --</option>
                    </select> <script src="http://www.google.com/jsapi"></script> <script
                        type="text/javascript">
                                             google.load('jquery', '1.3');
                    </script> <script
                        type="text/javascript">
                            $(function () {
                                $('#cod_estados').change(function () {
                                    if ($(this).val()) {
                                        $('#cod_cidades').hide();
                                        $('.carregando').show();
                                        $.getJSON('../../ajax/cidades.ajax.php?search=', {cod_estados: $(this).val(), ajax: 'true'}, function (j) {
                                            var options = '<option value=""></option>';
                                            for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                                            }
                                            $('#cod_cidades').html(options).show();
                                            $('.carregando').hide();
                                        });
                                    } else {
                                        $('#cod_cidades').html('<option value="">â€“ Escolha um estado â€“</option>');
                                    }
                                });
                            });
                    </script></td>
            </tr>
            <tr>
                <td class="label">TEL</td>
                <td class="input"><input value="<?php if (isset($dados['phone'])) {
    echo $dados['phone'];
} ?>" type="text" id="phone" name="phone"
                                         alt="phone" onchange="Contar(this)" /></td>
                <td class="label2">CEL</td>
                <td class="input2"><input value="<?php if (isset($dados['cel'])) {
    echo $dados['cel'];
} ?>" type="text" id="cel" name="cel" alt="cel"
                                          onchange="Contar(this)" /></td>
            </tr>
            <tr>
                <td class="label">FAX</td>
                <td class="input"><input value="<?php if (isset($dados['fax'])) {
    echo $dados['fax'];
} ?>" type="text" id="fax" name="fax" alt="fax"
                                         onchange="Contar(this)" /></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td class="label">Email Técnico</td>
                <td class="input"><input value="<?php if (isset($dados['email_tec'])) {
    echo $dados['email_tec'];
} ?>" type="email" id="email_tec"
                                         name="email_tec" /></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td class="label">Email Financ./Admin.</td>
                <td class="input"><input value="<?php if (isset($dados['email_admin'])) {
    echo $dados['email_admin'];
} ?>"  type="email" id="email_admin"
                                         name="email_admin" /></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"></td>

            </tr>
            </tbody>
        </table>
        <hr>
        <input type="submit" value="Salvar" name="salvar_novo_cliente" /> 
        <input type="hidden" name="usuario" value="<?= $userlogin->getId_colaborador(); ?>" />

    </form>

</div>

