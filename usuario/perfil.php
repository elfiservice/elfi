<?php
include "../checkuserlog.php";


//include_once "../classes/controller/UsuarioCtrl.class.php";
//include_once "../classes/controller/OrcamentosCtrl.class.php";
require '../classes/Config.inc.php';

if (!isset($_SESSION['idx'])) { 			//TESTE para saber se esta LOGADO!
	if (!isset($_COOKIE['idCookie'])) {

		//header("location: ../index.php");
		echo "Você não esta Logado!!";
	}
} else {
	
	$id_user = filter_input(INPUT_GET, 'id_user', FILTER_VALIDATE_INT);
	if(!$id_user) {
	
            WSErro("Erro na URL!", WS_ERROR);
            die();
	}
	
	$orc_ctrl = new OrcamentoCtrl();
        
                    $colabCtrl = new ColaboradorCtrl();
                    $user = $colabCtrl->buscarColaborador("*", "where id_colaborador = $id_user");

?>
<!doctype html>
<html class="no-js" lang="pt"> <!--<![endif]-->
<head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Perfil Usuario</title>
        
		<meta name="description" content="">
		<meta name="author" content="Elfi Service">

		<meta name="viewport" content="width=device-width,initial-scale=1">
    	<link rel="stylesheet" href="../estilos.css">
    	
    	<?php include_once '../includes/javascripts/tabela_no_head.php';?>
    	
</head>
<body>
<div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;"></div>


<div>
	<h2>Colaborador</h2>
</div>
<hr>
<?php
    if($user){
    foreach ($user as $usuario){
?>

<fieldset>
	<legend><b>Dados do Usuario: <?php echo $usuario->getLogin();?></b></legend>
		<table>
			<tr>
				<td>Email:</td>
				<td><?php echo $usuario->getEmail();?></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td><?php if($_SESSION['id'] == $id_user){echo $usuario->getCpf();}?></td>
			</tr>
			<tr>
				<td>Ultimo Log:</td>
				<td><?php echo date('d/m/Y \á\s H:m', strtotime($usuario->getUltDataLogado()));?></td>
			</tr>
			<tr>
				<td>Nº de Orçamentos feitos:</td>
				<td><?php echo $orc_ctrl->nDeOrcPorUsuario($usuario->getLogin());?></td>
			</tr>
			<tr>
				<td>Nº de Orçamentos que esta acompanhando:</td>
				<td><?php echo $orc_ctrl->nOrcUsuarioAcompanhando($usuario->getLogin());?></td>
			</tr>
			<tr>
				<td>Nº de Hitoricos em Orçamentos Não Aprovados:</td>
				<td><?php echo $orc_ctrl->nOrcNAprovadoPorUsuarioAcompanhando($usuario->getLogin());?></td>
			</tr>
			<tr>
				<td>Nº de Historicos em Orçamentos Aprovados:</td>
				<td><?php echo $orc_ctrl->nOrcAprovadoPorUsuarioAcompanhando($usuario->getLogin());?></td>
			</tr>
			
		</table>
		
		
		
		
</fieldset>
</body>
</html>



<?php 
}
    }else{
        echo "Usuario não encontrado.";
    }
}//fecha o else do $_SESSION

?>