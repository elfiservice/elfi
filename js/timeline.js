$(function () {
    
        $('.j_load').click(function () {
        var destino = $('.' + $(this).attr('rel'));
        var loaded = destino.find('li').length;  //conta quantos article existem na pagina
        //alert(loaded - 1);
        $.ajax({
            url: '../../ajax/timelinemore.php',
            data: {action: 'loadmore', offset: loaded - 1},
            type: 'POST',
            dataType: 'json',
            beforeSend: function () {
                $('.j_list').find('.form_load').fadeIn();
                $('.j_list').find('.trigger').fadeOut(400, function () {
                    $(this).remove();
                });
            },
            success: function (data) {
                $(data.result).appendTo(destino.find('.j_insert'));
                $('.j_list').find('.trigger, li').fadeIn(400, function () {
                    $('.j_list').find('.form_load').fadeOut();
                });
                
                if(data.final === false){
                    $('.j_list').find('.j_load').fadeOut();
                }
            }
        });
    });
    
});
