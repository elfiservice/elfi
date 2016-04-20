<?php
        include "../checkuserlog.php";
        include_once "../Config/config_sistema.php"; 
        include_once "../classes/controller/UsuarioCtrl.class.php";
        
         //include_once ("salvar_alteracao_orcamento.php");


                $ano_orc = "";
        if(isSet ($_GET['ano_orc'])) {
        
             $ano_orc = $_GET['ano_orc'];
        } 
		
		            $ano_orc_selec="";    
        if(isSet ($_POST['ano'])) {
        
             $ano_orc_selec = $_POST['ano'];
        } 
        
        
		
		$ident_orc="";    
        if(isSet ($_GET['id_orc'])) {
        
             $ident_orc = $_GET['id_orc'];
			 $situcao_orc = $_POST['itens_situcao_orc'];
			 
			$sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$logOptions_id'") or die (mysql_error()); 
			$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $nome_usuario = $linha_usuario->Login;
			 
             mysql_query("UPDATE orcamentos SET situacao_orc = '$situcao_orc' WHERE id ='$ident_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
			 mysql_query("UPDATE orcamentos SET colaborador_orc = '$nome_usuario' WHERE id ='$ident_orc'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
			 
			 ?>
			 
<script type="text/javascript" >
alert ("Orçamento ID <?php echo $ident_orc;?> atualizado para situação <?php echo $situcao_orc;?>!");


</script>
			 
			 <?php
			 
        } 
        
        
        $usuario = new UsuarioCtrl();
?>




<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        
	<meta name="description" content="">
	<meta name="author" content="Elfi Service">

	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="../estilos.css">    


		<!-- style type="text/css">

body {
    color: #012B8B;
    direction: ltr;
    font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
	
    font-size: 12px;
    margin: 0;
    
    padding: 0;
    text-align: left;
    unicode-bidi: embed;
	    margin: 0 auto;
	width:1000px;
}
		</style-->
    
    
<!-- Tabela  -->
<?php include_once '../includes/tabela_no_head.php';?>


    </head>
    <body>

	<div>
		<form action="visualizar_orcamentos.php?ano_orc=<?php echo $ano_orc_selec; ?>" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$consulta_menor_ano_orc = mysql_query("select DISTINCT ano_orc from orcamentos ORDER BY ano_orc DESC");
				while($l = mysql_fetch_array($consulta_menor_ano_orc)) {
				?>
				<option value="<?php echo $l['ano_orc']; ?>"><?php echo $l['ano_orc']; ?></option>
				<?php
				}
				?>
			</select>
			<input style="cursor: pointer;  color:#012B8B; border:1px solid #569ABC;" type="submit" name="logar" value="Buscar" id="logar" style="font: 13px verdana, arial, helvetica, sans-serif; background-color: #D5F8D8"  />
		</form>
	</div>
	<br>
    <div id="demo">
						
							
				
                             <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                                <thead>
                                    <tr>
                                            <th>Nº ORC</th>
                                            <th>Colaborador</th>
                                            <th>Situação</th>                                            
                                            <th>Editar</th>
                                            <th>Razão Social / Nome</th>
                                            <th>Classificação</th>
                                            <th>Data do ORC</th>
                                            <th>CNPJ</th>
                                            <th>Endereço</th>
                                            <th>Bairro</th>
                                            <th>Estado</th>
                                            <th>Cidade</th>
                                            <th>CEP</th>
                                            <th>Contato</th>                                            
                                            <th>Telefone</th>
                                            <th>Celular</th>
                                            <th>Email Técnico</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
            
            <?php
                
                $consulta_usuarios = mysql_query("select * from orcamentos WHERE ano_orc = '$ano_orc' ORDER BY id  DESC");
		$linhaass = mysql_num_rows($consulta_usuarios);
										
		while($row=mysql_fetch_array($consulta_usuarios))
													
                {
            ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['n_orc'].'.'.$row['ano_orc'];?>
                                        </td>
                                        <td>
                                            <?php //echo $row['colaborador_orc'];
            									$user = $usuario->buscarUserPorLogin($row['colaborador_orc']);
            								?>
                                            <a href="#" onclick="window.open('../usuario/perfil.php?id_user=<?php echo $user->getId();  ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                                            	<?php echo $row['colaborador_orc'];?>
                                            </a>                                            
                                        </td>                                        
                                        <td>
                                            
										    <form name="alterar_situcao_orc" action="visualizar_orcamentos.php?ano_orc=<?php echo date('Y');?>&id_orc=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
                                                
                                                
                                                <select name="itens_situcao_orc" id="itens_situcao_orc" class="formFieldsAno">
													<option value="<?php echo $row['situacao_orc'];?>"><?php echo $row['situacao_orc'];?></option>
													<?php include "../lista_situacao_orc.php"; ?>
												</select>
												
												<input type="submit" value="Alterar" name="alterar_situacao" />
                                            </form>
											
											
                                        </td>                                           
                                        <td>
                                            
                                            <!--form name="editar_cliente" action="editar_orcamento.php?id_cliente=<?php echo $row['id'];?>&msg_erro=" method="POST" enctype="multipart/form-data">
                                                
                                                <input type="submit" value="Editar" name="enviar_lembrete" />
                                                
                                            </form-->
											
												<a href="#" onclick="window.open('editar_orcamento.php?id_orc=<?php echo $row['id'];?>&msg_erro=', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
												Editar
												</a>
												<br>
												<a href="#" onclick="window.open('imprimir_orc.php?id_orc=<?php echo $row['id']; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10');">
												Imprimir
												</a>
												
                                            
                                        </td>
                                        
                                        
                                        <td>
                                            <?php echo $row['razao_social_contr'];?>
                                        </td>

                                        <td>
                                            <?php echo $row['atividade'].'-'.$row['classificacao'];?>
                                        </td>
                                                                                <td>
                                           <?php echo $row['data_adicionado_orc'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['cnpj_contr'];?>
                                        </td> 

                                                                                <td>
                                           <?php echo $row['endereco_contr'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['bairro_contr'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo utf8_encode($row['estado_contr']);?>
                                        </td> 
                                                                                <td>
                                           <?php echo utf8_encode($row['cidade_contr']);?>
                                        </td>
                                                                                                                        <td>
                                           <?php echo $row['cep_contr'];?>
                                        </td> 
                                                                                                                        <td>
                                           <?php echo $row['contato_clint'];?>
                                        </td>                                         
                                                                                <td>
                                           <?php echo $row['telefone_contr'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['celular_contr'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['email_contr'];?>
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