<?php
$userCtrl = new UsuarioCtrl();
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (isset($dados['submitBtn'])) {
    unset($dados['submitBtn']);


    $userCtrl->alterarTipoConta($dados);
}
?>

<h2>Controle Tipo de Conta</h2>
<div id="demo">
    <table class="display" id="example">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Email</th>
                <th>Ultimo Login</th>
                <th>Tipo Conta</th>
                <th>Alterar Conta</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $colabs = $userCtrl->buscarBD("*", "");

            foreach ($colabs as $colab) {
                ?>
                <tr>
                    <td>                        <?= Formatar::prefixEmail($colab->getLogin()) ; ?>                    </td>
                    <td>                        <?= $colab->getLogin(); ?>                    </td>
                    <td>                        <?= $colab->getLast_log_date(); ?>                    </td>
                    <td>                        <?= $colab->getTipo(); ?>                    </td>
                    <td>

                        <form action="configuracao.php?id_menu=controle_tipo_conta" method="post" enctype="multipart/form-data">
                            <select name="tipo" class="" id="tipo_conta_u">
                                <option value="">	</option>
                                <option value="ad">	Administrativo	</option>
                                <option value="fi">	Financeiro	</option>
                                <option value="tec">	Técnico	</option>
                                <option value="rh">	RH / Pessoal	</option>
                                <option value="fi_tec">	Financeiro e Técnico	</option>
                                <option value="fi_rh">	Financeiro e RH	</option>
                                <option value="tec_rh">	Técnico e RH	</option>
                                <option value="fi_tec_rh">	Todos os Centros	</option>

                            </select> 
                            <input type="hidden" name="id_user" value="<?= $colab->getId(); ?>" />
                            <input type="submit" value="Atualizar" name="submitBtn" />
                        </form>
                    </td>                                        
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>    
</div> 
