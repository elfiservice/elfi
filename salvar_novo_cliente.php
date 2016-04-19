<?php

include_once "/includes/funcoes.php";
/*
class validar
{
function replace($string)
{
return $string = str_replace("/","", str_replace("-","",str_replace(".","",$string)));
}function check_fake($string, $length)
{
for($i = 0; $i <= 9; $i++) {
$fake = str_pad("", $length, $i);
if($string === $fake)
return(1);
}
}function cpf($cpf)
{
$cpf = $this->replace($cpf);
$cpf = trim($cpf);
if(empty($cpf) || strlen($cpf) != 11)
return FALSE;
else{
if($this->check_fake($cpf, 11))
return FALSE;
else{
$sub_cpf = substr($cpf, 0, 9);
for($i = 0; $i <= 9; $i++) {
$dv += ($sub_cpf[$i] * (10-$i));
}
if($dv == 0)
return FALSE;
$dv = 11 - ($dv % 11); 
if($dv > 9)
$dv = 0;
if($cpf[9] != $dv)
return FALSE;$dv *= 2;
for($i = 0; $i <= 9; $i++) {
$dv += ($sub_cpf[$i] * (11-$i));
}
$dv = 11 - ($dv % 11); 
if($dv > 9)
$dv = 0;
if($cpf[10] != $dv)
return FALSE;
return TRUE;
}
}
}function cnpj($cnpj) 
{
$cnpj = $this->replace($cnpj);
$cnpj = trim($cnpj);
if(empty($cnpj) || strlen($cnpj) != 14)
return FALSE;
else{
if($this->check_fake($cnpj, 14))
return FALSE;
else{
$rev_cnpj = strrev(substr($cnpj, 0, 12));
for($i = 0; $i <= 11; $i++) {
$i == 0 ? $multiplier = 2 : $multiplier;
$i == 8 ? $multiplier = 2 : $multiplier;
$multiply = ($rev_cnpj[$i] * $multiplier);
$sum = $sum + $multiply;
$multiplier++;
}
$rest = $sum % 11;
if($rest == 0 || $rest == 1)
$dv1 = 0;
else
$dv1 = 11 - $rest; $sub_cnpj = substr($cnpj, 0, 12);
$rev_cnpj = strrev($sub_cnpj.$dv1);
unset($sum);
for($i = 0; $i <= 12; $i++) {$i == 0 ? $multiplier = 2 : $multiplier;
$i == 8 ? $multiplier = 2 : $multiplier;
$multiply = ($rev_cnpj[$i] * $multiplier);
$sum = $sum + $multiply;
$multiplier++;
}
$rest = $sum % 11;
if($rest == 0 || $rest == 1)
$dv2 = 0;
else
$dv2 = 11 - $rest;if($dv1 == $cnpj[12] && $dv2 == $cnpj[13])
return TRUE;
else
return FALSE;
}
}
}
}

$validate = new validar;

*/

include_once "Config/config_sistema.php"; 


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
             //echo "Pessoa Fisica !!";
             //echo $_POST['cpf'];
               
               $cnpj_cpf = $_POST['cpf'];
               
              /*
               if($validate->cpf($cnpj_cpf)){
                  
               }else{
                   ?>
                    <!--script language="JavaScript">
                   alert ("O CPF é inválido!");
                    </script-->
                   <?php
               }
               */
               
             
             $tipo = "PF";
             //$tipo = utf8_encode($tipo);
         }  else  {
             //echo "Pessoa Juridica!!";
             //echo $_POST['cnpj'];
             $cnpj_cpf = $_POST['cnpj'];

             
             /*
             if($validate->cnpj($cnpj_cpf)){
                  
               }else{
                   ?>
                    <!--script language="JavaScript">
                   alert ("O CNPJ é inválido!");
                    </script-->
                   <?php
               }
             */
             
             $tipo = "PJ";
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
          $cnpj_cpf =  limpaCPF_CNPJ($cnpj_cpf);

                
              

    // Add user info into the database table for the main site table
     $sql = mysql_query("INSERT INTO clientes (usuario, razao_social, nome_fantasia, classificacao, data_inclusao, ie, endereco, bairro, estado, cidade, cep, tel, cel, fax, email_tec, email_adm_fin, cnpj_cpf, tipo) 
     VALUES('$nome_usuario','$razao_social','$nome_fantasia','$classificacao', now(),'$ie', '$endereco', '$bairro', '$estado', '$cidade', '$cep', '$telefone', '$celular', '$fax', '$email_tec', '$email_admin', '$cnpj_cpf', '$tipo')")  
     or die (mysql_error());         
         
     
    echo "Novo cliente adicionado.";
     
     
     
     ?>
                    <script type="text/javascript" >
alert ("Cliente adicionado com Sucesso!");
</script>
    

<a href="javascript:history.back();" target="_self">Voltar</a>

<meta http-equiv="refresh" content="1;url=javascript:history.back()" >
<?php
 /*    
     header("location: financeiro.php"); // Shoot viewer back to the homepage of the site if they try to look here
exit();
          * 
  */
    }
  }
 
?>

