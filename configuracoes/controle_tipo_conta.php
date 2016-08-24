<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here

        if (isset($_POST['tipo'])) {
            $tipo_conta_user = $_POST['tipo'];
            $id_user = $_POST['id_user'];

            if ((!$tipo_conta_user)) {
                
            } else {

                mysql_query("UPDATE colaboradores SET tipo = '$tipo_conta_user' WHERE id_colaborador ='$id_user'");
            }
        }
        ?>



        <h2>Controle Tipo de Conta</h2>
        <div id="demo">
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
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
                    $consulta_usuarios = mysql_query("select * from colaboradores");
                    $linhaass = mysql_num_rows($consulta_usuarios);

                    while ($row = mysql_fetch_array($consulta_usuarios)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['Login']; ?>
                            </td>
                            <td>
                                <?php echo $row['Email']; ?>
                            </td>
                            <td>
                                <?php echo $row['last_log_date']; ?>
                            </td>
                            <td>
                                <?php echo $row['tipo']; ?>
                            </td>
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
                                    <input type="hidden" name="id_user" value="<?php echo $row['id_colaborador']; ?>" readonly="readonly" />
                                    <input type="submit" value="Atualizar" name="enviar_lembrete" />

                                </form>
                            </td>                                        
                        </tr>

                        <?php
                    }
                    ?>

                </tbody>
            </table>    
        </div> 
    </body>
</html>
