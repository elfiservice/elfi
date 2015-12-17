$(function() {

	// load the modal window
	$('a.nova_atividade').click(function(){

		// scroll to top
		$('html, body').animate({scrollTop:0}, 'fast');

		// before showing the modal window, reset the form incase of previous use.
		$('.success_nova_atividade, .error_nova_atividade').hide();
		$('form#Nova_ativ_Form').show();
		
		// Reset all the default values in the form fields
		$('#name').val('');


		//show the mask and contact divs
		$('#mask_nova_atividade').show().fadeTo('', 0.7);
		$('div#nova_atividade').fadeIn();

		// stop the modal link from doing its default action
		return false;
	});

	// close the modal window is close div or mask div are clicked.
	$('div#close_nova_atividade, div#mask_nova_atividade').click(function() {
		$('div#nova_atividade, div#mask_nova_atividade').stop().fadeOut('slow');

	});

	$('#Nova_ativ_Form input').focus(function() {
		$(this).val(' ');
	});
	


	// when the Submit button is clicked...
	$('input#submit').click(function() {
	$('.error_nova_atividade').hide().remove();
		//Inputed Strings
		var username = $('#name').val();
		
	
		//Error Count
		var error_count;
		
		//Regex Strings
		var username_regex = /^[a-z0-9_-]{3,16}$/,
			email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
		
			//Test Username
			if(!username_regex.test(name)) {
				$('#nova_atividade_header').after('<p class=error_nova_atividade>Preencha o campo</p>');
				error_count += 1;
			}
			

			
			//No Errors?
			if(error_count === 0) {
				$.ajax({
					type: "post",
					url: "nova_atividade.php",
					data: "name=" + name,
					error: function() {
						$('.error_nova_atividade').hide();
						$('#sendError').slideDown('slow');
					},
					success: function () {
						$('.error_nova_atividade').hide();
						$('.success_nova_atividade').slideDown('slow');
						$('form#Nova_ativ_Form').fadeOut('slow');
					}				
				});	
			}
			
			else {
                $('.error_nova_atividade').show();
            }
			
		return false;
	});
	
});