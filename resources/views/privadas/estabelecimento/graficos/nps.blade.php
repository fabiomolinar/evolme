@extends('layouts.estabelecimentos')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/morris.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/dashboardNPS.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/daterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/meudaterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/graficos.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-dashboard-nps') }}">
  <title>{{ trans('mensagens.titulo-dashboard-overview-nps') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-dashboard-overview-nps') }}">
@endsection

@section('conteudoPainel')
  @include('includes.privadas.dashboard.menuOverview')
  @include('includes.privadas.dashboard.selecionarData')
  <div class="row">
    <div class="col-xs-12 col-sm-4 col-md-3">
      <div class="panel panel-default" id="grafNotaNPS">
        <div class="panel-heading">{{ trans('mensagens.nota-nps') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <p id="nota-nps">{{ trans('mensagens.sua-nota-e') }}<span></span></p>
          <div class="grafico" id="morrisNotaNPS"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-9">
      <div class="panel panel-default" id="grafNPSPorNota">
        <div class="panel-heading">{{ trans('mensagens.nps-por-nota') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisNPSPorNota"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="panel panel-default" id="grafNPSNoTempo">
        <div class="panel-heading">{{ trans('mensagens.nps-no-tempo') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisNPSNoTempo"></div>
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
        nps_score: parseInt(Math.random()*7 + 4)
      });
    }
    //REMOVER O CÓDIGO ACIMA!!!!!!!!!!!!!!!!!
    var rawData = [];
    var diasComDados = 0;
    var dados = [];
    var dadosMedia = [];
    var dadosIdUnico = [];
    var dadosAgrupado = [];
    var nps = {};
    var graficoNPSNota = {};
    var graficoNPSPorNota = {};
    var graficoNPSNoTempo = {};
    function arrumarDados() {
      //Esconder warnings de que não há dados suficientes.
      esconderMostrarAlertas(dados);
      if (diasComDados > 2) {
        dadosIdUnico = apenasUltimaNota(dados,'id');
        nps = calcularNPS(dadosIdUnico,'nps');
        $('#nota-nps').show();
        $('#nota-nps span').html(nps.nota);
        if (nps.nota >= 20) {
          $('#nota-nps').css('color',cores.promotores);
          $('#nota-nps span').css('border-color',cores.promotores);
        } else if (nps.nota >= -30) {
          $('#nota-nps').css('color',cores.neutros);
          $('#nota-nps span').css('border-color',cores.neutros);
        } else {
          $('#nota-nps').css('color',cores.detratores);
          $('#nota-nps span').css('border-color',cores.detratores);
        }
        dadosAgrupado = agrupar(dadosIdUnico,'nps',[0,1,2,3,4,5,6,7,8,9,10]);
        dadosMedia = mediaMovelNPS(dados,30,'data','nps');
        dadosMedia.map(function(item){
          item.data = item.data.getTime();
        });
      }
    }
    function pintarBarras() {
      $('#morrisNPSPorNota svg rect').each(function(index,element){
        var elemento = $(element);
        if (index <= 6) {
          elemento.css('fill',cores.detratores);
        } else if (index <= 8) {
          elemento.css('fill',cores.neutros);
        } else {
          elemento.css('fill',cores.promotores);
        }
      });
    }

    $(document).ready(function(){
      $('#dashMenuNPS').addClass('active');
      $('#nota-nps').hide();
      if (typeof json_data != 'undefined'){
        $.each(json_data, function() {
    			rawData.push({
            data: moment(this.created_at,'YYYY-MM-DD').toDate(),
            id: parseFloat(this.id),
            nps: parseFloat(this.nps_score)
          });
    		});
      }
      rawData.sort(function(a,b){
        return a.data.getTime() - b.data.getTime();
      });
      dados = rawData;
      arrumarDados();
      if (diasComDados > 2) {
        graficoNPSNota = new Morris.Donut({
          element: 'morrisNotaNPS',
          data: nps.agrupado,
          resize: true,
          hideHover: true,
          colors: [cores.promotores,cores.detratores,cores.neutros]
        });
        graficoNPSPorNota = new Morris.Bar({
          element: 'morrisNPSPorNota',
          data: dadosAgrupado,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['0','1','2','3','4','5','6','7','8','9','10'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Nota: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
        pintarBarras();
        graficoNPSNoTempo = new Morris.Line({
          element: 'morrisNPSNoTempo',
          data: dadosMedia,
          xkey: 'data',
          ykeys: ['mMnps'],
          labels: ['NPS'],
          ymax: 100,
          ymin: -100,
          smooth: true,
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row){
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = moment(row.data).format('DD/MM/YYYY');
            return conteudo;
          }
        });
      }
      //Se o usuário mudar a data
      $('#selecionar-data').on('apply.daterangepicker', function(ev,picker){
        $('#nota-nps').hide();
        diasComDados = 0;
        dados = [];
        dadosMedia = [];
        dadosIdUnico = [];
        dadosAgrupado = [];
        nps = {};
        for (var i = 0; i < rawData.length; i++) {
          if (picker.startDate.toDate() - rawData[i].data <= 0) {
            if (picker.endDate.toDate() - rawData[i].data >= 0) {
              dados.push(rawData[i]);
            }
          }
        }
        arrumarDados();
        if (diasComDados > 2) {
          graficoNPSNota.setData(nps.agrupado);
          graficoNPSPorNota.setData(dadosAgrupado);
          pintarBarras();
          graficoNPSNoTempo.setData(dadosMedia);
        }
      });
      //Clique no daterangepicker
      $('.data-picker i, .data-picker b').click(function(){
        $('#selecionar-data').trigger('click');
      });
      //ON RESIZE
      window.onresize = function(event) {
        setTimeout(function(){pintarBarras();},500);
      }
    });
  </script>
@endsection
