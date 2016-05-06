<?php
include "checkuserlog.php";

include_once "Config/config_sistema.php";

$dyn_www = $_SERVER['HTTP_HOST'];


//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
//$logOptions = ''; // Initialize the logOptions variable that gets printed to the page
// If the session variable and cookie variable are not set this code runs
if (!isset($_SESSION['idx'])) {
    if (!isset($_COOKIE['idCookie'])) {

        include_once 'conectar.php';
        //header("location: conectar.php");
        //exit();
    }
} else {

    /*
      echo $logOptions;
      echo "TA LOGADO CARA!!";
      $id="";
      $email = "";



      $id = $_GET['id_colab'];
      $email_colab = $_GET['email'];
      echo $id .'<br>';
      echo $email_colab;
     */

    $consulta_colab = mysql_query("select * from colaboradores where id_colaborador = '$logOptions_id'");
    $linha_colab = mysql_fetch_object($consulta_colab);
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




            <script type="text/javascript">
            // Chama aba Seu Estado
                $(document).ready(function () {

                    $("#colaborador_logado").load('colaborador_logado.php?id_colaborador=<?php echo $logOptions_id; ?>');


                });

            </script>


        </head>
        <body>


            <div  style="background: url(imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
            </div>

            <h2 style="text-align: center;" >

                Painel Central

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

            <div style="margin:60px 0px 0px 0px;">

                <h3 style="text-align: center;"> Escolha o Setor </h3>
                <br></br>
                <table border="0" cellspacing="2"  align="center" CELLPADDING="5">
                    <thead>
                        <tr align="center">
                            <th><a href="financeiro.php?id_menu=#">Administrativo / Financeiro</a></th>
                            <th><a href="tecnico.php">Técnico</a></th>
                            <th><a href="rh.php">Pessoal / RH</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center" >
                            <td><a href="financeiro.php?id_menu=#"> <img src="imagens/finance.jpg" > </a></td>
                            <td><a href="tecnico.php"> <img src="imagens/tecnico.jpg" > </a></td>
                            <td><a href="rh.php"> <img src="imagens/rh.jpg" > </a></td>
                        </tr>

                    </tbody>
                </table>



            </div>








            <footer>



            </footer>


    <?php
}
?>	

    </body>
</html>
