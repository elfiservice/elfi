
<div>
	<h2><a href="tecnico.php?id_menu=cliente">Clientes</a> -> <a href="tecnico.php?id_menu=novo_cliente">Novo</a> -> Salvando</h2>
</div>
<hr>

<?php

//Este código será executado somente se o nome de usuário é Postado
if (isset ($_POST['razao_social']))
    {

    $id_usuario = $_POST['usuario'];  
    
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
	           $cnpj_cpf = $_POST['cpf'];
               $tipo = "PF";
             
         }  else  {
             $cnpj_cpf = $_POST['cnpj'];
             $tipo = "PJ";

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
                
                if ($razao_check > 0)
                {
                  ?>
                    <script type="text/javascript" >
                        alert ("Razao Social ja cadastrada no sistema! \n  Cliente NAO cadastrado.");
                                                exit();
                    </script>
                    
                    <meta http-equiv="refresh" content="0;url=javascript:history.back()" >
                    <a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
                    <?php
                } else if ($fantasia_check > 0){
                  ?>
                    <script type="text/javascript" >
                        alert ("Nome Fantasia ja cadastrada no sistema! \n  Cliente NAO cadastrado.");
                                                exit();
                    </script>
                    
                    <meta http-equiv="refresh" content="0;url=javascript:history.back()" >
                    <a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
                    <?php                
                
                    
                    
                } else if($email_tec_check > 0)  {
                  ?>
                    <script type="text/javascript" >
                        alert ("O Email Tecnico ja cadastrada no sistema! \n  Cliente NAO cadastrado.");
                                                exit();
                    </script>
                    
                    <meta http-equiv="refresh" content="0;url=javascript:history.back()" >
                    <a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
                    <?php                      
                    
                    
                    
                } else if ($cnpj_cpf_check > 0){
                   ?>
                    <script type="text/javascript" >
                        alert ("O CNPJ ou CPF ja cadastrado no sistema! \n  Cliente NAO cadastrado.");
                                            
                    </script>
                    
                    <meta http-equiv="refresh" content="0;url=javascript:history.back()" >
                    <a href="javascript:history.back();" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
                    <?php                     
                    
                    
                    
                    
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
    
   	//limpa CPF e CNPJ
         // $cnpj_cpf =  limpaCPF_CNPJ($cnpj_cpf);
                $cnpj_cpf = Formatar::limpaCPF_CNPJ($cnpj_cpf);
                
              

    // Add user info into the database table for the main site table
     $sql = mysql_query("INSERT INTO clientes (usuario, razao_social, nome_fantasia, classificacao, data_inclusao, ie, endereco, bairro, estado, cidade, cep, tel, cel, fax, email_tec, email_adm_fin, cnpj_cpf, tipo) 
     VALUES('$nome_usuario','$razao_social','$nome_fantasia','$classificacao', now(),'$ie', '$endereco', '$bairro', '$estado', '$cidade', '$cep', '$telefone', '$celular', '$fax', '$email_tec', '$email_admin', '$cnpj_cpf', '$tipo')")  
     or die (mysql_error());         
         
     
    echo "Novo cliente adicionado.";
     
     
     
     ?>
<script type="text/javascript" >
	alert ("Cliente adicionado com Sucesso!");
</script>
    

<a href="tecnico.php" target="_self">Voltar</a>

<!-- <meta http-equiv="refresh" content="1;url=javascript:history.back()" > -->
<?php

    }
  }
 
?>

