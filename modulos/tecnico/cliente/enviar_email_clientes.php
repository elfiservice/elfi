<div>
    <h2><?php include_once 'cliente/includes/nav_wizard.php'; ?> -> Enviar Emails para Todos Clientes</h2>
</div>
<hr>

<?php
require '../../includes/javascripts/editor_texto.php';


$clienteCtrl = new ClienteCtrl();
$clientes = $clienteCtrl->buscarBD("*", "WHERE mostrar = '1' ");

if (filter_has_var(INPUT_POST, "enviar_emails_submit")) {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    unset($dados['enviar_emails_submit']);
    $clienteCtrl->enviarEmailTodosClientes($dados);
}
?>
<section class="w3-container">

    <div class="w3-content">
        <h3>Enviando para <b><?= count($clientes) ?></b> clientes</h3>
    </div>

    <section class="w3-content">
        <form class="w3-row" action="" method="post" enctype="multipart/form-data" name="formEnviaEmailClientes">

            <label >Assunto</label>
            <input value="<?= (isset($dados['assunto']) ? $dados['assunto'] : "") ?>" style="margin-bottom: 10px;" type="text" name="assunto" size="50" maxlength="50" required>

            <textarea id="wysiwyg" name="mensagem"  rows="4" style="width: 100% " required>
                <?= (isset($dados['mensagem']) ? $dados['mensagem'] : "") ?>
            </textarea>

            <input  class="bt_incluir" style="margin-top: 10px"  type="submit" name="enviar_emails_submit" value="Enviar" id="enviar_emails"  />

        </form>
    </section>

</section>