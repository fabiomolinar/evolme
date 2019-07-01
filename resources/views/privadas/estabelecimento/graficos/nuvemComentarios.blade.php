@extends('layouts.estabelecimentos')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/overview.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/daterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/meudaterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/graficos.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-nuvem-comentarios') }}">
  <title>{{ trans('mensagens.titulo-nuvem-comentarios') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-nuvem-comentarios') }}">
@endsection

@section('conteudoPainel')
  @include('includes.privadas.dashboard.menuOverview')
  @include('includes.privadas.dashboard.selecionarData')
  <div class="panel panel-default" id="grafGeral">
    <div class="panel-heading">{{ trans('mensagens.comentarios') }}</div>
    <div class="panel-body">
      <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>

    </div>
  </div>
@endsection

@section('jsPainel')
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/moment.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/daterangepicker.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/selecionarData.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/graficos.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/d3.layout.cloud.js') }}"></script>
  <script type="text/javascript">
    //REMOVER O json_data ABAIXO-------------------
    var json_data = [];
    for (var i = 0; i < 50; i++) {
      json_data.push({
        created_at: moment('2016-' + parseInt(Math.random()*11 + 1) + '-' + parseInt(Math.random()*25 + 1),'YYYY-MM-DD').format('YYYY-MM-DD'),
        quality_score: parseInt(Math.random()*3 + 2),
        price_score: parseInt(Math.random()*5),
        customerservice_score: parseInt(Math.random()*2 + 1),
        waitingtime_score: parseInt(Math.random()*5)
      });
    }
    //REMOVER O CÓDIGO ACIMA!!!!!!!!!!!!!!!!!
    var rawData = [];
    var diasComDados = 0;
    var dados = [];
    var dadosMedia = [];
    var graficoGeral = {};
    function arrumarDados() {
      //Esconder warnings de que não há dados suficientes.
      esconderMostrarAlertas(dados);
      if (diasComDados > 2) {
        dadosMedia = mediaMovel(dados,30,'data',['qualidade','preco','servico','tempo']);
        dadosMedia.map(function(item){
          item.data = item.data.getTime();
        });
      }
    }

    $(document).ready(function(){
      $('#dashMenuNuvemComentario').addClass('active');
      if (typeof json_data != 'undefined'){
        $.each(json_data, function() {
    			rawData.push({
            data: moment(this.created_at,'YYYY-MM-DD').toDate(),
            qualidade: parseFloat(this.quality_score),
            preco: parseFloat(this.price_score),
            servico: parseFloat(this.customerservice_score),
            tempo: parseFloat(this.waitingtime_score)
          });
    		});
      }
      rawData.sort(function(a,b){
        return a.data.getTime() - b.data.getTime();
      });
      dados = rawData;
      arrumarDados();
      if (diasComDados > 2) {
        graficoGeral = new Morris.Line({
          element: 'morrisGeral',
          data: dadosMedia,
          xkey: 'data',
          ykeys: ['mMqualidade','mMpreco','mMservico','mMtempo'],
          labels: ['qualidade','preço','serviço','tempo'],
          ymax: 5,
          ymin: 0,
          smooth: true,
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row){
            var teste = $.parseHTML(content);
            teste[0].innerHTML = moment(row.data).format('DD/MM/YYYY');
            return teste;
          }
        });
      }
      //Se o usuário mudar a data
      $('#selecionar-data').on('apply.daterangepicker', function(ev,picker){
        diasComDados = 0;
        dados = [];
        dadosMedia = [];
        for (var i = 0; i < rawData.length; i++) {
          if (picker.startDate.toDate() - rawData[i].data <= 0) {
            if (picker.endDate.toDate() - rawData[i].data >= 0) {
              dados.push(rawData[i]);
            }
          }
        }
        arrumarDados();
        if (diasComDados > 2) {
          graficoGeral.setData(dadosMedia);
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
