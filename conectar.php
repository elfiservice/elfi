<?php

include './classes/Config.inc.php';

?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI</title>

        <meta name="description" content="">
        <meta name="author" content="Elfi Service">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="estilos.css">    

        <script src="js/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div  style="background: url(imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
        </div>        
        <div >
            <h2 style="text-align: center;" >Acesso ao Sistema Integrado da ELFI SERVICE para os Colaboradores  </h2>
        </div>
        <?php
        session_start();
        $login = new Login();

        if ($login->checkLogin()) {
            header('Location: index.php');
        }

        $dataLogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($dataLogin['logar'])) {
            $login->exeLogin($dataLogin);

            if (!$login->getResult()) {
                WSErro($login->getError()[0], $login->getError()[1]);
            } else {
                header('Location: index.php');
            }
        }

        ?>

        <form name="AdminLoginForm" action="" method="post">
            <table align="center">
                <tr>
                    <td><span>Email </span>                    </td>
                    <td><span>Senha </span>                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td><input name="login" type="email" id="login" maxlength="200"  />                    </td>
                    <td><input name="senha" type="password" id="senha" maxlength="16"  />                    </td>
                    <td> <input type="submit" name="logar" value="Entrar" id="logar"   />                    </td>								
                </tr>						
                <tr>
<!--                    <td>
                        <input name="remember" type="checkbox" id="remember" value="yes" />
                        <span>Mantenha-me conectado</span>
                    </td>-->
                    <td>
                        <a href="#" >Esqueceu sua Senha?</a>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </body>
</html>
