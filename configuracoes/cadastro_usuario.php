
<h2>Usuários Cadastrados no Sistema</h2>
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
            $colabCtrl = new ColaboradorCtrl();
            $colabs = $colabCtrl->buscarBD("*", "");

            foreach ($colabs as $colab) {
                ?>
                <tr>
                    <td>                        <?= $colab->getLogin(); ?>                    </td>
                    <td>                        <?= $colab->getEmail(); ?>                    </td>
                    <td>                        <?= $colab->getLast_log_date(); ?>                    </td>
                    <td>                        <?= $colab->getTipo(); ?>                    </td>
                    <td>
                    </td>                                        
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>    
</div> 

<h2>Cadastrar Novo</h2>
<div id="cadastro_novo_user">
    <?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (isset($dados['submitBtn'])) {
    unset($dados['submitBtn']);
    extract($dados);
    
    $novo_colab_obj = new Colaborador("", $Login, md5($Senha), "", "", "0000-00-00 00:00:00", $Email, 0);
//    var_dump($novo_colab_obj);
//    die;
    
    $colabCtrl = new ColaboradorCtrl();
    if($colabCtrl->inserirBD($novo_colab_obj)){
        WSErro("Cadastro realizado com Sucesso!", WS_ACCEPT);
        $dados[]= null;
    }
    
   
}
?>
    <form method="post" action="configuracao.php?id_menu=cadastro_usuario">
        <label>Login </label>
        <input type="text" name="Login" required maxlength="20"/><small> sem espaços</small>
        <br><br>
        <label>Email </label>
        <input type="email" name="Email" required maxlength="100"/><small> sem espaços</small>   
                <br><br>
        <label>Senha </label>
        <input type="password" name="Senha" required maxlength="8"/><small> ate 8 caracteres</small> 
        <br>
        <br>
        <input type="submit" value="Cadastrar" name="submitBtn" />
    </form>
</div> 