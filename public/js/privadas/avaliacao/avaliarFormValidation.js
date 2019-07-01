jQuery.validator.addMethod("dataValida",function(value,elemento){
  if (value == "") {
    return true
  }
  return moment(value,'YYYY-MM-DD',true).isValid();
},valDataInvalida);
$('form').validate({
  ignore: [], //opção para que o jQuery validate valide os inputs que estão hidden
  submitHandler: function(form){
    var dados = $(form).serialize();
    $.ajax({
      url: '/avaliar',
      type: 'POST',
      dataType: 'json',
      data: dados,
      success: function(data){
        alert(ajaxOKAvaliacaoEstabelecimento);
        window.location.replace("/buscar");
      },
      error: function(jqXHR, textStatus, errorThrown){
        ajaxErrorForm(jqXHR);
      }
    });
  },
  invalidHandler: function(evento, validator){
    alert(erroValidacao);
  },
  rules: {
    quality_score: {
      required: true,
      min: 1,
      max: 5
    },
    time_score: {
      required: true,
      min: 1,
      max: 5
    },
    price_score: {
      required: true,
      min: 1,
      max: 5
    },
    service_score: {
      required: true,
      min: 1,
      max: 5
    },
    freq_us: {
      required: false,
      digits: true,
      max: 180
    },
    freq_general: {
      required: false,
      digits: true,
      max: 180
    },
    nascimentoDia: {
      required: false,
      digits: true,
      min: 1,
      max: 31
    },
    nascimentoMes: {
      required: false,
      digits: true,
      min: 1,
      max: 12
    },
    nascimentoAno: {
      required: false,
      digits: true,
      min: parseInt(moment().format('YYYY'))-120,
      max: parseInt(moment().format('YYYY'))
    },
    birth_date: {
      dataValida: true,
      required: false
    }
  },
  messages: {
    quality_score: {
      required: valCampoObrigatorio,
      min: valCampoObrigatorio,
      max: valCampoObrigatorio
    },
    time_score: {
      required: valCampoObrigatorio,
      min: valCampoObrigatorio,
      max: valCampoObrigatorio
    },
    price_score: {
      required: valCampoObrigatorio,
      min: valCampoObrigatorio,
      max: valCampoObrigatorio
    },
    service_score: {
      required: valCampoObrigatorio,
      min: valCampoObrigatorio,
      max: valCampoObrigatorio
    },
    freq_us: {
      digits: valNumeroInteiro,
      max: valNumeroExcedeLimite
    },
    freq_general: {
      digits: valNumeroInteiro,
      max: valNumeroExcedeLimite
    },
    nascimentoDia: {
      digits: valNumeroInteiro,
      min: valDadoIncorreto,
      max: valDadoIncorreto
    },
    nascimentoMes: {
      digits: valNumeroInteiro,
      min: valDadoIncorreto,
      max: valDadoIncorreto
    },
    nascimentoAno: {
      digits: valNumeroInteiro,
      min: valDadoIncorreto,
      max: valDadoIncorreto
    },
    birth_date: {
      dataValida: valDataInvalida
    }
  },
  errorPlacement: function(error,element){
    var localErro = element.attr('name');
    var vetorEstrelas = ['quality_score','time_score','price_score','service_score'];
    if ($.inArray(localErro,vetorEstrelas) >= 0) {
      $('td[data-name=' + localErro + ']').next()
        .removeClass('fa-check')
        .addClass('fa fa-times')
        .show();
    }
    if (localErro == "birth_date") {
      $('#nascimentoAlerta').show();
    }
  },
  success: function(label,element){
    var localErro = $(element).attr('name');
    var vetorEstrelas = ['quality_score','time_score','price_score','service_score'];
    if ($.inArray(localErro,vetorEstrelas) >= 0) {
      $('td[data-name=' + localErro + ']').next()
        .removeClass('fa-times')
        .addClass('fa fa-check')
        .show();
    }
    if (localErro == "birth_date") {
      $('#nascimentoAlerta').hide();
    }
  },
  errorClass: "val-error",
  validClass: "val-valid"
});
