

$(document).ready(function() {
    setTimeout(function(){
            var a="<tr><td><b>Cartão</b></td><td><b>Valor</b></td><td><b>Ação</b></td></tr>";
            var total=0;


        // $("#add").click(function(){
        //
        //     var cartao =$("#cartoes").val();
        //     var valor  =$("#valor").val();
        //     total=total+parseFloat(valor);
        //     a=a+"<tr><td>"+cartao+"</td><td>"+valor+"</td><td><a href='#'>Remover</a></td></tr>";
        //     $("#tabelapedido").html(a);
        //     $("#tabelapedido").append("<tr><td><b>Total do Pedido</b></td><td><b>"+total+"</b></td></tr>");
        // });

        $("#add").click(function(){
            var dadosFormulario = {};




            dadosFormulario['cartao']= $("#cartoes").val();
            dadosFormulario['valor'] =$("#valor").val();
            dadosFormulario['id'] =$("#id").val();


            $.ajax({
                url: 'http://127.0.0.1:8000/recarga/registrar-item-pedido',
                type: "post",
                cache: false,
                blockUI: true,
                data: dadosFormulario,
                success: function(response) {

                    bootbox.alert({
                        message: "`Item registrado com Sucesso!",
                        callback: function () {
                            location.href='http://127.0.0.1:8000/recarga/meus-cartoes/'+dadosFormulario['id'];
                        }

                    })
                }
            });
        });
        $("#excluir").click(function(){
            var dadosFormulario = {};

            dadosFormulario['id'] =$("#id").val();
            dadosFormulario['iditenspedido']=$("#excluir").data("id");

            $.ajax({
                url: 'http://127.0.0.1:8000/recarga/excluir-item-pedido',
                type: "post",
                cache: false,
                blockUI: true,
                data: dadosFormulario,
                success: function(response) {
                    bootbox.alert({
                        message: "Iten Removido com Sucesso",
                        callback: function(){
                            location.href='http://127.0.0.1:8000/recarga/meus-cartoes/'+dadosFormulario['id'];
                        }
                    })
                }
            });
        });
        $("#confirmapedido").click(function(){
            var dadosFormulario = {};

            dadosFormulario['id'] =$("#id").val();


            $.ajax({
                url: 'http://127.0.0.1:8000/recarga/encaminhar-pedido',
                type: "post",
                cache: false,
                blockUI: true,
                data: dadosFormulario,
                success: function(response) {

                    bootbox.alert({
                        message: "`Pedido Confirmado com Sucesso!",
                        callback: function () {
                            location.href='http://127.0.0.1:8000/recarga/checkout/'+dadosFormulario['id'];
                        }
                    })
                }
            });
        });




    },100);
});

