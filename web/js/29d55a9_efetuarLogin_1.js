

$(document).ready(function() {
    setTimeout(function(){
        Cadastro.iniciar();

    },100);
});

Cadastro = {
    $formulario: null,
    dados: {},
    campos: [],
    dataConclusaoDatePicker: null,

    //PRIVADOS------------------------------------------------------------------------------------------------//

    iniciarCampos: function() {
        var myself = this;



        myself.campos.login = $("#login");
        myself.campos.senha = $("#senha");



        myself.campos.botaoSalvar = $("#btn-salvar");



        myself.aplicarMascarasNosCampos();
    },

    aplicarMascarasNosCampos: function() {
        var myself = this;


        myself.campos.botaoSalvar.click(function(){

            //myself.recolherDadosFormularioEEnviar();


        });

    },

    recolherDadosFormularioEEnviar: function() {
        var dadosFormulario = {};
        var myself = this;


        dadosFormulario['login'] =myself.campos.login.val();
        dadosFormulario['senha'] =myself.campos.senha.val();

        console.log(dadosFormulario);

        //myself.executarEnvio(dadosFormulario);
    },


    executarEnvio : function (dadosFormulario) {
        console.log("ate aqui");
        $.ajax({
            url: 'http://127.0.0.1:8000/efetuar-login',
            type: "post",
            cache: false,
            blockUI: true,
            data: dadosFormulario,
            success: function(response) {
                console.log("foi");
            }
        });
    },

    //PUBLICOS------------------------------------------------------------------------------------------------//

    iniciar: function() {
        this.iniciarCampos();
    }
};