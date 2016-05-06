<?php
$id_cliente = $_GET ['id_cliente'];

$mens_erro = $_GET ['msg_erro'];

$consulta_cliente = mysql_query ( "select * from clientes where id = '$id_cliente'" );
$linha_cliente = mysql_fetch_object ( $consulta_cliente );

// $estado = $linha_cliente->nome;

?>

<div>
	<h2><a href="tecnico.php?id_menu=cliente">Clientes</a> -> Excluir</h2>
</div>
<hr>


<div
	STYLE="font-size: 16px; text-align: center; margin-top: 10px; color: red;">
    
    <?php echo  $mens_erro; ?>
</div>
<div STYLE="font-size: 16px; margin-top: 10px; color: red;">

	<h4>Deseja realmente excluir esse Cliente ?</h4>
</div>
<div id="demo">
	<form method="post"
		action="tecnico.php?id_menu=salvar_excluir_cliente&id_cliente=<?=$id_cliente?>&msg_erro="
		onsubmit="return formCheck(this);">


		<table border="0">

			<tbody>
				<tr>
					<td class="label">Cod / ID:</td>
					<td class="input" COLSPAN="3"><b><?php echo $linha_cliente->id; ?></b></td>

				</tr>
				<tr>
					<td class="label">Razão Social / Nome:</td>
					<td class="input" COLSPAN="3"><b><?php echo $linha_cliente->razao_social; ?></b></td>

				</tr>
				<tr>
                                        
                                            <?php
																																												if ($linha_cliente->tipo == "Pessoa Fisica") {
																																													?>
                                            
                                        <td class="label2">CPF:</td>
					<td class=""><b> <?php echo $linha_cliente->cnpj_cpf; ?></b></td>
                                        
                                        
                                            <?php
																																												} else {
																																													?>
                                                 
                                        <td class="label">CNPJ:</td>
					<td class="input"><b>   <?php echo $linha_cliente->cnpj_cpf; ?></b>
					</td>

                                            
                                            <?php
																																												}
																																												
																																												?>
                                        
                                        
                                        

                                    </tr>


				<tr>
					<td class="label">Endereço:</td>
					<td class="input" COLSPAN="3"><b><?php echo "{$linha_cliente->endereco}, {$linha_cliente->bairro}, {$linha_cliente->cep}, {$linha_cliente->cidade} - {$linha_cliente->estado}"; ?></b>
					</td>

				</tr>


				<tr>
					<td class="label">TEL:</td>
					<td class="input"><b>	<?php echo $linha_cliente->tel; ?></b></td>

				</tr>

				<tr>
					<td colspan="2">


					<td colspan="2"></td>

				</tr>
			</tbody>
		</table>
		<hr>
								<input class="bt_vermelho" type="submit" value="Exluir"
						name="excluir_cliente" /> 
						<input type="hidden" name="usuario"
						value="<?php echo $logOptions_id; ?>" readonly="readonly" />
						<input type="hidden" name="razao_social"
						value="<?php echo $linha_cliente->razao_social; ?>" readonly="readonly" /></td>

	</form>



</div>