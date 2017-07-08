<?php
/*
 * Gerar relatorios e estatisticas sobre os Orçamentos Aprovados do Sistema PARA ATIVIDADES
 * 
 */

$ano_orc_selec = date('Y');

if (filter_has_var(INPUT_POST, 'ano')) {

    $ano_orc_selec = filter_input(INPUT_POST, 'ano', FILTER_VALIDATE_INT); //pega o Ano ao selecionar o ANO
}

$orcCrtl = new OrcamentoCtrl();
?>
<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -> <a href="tecnico.php?id_menu=relatorios_orc"> Relatórios</a> -> Atividades</h2>
</div>
<hr>


<fieldset>
    <legend>Busca por ano</legend>
    <!-- form Trocar ANO -->
    <div><!-- form Trocar ANO -->
        <form action="tecnico.php?id_menu=relatorios_atividade" method="post" enctype="multipart/form-data" name="formAgenda">
            Selecione o ANO:	
            <select name="ano" id="ano" class="formFieldsAno">
                <option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
                <?php
                $anos = $orcCrtl->buscarOrcamentos("DISTINCT ano_orc", "ORDER BY ano_orc DESC");
                foreach ($anos as $l) {
                    ?>
                    <option value="<?php echo $l['ano_orc']; ?>"><?php echo $l['ano_orc']; ?></option>
                    <?php
                }
                ?>
            </select>
            <input  type="submit" name="logar" value="Buscar" id="logar"   />
        </form>
    </div>




    <fieldset>
        <legend>Principais Atividades por Ano: <span style="color: red;"><?= $ano_orc_selec ?></span></legend>	


        <TABLE class="display" id="example"  >
            <thead>
                <TR>

                    <TH>Atividade</TH>
                    <TH>Quantidade</TH>



                </TR>
            </thead>
            <tbody>
                <?php
                $atividade_orcs = $orcCrtl->buscarOrcamentos("DISTINCT atividade", "WHERE  YEAR(data_adicionado_orc) = '$ano_orc_selec'  ");

                foreach ($atividade_orcs as $row) {
                    $atividade = $row['atividade'];

                    $atividades = $orcCrtl->buscarOrcamentos("*", "WHERE  YEAR(data_adicionado_orc) = '$ano_orc_selec' AND atividade = '$atividade' ");
                    $n_linhas_atividades = count($atividades);
                    //var_dump($n_linhas_atividades);
                    ?>
                    <tr align="center">
                        <td> <?= $atividade ?></td>
                        <td> <?= $n_linhas_atividades ?></td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </TABLE>
    </fieldset>


    <fieldset>
                <?php
        $atividade_selecionada = "Manutenção";

        if (filter_has_var(INPUT_POST, 'atividade')) {

            $atividade_selecionada = filter_input(INPUT_POST, 'atividade', FILTER_DEFAULT); //pega o Ano ao selecionar o ANO
        }
        ?>
        <legend>Por Atividade de <span style="color: red;"><?= $atividade_selecionada ?></span> no Ano de <span style="color: red;"><?= $ano_orc_selec ?></span></legend>	

        <div id="atividade"><!-- form Trocar ANO -->
            <form action="tecnico.php?id_menu=relatorios_atividade#atividade" method="post" enctype="multipart/form-data" name="formAgenda">
                Selecione a Atividade:	
                <select name="atividade" id="atividade" class="formFieldsAno">
                    <option value="<?php echo $atividade_selecionada; ?>"><?php echo $atividade_selecionada; ?></option>
                    <?php
                    $anos = $orcCrtl->buscarOrcamentos("DISTINCT atividade", "WHERE  YEAR(data_adicionado_orc) = '$ano_orc_selec'  ");
                    foreach ($anos as $l) {
                        ?>
                        <option value="<?php echo $l['atividade']; ?>"><?php echo $l['atividade']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <input  type="submit" name="logar" value="Buscar" id="logar"   />
            </form>
        </div>

        <TABLE class="display" id="example3"  >
            <thead>
                <TR>

                    <TH>Atividade-Classificação</TH>
                    <TH>Quantidade</TH>



                </TR>
            </thead>
            <tbody>
                <?php
                $classificacao_orcs = $orcCrtl->buscarOrcamentos("DISTINCT classificacao", "WHERE  YEAR(data_adicionado_orc) = '$ano_orc_selec'  ");

                foreach ($classificacao_orcs as $row) {
                    $classificacao = $row['classificacao'];

                    $atividades = $orcCrtl->buscarOrcamentos("*", "WHERE  YEAR(data_adicionado_orc) = '$ano_orc_selec' AND classificacao = '$classificacao' AND atividade = '$atividade_selecionada' ");
                    $n_linhas_classificacao = count($atividades);
                    //var_dump($n_linhas_atividades);
                    ?>
                    <tr align="center">
                        <td> <?= $classificacao ?></td>
                        <td> <?= $n_linhas_classificacao ?></td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </TABLE>
    </fieldset>
