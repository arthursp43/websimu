

$(document).ready(function() {
    setTimeout(function(){
        $("#btlogin").click(function () {

            bootbox.confirm({
                message: "Deseja realmente alterar seu Login?",
                callback: function(result){
                    if(result)
                    {
                        bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        $("#formlogin").submit();
                    }

                }
            })


        });

        $("#btnsenha").click(function () {

            bootbox.confirm({
                message: "Deseja realmente alterar sua Senha?",
                callback: function(result){
                    if(result)
                    {
                        bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        $("#formsenha").submit();
                    }

                }
            })


        });
    },100);
});

