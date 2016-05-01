<script src="<?= $www ?>/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#colaborador_logado").load('<?= $www ?>/colaborador_logado.php?id_colaborador=<?php echo $logOptions_id;?>');
});
</script>
