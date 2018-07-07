

$(document).ready(function() {
    setTimeout(function(){
       $("#btn-salvar").click(function () {
           var dadosFormulario = {};





           dadosFormulario['login'] =$("#login").val();
           dadosFormulario['senha'] =$("#senha").val();
           dadosFormulario['titular'] =$("#titular").val();
           dadosFormulario['validade'] =$("#validade").val();
           dadosFormulario['tipo'] =$("#tipo").val();

           $.ajax({
               url: 'http://127.0.0.1:8000/cartao/registrar',
               type: "post",
               cache: false,
               blockUI: true,
               data: dadosFormulario,
               success: function(response) {
                   alert("Parabéns, Cartão solicitado com sucesso!");
                   var dados = {};
                   dados['login'] = response[1];
                   dados['senha'] = response[2];

                   $.ajax({
                       url: 'http://127.0.0.1:8000/inicio',
                       type: "post",
                       cache: false,
                       blockUI: true,
                       data: dados,
                       success: function(response) {
                           $(document).html(response.html);
                       }

                   });
               }
           });


       });
    },100);
});

