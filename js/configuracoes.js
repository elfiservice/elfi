$(function () {

    $('#example button').click(function () {

//console.log(btnClicado.currentTarget.id);
        console.log($(this).attr('id'));
        var action = $(this).attr('id');
        var btnClicked = $(this);
        
        $.ajax({
            url: 'ajax/configuracoes.ajax.php',
            data: {callback_action: action},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                btnClicked.fadeOut(function () {
                    $('#' + action + '.form_load').fadeIn();

                });
            },

            success: function (data) {
                $('#' + action + '.form_load').fadeOut(function () {
                    //EXIBE CALLBACKS
                    if (data.erro) {
                        //mensagem de sucesso
                        alert(data.erro);
                    }

                    if (data.result) {
                        alert(data.result);
                       
                       
                    }
                    
                    $('button#' + action).fadeIn();

                });


            }
        });


    });


});