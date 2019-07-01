$('form').validate({
  submitHandler: function(form){
    var dados = $(form).serialize();
    $.ajax({
      url: '/trabalhe-conosco',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        alert(ajaxOK);
        window.location.replace("/");
      },
      error: function(jqXHR, textStatus, errorThrown){
        ajaxErrorForm(jqXHR);
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
      minlength: 20
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
