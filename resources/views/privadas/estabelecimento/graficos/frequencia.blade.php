@extends('layouts.estabelecimentos')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/morris.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/dashboardFrequencia.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/daterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/meudaterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/graficos.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-dashboard-frequencia') }}">
  <title>{{ trans('mensagens.titulo-dashboard-overview-frequencia') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-dashboard-overview-frequencia') }}">
@endsection

@section('conteudoPainel')
  @include('includes.privadas.dashboard.menuOverview')
  @include('includes.privadas.dashboard.selecionarData')
  <div class="row">
    <div class="col-xs-12 col-sm-6 com-md-3">
      <div class="panel panel-default" id="grafFreqEstabelecimento">
        <div class="panel-heading">
          {{ trans('mensagens.frequencia-meu-estabelecimento') }}
          <span>{{ trans('mensagens.por-mes') }}</span>
          <span class="duvida" data-toggle="tooltip" title="{{ trans('mensagens.freq-meu-est-explicacao') }}" data-placement="bottom">?</span>
        </div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisFreqEstabelecimento"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 com-md-3">
      <div class="panel panel-default" id="grafFreqGeral">
        <div class="panel-heading">
          {{ trans('mensagens.frequencia-total') }}
          <span>{{ trans('mensagens.por-mes') }}</span>
          <span class="duvida" data-toggle="tooltip" title="{{ trans('mensagens.freq-geral-est-explicacao') }}" data-placement="bottom">?</span>
        </div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisFreqGeral"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-offset-3 col-sm-6 com-md-3">
      <div class="panel panel-default" id="grafNovosRecorrentes">
        <div class="panel-heading">{{ trans('mensagens.novos-versus-recorrentes') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisNovosRecorrentes"></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('jsPainel')
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/morris.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/raphael.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/moment.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/daterangepicker.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/selecionarData.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/graficos.js') }}"></script>
  <script type="text/javascript">
    //REMOVER O json_data ABAIXO-------------------
    var json_data = [];
    for (var i = 0; i < 50; i++) {
      json_data.push({
        created_at: moment('2016-' + parseInt(Math.random()*11 + 1) + '-' + parseInt(Math.random()*25 + 1),'YYYY-MM-DD').format('YYYY-MM-DD'),
        id: parseInt(Math.random()*40),
        freq_estabelecimento: parseInt(Math.random()*7),
        freq_geral: parseInt(Math.random()*14 + 2),
        primeira_vez: parseInt(Math.random()*1 + 0.5)
      });
    }
    //REMOVER O CÓDIGO ACIMA!!!!!!!!!!!!!!!!!
    var min = 0;
    var max = 0;
    var min1 = 0;
    var max1 = 0;
    var min2 = 0;
    var max2 = 0;
    var rawData = [];
    var freqPossiveis = [];
    var diasComDados = 0;
    var dados = [];
    var dadosIdUnico = [];
    var dadosFreqEstabelecimento = [];
    var dadosFreqGeral = [];
    var dadosNovosRecorrentes = [];
    var graficoFreqEstabelecimento = {};
    var graficoFreqGeral = {};
    var graficoNovosRecorrentes = {};
    function arrumarDados() {
      //Esconder warnings de que não há dados suficientes.
      esconderMostrarAlertas(dados);
      if (diasComDados > 2) {
        dadosIdUnico = apenasUltimaNota(dados,'id',true,['freqEstabelecimento','freqGeral','novosRecorrentes']);
        max1 = Math.max.apply(Math,dadosIdUnico.map(function(obj){return obj.freqEstabelecimento}));
        min1 = Math.min.apply(Math,dadosIdUnico.map(function(obj){return obj.freqEstabelecimento}));
        max2 = Math.max.apply(Math,dadosIdUnico.map(function(obj){return obj.freqGeral}));
        min2 = Math.min.apply(Math,dadosIdUnico.map(function(obj){return obj.freqGeral}));
        max = (max1 > max2) ? max1 : max2;
        min = (min1 < min2) ? min1 : min2;
        for (var i = min; i <= max; i++) {
          freqPossiveis.push(i);
        }
        dadosFreqEstabelecimento = agrupar(dadosIdUnico,'freqEstabelecimento',freqPossiveis);
        dadosFreqGeral = agrupar(dadosIdUnico,'freqGeral',freqPossiveis);
        dadosNovosRecorrentes = agrupar(dados,'novosRecorrentes',[0,1]);
        dadosNovosRecorrentes = dadosNovosRecorrentes.map(function(obj){
          if (obj.valor === 0) {
            return {label: 'Recorrente', value: obj.quantidade};
          } else if (obj.valor === 1) {
            return {label: 'Novo', value: obj.quantidade};
          }
        });
      }
    }

    $(document).ready(function(){
      //Ativando tooltips
      $('[data-toggle="tooltip"]').tooltip();
      $('#dashMenuFrequencia').addClass('active');
      if (typeof json_data != 'undefined'){
        $.each(json_data, function() {
    			rawData.push({
            data: moment(this.created_at,'YYYY-MM-DD').toDate(),
            id: parseFloat(this.id),
            freqGeral: this.freq_geral,
            freqEstabelecimento: this.freq_estabelecimento,
            novosRecorrentes: this.primeira_vez
          });
    		});
      }
      rawData.sort(function(a,b){
        return a.data.getTime() - b.data.getTime();
      });
      dados = rawData;
      arrumarDados();
      if (diasComDados > 2) {
        graficoFreqEstabelecimento = new Morris.Bar({
          element: 'morrisFreqEstabelecimento',
          data: dadosFreqEstabelecimento,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['Frequência'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Vezes: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
        graficoFreqGeral = new Morris.Bar({
          element: 'morrisFreqGeral',
          data: dadosFreqGeral,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['Frequência'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Vezes: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
        graficoNovosRecorrentes = new Morris.Donut({
          element: 'morrisNovosRecorrentes',
          data: dadosNovosRecorrentes,
          resize: true,
          hideHover: true
        });
      }
      //Se o usuário mudar a data
      $('#selecionar-data').on('apply.daterangepicker', function(ev,picker){
        freqPossiveis = [];
        diasComDados = 0;
        dados = [];
        dadosIdUnico = [];
        dadosFreqEstabelecimento = [];
        dadosFreqGeral = [];
        dadosNovosRecorrentes = [];
        for (var i = 0; i < rawData.length; i++) {
          if (picker.startDate.toDate() - rawData[i].data <= 0) {
            if (picker.endDate.toDate() - rawData[i].data >= 0) {
              dados.push(rawData[i]);
            }
          }
        }
        arrumarDados();
        if (diasComDados > 2) {
          graficoFreqEstabelecimento.setData(dadosFreqEstabelecimento);
          graficoFreqGeral.setData(dadosFreqGeral);
          graficoNovosRecorrentes.setData(dadosNovosRecorrentes);
        }
      });
      //Clique no daterangepicker
      $('.data-picker i, .data-picker b').click(function(){
        $('#selecionar-data').trigger('click');
      });
      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
