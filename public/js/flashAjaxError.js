function flashAjaxError(erros) {
  $('html, body').animate({ scrollTop: 0 }, "slow");
  $('#errosAjax p').html(erros);
  $('#errosAjax').show().delay(5000).fadeOut(1000);
}
