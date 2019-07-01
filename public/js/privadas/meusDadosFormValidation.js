$('form').validate({
  submitHandler: function(form){
    var dados = $(form).serialize();
    ajaxCarregandoForm(ajaxMensagemCarregando);
      console.log(dados);
    $.ajax({
      url: '/usuario-atualizar-perfil',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
         $("#modalCarregando").modal('hide');
          location.reload();
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
    email: {
      required: true,
      email: true
    }
  },
  messages: {
    name: {
      required: valNomeReq
    },
    last_name: {
      required: valSobrenomeReq
    },
    email: {
      required: valEmailReq,
      email: valEmailEmail
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
