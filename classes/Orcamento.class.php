<?php

class Orcamento {

	private $id;
	private	$n_orc;
	private	$ano_orc;
	private	$colaborador_orc;
	private	$situacao_orc;
	private	$razao_social_contr;
	private	$cnpj_contr;
	private	$endereco_contr;
	private	$bairro_contr;
	private	$cidade_contr;
	private	$estado_contr;
	private	$cep_contr;
	private	$telefone_contr;
	private	$celular_contr;
	private	$email_contr;
	private	$contato_clint;
	private	$razao_social_obra;
	private	$cnpj_obra;
	private	$endereco_obra;
	private	$bairro_obra;
	private	$cidade_obra;
	private	$estado_obra;
	private	$cep_obra;
	private	$telefone_obra;
	private	$celular_obra;
	private	$email_obra;
	private	$atividade;
	private	$classificacao;
	private	$quantidade;
	private	$unidade;
	private	$descricao_servico_orc;
	private	$prazo_exec_orc;
	private	$validade_orc;
	private $pagamento_orc	;
	private $obs_orc;
	private $duvida_orc;
	private	$vr_servco_orc;
	private	$vr_material_orc;
	private	$desconto_orc;
	private	$vr_total_orc;
	private	$obra_igual_contrat;
	private	$data_adicionado_orc;
	private	$data_ultima_alteracao;
	private	$colaborador_ultim_alteracao;
	private	$data_aprovada;
	private	$data_inicio;
	private	$data_conclusao;
	private	$dias_d_aprovado;
	private	$dias_d_exec;
	private	$dias_ultrapassad;
	private	$serv_concluido;
	private	$feito_pos_entreg;
	private	$nao_conformidade;
	private	$obs_n_conformidad;
	private	$client_insatisfeito;
	private	$data_ultimo_cont_cliente;
	private $colab_ultimo_contato_client;
	

	public function getId() {
	         return $this->id;
	}
	
	public function setId($id) {
	         $this->id = $id;
	}
	
	public function getNOrc() {
	         return $this->n_orc;
	}
	
	public function setNOrc($n_orc) {
	         $this->n_orc = $n_orc;
	}
	
	public function getAnoOrc() {
	         return $this->ano_orc;
	}
	
	public function setAnoOrc($ano_orc) {
	         $this->ano_orc = $ano_orc;
	}
	
	public function getColabOrc() {
	         return $this->colaborador_orc;
	}
	
	public function setColabOrc($colaborador_orc) {
	         $this->colaborador_orc = $colaborador_orc;
	}
	
	public function getSituacaoOrc() {
	         return $this->situacao_orc;
	}
	
	public function setSituacaoOrc($situacao_orc) {
	         $this->situacao_orc = $situacao_orc;
	}
	
	public function getRazaoSocialContrat() {
	         return $this->razao_social_contr;
	}
	
	public function setRazaoSocialContrat($razao_social_contr) {
	         $this->razao_social_contr = $razao_social_contr;
	}
	
	public function getCnpjContrat() {
	         return $this->razao_social_contr;
	}
	
	public function setCnpjContrat($razao_social_contr) {
	         $this->razao_social_contr = $razao_social_contr;
	}
	
	public function getEnderecoContrat() {
	         return $this->endereco_contr;
	}
	
	public function setEnderecoContrat($endereco_contr) {
	         $this->endereco_contr = $endereco_contr;
	}
	
	
	
	

}
?>