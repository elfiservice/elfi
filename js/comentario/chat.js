function update(){
      $.post("chat.php", {}, function(data){
            $("#chatbox").html(data);
      });
      setTimeout("update()", 300);
}
				  
$(document).ready(
      function(){
            update();
            $("#button").click(
                  function(){
                        if ($("#message").val() != ""){
                              $.post("chat.php",{
                                    message: $("#message").val(),
									id_protesto: $("#id_protesto").val(),
									id_dono_protest: $("#id_dono_protest").val(),
									id_dono_coment: $("#id_dono_coment").val()
									
                                   // name: $("#name").val()
                              },
                              function(data){
                                    update();
                                    $("#message").val($("#message").val()),
									$("#message").val("");
                              }
                              );
                        }
                        else {
                              alert("Você não escreveu nenhum comentário.");
                        }
                  }
                  );
      }
);