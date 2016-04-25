

<?php
 include_once "Config/config_sistema.php"; 
 include_once "includes/funcoes.php";

if(isset($_GET['getClientId'])){  
  $res = mysql_query("select * from clientes where razao_social='".$_GET['getClientId']."'") or die(mysql_error());
  if($inf = mysql_fetch_array($res)){
    echo "formObj.razao_social.value = '".$inf["razao_social"]."';\n";    
    echo "formObj.cnpj.value = '".formatar($inf["cnpj_cpf"])."';\n";    
    echo "formObj.endereco.value = '".$inf["endereco"]."';\n";
    echo "formObj.bairro.value = '".$inf["bairro"]."';\n";     
  

    echo "formObj.cep.value = '".$inf["cep"]."';\n";
    echo "formObj.tel.value = '".$inf["tel"]."';\n";    
    echo "formObj.cel.value = '".$inf["cel"]."';\n";       
    echo "formObj.email_orc.value = '".$inf["email_tec"]."';\n";      
    

        echo  utf8_encode("formObj.city.value = '".$inf["cidade"]."';\n");    
    echo  utf8_encode("formObj.estado.value = '".$inf["estado"]."';\n");    
    
  }else{
    echo "formObj.razao_social.value = '';\n";    
    echo "formObj.cnpj.value = '';\n";    
    echo "formObj.endereco.value = '';\n";
    echo "formObj.bairro.value = '';\n";    
    echo "formObj.cep.value = '';\n";    
    echo "formObj.city.value = '';\n";    
    echo "formObj.estado.value = '';\n";      
    echo "formObj.tel.value = '';\n";    
    echo "formObj.cel.value = '';\n";    
    echo "formObj.email_orc.value = '';\n";      
  }    
}
?>