<?php
$ano_orc_selec = date('Y');

if (isSet($_POST['ano'])) {

    $ano_orc_selec = $_POST['ano'];
}



$colabCtrl = new ColaboradorCtrl();
$orcCrtl = new OrcamentoCtrl();
?>



<div>
    <h2>Orcamentos</h2>
</div>
<hr>
<div class="alinhamentoHorizontal">
    <ul>
        <li>
            <form name="novo_orc" action="?id_menu=orcamento/novo_orcamento" method="POST" enctype="multipart/form-data">
                <input class="bt_incluir"  type="submit" value="Novo" name="novo_orc_btn" />
            </form>
        </li>
        <li>
            <form name="acomp_aprovados" action="?id_menu=orcamento/aprovados/acompanhar_orcamentos" method="POST" enctype="multipart/form-data">
                <input class="bt_incluir"  type="submit" value="Aprovados" name="acomp_aprovados_btn" />
            </form>
        </li>    
        <li>
            <form name="relatorios_orc" action="?id_menu=orcamento/relatorios/relatorios_orc" method="POST" enctype="multipart/form-data">
                <input class="bt_incluir"  type="submit" value="Relatorios" name="arelatorios_orc_btn" />
            </form>
        </li>    
    </ul>

</div>
<hr>
<div>
    <form action="?id_menu=orcamento/manterOrcamentos" method="post" enctype="multipart/form-data" name="formAgenda">
        Selecione o ANO:	
        <select name="ano" id="ano" class="formFieldsAno">
            <option value="<?php echo $ano_orc_selec; ?>"><?php echo $ano_orc_selec; ?></option>
            <?php
            $anosOrcamentosArr = $orcCrtl->buscarOrcamentos("DISTINCT ano_orc", "ORDER BY ano_orc DESC");
            foreach ($anosOrcamentosArr as $orc => $l) {
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
            $orcamentosArray = $orcCrtl->buscarOrcamentos("*", "WHERE ano_orc = '$ano_orc_selec' ORDER BY id DESC");
            foreach ($orcamentosArray as $orc => $row) {
                $id_orc = $row['id'];
                $id_cliente = $row['id_cliente'];
                //Buscar ID do CLIENTE
                $clienteCtrl = new ClienteCtrl();
                $arrayClienteDao = $clienteCtrl->buscarBD("*", "WHERE razao_social = '" . $row['razao_social_contr'] . "' ");
                $clienteDao = $arrayClienteDao[0];

                ?>
                <tr>
                    <td>
                        <span style="display: none;"><?= $row['id'] ?></span>
                        <a href="#" class="" onclick="window.open('orcamento/imprimir_orc.php?id_orc=<?php echo $row['id']; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10');">
                            <?php
                            echo $row['n_orc'] . '.' . $row['ano_orc'];
                            ?>
                        </a>
                    </td>
                    <td>
                        <?php
                        //echo $row['colaborador_orc'];
                        $user = $colabCtrl->buscarBD("*", "WHERE Login = '" . $row['colaborador_orc'] . "' ");
                        ?>                                                  
                        <a  href="#" onclick="window.open('../../usuario/perfil.php?id_user=<?php echo $user[0]->getId_colaborador(); ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=1250, HEIGHT=500');">
                            <?php echo $row['colaborador_orc']; ?>
                        </a>                                            
                    </td>                                        
                    <td>
                        <?php
                        if ($row['situacao_orc'] == "Aguardando aprovação") {
                            ?>
                            <a class="bt_link bt_azul" href="#" onclick="window.open('orcamento/nao_aprovados/historico_acompanhamento.php?id_orc=<?php echo $row['id']; ?>', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=yes, SCROLLBARS=YES, TOP=10, LEFT=10');">
                                <?= $row['situacao_orc'] ?>
                            </a>
                            <?php
                        } else if ($row['situacao_orc'] == "Aprovado") {
                            ?>

                            <a class="bt_link bt_azul" href="?id_menu=orcamento/aprovados/acompanhar_orcamentos" >
                                <?= $row['situacao_orc'] ?>
                            </a>
                            <?php
                        } else if ($row['situacao_orc'] == "concluido") {
                            ?>

                            <a class="bt_link bt_azul" href="?id_menu=orcamento/historico_completo_orc&id_orc=<?= $row['id'] ?>" >
                                <?= $row['situacao_orc'] ?>
                            </a>
                            <?php
                            if ($row['feito_pos_entreg'] == 'n') {
                                echo"<small>Pos-venda ainda não respondida</small>";
                            } else {
                                echo"<small>Pos-venda " . Formatar::moedaBR($orcCrtl->satisfacaoOrc($id_orc, $id_cliente)) . "%</small>";
                            }
                        } else {
                            ?>

                            <a class="bt_link bt_azul" href="?id_menu=orcamento/historico_completo_orc&id_orc=<?= $row['id'] ?>" >
                                <?= $row['situacao_orc'] ?>
                            </a>
                            <?php
                        }
                        ?>
                    </td>   
                    <td><?php if ($row['situacao_orc'] != "concluido") { ?>
                            <form name="editarOrcamento" action="?id_menu=orcamento/editar_orcamento&id_orc=<?php echo $row['id']; ?>&msg_erro=" method="POST" enctype="multipart/form-data">
                                <input class="bt_verde" type="submit" value="Editar" name="editarOrcBtn" />
                            </form>
                            <form name="excluirOrcamento" action="?id_menu=orcamento/excluir_orcamento&id_orc=<?php echo $row['id']; ?>&msg_erro=" method="POST" enctype="multipart/form-data">
                                <input class="bt_vermelho" type="submit" value="Exluir" name="excluirOrcBtn" />
                            </form>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        if ($clienteDao && !empty($clienteDao)) {
                            ?>
                            <a href="?id_menu=cliente/perfil&id_cliente=<?= $clienteDao->getId(); ?>&tipo_cliente=<?= $clienteDao->getTipo(); ?>">
                                <?php
                                echo $row['razao_social_contr'];
                                ?>
                            </a>                                            
                            <?php
                        } else {
                            echo $row['razao_social_contr'] . "<br>";
                            echo"<small>cliente não encontrado no sistema</small>";
                        }
                        ?>
                    </td>
                    <td><?php echo $row['atividade'] . '-' . $row['classificacao']; ?>                    </td>
                    <td><?php echo date('d/m/Y, H:i', strtotime($row['data_adicionado_orc'])); ?>                    </td> 
                    <td><?php echo $row['cnpj_contr']; ?>                    </td> 
                    <td> <?php echo $row['endereco_contr']; ?>                    </td> 
                    <td>                        <?php echo $row['bairro_contr']; ?>                    </td> 
                    <td>                        <?php echo utf8_encode($row['estado_contr']); ?>                    </td> 
                    <td>                        <?php echo utf8_encode($row['cidade_contr']); ?>                    </td>
                    <td>                        <?php echo $row['cep_contr']; ?>                    </td> 
                    <td>                        <?php echo $row['contato_clint']; ?>                    </td>                                         
                    <td>                        <?php echo $row['telefone_contr']; ?>                    </td> 
                    <td>                        <?php echo $row['celular_contr']; ?>                    </td> 
                    <td>                        <?php echo $row['email_contr']; ?>                    </td>                                         

                </tr>

                <?php
            }
            ?>

        </tbody>
    </table> 
</div> 

