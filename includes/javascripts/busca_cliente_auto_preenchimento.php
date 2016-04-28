<?php
?>
<script type="text/javascript" src="./js/buscacliente/ajax.js"></script>
<script type="text/javascript">

	var ajax = new sack();
	var currentClientID=false;
	function getClientData()
	{
		var clientId = document.getElementById('clientID').value;
		if(clientId!=currentClientID){
			currentClientID = clientId
			ajax.requestFile = 'getClient.php?getClientId='+clientId;	// Specifying which file to get
			ajax.onCompletion = showClientData;	// Specify function that will be executed after file has been found
			ajax.runAJAX();		// Execute AJAX function			
		}
		
	}
	
	function showClientData()
	{
		var formObj = document.forms['clientForm'];	
		eval(ajax.response);
	}
	
	
	function initFormEvents()
	{
		document.getElementById('clientID').onblur = getClientData;
		document.getElementById('clientID').focus();
	}
	
	
	window.onload = initFormEvents;
	</script>
<!-- FIM Busca cliente para Auto Preenchimento  -->