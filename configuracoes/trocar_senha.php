        <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados['submitBtn'])) {
            unset($dados['submitBtn']);
            
            $colabCtrl = new ColaboradorCtrl();
            $colabCtrl->alterarSenha($dados, $userlogin);
              
        }
        ?>

        <h2>Alteração de sua Senha Atual</h2>
        <div id="demo">
            <form action="configuracao.php?id_menu=trocar_senha" method="post" enctype="multipart/form-data" >
                <table>
                    <tr>
                        <td width="115" valign="top"><p>Senha atual:</p> </td>
                        <td width="" valign="top"><input name="passatual" type="password" id="passatual" maxlength="16"  /></td>
                    </tr>
                    <tr>
                        <td width="115" valign="top"><p>Nova senha:</p> </td>
                        <td width="" valign="top"><input name="passnova" type="password" id="passnova" maxlength="16"  /></td>
                    </tr>
                    <tr>
                        <td width="115" valign="top"><p>Repita nova senha:</p> </td>
                        <td width="" valign="top"><input name="passnova2" type="password" id="passnova2" maxlength="16"  /></td>
                    </tr>
                    <tr  align="center">
                        <td></td>
                        <td>
                            <input type="submit" value="Atualizar" name="submitBtn" style="cursor:pointer; padding: 5px 10px; color:#fff; border:1px solid #000; background-color: rgb(59, 89, 152); "/>
                            <input type="hidden" name="id_user" value="<?= $userlogin->getId_colaborador(); ?>"  />
                        </td>
                    </tr>


                </table>
            </form>
        </div>  
