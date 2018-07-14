

$(document).ready(function() {
    setTimeout(function(){
        $("#enviar").click(function () {

            bootbox.confirm({
                message: "Deseja realmente solicitar novo Cartão?",
                callback: function(result){
                    if(result)
                    {
                        bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        $("#form1").submit();
                    }

                }
            })


        });
    },100);
});

