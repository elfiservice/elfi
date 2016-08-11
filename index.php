<?php
require ('./classes/Config.inc.php');
session_start();

$login = new Login();

if (!$login->checkLogin()) {
    unset($_SESSION['userlogin']);
    header("Location: conectar.php");
} else {
    $userlogin = $_SESSION['userlogin'];
}

//var_dump($_SESSION);
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
        <h2 style="text-align: center;" >   Painel Central  </h2>
        <div style="">
            <div id="colaborador_logado">
                <?php require './includes/colaborador_logado.inc.php'; ?>
            </div>
            <div style="float: right">
                    <?php require './includes/menu_geral.inc.php'; ?>
            </div>
        </div>
        <div style="margin:60px 0px 0px 0px;">
            <h3 style="text-align: center;"> Escolha o Setor </h3>
            <br></br>
            <table border="0" cellspacing="2"  align="center" CELLPADDING="5">
                <thead>
                    <tr align="center">
                        <th><a href="financeiro.php?id_menu=#">Administrativo / Financeiro</a></th>
                        <th><a href="tecnico.php?id_menu=timeline">Técnico</a></th>
                        <th><a href="rh.php">Pessoal / RH</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr align="center" >
                        <td><a href="financeiro.php?id_menu=#"> <img src="imagens/finance.jpg" > </a></td>
                        <td><a href="tecnico.php?id_menu=timeline"> <img src="imagens/tecnico.jpg" > </a></td>
                        <td><a href="rh.php"> <img src="imagens/rh.jpg" > </a></td>
                    </tr>

                </tbody>
            </table>
 </div>
    </body>
</html>
