

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


        myself.campos.id = $("#id");
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

        myself.campos.cpf.inputmask({
            mask: ['999.999.999-99', '99.999.999/9999-99'],
            keepStatic: true
        });

        myself.campos.cep.inputmask({
            mask: ['99999-999'],
            keepStatic: true
        });

        myself.campos.telefone.inputmask({
            mask: ['(99) 9999 9999'],
            keepStatic: true
        });

        myself.campos.celular.inputmask({
            mask: ['(99) 99999 9999'],
            keepStatic: true
        });

    },

    recolherDadosFormularioEEnviar: function() {
        var dadosFormulario = {};
        var myself = this;



        dadosFormulario['id'] =myself.campos.id.val();
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
        $("#registro").parsley().validate();

        if ($("#registro").parsley().isValid()) {
            $.ajax({
                url: 'http://127.0.0.1:8000/novo-usuario',
                type: "post",
                cache: false,
                blockUI: true,
                data: dadosFormulario,
                success: function (response) {
                    bootbox.dialog({message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Cadastro Criado com Sucesso!</div>'})

                    location.href = 'http://127.0.0.1:8000/login';
                }
            });
        }
    },

    //PUBLICOS------------------------------------------------------------------------------------------------//

    iniciar: function() {
        this.iniciarCampos();
    }
};