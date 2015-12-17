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
        
        
        
    </head>
    <body>
        <div>
		<?php
		$id="";
		$email = "";
		 include "checkuserlog.php";
			echo $logOptions;
		
		
		 $id = $_GET['id_colab'];
		 $email_colab = $_GET['email'];
		 echo $id .'<br>';
		 echo $email_colab;
		 
		
		?>
		</div>
        
        opa
    </body>
</html>
