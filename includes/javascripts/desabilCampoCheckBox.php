<?php
?>
<!--
DESABILITAR CAMPOS COM CHECKBOX
-->
<script type="text/javascript" src="<?= $www ?>/js/desabilitar/jquery-latest.js"></script>
<script type="text/javascript">
function toggleStatus() {


	if ($('#toggleElement').is(':checked')) {
		$('#elementsToOperateOn :input').attr('disabled', true);
		$('#elementsToOperateOn2 :input').removeAttr('disabled');


	} else {
		$('#elementsToOperateOn :input').removeAttr('disabled');
		$('#elementsToOperateOn2 :input').attr('disabled', true);
	}
}
</script>