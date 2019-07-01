@extends('layouts.estabelecimentos')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/morris.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/dashboardPerfil.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/daterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/meudaterangepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/dashboard/graficos.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-dashboard-habitos') }}">
  <title>{{ trans('mensagens.titulo-dashboard-overview-habitos') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-dashboard-overview-habitos') }}">
@endsection

@section('conteudoPainel')
  @include('includes.privadas.dashboard.menuOverview')
  @include('includes.privadas.dashboard.selecionarData')
  <div class="row">
    <div class="col-xs-12 col-md-8">
      <div class="panel panel-default" id="grafIdade">
        <div class="panel-heading">{{ trans('mensagens.idade') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisIdade"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-4">
      <div class="panel panel-default" id="grafGenero">
        <div class="panel-heading">{{ trans('mensagens.genero') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisGenero"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-4">
      <div class="panel panel-default" id="grafEstadoCivil">
        <div class="panel-heading">{{ trans('mensagens.estado-civil') }}</div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisEstadoCivil"></div>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-8">
      <div class="panel panel-default" id="grafRenda">
        <div class="panel-heading">{{ trans('mensagens.distribuicao-renda') }}<span>{{ trans('mensagens.em-salarios-minimos') }}</span></div>
        <div class="panel-body">
          <div class="alerta-coleta-3-dias alert alert-warning">{{ trans('mensagens.colete-pelo-menos-3-dias') }}</div>
          <div class="grafico" id="morrisRenda"></div>
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
      var asd = ['F','M'];
      var asd2 = [1,2,3,4,5];
      var asd3 = [1,2,3,4,5,6,7,8];
      json_data.push({
        created_at: moment('2016-' + parseInt(Math.random()*11 + 1) + '-' + parseInt(Math.random()*25 + 1),'YYYY-MM-DD').format('YYYY-MM-DD'),
        id: i,
        data_nascimento: moment(parseInt(Math.random()*50 + 1950) + '-' + parseInt(Math.random()*11 + 1) + '-' + parseInt(Math.random()*25 + 1),'YYYY-MM-DD').format('YYYY-MM-DD'),
        genero: asd[Math.floor(Math.random()*asd.length)],
        renda: asd2[Math.floor(Math.random()*asd2.length)],
        estado_civil: asd3[Math.floor(Math.random()*asd3.length)]
      });
    }
    //REMOVER O CÓDIGO ACIMA!!!!!!!!!!!!!!!!!
    var rawData = [];
    var idades = [];
    var idadesPossiveis = [];
    var min = 0;
    var max = 0;
    var dados = [];
    var dadosIdade = [];
    var dadosGenero = [];
    var dadosEstadoCivil = [];
    var dadosRenda = [];
    var graficoIdade = {};
    var graficoRenda = {};
    var graficoGenero = {};
    var graficoEstadoCivil = {};
    function arrumarDados() {
      //Esconder warnings de que não há dados suficientes.
      esconderMostrarAlertas(dados, true);
      if (dados.length > 0) {
        dadosGenero = agrupar(dados,'genero',['F','M']);
        dadosRenda = agrupar(dados,'renda',[1,2,3,4,5,6,7,8]);
        dadosEstadoCivil = agrupar(dados,'estadoCivil',[1,2,3,4,5]);
        idades = [];
        idades = contarIdades(dados,'nascimento');
        max = Math.max.apply(Math,idades.map(function(obj){return obj.idade}));
        min = Math.min.apply(Math,idades.map(function(obj){return obj.idade}));
        idadesPossiveis = [];
        for (var i = min; i <= max; i++) {
          idadesPossiveis.push(i);
        }
        dadosIdade = agrupar(idades,'idade',idadesPossiveis);
        //Retirando os candos da array dadosIdade que são iguais a zero
        while ((dadosIdade[0].quantidade == 0 && dadosIdade.length > 0)) {
          dadosIdade.shift();
        }
        while ((dadosIdade[dadosIdade.length - 1].quantidade == 0 && dadosIdade.length > 0)) {
          dadosIdade.pop();
        }
        //Mudando o value da string para a string correta
        dadosGenero = dadosGenero.map(function(obj){
          if (obj.valor == 'F') {
            return {label: 'Feminino', value: obj.quantidade};
          } else if (obj.valor == 'M') {
            return {label: 'Masculino', value: obj.quantidade};
          }
        });
        dadosEstadoCivil = dadosEstadoCivil.map(function(obj){
            if (obj.valor == 1) {
              return {label: 'Solteiro(a)', value: obj.quantidade};
            } else if (obj.valor == 2) {
              return {label: 'Casado(a)', value: obj.quantidade};
            } else if (obj.valor == 3) {
              return {label: 'União Estável', value: obj.quantidade};
            } else if (obj.valor == 4) {
              return {label: 'Divorciado(a)', value: obj.quantidade};
            } else if (obj.valor == 5) {
              return {label: 'Viúvo(a)', value: obj.quantidade};
            }
          })
        dadosRenda[0].valor = 'Até 1';
        dadosRenda[1].valor = '1 a 2';
        dadosRenda[2].valor = '2 a 4';
        dadosRenda[3].valor = '4 a 6';
        dadosRenda[4].valor = '6 a 8';
        dadosRenda[5].valor = '8 a 12';
        dadosRenda[6].valor = '12 a 16';
        dadosRenda[7].valor = '+16';
      }
    }

    $(document).ready(function(){
      $('#dashMenuPerfil').addClass('active');
      if (typeof json_data != 'undefined'){
        $.each(json_data, function() {
    			rawData.push({
            data: moment(this.created_at,'YYYY-MM-DD').toDate(),
            nascimento: moment(this.data_nascimento,'YYYY-MM-DD').toDate(),
            id: parseFloat(this.id),
            genero: this.genero,
            renda: parseFloat(this.renda),
            estadoCivil: parseFloat(this.estado_civil)
          });
    		});
      }
      dados = rawData;
      arrumarDados();
      if (dados.length > 0) {
        graficoIdade = new Morris.Bar({
          element: 'morrisIdade',
          data: dadosIdade,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: dadosIdade.map(function(obj){return obj.valor;}),
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Idade: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
        graficoGenero = new Morris.Donut({
          element: 'morrisGenero',
          data: dadosGenero,
          resize: true,
          hideHover: true
        });
        graficoEstadoCivil = new Morris.Donut({
          element: 'morrisEstadoCivil',
          data: dadosEstadoCivil,
          resize: true,
          hideHover: true
        });
        graficoRenda = new Morris.Bar({
          element: 'morrisRenda',
          data: dadosRenda,
          xkey: 'valor',
          ykeys: ['quantidade'],
          labels: ['Renda'],
          hideHover: true,
          resize: true,
          hoverCallback: function(index, options, content, row) {
            var conteudo = $.parseHTML(content);
            conteudo[0].innerHTML = 'Salário: ' + row.valor;
            conteudo[1].innerHTML = row.quantidade;
            return conteudo;
          }
        });
      }
      //Se o usuário mudar a data
      $('#selecionar-data').on('apply.daterangepicker', function(ev,picker){
        dados = [];
        dadosIdade = [];
        dadosGenero = [];
        dadosEstadoCivil = [];
        dadosRenda = [];
        for (var i = 0; i < rawData.length; i++) {
          if (picker.startDate.toDate() - rawData[i].data <= 0) {
            if (picker.endDate.toDate() - rawData[i].data >= 0) {
              dados.push(rawData[i]);
            }
          }
        }
        arrumarDados();
        if (dados.length > 0) {
          graficoIdade.setData(dadosIdade);
          graficoGenero.setData(dadosGenero);
          graficoEstadoCivil.setData(dadosEstadoCivil);
          graficoRenda.setData(dadosRenda);
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
