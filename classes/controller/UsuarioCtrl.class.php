<?php

/**
 * UsuarioCtrl.class [ Controller ]
 * Responsavel por fazer o Controle entre a View e o BD para tabela <b>usuario</b>
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class UsuarioCtrl {

    private $usuarioDao;
    private $usuario;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
        $this->usuario = new Usuario();
    }

    /**
     * Fazer INSERT no BD na tabela = usuario
     * @param Usuario $Obj = passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao inserir dados no BD e FALSE se houver algum problema na INSERÇÃO ou se o OBJETO não foi passado corretamente
     */
    public function inserirBD(Usuario $Obj) {
        if ($Obj instanceof Usuario) {

            foreach ((array) $Obj as $campo => $valor) {
                $campo = str_replace("\0Usuario\0", "", $campo);
                $campoArr[$campo] = $campo;
            }

//            unset($campoArr['id']);
            $arrObj = array_values((array) $Obj);
//            unset($arrObj[0]);


            $campoArr = implode(', ', array_keys($campoArr));
            $valores = " '" . implode("','", array_values($arrObj)) . "' ";
//            var_dump($valores);
//die;
            if ($this->usuarioDao->insert($campoArr, $valores)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Fazer SELECT no BD na tabela = <b>usuario</b>
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array de Objetos do tipo --><b>Usuario</b><-- se encontrar resultados, se não retorna NULL
     */
    public function buscarBD($campos, $termos) {
        $select = $this->usuarioDao->select($campos, $termos);
        if (!empty($select)) {
            return $this->montarObjeto($select);
        } else {
            return NULL;
        }
    }

    /**
     * Fazer UPDATE no BD na tabela = <b>usuario</b>
     * @param <b>Usuario</b> $obj =  passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao ATUALIZAR dados no BD e FALSE se houver algum problema na ATUALIZAÇÃO ou se o OBJETO não foi passado DO TIPO CORRETO
     */
    public function atualizarBD(Usuario $obj) {
        if ($obj instanceof Usuario) {
            $id = $obj->getId();
            $obj->setId("");

            foreach ((array) $obj as $campo => $valor) {
                if (!$valor == NULL || !$valor == "" || $valor == "0") {
                    $campo = str_replace("\0Usuario\0", "", $campo);
                    $camposDados[] = $campo . " = '" . $valor . "'";
                }
            }

            //unset($camposDados[0]);
            $camposDados = implode(', ', $camposDados);

            if ($this->usuarioDao->update($camposDados, "WHERE id = '$id' ")) {

                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    /**
     * Logica para Alteração de Senha do Usuario
     * @param $dados = array com os dados do campo das senhas
     * @return Mensagem de Erro ou Sucesso
     */
    public function alterarSenha($dados, $userlogin) {
        $senha_atual = md5($dados['passatual']);
        $senha_nova = $dados['passnova'];
        $senha_nova2 = $dados['passnova2'];
        $id_user = $dados['id_user'];
        if ((!$senha_atual) || (!$senha_nova) || (!$senha_nova2)) {
            return WSErro("Favor preencher todos os campos!", WS_ERROR);
        } else if ($senha_atual <> $userlogin->getSenha()) {
            return WSErro("Senha atual incorreta!", WS_ERROR);
        } else if ($senha_nova <> $senha_nova2) {
            return WSErro("Senha nova 1 e 2 são diferentes! Favor digitar novamente.", WS_ERROR);
        } else {
            $senha_nova_md5 = md5($senha_nova);
            $obj = new Usuario($id_user, "", "", $senha_nova_md5);
            if ($this->atualizarBD($obj)) {
                $textoCorpo = "<div> <p>Senha alterada com sucesso, segue abaixo:</p></div> <div> <p>Login: {$userlogin->getLogin()} <br> Nova Senha: <b>{$senha_nova}</b> </p></div>";
                $email = new EmailGenerico(array($userlogin->getLogin()), "Senha Alterada no Sistema", $textoCorpo, array(), array(), 1);
                if($email->enviarEmailSMTP()){
                    $textoWSerro = "Atualizada a senha com sucesso!<br>Foi enviado um Email com seus novos dados.";
                }else{
                    $textoWSerro = "Atualizada a senha com sucesso!<br>Ops! Ocorreu um Erro ao tentar enviar um Email com seus novos dados.";
                }
              
                return WSErro($textoWSerro, WS_ACCEPT);
            } else {
                return WSErro("Ocorreu algum erro ao tentar Atualizar, favor tentar novamente!.", WS_ERROR);
            }
        }
    }

    /**
     * Alterar o Tipo da Conta do Colaborador
     * @param type $dados = Array com os dados para Alteração, Tipo e ID
     * @return String = com Mensagem de Sucesso ou Erro
     */
    public function alterarTipoConta($dados) {
        $id_user = $dados['id_user'];
        $tipo_conta_user = $dados['tipo'];

        if (!empty($id_user) && !empty($tipo_conta_user)) {
            $obj = new Usuario($id_user, "", "", "", $tipo_conta_user);
            if ($this->atualizarBD($obj)) {
                return WSErro("Atualizado tipo de conta com sucesso!.", WS_ACCEPT);
            } else {
                return WSErro("Ocorreu algum erro ao tentar Atualizar, favor tentar novamente!.", WS_ERROR);
            }
        }else{
            return WSErro("Campo vazio, Não atualizado!", WS_ALERT);
        }
    }
    
     /**
     * Ativar/Desativar Email do Usuario no Sistema
     * @param INT $id = inteiro com o numero do ID do Usuario
     * @param INT $ativo =  valor informando a alteracao, Ativo = 1 ou Desativar = 0
     * @return Boolean = True para sucesso, False para Erro na Alteração no BD
     */
    public function ativarDesativarEmail($id, $ativo) {
        $this->usuario->setId($id);
        $this->usuario->setAtivo($ativo);
        
        if( $this->atualizarBD($this->usuario) ){
            return true;
        } else {
            return false;
        }
    }

    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($arrayDados) {
        $arrayObj = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            $arrayObj[] = new Usuario($id, $id_colaborador, $Login, $Senha, $tipo, $ativo, $last_log_date);
        }

        return $arrayObj;
    }

}
