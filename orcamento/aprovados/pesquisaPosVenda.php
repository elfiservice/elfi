<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema ELFI | Técnico</title>

        <meta name="description" content="">
        <meta name="author" content="Elfiservice">

        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="../../estilos.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <style>
            .linhaPontuacao{
                margin-left: 210px;
            }

            .conteinerListaItens{
                float: left; 
                width: 210px; 
                border: 0px solid black;
                margin-right: 30px;
            }
            li{
                margin-top: 2px;
            }
            .itensRadio {
                margin-top: 2px;
                padding-left: 0px;
            }

            .radioItem{
                margin-right: 60px;

            }
            
            .container-fluid{
             padding-bottom: 10px;   
            }
            
            input[type=radio]{

  
            }
        </style>


    </head>
    <body>
        <?php
        // put your code here
        ?>
        <header>

            <fieldset class="">
                <legend><span class="bt_vermelho">ELFI </span></legend>
                <h2>Pesquisa de Entrega de Serviço</h2>
            </fieldset>
        </header>
        <section>
            <form name="clientForm" method="post" action="tecnico.php?id_menu=salvar_editar_orcamento" onsubmit="return formCheck(this);">       
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">1. Informações sobre o Desempenho </span></legend>
                        <div class="linhaPontuacao"> 
                            <ul class="list-inline">
                                <li>Ruim/Regular</li>
                                <li>Bom/Ótimo</li>
                            </ul>
                        </div>
                        <div>

                            <div class="conteinerListaItens">
                                <ul class="list-group-item-heading">
                                    <li>Confiabilidade:</li>
                                    <li>Pontualidade: </li>
                                    <li>Disponibilidade</li>
                                    <li>Qualidade</li>
                                    <li>Atendimento às normas de segurança</li>
                                </ul>
                            </div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1confiabilidade" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1confiabilidade" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1pontualidade" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1pontualidade" value="1">   &ensp;
                                    </label>
                                </div>  
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1disponibilide" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1disponibilide" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1qualidade" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1qualidade" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="1normasseguranca" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="1normasseguranca" value="1">   &ensp;
                                    </label>
                                </div>

                            </div>
                        </div>


                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">2. Informações sobre o Atendimento  </span></legend>
                                                        <div class="linhaPontuacao"> 
                            <ul class="list-inline">
                                <li>Ruim/Regular</li>
                                <li>Bom/Ótimo</li>
                            </ul>
                        </div>
                        <div>

                            <div class="conteinerListaItens">
                                <ul class="list-group-item-heading">
                                    <li>Apresentação</li>
                                    <li>Envolvimento </li>
                                    <li>Educação</li>

                                </ul>
                            </div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="2apresentacao" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="2apresentacao" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="2envolvimento" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="2envolvimento" value="1">   &ensp;
                                    </label>
                                </div>  
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="2educacao" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="2educacao" value="1">   &ensp;
                                    </label>
                                </div>


                            </div>
                        </div>
                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">3. Informações sobre Andamento dos Serviços  </span></legend>
                                                        <div class="linhaPontuacao"> 
                            <ul class="list-inline">
                                <li>Ruim/Regular</li>
                                <li>Bom/Ótimo</li>
                            </ul>
                        </div>
                        <div>

                            <div class="conteinerListaItens">
                                <ul class="list-group-item-heading">
                                    <li>Organização</li>
                                    <li>Competência Técnica </li>
                             </ul>
                            </div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="3organizacao" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="3organizacao" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="3competencia" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="3competencia" value="1">   &ensp;
                                    </label>
                                </div>  
                           </div>
                        </div>
                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">4. Informações sobre o atendimento aos prazos estabelecidos  </span></legend>
                                                        <div class="linhaPontuacao"> 
                            <ul class="list-inline">
                                <li>Ruim/Regular</li>
                                <li>Bom/Ótimo</li>
                            </ul>
                        </div>
                        <div>

                            <div class="conteinerListaItens">
                                <ul class="list-group-item-heading">
                                    <li>Entrega do Orçamento</li>
                                    <li>Serviço realizado </li>
                             </ul>
                            </div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="4orcamento" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="4orcamento" value="1">   &ensp;
                                    </label>
                                </div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="4servico" value="0" > &ensp;
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="4servico" value="1">   &ensp;
                                    </label>
                                </div>  
                           </div>
                        </div>
                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">5. Em geral você esta Satisfeito com a ELFI?   </span></legend>

                        <div>
                            <div>
                                <div class="itensRadio">
                                    <label class="radio-inline radioItem">
                                        <input  type="radio" name="5satisfeito" value="1" > Sim
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="5satisfeito" value="0">   Não
                                    </label>
                                </div>

                           </div>
                        </div>
                    </fieldset>
                </article>
                <article>
                    <fieldset class="container-fluid">
                        <legend><span class="bt_vermelho">6. OUTROS COMENTÁRIOS:   </span></legend>

                        
                         
                                <div class="itensRadio">
                                    <textarea style="height: 10em; width: 100%;" id="text" name="6outrosComentarios"></textarea> 
                                </div>

                         
                       
                    </fieldset>
                </article>
                <article>
                                        <fieldset class="container-fluid text-center">
                        <legend><span class="bt_vermelho"> </span></legend>

                    
<input type="submit" value="Salvar e Enviar" name="salvar" /> 
                                        </fieldset>
                </article>
                   
            </form>
        </section>

    </body>
</html>
