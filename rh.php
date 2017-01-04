<?php
require 'classes/Config.inc.php';
session_start();

$menu = filter_input(INPUT_GET, 'id_menu', FILTER_DEFAULT);

$nome_arquivo = "rh";
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | RH</title>

        <meta name="description" content="">
        <meta name="author" content="Elfi Service">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="estilos.css">    

        <!-- Menus dorp down  -->
        <?php require_once './includes/javascripts/menu_dropdown.php'; ?>

        <!-- Tabela  -->
        <?php require_once './includes/javascripts/tabela_no_head.php'; ?>

    </head>
    <body>

        <div  style="background: url(imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"> </div>

        <?php
//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
        $login = (!empty($login) ? $login : $login = new Login());
        if (!$login->checkLogin()) {
            header("Location: conectar.php");
        } else {
            $userlogin = $login->getSession();
        }
        ?>

        <h2 style="text-align: center;" >RH</h2>
        <div style="">
            <div id="colaborador_logado">
                <?php require './includes/colaborador_logado.inc.php'; ?>
            </div>
            <div style="float: right">
                <?php require './includes/menu_geral.inc.php'; ?>
            </div>
        </div>

        <?php
        $tipo_conta = $userlogin->getTipo();

        if ($tipo_conta == "ad" && $userlogin->getId_colaborador() == 1) {
            ?>
            <div style="margin:20px 0px 20px 0px;">
                <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">           </div>
                <div id="menu_paginas">
                    <ul>
                        <li><a href="#" class="menuanchorclass myownclass" rel="cadastro_configuracao">Colaboradores</a></li>
                    </ul>
                </div>
                <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">              </div>
            </div>

            <div style="margin:20px 0px 20px 0px;">

                <div id="painel">
                    <?php
                    //QUERY STRING
                    if (!empty($menu)):
                        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . $nome_arquivo . DIRECTORY_SEPARATOR . strip_tags(trim($menu) . '.php');
                    else:
                        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . $nome_arquivo .'.php';
                    endif;

                    if (file_exists($includepatch)):
                        require_once($includepatch);
                    else:
                        echo "<div class=\"content notfound\">";
                        WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$menu}.php!", WS_ERROR);
                        echo "</div>";
                    endif;
                    ?>
                </div> <!-- painel -->

            </div> 

            <?php
        } else if ($tipo_conta == "ad") {
            ?>

            <div style="margin:20px 0px 20px 0px;">
                <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">                </div>

                <div id="menu_paginas">
                    <ul>
                        <li><a href="#" class="menuanchorclass myownclass" rel="usuarios_nao_admin">Usuários</a></li>
                    </ul>
                </div>
                <div class="barra_menu" style="background: #012B8B; text-align:center; padding:5px 0px 0px 0px;">
                </div>
            </div>

            <div style="margin:20px 0px 20px 0px;">
                <div id="painel">
                    <?php
                    //QUERY STRING
                    if (!empty($menu)):
                        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . $nome_arquivo . DIRECTORY_SEPARATOR . strip_tags(trim($menu) . '.php');
                    else:
                        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . $nome_arquivo . '.php';
                    endif;

                    if (file_exists($includepatch)):
                        require_once($includepatch);
                    else:
                        echo "<div class=\"content notfound\">";
                        WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$menu}.php!", WS_ERROR);
                        echo "</div>";
                    endif;
                    ?>
                </div> <!-- painel -->

            </div>

            <?php
        } else if ($tipo_conta <> "ad") {

            WSErro("Acesso Restrito para seu tipo de Usuario!", WS_ALERT);
        }
        ?>	

    </body>
</html>
