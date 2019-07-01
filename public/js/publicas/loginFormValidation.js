$('form').validate({
  submitHandler: function(form){
    var dados = $(form).serialize();
    $.ajax({
      url: '/login',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        console.log(data);
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
        ajaxErrorForm(jqXHR);
      }
    });
  },
  rules: {
    email: {
      required: true,
      email: true
    },
    password: {
      required: true,
      minlength: 6
    }
  },
  messages: {
    email: {
      required: valEmailReq,
      email: valEmailEmail
    },
    password: {
      required: valSenhaReq,
      minlength: valSenhaMin
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
