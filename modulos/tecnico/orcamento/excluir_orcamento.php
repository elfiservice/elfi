<?php
        $orc = "";
        if(isSet ($_GET['id_orc'])) {
        
             $orc = $_GET['id_orc'];
        } 

$mens_erro = $_GET ['msg_erro'];

if(!$orc == "" || !$orc == null){
$orcCtrlExcluir = new OrcamentoCtrl();
$orcExcluirObj = $orcCtrlExcluir->buscarOrcamentoPorId("*", "where id = $orc");
    if(!$orcExcluirObj == ""){

        
?>

 <div>
	<h2><?php include_once 'orcamento/includes/nav_wizard.php'; ?> -> Excluir</h2>
</div>
<hr>


<div
	STYLE="font-size: 16px; text-align: center; margin-top: 10px; color: red;">
    
    <?php echo  $mens_erro; ?>
</div>
<div STYLE="font-size: 16px; margin-top: 10px; color: red;">
                <h4>No momento não é possível excluir um Orçamento, </h4>
</div>
<div STYLE="font-size: 14px; margin: 10px 10px;">
    <p>
        <b> Faça uma das duas opção:</b><br>
        1- Ponha ele como <b>Situação de Cancelada</b>, <br>
        2- ou, <b>Edite</b> ele e faça um <b>novo Orçamento</b><br> 
    </p>
</div>
<div style="margin: 10px;">
	<form method="post"
		action=""
		onsubmit="">


		<table border="0">

			<tbody>
				<tr>
					<td class="label">Nº Orc</td>
                                        <td class="input" COLSPAN="3"><b><?= $orcExcluirObj->getNOrc().".".$orcExcluirObj->getAnoOrc() ?></b></td>

				</tr>
				<tr>
					<td class="label">Razão Social / Nome:</td>
                                        <td class="input" COLSPAN="3"><b><?= $orcExcluirObj->getRazaoSocialContrat() ?></b></td>

				</tr>




			</tbody>
		</table>
		<hr>
<!--								<input class="bt_vermelho" type="submit" value="Exluir"	name="excluir_cliente" /> 
												
-->
	</form>



</div>

<?php
    }else{
        echo "Orcamento não existente!";
    }
} else{
    
    echo "Orcamento nao encontrado!";
    
}
?>