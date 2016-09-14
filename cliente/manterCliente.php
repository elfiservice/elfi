<?php ?>
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
    <table class="display" id="example">
        <thead>
            <tr>
                <th>Cod.</th>
                <th>Colaborador</th>
                <th>Satisfação</th>
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
            $clienteCtrl = new ClienteCtrl();
            $clientes = $clienteCtrl->buscarBD("*", "Where mostrar='1'");
            foreach ($clientes as $cliente) {
                if (!empty($clienteCtrl->mediaSatisfacao($cliente->getId()))) {
                    $mostrarSatisfacao = Formatar::moedaBR($clienteCtrl->mediaSatisfacao($cliente->getId())) . '%';
                } else {
                    $mostrarSatisfacao = "<small><i>Não respondeu à nenhuma pesquisa até o momento</i></small>";
                }
                ?>
                <tr>
                    <td><?= $cliente->getId(); ?></td>
                    <td><?= $cliente->getUsuario(); ?></td>
                    <td><?= $mostrarSatisfacao ?></td>
                    <td>                                            
                        <form name="editar_cliente" action="tecnico.php?id_menu=editar_cliente&id_cliente=<?= $cliente->getId(); ?>&msg_erro=" method="POST" enctype="multipart/form-data">
                            <input style="color: green; margin-bottom: 5px;" type="submit" value="Editar" name="editarClienteBtn" />
                        </form>
                        <form name="excluir_cliente" action="tecnico.php?id_menu=excluir_cliente&id_cliente=<?= $cliente->getId(); ?>&msg_erro=" method="POST" enctype="multipart/form-data">
                            <input style="color: red;" type="submit" value="Exluir" name="excluirClienteBtn" />
                        </form>
                    </td>
                    <td>
                        <a href="tecnico.php?id_menu=perfil_cliente&id_cliente=<?= $cliente->getId(); ?>&tipo_cliente=<?= $cliente->getTipo(); ?>">
                            <?= $cliente->getRazaoSocial(); ?>
                        </a>
                    </td>
                    <td><?= $cliente->getNomeFantasia(); ?></td>
                    <td><?= Formatar::formatarDataComHora($cliente->getDataAdd()); ?></td> 
                    <td><?= ($cliente->getTipo() == "PJ" ? $cliente->getCnpj() : $cliente->getCpf()) ?></td> 
                    <td><?= $cliente->getEndereco(); ?></td> 
                    <td><?= $cliente->getBairro(); ?></td> 
                    <td><?php echo utf8_encode($cliente->getEstado()); ?></td> 
                    <td><?php echo utf8_encode($cliente->getCidade()); ?></td>
                    <td><?= $cliente->getCep(); ?></td> 
                    <td><?= $cliente->getTel(); ?></td> 
                    <td><?= $cliente->getCel(); ?></td> 
                    <td><?= $cliente->getFax(); ?></td> 
                    <td><?= $cliente->getEmailTec(); ?></td>                                         
                    <td><?= $cliente->getEmail_adm_fin(); ?></td>                                          
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table> 
</div>

