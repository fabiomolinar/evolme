@extends('layouts.estabelecimentos')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/morris.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/dashboardComparacao.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/daterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/meudaterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/graficos.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-dashboard-comparacao') }}">
  <title>{{ trans('mensagens.titulo-dashboard-overview-comparacao') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-dashboard-overview-comparacao') }}">
@endsection

@section('conteudoPainel')
  @include('includes.privadas.dashboard.menuOverview')
  @include('includes.privadas.dashboard.selecionarData')
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="panel panel-default" id="grafQualidade">
        <div class="panel-heading">{{ trans('mensagens.qualidade') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-uma-vez') }}</div>
          <div class="grafico" id="morrisQualidade"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="panel panel-default" id="grafAtendimento">
        <div class="panel-heading">{{ trans('mensagens.atendimento') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-uma-vez') }}</div>
          <div class="grafico" id="morrisAtendimento"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="panel panel-default" id="grafPreco">
        <div class="panel-heading">{{ trans('mensagens.preco') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-uma-vez') }}</div>
          <div class="grafico" id="morrisPreco"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="panel panel-default" id="grafTempo">
        <div class="panel-heading">{{ trans('mensagens.tempo') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-uma-vez') }}</div>
          <div class="grafico" id="morrisTempo"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="panel panel-default" id="grafLocal">
        <div class="panel-heading">{{ trans('mensagens.local') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-uma-vez') }}</div>
          <div class="grafico" id="morrisLocalizacao"></div>
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
        id: parseInt(Math.random()*40),
        created_at: moment('2016-' + parseInt(Math.random()*11 + 1) + '-' + parseInt(Math.random()*25 + 1),'YYYY-MM-DD').format('YYYY-MM-DD'),
        qualidade: parseInt(Math.random()*3 + 1),
        atendimento: parseInt(Math.random()*3 + 1),
        tempo: parseInt(Math.random()*3 + 1),
        localizacao: parseInt(Math.random()*3 + 1)
      });
    }
    json_data[0].preco = 2;
    json_data[1].preco = 3;
    json_data[2].preco = 2;
    json_data[3].preco = 1;
    json_data[4].preco = 2;
    json_data[5].preco = 3;
    json_data[6].preco = 1;
    json_data[7].preco = 2;
    //REMOVER O CÓDIGO ACIMA!!!!!!!!!!!!!!!!!
    var rawData = [];
    var dados = [];
    var dadosQualidade = [];
    var dadosAtendimento = [];
    var dadosPreco = [];
    var dadosTempo = [];
    var dadosLocalizacao = [];
    var graficoQualidade = {};
    var graficoAtendimento = {};
    var graficoPreco = {};
    var graficoTempo = {};
    var graficoLocalizacao = {};
    function arrumarDados() {
      //Esconder warnings de que não há dados suficientes.
      dados = apenasUltimaNota(dados,'id',true,['qualidade','atendimento','preco','tempo','localizacao']);
      dadosQualidade = agrupar(dados,'qualidade',[1,2,3]);
      dadosAtendimento = agrupar(dados,'atendimento',[1,2,3]);
      dadosPreco = agrupar(dados,'preco',[1,2,3]);
      dadosTempo = agrupar(dados,'tempo',[1,2,3]);
      dadosLocalizacao = agrupar(dados,'localizacao',[1,2,3]);
      esconderMostrarAlertas([dadosQualidade,dadosAtendimento,dadosPreco,dadosTempo,dadosLocalizacao],true,true,'quantidade',true,['#morrisQualidade','#morrisAtendimento','#morrisPreco','#morrisTempo','#morrisLocalizacao']);
      dadosQualidade[0].valor = 'Pior';
      dadosQualidade[1].valor = 'Igual';
      dadosQualidade[2].valor = 'Melhor';
      dadosAtendimento[0].valor = 'Pior';
      dadosAtendimento[1].valor = 'Igual';
      dadosAtendimento[2].valor = 'Melhor';
      dadosPreco[0].valor = 'Pior';
      dadosPreco[1].valor = 'Igual';
      dadosPreco[2].valor = 'Melhor';
      dadosTempo[0].valor = 'Pior';
      dadosTempo[1].valor = 'Igual';
      dadosTempo[2].valor = 'Melhor';
      dadosLocalizacao[0].valor = 'Pior';
      dadosLocalizacao[1].valor = 'Igual';
      dadosLocalizacao[2].valor = 'Melhor';
    }
    function pintarBarras() {
      $('.grafico').each(function(index, element){
        var retangulos = $(element).find('rect');
        retangulos[0].style.fill = cores.detratores;
        retangulos[1].style.fill = cores.neutros;
        retangulos[2].style.fill = cores.promotores;
      });
    }
    $(document).ready(function(){
      $('#dashMenuComparacao').addClass('active');
      if (typeof json_data != 'undefined'){
        $.each(json_data, function() {
    			rawData.push({
            id: this.id,
            data: moment(this.created_at,'YYYY-MM-DD').toDate(),
            qualidade: this.qualidade,
            atendimento: this.atendimento,
            preco: this.preco,
            tempo: this.tempo,
            localizacao: this.localizacao
          });
    		});
      }
      rawData.sort(function(a,b){
        return a.data.getTime() - b.data.getTime();
      });
      dados = rawData;
      arrumarDados();
      if (!(todosObjetosVazios(dadosQualidade,'quantidade'))) {
        graficoQualidade = new Morris.Bar({
          element: 'morrisQualidade',
          data: dadosQualidade,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['Qualidade'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Qualidade: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
      }
      if (!(todosObjetosVazios(dadosAtendimento,'quantidade'))) {
        graficoAtendimento = new Morris.Bar({
          element: 'morrisAtendimento',
          data: dadosAtendimento,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['Atendimento'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Atendimento: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
      }
      if (!(todosObjetosVazios(dadosPreco,'quantidade'))) {
        graficoPreco = new Morris.Bar({
          element: 'morrisPreco',
          data: dadosPreco,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['Preço'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Preço: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
      }
      if (!(todosObjetosVazios(dadosTempo,'quantidade'))) {
        graficoTempo = new Morris.Bar({
          element: 'morrisTempo',
          data: dadosTempo,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['Tempo'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Tempo: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
      }
      if (!(todosObjetosVazios(dadosLocalizacao,'quantidade'))) {
        graficoLocalizacao = new Morris.Bar({
          element: 'morrisLocalizacao',
          data: dadosLocalizacao,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['Localização'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Localização: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
      }
      pintarBarras();
      //Se o usuário mudar a data
      $('#selecionar-data').on('apply.daterangepicker', function(ev,picker){
        dados = [];
        dadosQualidade = [];
        dadosAtendimento = [];
        dadosPreco = [];
        dadosTempo = [];
        dadosLocalizacao = [];
        for (var i = 0; i < rawData.length; i++) {
          if (picker.startDate.toDate() - rawData[i].data <= 0) {
            if (picker.endDate.toDate() - rawData[i].data >= 0) {
              dados.push(rawData[i]);
            }
          }
        }
        arrumarDados();
        if (!(todosObjetosVazios(dadosQualidade,'quantidade'))) {
          graficoQualidade.setData(dadosQualidade);
        }
        if (!(todosObjetosVazios(dadosAtendimento,'quantidade'))) {
          graficoAtendimento.setData(dadosAtendimento);
        }
        if (!(todosObjetosVazios(dadosPreco,'quantidade'))) {
          graficoPreco.setData(dadosPreco);
        }
        if (!(todosObjetosVazios(dadosTempo,'quantidade'))) {
          graficoTempo.setData(dadosTempo);
        }
        if (!(todosObjetosVazios(dadosLocalizacao,'quantidade'))) {
          graficoLocalizacao.setData(dadosLocalizacao);
        }
        pintarBarras();
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
