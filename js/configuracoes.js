$(function () {

    $('#example button').click(function () {

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
                var formLoadImg = $('#' + action + '.form_load');
                formLoadImg.fadeOut(function () {
                    //EXIBE CALLBACKS
                    if (data.erro) {
                        //mensagem de erro
                        alert(data.erro);
                    }

                    if (data.result) {
                        alert(data.result);
//                        console.log(data.ativo);
                        btnClicked.text(data.ativo);
                        btnClicked.attr('id', data.ativo + '-' + data.id);
                        action = data.ativo + '-' + data.id;

                        formLoadImg.attr('id', action);

                    }

                    $('button#' + action).fadeIn();

                });
            }
        });
    });
});