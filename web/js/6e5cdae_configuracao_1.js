

$(document).ready(function() {
    setTimeout(function(){
            var a="<tr><td><b>Cartão</b></td><td><b>Valor</b></td><td><b>Ação</b></td></tr>";
            var total=0;

        $("#valor").inputmask('decimal', {
            'alias': 'numeric',
            'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ",",
            'digitsOptional': false,
            'allowMinus': false,
            'prefix': 'R$ ',
            'placeholder': ''
        });


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


            $("#form").parsley().validate();

            if ($("#form").parsley().isValid()){



            var dadosFormulario = {};
            var valor=$("#valor").val();
            var valorformatado=valor.replace(',','.');
            valorformatado=valorformatado.substring(3, valorformatado.length);

            console.log(valorformatado)


            dadosFormulario['cartao']= $("#cartoes").val();
            dadosFormulario['valor'] =valorformatado;
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
            }
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

