

$(document).ready(function() {
    setTimeout(function(){
        $("#chegou").click(function () {
        var id =$(this).attr("data-id");
            
                
                    

                        //bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        bootbox.prompt({ 
                          title: "Para confirmar a chegada do cartão innforme o Código de Segurança que está no verso do cartão.", 
                          closeButton: false,
                          callback: function(result){ 

                            alert(result);
                          /* result = String containing user input if OK clicked or null if Cancel clicked */ }
                        })
                        //location.href='http://127.0.0.1:8000/cartao/chegou/'+id;
                    

                
            


        });


        $("#bloquear").click(function () {
            var id =$(this).attr("data-id");
            bootbox.confirm({
                message: "Confirmar Bloqueio cartão número: "+id,
                callback: function(result){
                    if(result)
                    {
                        bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        location.href='http://127.0.0.1:8000/cartao/bloquear/'+id;
                    }

                }
            })


        });

        $("#cancelar").click(function () {
            var id =$(this).attr("data-id");
            bootbox.confirm({
                message: "Confirmar Cancelamento do cartão número: "+id,
                callback: function(result){
                    if(result)
                    {
                        bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        location.href='http://127.0.0.1:8000/cartao/cancelar/'+id;
                    }

                }
            })


        });

        $("#ativar").click(function () {
            var id =$(this).attr("data-id");
            bootbox.confirm({
                message: "Confirmar Ativação do cartão número: "+id,
                callback: function(result){
                    if(result)
                    {
                        bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        location.href='http://127.0.0.1:8000/cartao/chegou/'+id;
                    }

                }
            })


        });
    },100);
});

