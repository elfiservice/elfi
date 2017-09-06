$(function () {
  
  $('input[name="recuperar-senha-btn"]').click( function () {
//        var form = $(this);
        var form = $('form[name="EsqueciSenhaForm"]');  
        var callback = form.find('input[name="callback"]').val();
        var callback_action = form.find('input[name="callback_action"]').val();     
        var email = form.find('input[name="email-recuperar"]').val();
               
        $.ajax({
            url: 'ajax/' + callback + '.ajax.php',
            data: {callback_action: callback_action, email: email},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                console.log(callback);
                $('.form_load').fadeIn();
                $('.trigger_ajax').fadeOut('fast');
            },

            success: function (data) {
                //REMOVE LOAD
                $('.form_load').fadeOut('slow', function () {
                    //EXIBE CALLBACKS
                    if (data.erro) {
                        //mensagem de sucesso
                        alert(data.erro);
                    }
                    
                    if (data.result) {
                        alert(data.result);
                        $('input[name="email-recuperar"]').val("");
                        $("#id01").fadeOut();
                    }

                });
            }
        });
       return false;
    });
  
  
});