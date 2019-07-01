function ajaxErrorForm(jqXHR) {
  if (jqXHR.status == 422) {
    var textoDoErro = "";
    if (jqXHR.hasOwnProperty('responseJSON')) {
      $.each(jqXHR.responseJSON,function(key,value){
        textoDoErro += value + "<br>";
      });
    }
    if (textoDoErro == "") {
      $("#modalErro .modal-body p").html(ajaxError);
      $("#modalErro").modal();
    } else {
      flashAjaxError(textoDoErro);
    }
  } else {
    $("#modalErro .modal-body p").html(ajaxError);
    $("#modalErro").modal();
  }
}
