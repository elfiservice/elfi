<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'classes/Config.inc.php';
session_start();
$dyn_www = $_SERVER['HTTP_HOST'];

$menu = $_GET['id_menu'];
$erro_senha = "";
?>




<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Configurações</title>

        <meta name="description" content="">
        <meta name="author" content="Elfi Service">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="estilos.css">    

        <script src="js/jquery.min.js" type="text/javascript"></script>




        <script type="text/javascript">
            // Chama aba Seu Estado
            $(document).ready(function () {

                $("#colaborador_logado").load('colaborador_logado.php?id_colaborador=<?php echo $logOptions_id; ?>');


            });

        </script>

        <!-- Menus dorp down  -->

        <link rel="stylesheet" type="text/css" href="js/menus/anylinkmenu.css" />

        <script type="text/javascript" src="js/menus/menucontents.js"></script>

        <script type="text/javascript" src="js/menus/anylinkmenu.js">

            /***********************************************
             * AnyLink JS Drop Down Menu v2.0- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
             * This notice MUST stay intact for legal use
             * Visit Project Page at http://www.dynamicdrive.com/dynamicindex1/dropmenuindex.htm for full source code
             ***********************************************/

        </script>

        <script type="text/javascript">

            //anylinkmenu.init("menu_anchors_class") //Pass in the CSS class of anchor links (that contain a sub menu)
            anylinkmenu.init("menuanchorclass")

        </script>

        <!-- Tabela  -->
        <link rel="stylesheet" href="tabela/demo_page.css">  
        <link rel="stylesheet" href="tabela/demo_table.css">  

        <script type="text/javascript" language="javascript" src="tabela/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="tabela/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8">
            $(document).ready(function () {
                $('#example').dataTable();
            });
        </script>

    </head>
    <body>


        <div  style="background: url(imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
        </div>


        <?php
//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
        $login = (!empty($login) ? $login : $login = new Login());
        if (!$login->checkLogin()) {
        WSErro("VocÊ não esta Logado!", WS_ALERT);
        die();
        } else {
        $userlogin = $login->getSession();
        }
        ?>

        <h2 style="text-align: center;" >

            Configurações

        </h2>


        <div style="">

            <div id="colaborador_logado">

            </div>

            <div style="float: right">
                <?php
                echo $logOptions;
                ?>
            </div>
        </div>

        <?php
        $consulta_colab = mysql_query("select * from colaboradores where id_colaborador = '$logOptions_id'");
        $linha_colab = mysql_fetch_object($consulta_colab);

        $tipo_conta = $linha_colab->tipo;



        if ($tipo_conta == "ad")

        {
        ?>




        <div style="margin:20px 0px 20px 0px;">

            <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">

            </div>


            <div id="menu_paginas">
                <ul>
                    <li><a href="#" class="menuanchorclass myownclass" rel="cadastro_configuracao">Usuários</a></li>

                </ul>
            </div>

            <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">

            </div>



        </div>

        <div style="margin:20px 0px 20px 0px;">



            <?php
//Estrutura para Link Controle Tipo conta Usuário
            if ($menu == "controle_tipo_conta")
            {
//echo "Cadastro usuario aqui";


            if (isset ($_POST['tipo']))
            {

            $tipo_conta_user = $_POST['tipo'];
            $id_user = $_POST['id_user'];

            if((!$tipo_conta_user)){


            }else{

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

                        while($row = mysql_fetch_array($consulta_usuarios))

                        {
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
            <?php
            }


//Estrutura para Link Controle Tipo conta Usuário
            if ($menu == "trocar_senha")
            {
//echo "Cadastro usuario aqui";


            if (isset ($_POST['passatual']))
            {

            $senha_atual = $_POST['passatual'];
            $senha_nova = $_POST['passnova'];
            $senha_nova2 = $_POST['passnova2'];
            $id_user = $_POST['id_user'];

            if((!$senha_atual) || (!$senha_nova) || (!$senha_nova2)){

            $erro_senha = '<span style="color: red;"> Favor preencher todos os campos</span>';

            }else{

            mysql_query("UPDATE colaboradores SET tipo = '$tipo_conta_user' WHERE id_colaborador ='$id_user'");

            }

            }
            ?>



            <h2>Alteração de sua Senha Atual</h2>
            <div id="demo">
                <form action="configuracao.php?id_menu=trocar_senha" method="post" enctype="multipart/form-data" >
                    <table>
                        <tr>
                            <td width="" colspan="2"><?php echo $erro_senha; ?></td>
                        </tr>
                        <tr>
                            <td width="115" valign="top"><p>Senha atual:</p> </td>
                            <td width="" valign="top"><input name="passatual" type="password" id="passatual" maxlength="16"  class="formFieldsTrocasenha" /></td>
                        </tr>
                        <tr>
                            <td width="115" valign="top"><p>Nova senha:</p> </td>
                            <td width="" valign="top"><input name="passnova" type="password" id="passnova" maxlength="16"  class="formFieldsTrocasenha" /></td>
                        </tr>
                        <tr>
                            <td width="115" valign="top"><p>Repita nova senha:</p> </td>
                            <td width="" valign="top"><input name="passnova2" type="password" id="passnova2" maxlength="16"  class="formFieldsTrocasenha" /></td>
                        </tr>
                        <tr  align="center">
                            <td COLSPAN="" ></td>
                            <td COLSPAN="" >
                                <input type="submit" value="Atualizar" name="enviar_lembrete" style="cursor:pointer; padding: 5px 10px; color:#fff; border:1px solid #000; background-color: rgb(59, 89, 152); "/>
                                <input type="hidden" name="id_user" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
                            </td>
                        </tr>


                    </table>
                </form>
            </div>  






            <?php
            }
            ?>       

        </div> 





        <?php
        }else if($tipo_conta <> "ad"){
        ?>




        <div style="margin:20px 0px 20px 0px;">

            <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">

            </div>


            <div id="menu_paginas">
                <ul>
                    <li><a href="#" class="menuanchorclass myownclass" rel="usuarios_nao_admin">Usuários</a></li>

                </ul>
            </div>

            <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">

            </div>



        </div>

        <div style="margin:20px 0px 20px 0px;">



            <?php
//Estrutura para Link Controle Tipo conta Usuário
            if ($menu == "trocar_senha")
            {
//echo "Cadastro usuario aqui";


            if (isset ($_POST['passatual']))
            {

            $senha_atual = $_POST['passatual'];
            $senha_nova = $_POST['passnova'];
            $senha_nova2 = $_POST['passnova2'];
            $id_user = $_POST['id_user'];

            if((!$senha_atual) || (!$senha_nova) || (!$senha_nova2)){

            $erro_senha = '<span style="color: red;"> Favor preencher todos os campos</span>';

            }else{

            mysql_query("UPDATE colaboradores SET tipo = '$tipo_conta_user' WHERE id_colaborador ='$id_user'");

            }

            }
            ?>



            <h2>Alteração de sua Senha Atual</h2>
            <div id="demo">
                <form action="configuracao.php?id_menu=trocar_senha" method="post" enctype="multipart/form-data" >
                    <table>
                        <tr>
                            <td width="" colspan="2"><?php echo $erro_senha; ?></td>
                        </tr>
                        <tr>
                            <td width="115" valign="top"><p>Senha atual:</p> </td>
                            <td width="" valign="top"><input name="passatual" type="password" id="passatual" maxlength="16"  class="formFieldsTrocasenha" /></td>
                        </tr>
                        <tr>
                            <td width="115" valign="top"><p>Nova senha:</p> </td>
                            <td width="" valign="top"><input name="passnova" type="password" id="passnova" maxlength="16"  class="formFieldsTrocasenha" /></td>
                        </tr>
                        <tr>
                            <td width="115" valign="top"><p>Repita nova senha:</p> </td>
                            <td width="" valign="top"><input name="passnova2" type="password" id="passnova2" maxlength="16"  class="formFieldsTrocasenha" /></td>
                        </tr>
                        <tr  align="center">
                            <td COLSPAN="" ></td>
                            <td COLSPAN="" >
                                <input type="submit" value="Atualizar" name="enviar_lembrete" style="cursor:pointer; padding: 5px 10px; color:#fff; border:1px solid #000; background-color: rgb(59, 89, 152); "/>
                                <input type="hidden" name="id_user" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
                            </td>
                        </tr>


                    </table>
                </form>
            </div>  



        </div> 


        <?php
        }

        }else{

        echo '<p>Acesso restrito.</p>';


        }

        ?>	

    </body>
</html>
