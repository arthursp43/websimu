

$(document).ready(function() {
    setTimeout(function(){
        $("#chegou").click(function () {
        var id =$(this).attr("data-id");
            
                
                    

                        //bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        bootbox.prompt({ 
                          title: "Para confirmar a chegada do cartão innforme o Código de Segurança que está no verso do cartão.", 
                          closeButton: false,
                          callback: function(result){ 


                            $.ajax({
                                url: 'http://127.0.0.1:8000/cartao/chegou',
                                type: "post",
                                cache: false,
                                blockUI: true,
                                data: {result:result, id:id},
                                success: function(response) {
                                    if(response['status']=='ok')
                                    {
                                        bootbox.alert("Chegada do Cartão Registrada com Sucesso, você já pode começar a utiliza-lo")
                                        location.href='http://127.0.0.1:8000/inicio';
                                    }else{
                                        bootbox.alert("Código de Segurança inválido!")
                                    }
                                }
                            });
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


        $("#ver-saldo").click(function () {
            var id =$(this).attr("data-id");
            var dadosFormulario = {};

            dadosFormulario['id'] =id;

            $.ajax({
                url: 'http://127.0.0.1:8000/cartao/saldo',
                type: "post",
                cache: false,
                blockUI: true,
                data: dadosFormulario,
                success: function(response) {

                    bootbox.alert("Saldo: R$"+response['saldo']);

                }
            });



        });
    },100);
});

