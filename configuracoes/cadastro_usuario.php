
<h2>Usuários Cadastrados no Sistema</h2>
<div id="demo">
    <table class="display" id="example">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Colaborador</th>                
                <th>Ultimo Login</th>
                <th>Tipo Conta</th>
                <th>Ativo</th>                
                <th>Alterar Conta</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $userCtrl = new UsuarioCtrl();
            $colabs = $userCtrl->buscarBD("*", "");

            foreach ($colabs as $colab) {
                ?>
                <tr>
                    <td><?= $colab->getLogin(); ?> </td>
                    <td><?= $colab->getId_colaborador(); ?> </td>
                    <td><?= $colab->getLast_log_date(); ?></td>
                    <td><?= $colab->getTipo(); ?></td>
                    <td><?= ($colab->getAtivo() == "0" ? "Não" : "Sim") ?></td>                    
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

        //$novo_colab_obj = new Colaborador("", $Login, md5($Senha), "", "", "0000-00-00 00:00:00", $Email, 0);
        $novo_usuarioObj = new Usuario("", "", $Email, md5($Senha), "", 0);

        if ($userCtrl->inserirBD($novo_usuarioObj)) {
            WSErro("Cadastro realizado com Sucesso!", WS_ACCEPT);
            $dados[] = null;
        }
    }
    ?>
    <form method="post" action="configuracao.php?id_menu=cadastro_usuario">

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