<?php
?>
<!-- MAscaras em campos valores-->
<script src="<?= $www ?>/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= $www ?>/js/mascara/jquery.meio.mask.js"
	charset="utf-8"></script>
<script type="text/javascript">
  (function($){
    // call setMask function on the document.ready event
      $(function(){
        $('input:text').setMask();
      }
    );
  })(jQuery);
</script>
<!-- FIM  MAscaras em campos -->