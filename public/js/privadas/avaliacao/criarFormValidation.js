$('form').validate({
  submitHandler: function(form){
    var dados = $(form).serialize();
    $.ajax({
      url: '/',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        alert(ajaxOK);
        window.location.replace("/");
      },
      error: function(jqXHR, textStatus, errorThrown){
        ajaxErrorForm(jqXHR);
        if ($('#errosAjax').css('display') === 'none') {
          window.location.replace("/");
        }
      }
    });
  },
  rules: {
    cidade: {
      required: true
    },
    estabelecimento: {
      required: true
    },
    endereco: {
      required: true
    }
  },
  messages: {
    cidade: valNomeReq,
    estabelecimento: valEstabelecimentoReq,
    endereco: valEnderecoReq
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
