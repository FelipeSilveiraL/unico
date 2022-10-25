$("#estados").on("change", function(){
    var idEstado = $("#estados").val();
    
    $.ajax({
        url: '../bd/trazCidades.php',
        type: 'POST',
        data:{id:idEstado},
        beforeSend:function(data){
            $("#cidade").html('<option value="">Carregando...</option>');
        },
        success:function(data){
            $("#cidade").html(data);
        },
        error:function(data){
            $("#cidade").html('<option value="">Erro ao carregar...</option>');
        }

    });

});