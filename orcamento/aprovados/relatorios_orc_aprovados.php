<?php
/*
 * Gerar relatorios e estatisticas sobre os Orçamentos Aprovados do Sistema
 * 
 */

$ano_orc_selec = date('Y');

if (isSet($_POST['ano'])) {

    $ano_orc_selec = $_POST['ano']; //pega o Ano ao selecionar o ANO
  
}
?>
<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> <a href="tecnico.php?id_menu=acompanhar_orcamentos">Aprovados</a> -> Relatórios</h2>
</div>
<hr>

<fieldset>
    <legend>Busca por ano</legend>
    <div>
        <form action="tecnico.php?id_menu=relatorios_orc_aprovados" method="post" enctype="multipart/form-data" name="formAgenda">
            Selecione o ANO:	
            <select name="ano" id="ano" class="formFieldsAno">
                <option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
                <?php
                $consulta_menor_ano_orc = mysql_query("select DISTINCT ano_orc from orcamentos ORDER BY ano_orc DESC");
                while ($l = mysql_fetch_array($consulta_menor_ano_orc)) {
                    ?>
                    <option value="<?php echo $l['ano_orc']; ?>"><?php echo $l['ano_orc']; ?></option>
                    <?php
                }
                ?>
            </select>
            <input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
        </form>
    </div>
</fieldset>


<fieldset>
    <legend>Orçamentos Aprovados</legend>

    <TABLE border="1" class="tableComum" >
        <thead>
            <TR>

                <TH>MÊS</TH>
                <TH>ORC APROVADOR</TH>
                <TH>TOTAL ORC NO MêS</TH>
                <TH>% ORC APROVADOS NO MêS</TH>

            </TR>
        </thead>
        <tbody>

<?php
//$ano_orc = date('Y');

            $total = 0;
            $total_orc_feitos = 0;

            for ($i = 1; $i <= 12; $i++) {

//consulta Nºde ORC aprovados no mes 
                $sql_n_orc = mysql_query("SELECT * FROM orcamentos WHERE MONTH(data_aprovada) = '$i' AND YEAR(data_aprovada) = '$ano_orc_selec'") or die(mysql_error());
                $n_linhas_orc_aprovados = mysql_num_rows($sql_n_orc);

                $mes_atual = date('m');
                //var_dump($mes_atual);
                if ($i > $mes_atual) {

                    $n_orc_feitos_no_mes = 0;
                } else {
//selecionar controles
                    $sql_n_orc = mysql_query("SELECT * FROM orcamentos WHERE MONTH(data_adicionado_orc)  = '$i' AND YEAR(data_adicionado_orc) = '$ano_orc_selec'") or die(mysql_error());
                    $n_orc_feitos_no_mes = mysql_num_rows($sql_n_orc);

                    //var_dump($n_orc_feitos_no_mes);
                    //$linha = mysql_fetch_object($sql_n_orc);
                    //$n_orc_feitos_no_mes = $linha->n_orc_feitos;
                }

                if ($n_orc_feitos_no_mes == 0) {
                    $em_porcentagem = 0;
                } else {

                    $em_porcentagem = ($n_linhas_orc_aprovados / $n_orc_feitos_no_mes) * 100;
                }

                echo "<TR align=\"center\"><TD class=\"indiceTabelaComum \">" . $i . "</TD> <TD>" . $n_linhas_orc_aprovados . "</TD> <TD>" . $n_orc_feitos_no_mes . "</TD> <TD>" . number_format($em_porcentagem, 2, '.', '') . "%</TD> </TR>";

                $total = $total + $n_linhas_orc_aprovados;
                $total_orc_feitos = $total_orc_feitos + $n_orc_feitos_no_mes;
            }
            ?>	



        </tbody>
    </TABLE>	

            <?php
            echo "<br>Total propostas Aprovadas: " . $total . " de " . $total_orc_feitos . " feitas<br>";
            ?>	
 </fieldset>
    <fieldset>
        <legend>Principais Clientes Por Ano Selecionado: <span style="color: red;"><?= $ano_orc_selec ?></span></legend>	


        <TABLE class="display" id="example"  >
            <thead>
                <TR>

                    <TH>Cliente</TH>
                    <TH>Nº Propostas Feitas</TH>
                    <TH>Nº Propostas Aprovadas</TH>
                    <TH>% de Aprovação</TH>



                </TR>
            </thead>
            <tbody>
<?php
$sql = "SELECT * FROM clientes";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';

    $id_cliente = $row['id'];
    $tipo_cliente = $row['tipo'];
    $nome_cliente = $row['razao_social'];



    $sql = mysql_query("SELECT * FROM orcamentos WHERE razao_social_contr = '$nome_cliente' AND ano_orc='$ano_orc_selec'");
    $total = mysql_num_rows($sql);
    $sqlAprovadas = mysql_query("SELECT * FROM orcamentos WHERE razao_social_contr = '$nome_cliente' AND ano_orc='$ano_orc_selec' AND situacao_orc = 'Aprovado'");
$totalAprovados = mysql_num_rows($sqlAprovadas);    
//echo $total;

                if ($total == 0) {
                    $em_porcentagem_aprovados = 0;
                } else {

                    $em_porcentagem_aprovados = ($totalAprovados / $total) * 100;
                }


    echo "<TR align=\"center\"><TD><a href=\"tecnico.php?id_menu=perfil_cliente&id_cliente={$id_cliente}&tipo_cliente={$tipo_cliente}\">" . $nome_cliente . "</a></TD> <td>" . $total . "</td><td>{$totalAprovados} </td><td> {$em_porcentagem_aprovados}% </td></TR>";
}
?>  




            </tbody>
        </TABLE>




    </fieldset>

   <fieldset>
        <legend>Clientes Geral (Todos os Anos)</legend>	


        <TABLE class="display" id="example2"  >
            <thead>
                <TR>

                    <TH>Cliente</TH>
                    <TH>Nº Propostas Feitas</TH>
                    <TH>Nº Propostas Aprovadas</TH>
                    <TH>% de Aprovação</TH>



                </TR>
            </thead>
            <tbody>
<?php
$sql = "SELECT * FROM clientes";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)) {
    //echo '<option id="clientID" value="'.$row['razao_social'].'">'.$row['razao_social'].'</option>';

    $id_cliente = $row['id'];
    $tipo_cliente = $row['tipo'];
    $nome_cliente = $row['razao_social'];



    $sql = mysql_query("SELECT * FROM orcamentos WHERE razao_social_contr = '$nome_cliente' ");
    $total = mysql_num_rows($sql);
    $sqlAprovadas = mysql_query("SELECT * FROM orcamentos WHERE razao_social_contr = '$nome_cliente'  AND situacao_orc = 'Aprovado'");
$totalAprovados = mysql_num_rows($sqlAprovadas);    
//echo $total;

                if ($total == 0) {
                    $em_porcentagem_aprovados = 0;
                } else {

                    $em_porcentagem_aprovados = ($totalAprovados / $total) * 100;
                }


    echo "<TR align=\"center\"><TD><a href=\"tecnico.php?id_menu=perfil_cliente&id_cliente={$id_cliente}&tipo_cliente={$tipo_cliente}\">" . $nome_cliente . "</a></TD> <td>" . $total . "</td><td>{$totalAprovados} </td><td> {$em_porcentagem_aprovados}% </td></TR>";
}
?>  




            </tbody>
        </TABLE>




    </fieldset>	
