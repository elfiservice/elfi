<div>
    <h2><a href="tecnico.php?id_menu=orcamento">Orcamentos</a> -><a href="tecnico.php?id_menu=acompanhar_orcamentos">Aprovados</a> -> Historico</h2>
</div>
<hr>
<?php
//$ano_atual = date('Y');
//Salva Historico no BD
if(filter_has_var(INPUT_POST, 'salvar_historico_orc_aprov')){
    $id_orc = filter_input(INPUT_POST, 'id_orc', FILTER_DEFAULT);
    $data = filter_input(INPUT_POST, 'dia_hoje', FILTER_DEFAULT);
    $descricao_historico = filter_input(INPUT_POST, 'descricao_historico', FILTER_DEFAULT);
    $id_colab = $_SESSION['id'];
    $colab = $_SESSION['Login'];
    
    if($descricao_historico){
     $orcamentoCtrl = new OrcamentoCtrl();
     $valores = array($id_orc, $data, $descricao_historico,  $id_colab, $colab ); //Por na seguencia CERTA da TAbela
    if($orcamentoCtrl->inserirHistoricoOrcAprovado($valores)){
        WSErro("Salvo com sucesso.", WS_ACCEPT);
    }else{
        WSErro("Ocorreu algum Erro ao tentar salvar.", WS_ERROR);
    }
    }else{
        WSErro("Campo Descrição em branco!", WS_ALERT);
    }
    echo"<a class=\"bt_link\" href=\"tecnico.php?id_menu=hitorico_orc_aprovado&id_orc={$id_orc}\">Voltar</a>";
    
    die();
}

//VERIFICA A URL E PARAMETRO PASSADO
$id_orc = filter_input(INPUT_GET, 'id_orc', FILTER_VALIDATE_INT);
if ($id_orc) {
    $orcamentoCtrl = new OrcamentoCtrl();
    $orcObj = $orcamentoCtrl->buscarOrcamentoPorId("*", "WHERE id = $id_orc");
    // var_dump($orcObj);
    if (!$orcObj) {

        WSErro("Orçamento não encontrado!", WS_ALERT);
        die();
    }
} else {
    WSErro("Erro na URL!", WS_ERROR);
    die();
}

$data_hj = date('Y-m-d');


//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
if (!isset($_SESSION['idx'])) {
    if (!isset($_COOKIE['idCookie'])) {

        echo"Voce não esta logado!";
    }
} else {
    ?>	

    <div>
        <h3> Histórico Orçamento Nº <?= $orcObj->getNOrc() . "." . $orcObj->getAnoOrc() ?> - Cliente: <?= $orcObj->getRazaoSocialContrat() ?></h3>

    </div>

    <fieldset>
        <legend><b>Dados</b></legend>
        <form action="tecnico.php?id_menu=hitorico_orc_aprovado" method="post" enctype="multipart/form-data" name="formAgenda">
            Data deste Historico: 	<b><?= Formatar::formatarDataSemHora($data_hj); ?></b>
            </br></br>
            <label for="email_orc">Descrição:</label></br>
            <textarea  rows="3" cols="100" id="text" name="descricao_historico"></textarea>
            </br></br>
            <input  type="submit" name="salvar_historico_orc_aprov" value="Salvar" id="logar"  />
            <input type="hidden" value="<?= $data_hj; ?>" name="dia_hoje"  />
             <input type="hidden" name="id_orc" value="<?= $orcObj->getId() ?>" />				
        </form>

    </fieldset>


    <fieldset>
        <legend><b>Histórico</b></legend>

        <TABLE  class="display" id="example2">
            <thead>
                <TR>
                    <TH></TH>
                    <TH>Data</TH>
                    <TH>Descrição</TH>
                    <TH>Colaborador</TH>

                </TR>
            </thead>
            <tbody>

                <?php
                $histoORc = $orcamentoCtrl->buscarHistoricoOrcamento("*", "WHERE id_acompanhamento = '$id_orc' AND mostrar= '0' ORDER BY id DESC", "historico_orc_aprovado");
                if($histoORc){
                foreach ($histoORc as $row) {
                    ?>
                    <tr>
                        <td class="center">
                            <a class="bt_link bt_verde" href="tecnico.php?id_menu=editar_historico_orc_aprovado&id_historico=<?= $row['id']?>" >editar</a>
                            <hr>
                            <a class="bt_link bt_vermelho" href="tecnico.php?id_menu=excluir_historico_orc_aprovado&id_historico=<?= $row['id']?>">excluir</a>
                        </td>
                    
                        <td><?php echo $row['data']; ?></td>
                        <td><?php echo $row['descricao']; ?></td>
                        <td><?php echo $row['colaborador']; ?></td>


                    </tr>


                    <?php
                }
                }
                ?>

            </tbody>
        </TABLE>
    </fieldset>	

    <?php
}
?>

</body>
</html>