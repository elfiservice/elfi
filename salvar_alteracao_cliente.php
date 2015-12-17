<?php

include_once "Config/config_sistema.php"; 


//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['razao_social']))
    {

        $id_usuario = $_POST['usuario'];
        
    $id_cliente = $_GET['id_cliente'];
    
     $razao_social = $_POST['razao_social'];
     $nome_fantasia = $_POST['nome_fantasia'];
     $classificacao = $_POST['classificacao'];
     //$cnpj = $_POST['cnpj'];
    // $cpf = $_POST['cpf'];
     $ie = $_POST['ie'];
     $endereco = $_POST['endereco'];
     $bairro = $_POST['bairro'];
     $cep = $_POST['cep'];
     $cod_estado = $_POST['cod_estados'];
     $cod_cidade = $_POST['cod_cidades'];
     $telefone = $_POST['phone'];
     $celular = $_POST['cel'];
     $fax = $_POST['fax'];
     $email_tec = $_POST['email_tec'];   
     $email_admin = $_POST['email_admin'];        
     
           if(isset($_POST['tipo'])) {
             //echo "Pessoa Fisica !!";
             //echo $_POST['cpf'];
             $cnpj_cpf = $_POST['cpf'];
             $tipo = "Pessoa Fisica";
             //$tipo = utf8_encode($tipo);
         }  else  {
             //echo "Pessoa Juridica!!";
             //echo $_POST['cnpj'];
             $cnpj_cpf = $_POST['cnpj'];
             $tipo = "Pessoa Juridica";
             //$tipo = utf8_encode($tipo);
         }
         
         
                  
         	$sql_razao = mysql_query("SELECT * FROM clientes WHERE razao_social='$razao_social'") or die (mysql_error()); 
		$razao_check = mysql_num_rows($sql_razao); 
                
                $sql_fantasia = mysql_query("SELECT * FROM clientes WHERE nome_fantasia='$nome_fantasia'") or die (mysql_error()); 
		$fantasia_check = mysql_num_rows($sql_fantasia); 
                
         	$sql_email_tec = mysql_query("SELECT * FROM clientes WHERE email_tec='$email_tec'") or die (mysql_error()); 
		$email_tec_check = mysql_num_rows($sql_email_tec);
                
                if ($cnpj_cpf == ""){
                    
                    $cnpj_cpf_check = 0;
                    
                }else{
                
         	$sql_cnpj_cpf = mysql_query("SELECT * FROM clientes WHERE cnpj_cpf='$cnpj_cpf'") or die (mysql_error()); 
		$cnpj_cpf_check = mysql_num_rows($sql_cnpj_cpf);                 
                
                }
                
                if ($razao_check > 1)
                {

                ?>
                    <script type="text/javascript" >
                        alert ("Razao Social ja cadastrada no sistema! \n  Cliente NAO cadastrado.");
                                              
                    </script>
                    
                        
                                       
                    <!--a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a-->
                 <?php
                    
                     header("location: editar_cliente.php?id_cliente=$id_cliente&msg_erro=Razao Social ja cadastrada no sistema! Cliente NAO cadastrado."); // Shoot viewer back to the homepage of the site if they try to look here
                     
                    exit();
                    
                    
                } else if ($fantasia_check > 1){
                  ?>
                    <script type="text/javascript" >
                        alert ("Nome Fantasia ja cadastrada no sistema! \n  Cliente NAO cadastrado.");
                                                exit();
                    </script>
                    
                    <?php                
                     header("location: editar_cliente.php?id_cliente=$id_cliente&msg_erro=Nome Fantasia ja cadastrada no sistema! Cliente NAO cadastrado."); // Shoot viewer back to the homepage of the site if they try to look here
                     
                    exit();
                    
                    
                } else if($email_tec_check > 1)  {
                  ?>
                    <script type="text/javascript" >
                        alert ("O Email Tecnico ja cadastrada no sistema! \n  Cliente NAO cadastrado.");
                                                exit();
                    </script>
                    
                    <?php                      
                   header("location: editar_cliente.php?id_cliente=$id_cliente&msg_erro=O Email Tecnico ja cadastrada no sistema! Cliente NAO cadastrado."); // Shoot viewer back to the homepage of the site if they try to look here
                     
                    exit();
                    
                    
                } else if ($cnpj_cpf_check > 1){
                   ?>
                    <script type="text/javascript" >
                        alert ("O CNPJ ou CPF ja cadastrado no sistema! \n  Cliente NAO cadastrado.");
                                            
                    </script>
                    <?php                     
                    header("location: editar_cliente.php?id_cliente=$id_cliente&msg_erro=O CNPJ ou CPF ja cadastrado no sistema! \n  Cliente NAO cadastrado."); // Shoot viewer back to the homepage of the site if they try to look here
                    exit(); 
                    
                    
                    
                }
                else{
         
         
         
         
     
           		$consulta_estado = mysql_query("select * from estados where cod_estados = '$cod_estado'");
			$linha_estado = mysql_fetch_object($consulta_estado);

                        $estado = $linha_estado->nome;
                        
                        $consulta_cidade = mysql_query("select * from cidades where cod_cidades = '$cod_cidade'");
			$linha_cidade = mysql_fetch_object($consulta_cidade);

                        $cidade = $linha_cidade->nome;
         
                  
         	$sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die (mysql_error()); 
		$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $nome_usuario = $linha_usuario->Login; 

                        
                        mysql_query("UPDATE clientes SET razao_social = '$razao_social' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET nome_fantasia = '$nome_fantasia' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET classificacao = '$classificacao' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET ie = '$ie' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET endereco = '$endereco' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET bairro = '$bairro' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET cep = '$cep' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET cnpj_cpf = '$cnpj_cpf' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET tipo = '$tipo' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET tel = '$telefone' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET cel = '$celular' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET fax = '$fax' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET email_tec = '$email_tec' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET email_adm_fin = '$email_admin' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET estado = '$estado' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
                        mysql_query("UPDATE clientes SET cidade = '$cidade' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));
			mysql_query("UPDATE clientes SET usuario = '$nome_usuario' WHERE id ='$id_cliente'")  or die (mysql_error("Ocorreu um erro ao tentar salvar as alterações"));                        
                        
                        
                        
    /*/ Add user info into the database table for the main site table
     $sql = mysql_query("INSERT INTO clientes (razao_social, nome_fantasia, classificacao, data_inclusao, ie, endereco, bairro, estado, cidade, cep, tel, cel, fax, email_tec, email_adm_fin, cnpj_cpf, tipo) 
     VALUES('$razao_social','$nome_fantasia','$classificacao', now(),'$ie', '$endereco', '$bairro', '$estado', '$cidade', '$cep', '$telefone', '$celular', '$fax', '$email_tec', '$email_admin', '$cnpj_cpf', '$tipo')")  
     or die (mysql_error());         
        */ 
     
     //echo "Novo cliente adicionado.";
     
         
?>
<script>
	alert ("Cliente atualizado com sucesso!");
</script>

<?php
    }
    }
?>