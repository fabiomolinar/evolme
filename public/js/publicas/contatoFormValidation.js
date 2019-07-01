$('form').validate({
  submitHandler: function(form){
    var dados = $(form).serialize();
    ajaxCarregandoForm(ajaxMensagemCarregando);
    $.ajax({
      url: '/contato',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        $("#modalCarregando").modal('hide');
        if(data.status == "true"){
            $(form)[0].reset();
            ajaxSucessoForm(data.mensagem);
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $("#modalCarregando").modal('hide');
        ajaxErrorForm(jqXHR);
        if ($('#errosAjax').css('display') === 'none') {
          window.location.replace("/contato#formulario-contato");
        }
      }
    });
  },
  rules: {
    nome: {
      required: true
    },
    email: {
      required: true,
      email: true
    },
    telefone: {
      required: function(element){
        return $(element).val().trim().length > 0;
      },
      number: true,
      minlength: 7
    },
    mensagem: {
      required: true,
      minlength: 10
    }
  },
  messages: {
    nome: valNomeReq,
    email: {
      required: valEmailReq,
      email: valEmailEmail
    },
    telefone: {
      number: valTelNum,
      minlength: valTelMin
    },
    mensagem: {
      required: valMsgReq,
      minlength: valMsgMin
    }
  },
  errorPlacement: function(error,element){
    var rotulo = element.next();
    rotulo.attr('placeholder',error.text());
  },
  success: function(label,element){
    var rotulo = $(element).next();
    rotulo.attr('placeholder',rotulo.attr('original'));
  },
  errorClass: "val-error",
  validClass: "val-valid"
});
