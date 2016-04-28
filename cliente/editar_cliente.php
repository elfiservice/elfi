<?php


?>




    

<!-- MAscaras em campos -->
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/mascara/jquery.meio.mask.js" charset="utf-8"></script>
<script type="text/javascript" >
  (function($){
    // call setMask function on the document.ready event
      $(function(){
        $('input:text').setMask();
      }
    );
  })(jQuery);
</script>        
              
                
<!--
DESABILITAR CAMPOS COM CHECKBOX
-->
<script type="text/javascript" src="js/desabilitar/jquery-latest.js"></script>
<script type="text/javascript">
function toggleStatus() {


    if ($('#toggleElement').is(':checked')) {
        $('#elementsToOperateOn :input').attr('disabled', true);
		$('#elementsToOperateOn2 :input').removeAttr('disabled');
		
		
    } else {
        $('#elementsToOperateOn :input').removeAttr('disabled');
		$('#elementsToOperateOn2 :input').attr('disabled', true);
    }   
}
</script>


         <script language="JavaScript">


/***********************************************
* Required field(s) validation v1.10- By NavSurf
* Visit Nav Surf at http://navsurf.com
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function formCheck(formobj){
	// Enter name of mandatory fields
	var fieldRequired = Array("razao_social", "nome_fantasia", "endereco", "bairro", "cod_estados", "cod_cidades", "phone");
	// Enter field description to appear in the dialog box
	var fieldDescription = Array("Razão Social", "Nome Fantasia", "Endereço", "Bairro", "Estado", "Cidade", "Telefone");
	// dialog message
	var alertMsg = "Por favor completar os campos:\n";
	
	var l_Msg = alertMsg.length;
	
	for (var i = 0; i < fieldRequired.length; i++){
		var obj = formobj.elements[fieldRequired[i]];
		if (obj){
			switch(obj.type){
			case "select-one":
				if (obj.selectedIndex == -1 || obj.options[obj.selectedIndex].text == ""){
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
				if (obj.value == "" || obj.value == null){
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

</script>

<?php

$id_cliente = $_GET['id_cliente'];

$mens_erro = $_GET['msg_erro'];

           		$consulta_cliente = mysql_query("select * from clientes where id = '$id_cliente'");
			$linha_cliente = mysql_fetch_object($consulta_cliente);
if(mysql_num_rows($consulta_cliente)> 0){
                        //$estado = $linha_cliente->nome;

?>

<div>
	<h2>Clientes -> Editar</h2>
</div>
<hr>


<div STYLE="font-size: 16px; text-align: center; margin-top: 10px; color: red;">
    
    <?php echo $mens_erro; ?>
</div>
                
                <div id="demo">
                <form method="post" action="tecnico.php?id_menu=salvar_editar_cliente&id_cliente=<?=$id_cliente?>" onsubmit="return formCheck(this);">       


                <table border="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <?php 
                                                if ($linha_cliente->tipo == "PF")
                                                {
                                                    ?>
                                            <p>Pessoa física <input id="toggleElement" type="checkbox" name="tipo"  onchange="toggleStatus()" checked/></p>
                                            <?php
                                                    
                                                } else {
                                            ?>
                                                 
                                                <p>Pessoa física <input id="toggleElement" type="checkbox" name="tipo"  onchange="toggleStatus()" /></p>
                                            
                                            <?php        
                                                }
                                            
                                            ?>
                                            
                                            
                                        </th>
                                        <th COLSPAN="3">Classificação 
                                            <select name="classificacao">
                                                                                        <?php 
                                                if ($linha_cliente->classificacao == "padrao")
                                                {
                                                    ?>
                                                            <option selected value="padrao">Padrão</option>
                                                            <option value="contrato">Contrato</option>                                            
                                            <?php
                                                    
                                                } else if($linha_cliente->classificacao == "contrato") {
                                            ?>
                                                 
                                                            <option value="padrao">Padrão</option>
                                                            <option selected value="contrato">Contrato</option>                                                
                                            
                                            <?php        
                                                }else{
                                                    ?>
                                                            <option selected value="padrao">Padrão</option>
                                                            <option value="contrato">Contrato</option>                                            
                                            <?php
                                                }
                                            
                                            ?>    
 
                                           </select>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="label">Razão Social / Nome </td>
                                        <td class="input" COLSPAN="3"><input type="text" name="razao_social" value="<?php echo $linha_cliente->razao_social; ?>" size="50px" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" /> </td>

                                    </tr>
                                    <tr>
                                        <td class="label">Nome Fantasia </td>
                                        <td class="input" COLSPAN="3"><input type="text" name="nome_fantasia" value="<?php echo $linha_cliente->nome_fantasia; ?>" size="50px" onkeyup="this.value = this.value.toUpperCase();"/></td>

                                    </tr>
                                    <tr>
                                        
                                            <?php 
                                                if ($linha_cliente->tipo == "Pessoa Fisica")
                                                {
                                                    ?>
                                            
                                        <td class="label">CNPJ</td>
                                        <td class="input">             
                                            <div id="elementsToOperateOn"><input type="text" id="cnpj" name="cnpj" alt="cnpj" disabled/><br /></div>
                                        </td>
                                        <td class="label2">CPF</td>
                                        <td class="input2">
                                            <div id="elementsToOperateOn2"><input type="text" value="<?php echo $linha_cliente->cnpj_cpf; ?>" id="cpf" name="cpf" alt="cpf" /><br /></div>
                                        </td>
                                        
                                        
                                            <?php
                                                    
                                                } else {
                                            ?>
                                                 
                                        <td class="label">CNPJ</td>
                                        <td class="input">             
                                            <div id="elementsToOperateOn"><input type="text" value="<?php echo $linha_cliente->cnpj_cpf; ?>" id="cnpj" name="cnpj" alt="cnpj" /><br /></div>
                                        </td>
                                        <td class="label2">CPF</td>
                                        <td class="input2">
                                            <div id="elementsToOperateOn2"><input type="text" id="cpf" name="cpf" alt="cpf" disabled/><br /></div>
                                        </td>
                                            
                                            <?php        
                                                }
                                            
                                            ?>
                                        
                                        
                                        

                                    </tr>

                                    <tr>
                                        <td class="label">Inscrição Estadual</td>
                                        <td class="input">
                                            <input type="text" name="ie" value="<?php echo $linha_cliente->ie; ?>" alt="ie" id="ie" size="10px" />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td class="label">Endereço</td>
                                        <td class="input" COLSPAN="3">
                                            <input type="text" name="endereco" value="<?php echo $linha_cliente->endereco; ?>" size="50px" maxlength="180" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                      
                                    </tr>
                                    <tr>
                                        <td class="label">Bairro</td>
                                        <td class="input" >
                                            <input type="text" name="bairro" value="<?php echo $linha_cliente->bairro; ?>" size="30px" maxlength="90" onkeyup="this.value = this.value.toUpperCase();" />
                                        </td>
                                        <td class="label2">CEP</td>
                                        <td class="input2">
                                            <input type="text" id="cep" name="cep" alt="cep" value="<?php echo $linha_cliente->cep; ?>" />
                                        </td>                                        
                                       
                                    </tr>
                                    <tr>
                                        <td class="label">Estado</td>
                                        <td class="input">
                                            
                                            <?php
                                           
                                            $estado_cliente = $linha_cliente->estado;
                                            
                        $consulta_estado = mysql_query("select * from estados where nome = '$estado_cliente'");
						$linha_estado = mysql_fetch_object($consulta_estado);

                        $cod_estado_clientes = @$linha_estado->cod_estados;
                                            
                                            
                                            ?>
                                            
                                            
                                            
                                           <select name="cod_estados" id="cod_estados">
                                                <option value=" "> </option>
                                                    <?php
                                                            $sql = "SELECT cod_estados, sigla
                                                                            FROM estados
                                                                            ORDER BY sigla";
                                                            $res = mysql_query( $sql );
                                                            while ( $row = mysql_fetch_assoc( $res ) ) {
                                                                
                                                                if($cod_estado_clientes == $row['cod_estados']){
                                                                 
                                                                    echo '<option selected value="'.$row['cod_estados'].'">'.$row['sigla'].'</option>';
                                                                }else {
                                                                    
                                                                
                                                                    echo '<option value="'.$row['cod_estados'].'">'.$row['sigla'].'</option>';
                                                                }
                                                            }
                                                    ?>
                                            </select>
                                        </td>
                                        <td class="label2">Cidade</td>
                                        <td class="input2">
                                            
                                                                                        <?php
                                           
                                            $cidade_cliente = $linha_cliente->cidade;
                                            
                        $consulta_estado = mysql_query("select * from cidades where nome = '$cidade_cliente'");
			$linha_cidade = mysql_fetch_object($consulta_estado);

                        @$cod_cidade_clientes = $linha_cidade->cod_cidades;
                                           // echo $cod_cidade_clientes;
                                            
                                            ?>
                                            
                                            
                                            <span class="carregando"></span>
                                                <select name="cod_cidades" id="cod_cidades">
                                                        <option value="<?php echo $cod_cidade_clientes; ?>"><?php echo utf8_encode($linha_cliente->cidade); ?></option>
                                                </select>

                                                <script src="http://www.google.com/jsapi"></script>
                                                <script type="text/javascript">
                                                  google.load('jquery', '1.3');
                                                </script>		

                                                <script type="text/javascript">
                                                $(function(){
                                                        $('#cod_estados').change(function(){
                                                                if( $(this).val() ) {
                                                                        $('#cod_cidades').hide();
                                                                        $('.carregando').show();
                                                                        $.getJSON('cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
                                                                                var options = '<option value=""></option>';	
                                                                                for (var i = 0; i < j.length; i++) {
                                                                                        options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                                                                                }	
                                                                                $('#cod_cidades').html(options).show();
                                                                                $('.carregando').hide();
                                                                        });
                                                                } else {
                                                                        $('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
                                                                }
                                                        });
                                                });
                                                </script>
                                        </td>                                      
                                    </tr>
                                    <tr>
                                        <td class="label">TEL</td>
                                        <td class="input">
                                            <input type="text" id="phone" name="phone" alt="phone" value="<?php echo $linha_cliente->tel; ?>"/>
                                        </td>
                                        <td class="label2">CEL</td>
                                        <td class="input2">
                                            <input type="text" id="cel" name="cel" alt="cel" value="<?php echo $linha_cliente->cel; ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label">FAX</td>
                                        <td class="input">
                                             <input type="text" id="fax" name="fax" alt="fax" value="<?php echo $linha_cliente->fax; ?>" />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    
                                    <tr>
                                        <td class="label">Email Técnico</td>
                                        <td class="input">
                                             <input type="email" id="email_tec" name="email_tec" value="<?php echo $linha_cliente->email_tec; ?>" />
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    
                                    </tr>
                                    <tr>
                                        <td class="label">Email Financ./Admin.</td>
                                        <td class="input">
                                             <input type="email" id="email_admin" name="email_admin" value="<?php echo $linha_cliente->email_adm_fin; ?>" />
                                        </td>  
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>                                        
                                    </tr>
                                    
                                    <tr>
                                    
                                        <td colspan="4">

                                        </td>
                                        
         
                                      
                                    </tr>                                    
                                </tbody>
                            </table>
                              <hr>
                                  <input class="bt_verde" type="submit" value="Salvar" name="salvar_novo_cliente" />
                                  <input type="hidden" name="usuario" value="<?php echo $logOptions_id; ?>" readonly="readonly" />
		
                </form>

                    
                    
                </div>
<?php }else {
	echo '<br> Cliente não encontrado </b> <a href="tecnico.php?id_menu=cliente" target="_self">Voltar</a>';
}?>