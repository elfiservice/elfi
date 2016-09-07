<?php ?>


<!-- MAscaras em campos -->
<?php require 'includes/javascripts/mascaras_campos_valores_monetario.php'; ?>     


<!--
DESABILITAR CAMPOS COM CHECKBOX
-->
<?php require 'includes/javascripts/desabilCampoCheckBox.php'; ?>

<?php require 'includes/javascripts/testeCnpjeCpf.php'; ?>
<?php require 'includes/javascripts/testeTelefone.php'; ?>
<!-- Campos Obrigatorios -->
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


if ($cli instanceof ClientePJ) {
$cnpj_cpf = '<td class="label">CNPJ</td>
                        <td class="input">             
                            <div id=""><input value="'.$cli->getCnpj().'" type="text" id="cnpj" name="cnpj" alt="cnpj" onBlur="TESTA();" /></div>
                        </td>';
$ie_rg = '<td class="label">Inscrição Estadual</td>
                    <td class="input">
                        <input type="text" name="ie" value="'.$cli->getIe().'" alt="ie" id="ie" size="10" />
                    </td>';

    
    
} else if ($cli instanceof ClientePF) {
  $cnpj_cpf = '<td class="label2">CPF</td>
                        <td class="input2">
                            <div id=""><input value="'.$cli->getCpf().'" type="text" id="cpf" name="cpf" alt="cpf" onBlur="TESTA();" /><br /></div>
                        </td>';
$ie_rg = '<td class="label">RG</td>
                    <td class="input">
                        <input type="text" name="ie" value="'.$cli->getIe().'" alt="ie" id="ie" size="10" />
                    </td>';
} else {
    WSErro("Ops! Erro no Objeto do Sistema!", WS_ERROR, "die");
}
?>

<div>
    <h2><a href="tecnico.php?id_menu=cliente">Clientes</a> -> Editar</h2>
</div>
<hr>

<div id="demo">
    <form method="post" action="tecnico.php?id_menu=salvar_editar_cliente&id_cliente=<?= $id_cliente ?>" onsubmit="return formCheck(this);">       


        <table>
            <thead>
                <tr>

                    <th COLSPAN="3">Classificação 
                        <select name="classificacao">
                            <?php
                            if ($cli->getClassificacao() == "padrao") {
                                ?>
                                <option selected value="padrao">Padrão</option>
                                <option value="contrato">Contrato</option>                                            
                                <?php
                            } else if ($cli->getClassificacao() == "contrato") {
                                ?>

                                <option value="padrao">Padrão</option>
                                <option selected value="contrato">Contrato</option>                                                

                                <?php
                            } else {
                                ?>
                                <option selected value="padrao">Padrão</option>
                                <option value="contrato">Contrato</option>                                            
                                <?php
                            }
                            ?>    

                        </select>
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="label">Razão Social / Nome </td>
                    <td class="input" COLSPAN="3"><input type="text" name="razao_social" value="<?= $cli->getRazaoSocial(); ?>" size="50" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" /> </td>
                </tr>
                <tr>
                    <td class="label">Nome Fantasia </td>
                    <td class="input" COLSPAN="3"><input type="text" name="nome_fantasia" value="<?= $cli->getNomeFantasia() ?>" size="50" onkeyup="this.value = this.value.toUpperCase();"/></td>
                </tr>
                <tr>
                      <?= $cnpj_cpf ?>
                </tr>
                <tr>
                       <?= $ie_rg; ?>
                    <td>  </td>
                    <td>  </td>                                        
                </tr>
                <tr>
                    <td class="label">Endereço</td>
                    <td class="input" COLSPAN="3">
                        <input type="text" name="endereco" value="<?= $cli->getEndereco() ?>" size="50" maxlength="180" onkeyup="this.value = this.value.toUpperCase();" />
                    </td>

                </tr>
                <tr>
                    <td class="label">Bairro</td>
                    <td class="input" >
                        <input type="text" name="bairro" value="<?= $cli->getBairro() ?>" size="30" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" />
                    </td>
                    <td class="label2">CEP</td>
                    <td class="input2">
                        <input type="text" id="cep" name="cep" alt="cep" value="<?= $cli->getCep() ?>" />
                    </td>                                        

                </tr>
                <tr>
                    <td class="label">Estado</td>
                    <td class="input">

                        <?php
                        $estado_cliente = $linha_cliente->estado;

                        $consulta_estado = mysql_query("select * from estados where nome = '$estado_cliente'");
                        $linha_estado = mysql_fetch_object($consulta_estado);

                        $cod_estado_clientes = @$linha_estado->cod_estados;
                        ?>



                        <select name="cod_estados" id="cod_estados">
                            <option value=" "> </option>
                            <?php
                            $sql = "SELECT cod_estados, sigla
                                                                            FROM estados
                                                                            ORDER BY sigla";
                            $res = mysql_query($sql);
                            while ($row = mysql_fetch_assoc($res)) {

                                if ($cod_estado_clientes == $row['cod_estados']) {

                                    echo '<option selected value="' . $row['cod_estados'] . '">' . $row['sigla'] . '</option>';
                                } else {


                                    echo '<option value="' . $row['cod_estados'] . '">' . $row['sigla'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </td>
                    <td class="label2">Cidade</td>
                    <td class="input2">

                        <?php
                        $cidade_cliente = $linha_cliente->cidade;

                        $consulta_estado = mysql_query("select * from cidades where nome = '$cidade_cliente'");
                        $linha_cidade = mysql_fetch_object($consulta_estado);

                        @$cod_cidade_clientes = $linha_cidade->cod_cidades;
// echo $cod_cidade_clientes;
                        ?>


                        <span class="carregando"></span>
                        <select name="cod_cidades" id="cod_cidades">
                            <option value="<?php echo $cod_cidade_clientes; ?>"><?php echo utf8_encode($linha_cliente->cidade); ?></option>
                        </select>

                        <script src="http://www.google.com/jsapi"></script>
                        <script type="text/javascript">
                            google.load('jquery', '1.3');
                        </script>		

                        <script type="text/javascript">
                            $(function () {
                                $('#cod_estados').change(function () {
                                    if ($(this).val()) {
                                        $('#cod_cidades').hide();
                                        $('.carregando').show();
                                        $.getJSON('cidades.ajax.php?search=', {cod_estados: $(this).val(), ajax: 'true'}, function (j) {
                                            var options = '<option value=""></option>';
                                            for (var i = 0; i < j.length; i++) {
                                                options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                                            }
                                            $('#cod_cidades').html(options).show();
                                            $('.carregando').hide();
                                        });
                                    } else {
                                        $('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
                                    }
                                });
                            });
                        </script>
                    </td>                                      
                </tr>
                <tr>
                    <td class="label">TEL</td>
                    <td class="input">
                        <input type="text" onchange="Contar(this)" id="phone" name="phone" alt="phone" value="<?php echo $linha_cliente->tel; ?>"/>
                    </td>
                    <td class="label2">CEL</td>
                    <td class="input2">
                        <input type="text" onchange="Contar(this)" id="cel" name="cel" alt="cel" value="<?php echo $linha_cliente->cel; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">FAX</td>
                    <td class="input">
                        <input type="text" onchange="Contar(this)" id="fax" name="fax" alt="fax" value="<?php echo $linha_cliente->fax; ?>" />
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>                                        
                </tr>

                <tr>
                    <td class="label">Email Técnico</td>
                    <td class="input">
                        <input type="email" id="email_tec" name="email_tec" value="<?php echo $linha_cliente->email_tec; ?>" />
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>                                        

                </tr>
                <tr>
                    <td class="label">Email Financ./Admin.</td>
                    <td class="input">
                        <input type="email" id="email_admin" name="email_admin" value="<?php echo $linha_cliente->email_adm_fin; ?>" />
                    </td>  
                    <td>

                    </td>
                    <td>

                    </td>                                        
                </tr>

                <tr>

                    <td colspan="4">

                    </td>



                </tr>                                    
            </tbody>
        </table>
        <hr>
        <input class="bt_verde" type="submit" value="Salvar" name="salvar_novo_cliente" />
        <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />

    </form>



</div>
