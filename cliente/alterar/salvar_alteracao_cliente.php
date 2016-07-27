
<?php
//include_once "../../Config/config_sistema.php"; 
include_once "includes/funcoes.php";



if (isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];
    ?>
    <div>
        <h2><a href="tecnico.php?id_menu=cliente">Clientes</a> -> <a href="tecnico.php?id_menu=editar_cliente&id_cliente=<?= $_GET['id_cliente'] ?>&msg_erro=">Editar</a> -> Salvando</h2>
    </div>
    <hr>

    <?php
//Este código será executado somente se o nome de usuário é Postado
    if (isset($_POST['razao_social'])) {

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

        if (isset($_POST['tipo'])) {
            //echo "Pessoa Fisica !!";
            //echo $_POST['cpf'];
            $cnpj_cpf = $_POST['cpf'];
            $tipo = "PF";
            //$tipo = utf8_encode($tipo);
        } else {
            //echo "Pessoa Juridica!!";
            //echo $_POST['cnpj'];
            $cnpj_cpf = $_POST['cnpj'];
            $tipo = "PJ";
            //$tipo = utf8_encode($tipo);
        }



        $sql_razao = mysql_query("SELECT * FROM clientes WHERE razao_social='$razao_social'") or die(mysql_error());
        $razao_check = mysql_num_rows($sql_razao);

        $sql_fantasia = mysql_query("SELECT * FROM clientes WHERE nome_fantasia='$nome_fantasia'") or die(mysql_error());
        $fantasia_check = mysql_num_rows($sql_fantasia);

        $sql_email_tec = mysql_query("SELECT * FROM clientes WHERE email_tec='$email_tec'") or die(mysql_error());
        $email_tec_check = mysql_num_rows($sql_email_tec);

        if ($cnpj_cpf == "") {

            $cnpj_cpf_check = 0;
        } else {

            $sql_cnpj_cpf = mysql_query("SELECT * FROM clientes WHERE cnpj_cpf='$cnpj_cpf'") or die(mysql_error());
            $cnpj_cpf_check = mysql_num_rows($sql_cnpj_cpf);
        }

        if ($razao_check > 1) {

            echo "<b> <span style=\"color:red;\"> Razao Social ja cadastrada no sistema! <br> Cliente NAO atualizado. </span></b>";
            ?>
            <a href="javascript:history.back(-1);" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
            <?php
            exit();
        } else if ($fantasia_check > 1) {
            echo "<b> <span style=\"color:red;\">Nome Fantasia ja cadastrada no sistema! <br> Cliente NAO atualizado. </span></b>";
            ?>
            <a href="javascript:history.back(-1);" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
            <?php
            exit();
        } else if ($cnpj_cpf_check > 1) {
            echo "<b> <span style=\"color:red;\">O CPF ja cadastrada no sistema!  <br> Cliente NAO atualizado. </span></b>";
            ?>
            <a href="javascript:history.back(-1);" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>
            <?php
            exit();
        } else {





            $consulta_estado = mysql_query("select * from estados where cod_estados = '$cod_estado'");
            $linha_estado = mysql_fetch_object($consulta_estado);

            $estado = $linha_estado->nome;

            $consulta_cidade = mysql_query("select * from cidades where cod_cidades = '$cod_cidade'");
            $linha_cidade = mysql_fetch_object($consulta_cidade);

            $cidade = $linha_cidade->nome;


            $sql_nome_user = mysql_query("SELECT * FROM colaboradores WHERE id_colaborador='$id_usuario'") or die(mysql_error());
            $linha_usuario = mysql_fetch_object($sql_nome_user);

            $nome_usuario = $linha_usuario->Login;

            $cnpj_cpf = limpaCPF_CNPJ($cnpj_cpf); //limpar CNPJ ou CPF

            if (mysql_query("UPDATE clientes SET 
						usuario = '$nome_usuario',
						razao_social = '$razao_social',
						nome_fantasia = '$nome_fantasia',
						classificacao = '$classificacao',
						ie = '$ie',
						endereco = '$endereco',
						bairro = '$bairro',
						cep = '$cep',
						cnpj_cpf = '$cnpj_cpf',
						tipo = '$tipo',
						tel = '$telefone',
						cel = '$celular',
						fax = '$fax',
						email_tec = '$email_tec',
						email_adm_fin = '$email_admin',
						estado = '$estado',
						cidade = '$cidade'					
					WHERE id ='$id_cliente'")) {
                
                LogCtrl::inserirLog($_SESSION['id'], "Cliente Codigo <b>{$id_cliente} atualizado</b>", "tec");
                ?>
                <script>
                    alert("Cliente atualizado com sucesso!");
                </script>
                <?php
                if ($email_tec_check > 1) {
                    echo "<b> <span style=\"color:red;\">Atenção: já existe este Email Tecnico cadastrado no sistema!  </span></b>";
                    ?>
                        <!--                    <a href="javascript:history.back(-1);" target="_self"><span STYLE="font-size: 16px; text-align: center; margin-top: 200px;">VOLTAR</span></a>-->
                    <?php
                    // exit();
                }
                ?>
                <a href="tecnico.php?id_menu=cliente" target="_self">Voltar</a>
                <?php
            } else {
                echo"<b> Ocorreu um erro ao tentar salvar as alteracoes!</b>";
            }
        }
    }
} else {
    echo"<b> Cliente n�o identificado </b>";
}
?>