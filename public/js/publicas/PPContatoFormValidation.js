$('form[name=PPFormContato]').validate({
  submitHandler: function(form){
    var dados = $(form).serialize();
    ajaxCarregandoForm(ajaxMensagemCarregando);
    $.ajax({
      url: '/ppContato',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        $("#modalCarregando").modal('hide');
        if(data.status == "true"){
          ajaxSucessoForm(data.mensagem);
          $(form)[0].reset();
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
    estabelecimento: {
      required: true
    },
    email: {
      required: true,
      email: true
    },
    telefone: {
      required: true,
      number: true,
      minlength: 7
    },
    mensagem: {
      required: function(element){
        return $(element).val().trim().length > 0;
      },
      minlength: 10
    }
  },
  messages: {
    nome: valNomeReq,
    estabelecimento: valEstabelecimentoReq,
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
//--------------------Form de seleção de produto
$('form[name=PPFormPasso1e2]').validate({
  ignore: [], //opção para que o jQuery validate valide os inputs que estão hidden
  submitHandler: function(form){
    var dados = $(form).serialize() + "&pacote=" + pacoteSelecionado;
    ajaxCarregandoForm(ajaxMensagemCarregando);
    $.ajax({
      url: '/planos-precos',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        $("#modalCarregando").modal('hide');
        if(data.status){
          ajaxSucessoForm(data.mensagem);
          $(form)[0].reset();
          location.href = "/perfil";
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
        //$("#modalCarregando").modal('hide');
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
    confirmarEmail: {
      equalTo: "#passo2 input[name=email]"
    },
    senha: {
      required: true,
      minlength: 6
    },
    confirmarSenha: {
      equalTo: "#passo2 input[name=senha]"
    },
    estabelecimento: {
      required: true
    },
    cidade: {
      required: false
    },
    telefone: {
      required: true,
      number: true,
      minlength: 7
    },
  },
  messages: {
    nome: valNomeReq,
    email: {
      required: valEmailReq,
      email: valEmailEmail
    },
    confirmarEmail: valEmailIgual,
    senha: {
      required: valSenhaReq,
      minlength: valSenhaMin
    },
    confirmarSenha: valSenhaIgual,
    estabelecimento: valEstabelecimentoReq,
    telefone: {
      number: valTelNum,
      minlength: valTelMin
    }
  },
  errorPlacement: function(error,element){
    var localErro = element.attr('name');
    var vetorErrosPasso2 = ["nome","email","confirmarEmail","senha","confirmarSenha"];
    for (var i = 0; i < vetorErrosPasso2.length; i++) {
      if (vetorErrosPasso2[i] == localErro && element.attr('class') == 'val-error') {
        $('#BPasso2').trigger('click');
      }
    }
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
