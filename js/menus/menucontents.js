

var anylinkmenu3={divclass:'anylinkmenucols', inlinestyle:'', linktarget:''} //Third menu variable. Same precaution.
anylinkmenu3.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
anylinkmenu3.items=[
	["Cliente", "financeiro.php?id_menu=cliente"],
	["Fornecedor", "financeiro.php?id_menu=fornecedor"],
	["Funcionário", "financeiro.php?id_menu=funcionario"] //no comma following last entry!
]

var anylinkmenu_financeiro={divclass:'anylinkmenucols', inlinestyle:'', linktarget:''} //Third menu variable. Same precaution.
anylinkmenu_financeiro.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
anylinkmenu_financeiro.items=[
	["Contas Receber/Pagar", "financeiro.php?id_menu=receber_pagar"],
	["Baixa de Contas", "financeiro.php?id_menu=baixa_contas"],
	["Controle de Caixa", "financeiro.php?id_menu=controle_caixa", "efc"],
	["Controle de Bancos", "financeiro.php?id_menu=controle_bancos"],
	["Plano de Contas", "financeiro.php?id_menu=plano_contas"],
	["Fluxo de Caixa", "financeiro.php?id_menu=fluxo_caixa"]

]


var anylinkmenu_relatorio={divclass:'anylinkmenucols', inlinestyle:'', linktarget:''} //Third menu variable. Same precaution.
anylinkmenu_relatorio.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
anylinkmenu_relatorio.items=[
	["Caixas / Bancos", "financeiro.php?id_menu=caixas_bancos"],
	["Demonstrativo Resultado do Exercício", "financeiro.php?id_menu=demo_resultado_exercicio"]


]


/*Pagina CONFIGURAÇÃO*/

var cadastro_configuracao={divclass:'anylinkmenucols', inlinestyle:'', linktarget:''} //Third menu variable. Same precaution.
cadastro_configuracao.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
cadastro_configuracao.items=[
	["Controle Tipo de Conta", "configuracao.php?id_menu=controle_tipo_conta"],
        ["Cadastrar Novo", "configuracao.php?id_menu=cadastro_usuario"],
        ["Alterar Senha", "configuracao.php?id_menu=trocar_senha"]
	
]

var usuarios_nao_admin={divclass:'anylinkmenucols', inlinestyle:'', linktarget:''} //Third menu variable. Same precaution.
usuarios_nao_admin.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
usuarios_nao_admin.items=[
	["Alterar Senha", "configuracao.php?id_menu=trocar_senha"]
	
]


/*Pagina TECNICO*/

var tecnico_cadastro={divclass:'anylinkmenucols', inlinestyle:'', linktarget:''} //Third menu variable. Same precaution.
tecnico_cadastro.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
tecnico_cadastro.items=[
	["Cliente", "financeiro.php?id_menu=cliente"],
	["Fornecedor", "financeiro.php?id_menu=fornecedor"]
	
]

var tecnico_cliente={divclass:'anylinkmenucols', inlinestyle:'', linktarget:''} //Third menu variable. Same precaution.
tecnico_cliente.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
tecnico_cliente.items=[
	["Novo", "tecnico.php?id_menu=novo_cliente"],
	["Editar", "tecnico.php?id_menu=editar_cliente"]
	
]

var tecnico_orcamento={divclass:'anylinkmenucols', inlinestyle:'', linktarget:''} //Third menu variable. Same precaution.
tecnico_orcamento.cols={divclass:'column', inlinestyle:''} //menu.cols if defined creates columns of menu links segmented by keyword "efc"
tecnico_orcamento.items=[
	["Novo", "tecnico.php?id_menu=orcamento"],
        ["Editar", "tecnico.php?id_menu=editar_orcamento"],
		["Não Aprovados", "tecnico.php?id_menu=acompanhar_orc"],
		["Aprovados", "acompanhamento/acompanhar_orcamentos.php"]

	
]

