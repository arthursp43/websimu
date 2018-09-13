

$(document).ready(function() {
    setTimeout(function(){
        

        $("#btn-login2").click(function () {


            $("#form-login").parsley().validate();

            if ($("#form-login").parsley().isValid()){
                        bootbox.dialog({ message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Aguarde...</div>' })
                        $("#form-login").submit();}

        });
    },100);
});

