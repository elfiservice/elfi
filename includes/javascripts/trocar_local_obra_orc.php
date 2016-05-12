<?php
?>
<!-- Troca Local da Obra no OR�amento  -->
<script type="text/javascript">

function retira_form_obra() {
var planet = document.getElementById("form_local_obra");
planet.innerHTML = "<input onClick=\"return mostra_form_obra()\" name=\"submit\" type=\"submit\" value=\"O contratante é diferente do Local da Obra.\"  />";
}

//window.onload = cara;

</script>
<script type="text/javascript">

function mostra_form_obra() {
var planet = document.getElementById("form_local_obra");
planet.innerHTML = "            <input onClick=\"return retira_form_obra()\" name=\"submit\" type=\"submit\" value=\"Os dados da contratante são os mesmos da Obra.\"  /> \n\
                <table border=\"0\"> \n\
                                <tbody> \n\
                                    <tr align=\"left\"> \n\
                                      <td><label for=\"razao_social2\">Razao Social:</label></br> \n\
                                        <input name=\"razao_social2\" id=\"razao_social2\" size=\"60\" maxlength=\"255\"> \n\
                                      </td> \n\
                                      <td><label for=\"cnpj2\">CNPJ:</label></br> \n\
                                        <input name=\"cnpj2\" id=\"cnpj2\" alt=\"cnpj\" size=\"20\" maxlength=\"20\"> \n\
                                    </td> \n\
                                </tr> \n\
                                  <tr align=\"left\"> \n\
                                    <td><label for=\"endereco2\">Endereco:</label></br> \n\
                                    <input name=\"endereco2\" id=\"endereco2\" size=\"60\" maxlength=\"255\"></td> \n\
                                </tr> \n\
                                <tr align=\"left\"> \n\
                                    <td><label for=\"bairro2\">Bairro:</label></br> \n\
                                    <input name=\"bairro2\" id=\"bairro2\" size=\"20\" maxlength=\"255\"> \n\
                                    </td> \n\
                                    <td><label for=\"city2\">Cidade:</label></br> \n\
                                    <input name=\"city2\" id=\"city2\" size=\"20\" maxlength=\"255\"> \n\
                                    </td> \n\
                                    <td><label for=\"estado2\">Estado:</label></br>\n\
                                        <input name=\"estado2\" id=\"estado2\" size=\"20\" maxlength=\"255\" > \n\
                                                    </td>\n\
                                    </tr> \n\
                                <tr align=\"left\"> \n\
                                    <td><label for=\"cep2\">CEP:</label></br> \n\
                                    <input name=\"cep2\" id=\"cep2\" alt=\"cep\" size=\"20\" maxlength=\"15\"> \n\
                                  </td> \n\
                                     <td><label for=\"tel2\">Telefone:</label></br> \n\
                                    <input name=\"tel2\" id=\"tel2\" size=\"20\" alt=\"phone\" maxlength=\"15\"> \n\
                                    </td> \n\
                                     <td><label for=\"cel2\">Celular:</label></br> \n\
                                    <input name=\"cel2\" id=\"cel2\" size=\"20\" alt=\"cel\" maxlength=\"15\"> \n\
                                    </td> \n\
                                    </tr> \n\
                                <tr align=\"left\"> \n\
                                    <td><label for=\"email_orc2\">Email:</label></br> \n\
                                    <input name=\"email_orc2\" id=\"email_orc2\" size=\"20\" maxlength=\"255\"> \n\
                                    </td> \n\
                                </tr> \n\
                                </tbody> \n\
                </table> \n\
                ";
}

//window.onload = cara;

</script>
<!-- FIM  Troca Local da Obra no OR�amento  -->