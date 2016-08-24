<?php

/**
 * ColaboradorCtrl.class [ Controller ]
 * Responsavel por fazer o Controle entre a View e o BD para tabela <b>colaboradores</b>
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class ColaboradorCtrl {

    private $ColaboradorDao;

    public function __construct() {
        $this->ColaboradorDao = new ColaboradorDAO();
    }

    /**
     * Fazer SELECT no BD na tabela = <b>colaboradores</b>
     * @param string $campos = Campos do BD a serem pesquisados
     * @param string $termos = Termos para Filtrar a Busca no BD (WHERE, etc)
     * @return Array de Objetos do tipo --><b>Colaborador</b><-- se encontrar resultados, se não retorna NULL
     */
    public function buscarBD($campos, $termos) {
        $select = $this->ColaboradorDao->select($campos, $termos);
        if (!empty($select)) {

            return $this->montarObjeto($select);
        } else {
            return NULL;
        }
    }

    /**
     * Fazer UPDATE no BD na tabela = colaborador
     * @param Colaborador $obj =  passar uma Instancia deste tipo para inserir no BD
     * @return boolean = TRUE se Sucesso ao ATUALIZAR dados no BD e FALSE se houver algum problema na ATUALIZAÇÃO ou se o OBJETO não foi passado DO TIPO CORRETO
     */
    public function atualizarBD(Colaborador $obj) {
        if ($obj instanceof Colaborador) {
            $id = $obj->getId_colaborador();

            foreach ((array) $obj as $campo => $valor) {
                if (!$valor == NULL || !$valor == "" || $valor == "0") {
                    $campo = str_replace("\0Colaborador\0", "", $campo);
                    $campo = str_replace("\0Usuario\0", "", $campo);
                    $camposDados[] = $campo . " = '" . $valor . "'";
                }
            }

            unset($camposDados[0]);
            $camposDados = implode(', ', $camposDados);

            if ($this->ColaboradorDao->update($camposDados, "WHERE id_colaborador = '$id' ")) {

                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

  /*
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
            //mysql_query("UPDATE colaboradores SET tipo = '$tipo_conta_user' WHERE id_colaborador ='$id_user'");
        } else {
            $senha_nova_md5 = md5($senha_nova);
            $obj = new Colaborador($id_user, "", $senha_nova_md5, "", "", "", "", "");
            if ($this->atualizarBD($obj)) {

                return WSErro("Atualizada a senha com sucesso!.", WS_ACCEPT);
            } else {
                return WSErro("Ocorreu algum erro ao tentar Atualizar, favor tentar novamente!.", WS_ERROR);
            }
        }
    }

    //--------------------------------------------------
    //----------------PRIVATES---------------------
    //--------------------------------------------------
    private function montarObjeto($arrayDados) {
        $arrayObjColab = array();
        foreach ($arrayDados as $dado) {
            extract($dado);
            $arrayObjColab[] = new Colaborador($id_colaborador, $Login, $Senha, $cpf, $tipo, $last_log_date, $Email, $email_activated);
        }

        return $arrayObjColab;
    }

}
