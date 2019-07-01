$('form').validate({
  submitHandler: function(form){
    var dados = $(form).serialize();
    $.ajax({
      url: '/',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        alert(ajaxOKAdicionarEstabelecimento);
        window.location.replace("/admin/user");
      },
      error: function(jqXHR, textStatus, errorThrown){
        ajaxErrorForm(jqXHR);
      }
    });
  },
  rules: {
    estabelecimento: {
      required: true
    },
    cidade: {
      required: true
    },
    telefone: {
      required: true,
      number: true,
      minlength: 7
    }
  },
  messages: {
    estabelecimento: valEstabelecimentoReq,
    cidade: valCidadeReq,
    telefone: {
      number: valTelNum,
      minlength: valTelMin
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
