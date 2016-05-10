<?php

?>
<div>
	<h2>Clientes</h2>
</div>
<hr>
<div style="padding-bottom: 0px;">
	<form name="novo_cliente" action="tecnico.php?id_menu=novo_cliente" method="POST" enctype="multipart/form-data">
            <input class="bt_incluir" type="submit" value="Novo" name="novo_cliente_btn" />
	</form>
</div>

<hr>
            
                
                <div id="demo">
                             <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                                <thead>
                                    <tr>
                                            <th>Cod.</th>
                                            <th>Colaborador</th>
                                            <th>Alterar/Excluir</th>
                                            <th>Razao Social / Nome</th>
                                            <th>Nome Fantasia</th>
<!--                                             <th>Classificacao</th> -->
                                            <th>Data do Cadastro</th>
                                            <th>CNPJ / CPF</th>
<!--                                             <th>Inscricao Estadual</th> -->
                                            <th>Endereco</th>
                                            <th>Bairro</th>
                                            <th>Estado</th>
                                            <th>Cidade</th>
                                            <th>CEP</th>
                                            <th>Telefone</th>
                                            <th>Celular</th>
                                            <th>FAX</th>
                                            <th>Email Tecnico</th>
                                            <th>Email Financeiro/Admin.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
            
            <?php
                
                $consulta_usuarios = mysql_query("select * from clientes Where mostrar='1'");
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
                                            
                                            <form name="editar_cliente" action="tecnico.php?id_menu=editar_cliente&id_cliente=<?php echo $row['id'];?>&msg_erro=" method="POST" enctype="multipart/form-data">
                                                
                                                <input style="color: green; margin-bottom: 5px;" type="submit" value="Editar" name="editarClienteBtn" />
                                                
                                            </form>
                                            
                                            <form name="excluir_cliente" action="tecnico.php?id_menu=excluir_cliente&id_cliente=<?php echo $row['id'];?>&msg_erro=" method="POST" enctype="multipart/form-data">
                                                
                                                <input style="color: red;" type="submit" value="Exluir" name="excluirClienteBtn" />
                                                
                                            </form>
                                            
                                        </td>
                                        
                                        
                                        <td>
                                            <?php echo $row['razao_social'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['nome_fantasia'];?>
                                        </td>
<!--                                         <td> -->
                                            <?php //echo $row['classificacao'];?>
<!--                                         </td> -->
                                                                                <td>
                                           <?php
                                           	echo Formatar::formatarDataComHora($row['data_inclusao']);
                                           
                                         //echo  date('d/m/Y, H:i', strtotime($row['data_inclusao']));?>
                                        </td> 
                                                                                <td>
                                           <?php echo $row['cnpj_cpf'];?>
                                        </td> 
<!--                                                                                 <td> -->
                                           <?php //echo $row['ie'];?>
<!--                                         </td>  -->
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
                
               