$(document).ready(function() {
    setTimeout(function(){


        $("#opcao").change(function () {


            if($("#opcao").val()==1) {
                $("#cartao").css('display', 'block');
                $("#boleto").css('display', 'none');
            }
            if($("#opcao").val()==2) {
                $("#cartao").css('display', 'none');
                $("#boleto").css('display', 'block');
            }
        });

        $("#checkout").click(function () {

            var dadosFormulario = {};

            dadosFormulario['id'] =$("#idpedido").val();
            dadosFormulario['tipo'] =$("#opcao").val();

            bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })

            $.ajax({
                url: 'http://127.0.0.1:8000/recarga/pagamento',
                type: "post",
                cache: false,
                blockUI: true,
                data: dadosFormulario,
                success: function(response) {

                    var dialog = bootbox.dialog({
                        message: '<p><i class="fa fa-spin fa-spinner"></i> Consultando Operadora de Crédito...</p>'
                    });
                    dialog.init(function(){
                        setTimeout(function(){

                            location.href='http://127.0.0.1:8000/inicio';
                        }, 3000);
                    });


// do something in the background

                }
            });



        });
    },100);
});

