$('form').validate({
  submitHandler: function(form){
    var dados = $(form).serialize();
    ajaxCarregandoForm(ajaxMensagemCarregando);
    $.ajax({
      url: '/cadastrar',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        if(data.status == "true"){
          if(data.returnUrl != null && data.returnUrl != ""){
            window.location.replace(data.returnUrl);
          }
        }else{
          ajaxError = data.loginFail;
          ajaxErrorForm(ajaxError);
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        $("#modalCarregando").modal('hide');
        ajaxErrorForm(jqXHR);
      }
    });
  },
  rules: {
    name: {
      required: true
    },
    last_name: {
      required: false
    },
    nickname: {
      required: false
    },
    email: {
      required: true,
      email: true
    },
    email_confirmation: {
      equalTo: "form input[name=email]"
    },
    password: {
      required: true,
      minlength: 6
    },
    password_confirmation: {
      equalTo: "form input[name=password]"
    },
    concordo: {
      required: true
    }
  },
  messages: {
    name: {
      required: valNomeReq
    },
    last_name: {
      required: ""
    },
    email: {
      required: valEmailReq,
      email: valEmailEmail
    },
    email_confirmation: {
      equalTo: valEmailIgual
    },
    password: {
      required: valSenhaReq,
      minlength: valSenhaMin
    },
    password_confirmation: {
      equalTo: valSenhaIgual
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
