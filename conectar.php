<?php
// Initialize some vars
//include './classes/Config.inc.php';
$link_estado = "";
$errorMsg = '';
$email = '';
$pass = '';
$remember = '';
if (isset($_POST['email'])) {

    $email = $_POST['email'];
    //echo $email;
    $pass = $_POST['pass'];
    if (isset($_POST['remember'])) {
        $remember = $_POST['remember'];
    }
    $email = stripslashes($email);
    $pass = stripslashes($pass);
    $email = strip_tags($email);
    $pass = strip_tags($pass);

    // error handling conditional checks go here
    if ((!$email) || (!$pass)) {

        $errorMsg = 'Preencha por favor ambos os campos';
    } else { // Error handling is complete so process the info if no errors
        //echo "oi";
        session_start();
        include 'Config/config_sistema.php'; // Connect to the database
        $email = mysql_real_escape_string($email); // After we connect, we secure the string before adding to query
        //$pass = mysql_real_escape_string($pass); // After we connect, we secure the string before adding to query
        $pass = md5($pass); // Add MD5 Hash to the password variable they supplied after filtering it
        // Make the SQL query
        $sql = mysql_query("SELECT * FROM colaboradores WHERE Email='$email' AND Senha='$pass' ") or die(mysql_error());
        $login_check = mysql_num_rows($sql);
        // If login check number is greater than 0 (meaning they do exist and are activated)
        if ($login_check > 0) {
            while ($row = mysql_fetch_array($sql)) {

                // Pleae note: Adam removed all of the session_register() functions cuz they were deprecated and
                // he made the scripts to where they operate universally the same on all modern PHP versions(PHP 4.0  thru 5.3+)
                // Create session var for their raw id
                $id = $row["id_colaborador"];
                $_SESSION['id'] = $id;
                // Create the idx session var
                $_SESSION['idx'] = base64_encode("g4p3h9xfn8sq03hs2234$id");
                // Create session var for their username
                $username = $row["Login"];
                $_SESSION['Login'] = $username;
                $_SESSION['tipo_user'] = $row["tipo"];

                mysql_query("UPDATE colaboradores SET last_log_date=now() WHERE id_colaborador = '$id' LIMIT 1");
            } // close while
            // Remember Me Section
            if ($remember == "yes") {
                $encryptedID = base64_encode("g4enm2c0c4y3dn3727553$id");
                setcookie("idCookie", $encryptedID, time() + 60 * 60 * 24 * 100, "/"); // Cookie set to expire in about 30 days
                setcookie("passCookie", $pass, time() + 60 * 60 * 24 * 100, "/"); // Cookie set to expire in about 30 days
            }
            // All good they are logged in, send them to homepage then exit script

            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            include './classes/Config.inc.php';
            LogCtrl::inserirLog($_SESSION['id'], "Colaborador logado", $_SESSION['tipo_user']);

            $header = header("location: index.php");


            exit();
        } else { // Run this code if login_check is equal to 0 meaning they do not exist
            $errorMsg = "Dados incorretos, por favor tente novamente";
        }
    } // Close else after error checks
} //Close if (isset ($_POST['uname'])){
//echo $_POST['email'];
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

            <h2 style="text-align: center;" >

                Acesso ao Sistema Integrado da ELFI SERVICE para os Colaboradores

            </h2>

        </div>
        <form action="conectar.php" method="POST" enctype="multipart/form-data" name="formlogin">
            <table align="center">

                <tr style = "vertical-align: top;">
                    <td COLSPAN="2" height = "20" style = "padding: 0 0 0 11px;">
                        <span style="font: 11px verdana, arial, helvetica, sans-serif; color: red; width:0px; padding: 0px 0px 0px 0px; margin: 0px 0px 0px 0px;"> <?php echo $errorMsg; ?> </span>
                    </td>
                </tr>
                <tr>
                    <td style = "padding: 0 0 0 11px;">
                        <span style=" color:#012B8B; font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;  text-align: center;">Email </span>
                    </td>

                    <td style = "padding: 0 0 0 11px;">
                        <span style=" color:#012B8B; font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;  text-align: right;">Senha </span>
                    </td>
                </tr>

                <tr>
                    <td style = "padding: 0 0 0 11px;">
                        <label for="textfield"></label>
                        <input name="email" type="text" id="email" maxlength="200" style=" width: 169px; border:1px dotted #ffffff;  background-color: #F0F2F9" />
                    </td>
                    <td style = "padding: 0 0 0 11px;">
                        <label for="label"></label>
                        <input name="pass" type="password" id="pass" maxlength="16"  style=" width: 169px; border:1px dotted #ffffff; background-color: #F0F2F9" />
                    </td>
                    <td style = "padding: 0 0 0 11px;">
                        <label for="Submit"></label>
                        <input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Entrar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
                    </td>								
                </tr>						

                <tr>
                    <td style = "padding: 0 0 0 11px;">
                        <input name="remember" type="checkbox" id="remember" value="yes" />
                        <span style=" color:#012B8B; font: 11px 'lucida grande',tahoma,verdana,arial,sans-serif; text-align: right;">Mantenha-me conectado</span>
                    </td>
                    <td style = "padding: 0 0 0 11px;">
                        <a href="senha.php" class="style3" style="cursor:pointer; color:#012B8B; font: 11px 'lucida grande',tahoma,verdana,arial,sans-serif;">Esqueceu sua Senha?</a>
                    </td>
                </tr>
            </table>




        </form>
    </body>
</html>
