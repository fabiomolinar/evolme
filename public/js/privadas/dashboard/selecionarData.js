$(function(){
  moment.locale('pt-br');
  $('#selecionar-data').daterangepicker({
    autoUpdateInput: false,
    locale: {
      format: 'DD/MM/YYYY',
      separator: ' - ',
      applyLabel: 'Aplicar',
      cancelLabel: 'Cancelar',
      customRangeLabel: 'Outro período',
      daysOfWeek: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
      monthNames: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
      firstDay: moment.localeData().firstDayOfWeek()
    },
    ranges: {
      'Última semana': [moment().subtract(6, 'days'), moment()],
      'Esse mês': [moment().startOf('month'), moment()],
      'Último mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
      'Últimos 6 meses': [moment().subtract(6, 'month').startOf('month'), moment()],
      'Todo período': [moment("20141013", "YYYYMMDD"),moment()]
    }
  }, function(start, end, label){
    $('#selecionar-data').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
  });
});
