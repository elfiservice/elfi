<?php

$ano_orc = "";
if(isSet ($_GET['ano_orc'])) {

	$ano_orc = $_GET['ano_orc'];
	$ano_orc_selec=$ano_orc;
}else{
	$ano_orc = date('Y');
	$ano_orc_selec=$ano_orc;
}

//$ano_orc_selec="";
if(isSet ($_POST['ano'])) {

	$ano_orc_selec = $_POST['ano'];
}

$ident_orc="";
if(isSet ($_GET['id_orc'])) {

	$ident_orc = $_GET['id_orc'];
	$situcao_orc = $_POST['itens_situcao_orc'];

	$usuarioObj = new UsuarioCtrl();
	$usuario = $usuarioObj->buscarUserPorId($logOptions_id);
	$nome_usuario = $usuario->getLogin();
	
	$orcObj = new Orcamento(); 
	$orcObj->setId($ident_orc);
	$orcObj->setColabOrc($nome_usuario);
	$orcObj->setSituacaoOrc($situcao_orc);
	
	$orcCrtlObj = new OrcamentoCtrl();
	//var_dump($orcObj);
	$resultAtualizOrcamento = $orcCrtlObj->atualizarOrcamento($orcObj);

	//var_dump($resultAtualizOrcamento);
	?>
			 
<script type="text/javascript" >
	alert ("Orcamento de ID <?= $orcObj->getId();?> foi atualizado: \n Situacao: <?= $resultAtualizOrcamento[3]["situacao_orc"];?> \n Colaborador: <?= $resultAtualizOrcamento[2]['colaborador_orc']?>!");
</script>
			 
<?php

        } 
       
        $usuario = new UsuarioCtrl();
        $orcCrtl = new OrcamentoCtrl();
?>



<div>
	<h2>Orcamentos</h2>
</div>
<hr>

	<div>
		<form action="tecnico.php?ano_orc=<?php echo $ano_orc_selec; ?>&id_menu=orcamento" method="post" enctype="multipart/form-data" name="formAgenda">
			Selecione o ANO:	
			<select name="ano" id="ano" class="formFieldsAno">
				<option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
				<?php
				$anosOrcamentosArr = $orcCrtl->buscarOrcamentos("DISTINCT ano_orc", "ORDER BY ano_orc DESC");
				
				//$consulta_menor_ano_orc = mysql_query("select DISTINCT ano_orc from orcamentos ORDER BY ano_orc DESC");
				//while($l = mysql_fetch_array($consulta_menor_ano_orc)) 
				foreach ($anosOrcamentosArr as $orc => $l)
				{
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
                                            <th>No. ORC</th>
                                            <th>Colaborador</th>
                                            <th>Situacao</th>                                            
                                            <th>Editar</th>
                                            <th>Razao Social / Nome</th>
                                            <th>Classificacao</th>
                                            <th>Data do ORC</th>
                                            <th>CNPJ</th>
                                            <th>Endereco</th>
                                            <th>Bairro</th>
                                            <th>Estado</th>
                                            <th>Cidade</th>
                                            <th>CEP</th>
                                            <th>Contato</th>                                            
                                            <th>Telefone</th>
                                            <th>Celular</th>
                                            <th>Email Tecnico</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
            
<?php
	     $orcamentosArray = $orcCrtl->buscarOrcamentos("*", "WHERE ano_orc = $ano_orc ORDER BY id  DESC");
		foreach ($orcamentosArray as $orc => $row)
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
                                            
										    <form name="alterar_situcao_orc" action="tecnico.php?ano_orc=<?php echo date('Y');?>&id_orc=<?php echo $row['id']; ?>&id_menu=orcamento" method="POST" enctype="multipart/form-data">
                                                
                                                
                                                <select name="itens_situcao_orc" id="itens_situcao_orc" class="formFieldsAno">
													<option value="<?php echo $row['situacao_orc'];?>"><?php echo $row['situacao_orc'];?></option>
													<?php include "includes/orcamento/lista_situacao_orc.php"; ?>
												</select>
												
												<input type="submit" value="Alterar" name="alterar_situacao" />
                                            </form>
											
											
                                        </td>                                           
                                        <td>
                                            
                                            <!--form name="editar_cliente" action="editar_orcamento.php?id_cliente=<?php echo $row['id'];?>&msg_erro=" method="POST" enctype="multipart/form-data">
                                                
                                                <input type="submit" value="Editar" name="enviar_lembrete" />
                                                
                                            </form-->
											
												<!-- a href="#" onclick="window.open('../editar_orcamento.php?id_orc=<?php echo $row['id'];?>&msg_erro=', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
												Editar
												</a-->
                                            <form name="editarOrcamento" action="tecnico.php?id_menu=editar_orcamento&id_orc=<?php echo $row['id'];?>&msg_erro=" method="POST" enctype="multipart/form-data">
                                                
                                                <input style="color: green; margin-bottom: 5px;" type="submit" value="Editar" name="editarOrcBtn" />
                                                
                                            </form>												
												
												<a href="#" onclick="window.open('../imprimir_orc.php?id_orc=<?php echo $row['id']; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10');">
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
        
