<?php

?>
<!--
MAscaras em campos
-->
<script src="../js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="./js/mascara/jquery.meio.mask.js"
	charset="utf-8"></script>
<script type="text/javascript">
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
<script type="text/javascript" src="./js/desabilitar/jquery-latest.js"></script>
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

<!-- TESTE do CNPJ e CPF -->
<script type="text/javascript"
	src="http://www.shiguenori.com/jquery/jquery-1.3.1.js"></script>
<script type="text/javascript" src="./js/validacao/jquery.validate.js"></script>

<script> 
function isNUMB(c) 
 { 
 if((cx=c.indexOf(","))!=-1) 
  { 
  c = c.substring(0,cx)+"."+c.substring(cx+1); 
  } 
 if((parseFloat(c) / c != 1)) 
  { 
  if(parseFloat(c) * c == 0) 
   { 
   return(1); 
   } 
  else 
   { 
   return(0); 
   } 
  } 
 else 
  { 
  return(1); 
  } 
 }
function LIMP(c) 
 { 
 while((cx=c.indexOf("-"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("/"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(","))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("."))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("("))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(")"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(" "))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 return(c); 
 }

function VerifyCNPJ(CNPJ) 
 { 
 CNPJ = LIMP(CNPJ); 
 if(isNUMB(CNPJ) != 1) 
  { 
  return(0); 
  } 
 else 
  { 
  if(CNPJ == 0) 
   { 
   return(0); 
   } 
  else 
   { 
   g=CNPJ.length-2; 
   if(RealTestaCNPJ(CNPJ,g) == 1) 
    { 
    g=CNPJ.length-1; 
    if(RealTestaCNPJ(CNPJ,g) == 1) 
     { 
     return(1); 
     } 
    else 
     { 
     return(0); 
     } 
    } 
   else 
    { 
    return(0); 
    } 
   } 
  } 
 } 
function RealTestaCNPJ(CNPJ,g) 
 { 
 var VerCNPJ=0; 
 var ind=2; 
 var tam; 
 for(f=g;f>0;f--) 
  { 
  VerCNPJ+=parseInt(CNPJ.charAt(f-1))*ind; 
  if(ind>8) 
   { 
   ind=2; 
   } 
  else 
   { 
   ind++; 
   } 
  } 
  VerCNPJ%=11; 
  if(VerCNPJ==0 || VerCNPJ==1) 
   { 
   VerCNPJ=0; 
   } 
  else 
   { 
   VerCNPJ=11-VerCNPJ; 
   } 
 if(VerCNPJ!=parseInt(CNPJ.charAt(g))) 
  { 
  return(0); 
  } 
 else 
  { 
  return(1); 
  } 
 } 
 

  function FormataCGC(Formulario, Campo, TeclaPres) 
  { 
    var tecla = TeclaPres.keyCode; 
    var strCampo; 
    var vr; 
    var tam; 
    var TamanhoMaximo = 14; 
  
    eval("strCampo = document." + Formulario + "." + Campo); 
  
    vr = strCampo.value; 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace(",", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    tam = vr.length;

    if (tam < TamanhoMaximo && tecla != 8) 
    { 
      tam = vr.length + 1; 
    }

    if (tecla == 8) 
    { 
      tam = tam - 1; 
    }

    if (tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105) 
    { 
      if (tam <= 2) 
      { 
        strCampo.value = vr; 
      } 
       if ((tam > 2) && (tam <= 6)) 
       { 
         strCampo.value = vr.substr(0, tam - 2) + "-" + vr.substr(tam - 2, tam); 
       } 
       if ((tam >= 7) && (tam <= 9)) 
       { 
         strCampo.value = vr.substr(0, tam - 6) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 10) && (tam <= 12)) 
       { 
         strCampo.value = vr.substr(0, tam - 9) + "." + vr.substr(tam - 9, 3) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 13) && (tam <= 14)) 
       { 
         strCampo.value = vr.substr(0, tam - 12) + "." + vr.substr(tam - 12, 3) + "." + vr.substr(tam - 9, 3) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 15) && (tam <= 17)) 
       { 
         strCampo.value = vr.substr(0, tam - 14) + "." + vr.substr(tam - 14, 3) + "." + vr.substr(tam - 11, 3) + "." + vr.substr(tam - 8, 3) + "." + vr.substr(tam - 5, 3) + "-" + vr.substr(tam - 2, tam); 
      } 
    } 
  }

function TESTA() 
 { 
 if(VerifyCNPJ(document.forms[0].cnpj.value) == 1) 
  { 
  exit;
  } 
 else 
  { 
  alert("CNPJ não é válido!"); 
  
  } 
  
  if(VerifyCNPJ(document.forms[0].cnpj.value) == "")
      {
          exit;
      }else
          {
 document.forms[0].cnpj.focus(); 
 return; 
 }
 } 
</script>

<!-- TESTE campo Telefone -->
<script language="Javascript">
function Contar(Campo){

if(Campo.value.length < 14)
alert('Atenção, número deve ser nesse formato: (##) ####-#### !');
}
</script>

<!-- Cadastrar novos Clientes -->
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


<div>
	<h2>Clientes -> Novo</h2>
</div>
<hr>

<div class="" style="text-align: ;">



	<form method="post" action="tecnico.php?id_menu=salvar_novo_cliente"
		onsubmit="return formCheck(this);">


		<table border="0">
			<thead>
				<tr>
					<th>
						<p>
							Pessoa física <input id="toggleElement" type="checkbox"
								name="tipo" onchange="toggleStatus()" />
						</p>
					</th>
					<th COLSPAN="3">Classificação <select name="classificacao">
							<option value="padrao">Padrão</option>
							<option value="contrato">Contrato</option>
					</select>
					</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="label">Razão Social / Nome</td>
					<td class="input" COLSPAN="3"><input type="text"
						name="razao_social" value="" size="50px" maxlength="90"
						onkeyup="this.value = this.value.toUpperCase();" /></td>

				</tr>
				<tr>
					<td class="label">Nome Fantasia</td>
					<td class="input" COLSPAN="3"><input type="text"
						name="nome_fantasia" value="" size="50px"
						onkeyup="this.value = this.value.toUpperCase();" /></td>

				</tr>
				<tr>
					<td class="label">CNPJ</td>
					<td class="input">
						<div id="elementsToOperateOn">
							<input type="text" id="cnpj" name="cnpj" alt="cnpj"
								onBlur="TESTA();" />
						</div>

					</td>
					<td class="label2">CPF</td>
					<td class="input2">
						<div id="elementsToOperateOn2">
							<input type="text" id="cpf" name="cpf" alt="cpf" disabled /><br />
						</div>
					</td>
				</tr>

				<tr>
					<td class="label">Inscrição Estadual</td>
					<td class="input"><input type="text" name="ie" alt="ie" id="ie"
						value="" size="10px" /></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td class="label">Endereço</td>
					<td class="input" COLSPAN="3"><input type="text" name="endereco"
						value="" size="50px" maxlength="180"
						onkeyup="this.value = this.value.toUpperCase();" /></td>

				</tr>
				<tr>
					<td class="label">Bairro</td>
					<td class="input"><input type="text" name="bairro" value=""
						size="30px" maxlength="90"
						onkeyup="this.value = this.value.toUpperCase();" /></td>
					<td class="label2">CEP</td>
					<td class="input2"><input type="text" id="cep" name="cep" alt="cep" /></td>

				</tr>
				<tr>
					<td class="label">Estado</td>
					<td class="input"><select name="cod_estados" id="cod_estados">
							<option value=""></option>
<?php
							$sql = "SELECT cod_estados, sigla FROM estados ORDER BY sigla";
							$res = mysql_query ( $sql );
							while ( $row = mysql_fetch_assoc ( $res ) ) {
								echo '<option value="' . $row ['cod_estados'] . '">' . $row ['sigla'] . '</option>';
							}
?>
                                        </select></td>
					<td class="label2">Cidade</td>
							<td class="input2"><span class="carregando">Aguarde,
									carregando...</span> <select name="cod_cidades"
								id="cod_cidades">
									<option value="">-- Escolha um estado --</option>
							</select> <script src="http://www.google.com/jsapi"></script> <script
									type="text/javascript">
                                                  google.load('jquery', '1.3');
                                                </script> <script
									type="text/javascript">
                                                $(function(){
                                                        $('#cod_estados').change(function(){
                                                                if( $(this).val() ) {
                                                                        $('#cod_cidades').hide();
                                                                        $('.carregando').show();
                                                                        $.getJSON('./cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
                                                                                var options = '<option value=""></option>';	
                                                                                for (var i = 0; i < j.length; i++) {
                                                                                        options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
                                                                                }	
                                                                                $('#cod_cidades').html(options).show();
                                                                                $('.carregando').hide();
                                                                        });
                                                                } else {
                                                                        $('#cod_cidades').html('<option value="">â€“ Escolha um estado â€“</option>');
                                                                }
                                                        });
                                                });
                                                </script></td>
				</tr>
				<tr>
					<td class="label">TEL</td>
					<td class="input"><input type="text" id="phone" name="phone"
						alt="phone" onchange="Contar(this)" /></td>
					<td class="label2">CEL</td>
					<td class="input2"><input type="text" id="cel" name="cel" alt="cel"
						onchange="Contar(this)" /></td>
				</tr>
				<tr>
					<td class="label">FAX</td>
					<td class="input"><input type="text" id="fax" name="fax" alt="fax"
						onchange="Contar(this)" /></td>
					<td></td>
					<td></td>
				</tr>

				<tr>
					<td class="label">Email Técnico</td>
					<td class="input"><input type="email" id="email_tec"
						name="email_tec" /></td>
					<td></td>
					<td></td>

				</tr>
				<tr>
					<td class="label">Email Financ./Admin.</td>
					<td class="input"><input  type="email" id="email_admin"
						name="email_admin" /></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="4"></td>

				</tr>
			</tbody>
		</table>
<hr>
<input type="submit" value="Salvar"
						name="salvar_novo_cliente" /> 
						<input type="hidden" name="usuario"
						value="<?php echo $logOptions_id; ?>" readonly="readonly" />

	</form>

</div>

