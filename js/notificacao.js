$(function () {

//  setInterval(function (){
//              $.ajax({
//            url: 'ajax/notificar_setor_tec.php',
////            data: {action: 'loadmore', offset: loaded - 1},
////            type: 'POST',
//            dataType: 'json',
//            beforeSend: function () {
//                //$('.j_notificacao').remove();
//            },
//            success: function (data) {
////$('.j_notificacao').fadeIn();
//                //$(data.result).change('.j_notificacao');
//                console.log(data.result);
//
//
//
//            }
//        });
//  }, 1000);


    setInterval(function () {
        var url = "ajax/notificar_setor_tec.php";
        //var valor = jQuery("#j_notificacao").load(url);
//         console.log(valor.data(v));

        jQuery("#j_notificacao").load(url);
    }, 1000);



});