

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



        myself.campos.nome = $("#nome");
        myself.campos.sobrenome = $("#sobrenome");
        myself.campos.dtnascimento = $("#dtnascimento");
        myself.campos.sexo = $("#sexo");
        myself.campos.cpf = $("#cpf");
        myself.campos.celular = $("#celular");
        myself.campos.telefone = $("#telefone");
        myself.campos.nomePai = $("#nomePai");
        myself.campos.email = $("#email");
        myself.campos.cep = $("#cep");
        myself.campos.complemento = $("#complemento");
        myself.campos.login = $("#login");
        myself.campos.senha = $("#senha");


        myself.campos.botaoSalvar = $("#btn-salvar");



        myself.aplicarMascarasNosCampos();
    },

    aplicarMascarasNosCampos: function() {
        var myself = this;


        myself.campos.botaoSalvar.click(function(){
            
                    myself.recolherDadosFormularioEEnviar();


        });

    },

    recolherDadosFormularioEEnviar: function() {
        var dadosFormulario = {};
        var myself = this;




        dadosFormulario['nome'] =myself.campos.nome.val();
        dadosFormulario['sobrenome'] =myself.campos.sobrenome.val();
        dadosFormulario['dtnascimento'] =myself.campos.dtnascimento.val();
        dadosFormulario['sexo'] =myself.campos.sexo.val();
        dadosFormulario['cpf'] =myself.campos.cpf.val();
        dadosFormulario['celular'] =myself.campos.celular.val();
        dadosFormulario['telefone'] =myself.campos.telefone.val();
        dadosFormulario['nomePai'] =myself.campos.nomePai.val();
        dadosFormulario['email'] =myself.campos.email.val();
        dadosFormulario['cep'] =myself.campos.cep.val();
        dadosFormulario['complemento'] =myself.campos.complemento.val();
        dadosFormulario['login'] =myself.campos.login.val();
        dadosFormulario['senha'] =myself.campos.senha.val();



        myself.executarEnvio(dadosFormulario);
    },


    executarEnvio : function (dadosFormulario) {
        console.log("ate aqui");
        $.ajax({
            url: 'http://127.0.0.1:8000/novo-usuario',
            type: "post",
            cache: false,
            blockUI: true,
            data: dadosFormulario,
            success: function(response) {
                alert('js funcionando com ajax');
            }
        });
    },

    //PUBLICOS------------------------------------------------------------------------------------------------//

    iniciar: function() {
        this.iniciarCampos();
    }
};