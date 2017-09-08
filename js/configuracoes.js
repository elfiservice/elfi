$(function () {

  $('.j_btn_rec_email').click( function ( btnClicado ) {

console.log(btnClicado.currentTarget.id);

        var action = btnClicado.currentTarget.id;  
//        var callback = form.find('input[name="callback"]').val();
//        var callback_action = form.find('input[name="callback_action"]').val();     
//        var email = form.find('input[name="email-recuperar"]').val();
               
        $.ajax({
            url: 'ajax/configuracoes.ajax.php',
            data: {callback_action: action},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.form_load').fadeIn();
//                $('.trigger_ajax').fadeOut('fast');
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