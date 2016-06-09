<?php
 

        include "../checkuserlog.php";

        include_once "../Config/config_sistema.php"; 
require '../Config/SistemConfig.php';
		
		$id_orc = "";
        if(isSet ($_GET['id_orc'])) {
        
             $id_orc = $_GET['id_orc'];
        } 
		
			$sql_nome_user = mysql_query("SELECT * FROM orcamentos WHERE id = '$id_orc'") or die (mysql_error()); 
			$linha_usuario = mysql_fetch_object($sql_nome_user);
                
                $cliente = $linha_usuario->razao_social_contr;
				$atividade = $linha_usuario->atividade;
				$classificacao = $linha_usuario->classificacao;
				$inf_servicos = $linha_usuario->descricao_servico_orc;
				//$novo_cliente = $linha_usuario->novo_cliente;
				$n_orc = $linha_usuario->n_orc;
				$ano_orc = $linha_usuario->ano_orc;
				$prazo_exec = $linha_usuario->prazo_exec_orc;
				$email = $linha_usuario->email_contr;
				$data_aprovada = $linha_usuario->data_aprovada;
				
				$data_inicio = $linha_usuario->data_inicio;
				$data_conclusao = $linha_usuario->data_conclusao;
				$feito_pos_entreg = $linha_usuario->feito_pos_entreg;
				$nao_conformidade = $linha_usuario->nao_conformidade;
				$obs_n_conformidad = $linha_usuario->obs_n_conformidad;
				$client_insatisfeito = $linha_usuario->client_insatisfeito;
				$vr_proposta_aprovada = $linha_usuario->vr_total_orc;
				
				
				
				

?>


<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="pt"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="pt"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="pt"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Técnico</title>
        
	<meta name="description" content="">
	<meta name="author" content="Elfi Service">

	<meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../estilos.css">
	
	<style type="text/css">
		#menu {

 
 }
 

#menu ul {
 padding:0px 0px 0px 0px;
 margin:-2px 0px 0px 0px;
 float: left;
 width: 100%;
 list-style:none;
 font: 11px verdana, arial, helvetica, sans-serif;

 
 }

 #menu ul li {display: inline;}

 #menu ul li a{
 padding: 5px 10px;
 margin: 0px 0px;
 float:left;
 /* visual do link */

 
text-decoration: none; 
display: inline-block;
 }

 
  #menu ul li a:hover  {


 }
	
	</style>

<script type="text/javascript">
   function mascaraData(campoData){
              var data = campoData.value;
              if (data.length == 2){
                  data = data + '/';
                  document.forms[0].data.value = data;
      return true;              
              }
              if (data.length == 5){
                  data = data + '/';
                  document.forms[0].data.value = data;
                  return true;
              }
         }
</script>
	
<?php
require '../includes/javascripts/mascaras_campos_valores_monetario.php';
?>
	
	
	</head>
<body>

        <div  style="background: url(../imagens/topo1.png) repeat-x;  padding:5px 0px 30px 0px;">
				</div>

    <?php


		//------ CHECK IF THE USER IS LOGGED IN OR NOT AND GIVE APPROPRIATE OUTPUT -------
		//$logOptions = ''; // Initialize the logOptions variable that gets printed to the page
		// If the session variable and cookie variable are not set this code runs
		if (!isset($_SESSION['idx'])) { 
		  if (!isset($_COOKIE['idCookie'])) {

                                    echo "você não esta conectado!";

  }
} else {

?>	



<a href="javascript:void(0)" onclick="fecha()">Fechar</a>

 <!--

/***********************************************
* Required field(s) validation v1.10- By NavSurf
* Visit Nav Surf at http://navsurf.com
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function formCheck(formobj){
	// Enter name of mandatory fields
	var fieldRequired = Array("clientID", "n_orc", "email_orc", "descricao_servicos", "atividade1", "classificacao1", "novo_cliente", "data", "prz_execucao");
	// Enter field description to appear in the dialog box
	var fieldDescription = Array("Cliente", "Nº do orçamento", "Email","Descrição dos serviços", "Atividade do serviço", "Classificação", "se o cliente é novo", "Data da aprovação", "Prazo de execução");
	// dialog message
	var alertMsg = "Por favor completar os campos:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == "" ){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			case "select-multiple":
				if (obj.selectedIndex == -1){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			case "text":
			case "textarea":
				if (obj.value == "" || obj.value == null || obj.value == "0,00"){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
				break;
			default:
			}
			if (obj.type == undefined){
				var blnchecked = false;
				for (var j = 0; j < obj.length; j++){
					if (obj[j].checked){
						blnchecked = true;
					}
				}
				if (!blnchecked){
					alertMsg += " - " + fieldDescription[i] + "\n";
				}
			}
		}
	}

	if (alertMsg.length == l_Msg){
		return true;
	}else{
		alert(alertMsg);
		return false;
	}
}
// -->
</script>

            <div class="thepet" style="text-align: center;">
                
                 
                
            <form name="clientForm" method="post" action="salvar_orc_editado.php" onsubmit="return formCheck(this);">       

            <fieldset>
            <legend><b>Dados</b></legend>
                <table border="0">
                                <tbody>

                                    <tr align="left">
                                        <td><label for="clientID">Cliente: </label><br>
                 								<?php echo $cliente; ?>                                            
                                        </td>

                                    </tr>
                                <tr align="left">
                                    
                                    <td><label for="n_orc">Nº Orçamento:</label><br>
                                    <!-- input name="n_orc" id="n_orc" value="<?php echo $n_orc; ?>" size="10" maxlength="8"-->
                                    <?php echo $n_orc; //por o ANO depois ?>
                                    </td>
                                 
                                    
                                    
                                </tr> 
                                <!-- tr align="left">
                                    
                                    <td><label for="novo_cliente">Novo cliente? :</label><br>
		<?php
								if ($novo_cliente == 's') {

									?>
                                    <input type="radio" name="novo_cliente" value="s" checked> Sim 
									<input type="radio" name="novo_cliente" value="n"> Não
                                 <?php
									} else {
									
									
?>								 	<input type="radio" name="novo_cliente" value="s" > Sim 
									<input type="radio" name="novo_cliente" value="n" checked> Não
                                    <?php
									}
									?>
									
									</td-->
                                 
                                    
                                    
                                </tr> 	

								<tr align="left">
                                    
                                    <td><label for="data_aprovada">Data Aprovado:</label><br>
										<!-- input type="text" value="<?php echo $data_aprovada; ?>" name="data" id="data" maxlength="10" -->
                                    	<?php $data = explode("-", $data_aprovada);
                                    			echo $data[2]."/".$data[1]."/".$data[0];	
                                    	?>
                                    </td>
									
									<td><label for="data_inicio">Data Inicio:</label><br>
                                                                                <input type="text" value="<?php if($data_inicio == "0000-00-00") {  echo"00000000"; }else{ echo date('d/m/Y', strtotime($data_inicio));} ?>" alt="date" name="data_inicio" id="data_inicio" maxlength="10" >
                                    
                                    </td>
									
									<td><label for="data_aprovada">Data Conclusao:</label><br>
                                                                                <input type="text" alt="date"  value="<?php if($data_conclusao == "0000-00-00") { echo"00000000"; }else{ echo date('d/m/Y', strtotime($data_conclusao));} ?>" name="data_conclusao" id="data_conclusao" maxlength="10" >
                                    
                                    </td>
                                 
                                    <td><label for="nao_conformidade">Não conformidades? :</label><br>
									<?php
								if ($nao_conformidade == 's') {

									?>
                                    <input type="radio" name="nao_conformidade" value="s" checked> Sim 
									<input type="radio" name="nao_conformidade" value="n"> Não
                                 <?php
									} else {
									
									
?>								 	<input type="radio" name="nao_conformidade" value="s" > Sim 
									<input type="radio" name="nao_conformidade" value="n" checked> Não
                                    <?php
									}
									?>
									
									</td>
								<td><label for="nao_conformidade">Cliente insatisfeito? :</label><br>
									<?php
								if ($client_insatisfeito == 's') {

									?>
                                    <input type="radio" name="client_insatisfeito" value="s" checked> Sim 
									<input type="radio" name="client_insatisfeito" value="n"> Não
                                 <?php
									} else {
									
									
?>								 	<input type="radio" name="client_insatisfeito" value="s" > Sim 
									<input type="radio" name="client_insatisfeito" value="n" checked> Não
                                    <?php
									}
									?>
									
									</td>
 								 </tr>

                                <tr align="left">
                                    
								
                                 
                                    
                                    
                                </tr>                                
                                </tbody>
                </table>
           </fieldset>
           
                     <fieldset>
 				
									<label >OBS da não conformidade:</label>
									<textarea  rows="1" cols="100" style="height:1em;" id="text" name="obs_n_conformidad"><?php echo $obs_n_conformidad; ?></textarea>
							    
                         
          </fieldset>
           

						<table border="0">
                            
                               <tr align="left">
                                    <td>
                                        

                                        <input type="submit" value="Atualizar Orçamento" name="salvar_orc" />
                                        <input type="hidden" value="<?php echo date('Y'); ?>" name="ano_atual_orc" hidden="hidden" />
                                        <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
										<input type="hidden" name="id_orc" value="<?php echo $id_orc; ?>" readonly="readonly" />
										<input type="hidden" name="data" value="<?php echo $data_aprovada; ?>" readonly="readonly" />
										<input type="hidden" name="prz_execucao" value="<?php echo $prazo_exec; ?>" readonly="readonly" />
										<input type="hidden" name="email_orc" value="<?php echo $email; ?>" readonly="readonly" />
										<input type="hidden" name="descricao_servicos" value="<?php echo $inf_servicos; ?>" readonly="readonly" />
										<input type="hidden" name="vr_proposta_aprovada" value="<?php echo $vr_proposta_aprovada; ?>" readonly="readonly" />
										<input type="hidden" name="clientID" value="<?php echo $cliente; ?>" readonly="readonly" />
										<input type="hidden" name="n_orc" value="<?php echo $n_orc; ?>" readonly="readonly" />
                                     
                                    </td>

                                 
                                    
                                </tr>

                         </table>
                </form>
                
				
				
				
				
              </div>

<?php
}

?>

</body>
</html>