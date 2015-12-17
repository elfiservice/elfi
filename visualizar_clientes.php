<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
        include "checkuserlog.php";

        include_once "Config/config_sistema.php"; 
        
        
         include_once ("salvar_alteracao_cliente.php");


        
        
        
        
        

?>




<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Financeiro</title>
        
	<meta name="description" content="">
	<meta name="author" content="Elfi Service">

	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="estilos1.css">    


		<style type="text/css">

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
		</style>
    
    
<!-- Tabela  -->
<link rel="stylesheet" href="tabela/demo_page.css">  
<link rel="stylesheet" href="tabela/demo_table.css">  

		<script type="text/javascript" language="javascript" src="tabela/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="tabela/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable();
			} );
		</script>


    </head>
    <body>

            
                
                  
                
                <div id="demo">
                             <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                                <thead>
                                    <tr>
                                            <th>Cod.</th>
                                            <th>Colaborador</th>
                                            <th>Editar</th>
                                            <th>Razão Social / Nome</th>
                                            <th>Nome Fantasia</th>
                                            <th>Classificação</th>
                                            <th>Data do Cadastro</th>
                                            <th>CNPJ / CPF</th>
                                            <th>Inscrição Estadual</th>
                                            <th>Endereço</th>
                                            <th>Bairro</th>
                                            <th>Estado</th>
                                            <th>Cidade</th>
                                            <th>CEP</th>
                                            <th>Telefone</th>
                                            <th>Celular</th>
                                            <th>FAX</th>
                                            <th>Email Técnico</th>
                                            <th>Email Financeiro/Admin.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
            
            <?php
                
                $consulta_usuarios = mysql_query("select * from clientes");
		$linhaass = mysql_num_rows($consulta_usuarios);
										
		while($row=mysql_fetch_array($consulta_usuarios))
													
                {
            ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['id'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['usuario'];?>
                                        </td>                                        
                                        
                                        <td>
                                            
                                            <form name="editar_cliente" action="editar_cliente.php?id_cliente=<?php echo $row['id'];?>&msg_erro=" method="POST" enctype="multipart/form-data">
                                                
                                                <input type="submit" value="Editar" name="enviar_lembrete" />
                                                
                                            </form>
                                            
                                        </td>
                                        
                                        
                                        <td>
                                            <?php echo $row['razao_social'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['nome_fantasia'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['classificacao'];?>
                                        </td>
                                                                                <td>
                                           <?php echo $row['data_inclusao'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['cnpj_cpf'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['ie'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['endereco'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['bairro'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo utf8_encode($row['estado']);?>
                                        </td> 
                                                                                <td>
                                           <?php echo utf8_encode($row['cidade']);?>
                                        </td>
                                                                                                                        <td>
                                           <?php echo $row['cep'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['tel'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['cel'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['fax'];?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['email_tec'];?>
                                        </td>                                         
                                                                                <td>
                                           <?php echo $row['email_adm_fin'];?>
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