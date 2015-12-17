$(function() {

	// load the modal window
	$('a.nova_classificacao').click(function(){

		// scroll to top
		$('html, body').animate({scrollTop:0}, 'fast');

		// before showing the modal window, reset the form incase of previous use.
		$('.success, .error').hide();
		$('form#Nova_classf_Form').show();
		
		// Reset all the default values in the form fields
		$('#name').val('');


		//show the mask and contact divs
		$('#mask').show().fadeTo('', 0.7);
		$('div#nova_classificacao').fadeIn();

		// stop the modal link from doing its default action
		return false;
	});

	// close the modal window is close div or mask div are clicked.
	$('div#close, div#mask').click(function() {
		$('div#nova_classificacao, div#mask').stop().fadeOut('slow');

	});

	$('#Nova_classf_Form input').focus(function() {
		$(this).val(' ');
	});
	


	// when the Submit button is clicked...
	$('input#submit').click(function() {
	$('.error').hide().remove();
		//Inputed Strings
		var username = $('#name').val();
		
	
		//Error Count
		var error_count;
		
		//Regex Strings
		var username_regex = /^[a-z0-9_-]{3,16}$/,
			email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
		
			//Test Username
			if(!username_regex.test(name)) {
				$('#contact_header').after('<p class=error>Preencha o campo</p>');
				error_count += 1;
			}
			

			
			//No Errors?
			if(error_count === 0) {
				$.ajax({
					type: "post",
					url: "nova_classificacao.php",
					data: "name=" + name,
					error: function() {
						$('.error').hide();
						$('#sendError').slideDown('slow');
					},
					success: function () {
						$('.error').hide();
						$('.success').slideDown('slow');
						$('form#Nova_classf_Form').fadeOut('slow');
					}				
				});	
			}
			
			else {
                $('.error').show();
            }
			
		return false;
	});
	
});