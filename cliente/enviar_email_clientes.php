<div>
    <h2><a href="tecnico.php?id_menu=cliente">Clientes</a> -> Enviar Emails para Todos Clientes</h2>
</div>
<hr>

<?php require 'includes/javascripts/editor_texto.php'; 

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

?>

<form action="" method="post" enctype="multipart/form-data" name="formEnviaEmailClientes">

    <textarea id="wysiwyg" name="editorEnviaEmailTodosClientes"  rows="4" cols="100">
        
    </textarea>

    <input  class="bt_incluir" style="margin-top: 10px"  type="submit" name="enviar_emails_submit" value="Enviar" id="enviar_emails"  />

</form>