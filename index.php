<?php
require ('./classes/Config.inc.php');
if (!session_id()) {
    session_start();
}

$login = new Login();
if (!$login->checkLogin()) {
    header("Location: conectar.php");
} else {
    $userlogin = $login->getSession();
}

//var_dump($_SESSION);
$menu = filter_input(INPUT_GET, 'modulo', FILTER_DEFAULT);

$nome_arquivo = basename($_SERVER['PHP_SELF'], '.php');
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
        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
        <link rel="stylesheet" href="css/w3.css">
    </head>
    <body>
        <div  style="background: url(imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
        </div>
        <h2 style="text-align: center;" >   Painel Central  </h2>
        <div class="w3-container" style="">
            <div id="colaborador_logado">
                <?php require './includes/colaborador_logado.inc.php'; ?>
            </div>
            <div style="float: right">
                <?php require './includes/menu_geral.inc.php'; ?>
            </div>
        </div>

        <?php
        //QUERY STRING
        if (!empty($menu)):
            //$includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'modulos' . DIRECTORY_SEPARATOR . strip_tags(trim($menu)) . '/index.php';
        header('Location: ' . DIRECTORY_SEPARATOR . 'modulos' . DIRECTORY_SEPARATOR . strip_tags(trim($menu)));
        else:
            //$includepatch = __DIR__ . DIRECTORY_SEPARATOR . $nome_arquivo . '.php';
            //$includepatch = "";
            ?>
            <section class="w3-container">
                <div class="w3-content">
                    <h3 style="text-align: center;"> Escolha o Setor </h3>
                    <div class="w3-row">
                        <div class="w3-col w3-margin-right  m4 l3 w3-card-2 w3-white">
                            <a href="modulos/tecnico/?id_menu=timeline"> 
                                <img width="100%" src="imagens/tecnico.jpg" > 
                                <div class="w3-container w3-center">
                                    <p>
                                        Técnico
                                    </p>
                                </div>      

                            </a>
                        </div>

<!--                        <div class="w3-col m4 l3 w3-card-2 w3-margin-right w3-white">
                            <a href="modulos/rh/?id_menu=timeline"> 
                                <img width="100%" src="imagens/tecnico.jpg" > 
                                <div class="w3-container w3-center">
                                    <p>
                                        RH
                                    </p>
                                </div>      
                            </a>
                        </div>-->

                    </div>
                </div>
            </section>
        <?php
        endif;
        
//                            if (file_exists($includepatch)):
//                        require_once($includepatch);
//                    elseif($menu == "timeline"):
//                        require_once (__DIR__ . DIRECTORY_SEPARATOR . 'timeline.php');
//                    else:
//                        echo "<div class=\"content notfound\">";
//                        WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$menu}.php!", WS_ERROR);
//                        echo "</div>";
//                    endif;

       //var_dump($includepatch);
        ?>




    </body>
</html>
