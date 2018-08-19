

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
        $("#tipo").change(function () {

            if($("#tipo").val()=='VALE TRANSPORTE')
            {
                $("#doc1").css('display', 'block');
                $("#doc2").css('display', 'none');
            }
            else{
                $("#doc1").css('display', 'none');
                $("#doc2").css('display', 'block');
            }

        });

    },100);
});

