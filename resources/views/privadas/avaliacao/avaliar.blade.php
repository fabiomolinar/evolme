@extends('layouts.privada')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/avaliacao/avaliar.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-avaliar') }}">
  <title>{{ trans('mensagens.titulo-avaliar') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-avaliar') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  <div class="row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">{{ trans('mensagens.avaliar') }}</div>
        <div class="panel-body">
          <form class="" action="" method="post" novalidate="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h4>{{ $estabelecimento['nome'] }}</h4>
            <input class="inputEstrelas" type="hidden" name="quality_score" value="0">
            <input class="inputEstrelas" type="hidden" name="time_score" value="0">
            <input class="inputEstrelas" type="hidden" name="price_score" value="0">
            <input class="inputEstrelas" type="hidden" name="service_score" value="0">
            <table class="table table-striped tabelaEstrelas">
              <tr>
                <td>{{trans('mensagens.qualidade')}}</td>
                <td class="estrelas" data-name="quality_score"></td>
                <td class="estrelas-validacao"></td>
              </tr>
              <tr>
                <td>{{trans('mensagens.tempo')}}</td>
                <td class="estrelas" data-name="time_score"></td>
                <td class="estrelas-validacao"></td>
              </tr>
              <tr>
                <td>{{trans('mensagens.preco')}}</td>
                <td class="estrelas" data-name="price_score"></td>
                <td class="estrelas-validacao"></td>
              </tr>
              <tr>
                <td>{{trans('mensagens.atendimento')}}</td>
                <td class="estrelas" data-name="service_score"></td>
                <td class="estrelas-validacao"></td>
    freq_us
            </table>
            <p>{{ trans('mensagens.perguntas-abaixo-sao-opcionais') }}</p>
            <table class="table table-striped perguntasAdicionais" id="tabelaQuestAdicionais">
              {{-- Aqui virão os questionários adicionais --}}
              @include('includes.privadas.avaliacao.adicionais.avaliacaoNPS')
              @include('includes.privadas.avaliacao.adicionais.avaliacaoFrequencia')
              @include('includes.privadas.avaliacao.adicionais.avaliacaoComparacao1')
              @include('includes.privadas.avaliacao.adicionais.avaliacaoComparacao2')
              @include('includes.privadas.avaliacao.adicionais.avaliacaoPerfil1')
              @include('includes.privadas.avaliacao.adicionais.avaliacaoPerfil2')
            </table>
            <div class="row botoes-formulario">
              <div class="col-xs-6">
                <button type="submit" name="enviar" class="btn btn-primary">{{ trans('mensagens.enviar') }}</button>
              </div>
              <div class="col-xs-6">
                <button type="button" name="mostrarMais" class="btn btn-info">{{ trans('mensagens.mostrar-mais') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
  @include('includes.footer')
@endsection

@section('js')
  <script type="text/javascript">
    //criando mensagens que serão passadas para o contatoFormValidation
    var opcoesAjaxOKAvaliacaoEstabelecimento = [
      "{!! trans('mensagens.avaliacao-recebida-sucesso-1') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-2') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-3') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-4') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-5') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-6') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-7') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-8') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-9') !!}",
      "{!! trans('mensagens.avaliacao-recebida-sucesso-10') !!}"
    ];
    var ajaxOKAvaliacaoEstabelecimento = opcoesAjaxOKAvaliacaoEstabelecimento[Math.floor(Math.random()*11)];
    var ajaxError = "{{ trans('mensagens.ajax-error') }}";
    var valCampoObrigatorio = "{{ trans('mensagens.campo-obrigatorio') }}";
    var valNumeroInteiro = "{{ trans('mensagens.val-numero-inteiro') }}";
    var valNumeroExcedeLimite = "{{ trans('mensagens.val-numero-excede-limite') }}";
    var valDataInvalida = "{{ trans('mensagens.val-data-invalida') }}";
    var valDadoIncorreto = "{{ trans('mensagens.val-input-incorreto') }}";
    var erroValidacao = "{{ html_entity_decode(trans('mensagens.erro-validacao-avaliar')) }}";
  </script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/moment.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/avaliacao/avaliarFormValidation.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/avaliacao/jquery.raty.js') }}"></script>
  <script type="text/javascript">
    var notas = {
      qualidade: 0,
      tempo: 0,
      preco: 0,
      localizacao: 0
    }
    $(function () {
      $('[data-toggle="tooltip"]').tooltip({
        delay: 100,
        placement: "auto top"
      });
    });
    var questAdicionais = [
      'idAvaliacaoComparacao1',
      'idAvaliacaoComparacao2',
      'idAvaliacaoPerfil1',
      'idAvaliacaoPerfil2',
      'idAvaliacaoFrequencia',
      'idAvaliacaoNPS'
    ];
    var questProibidos = [];
    function selecionarQuestAdicional(remover = [], tempo = 666) {
      if (!(remover.constructor === Array)) {
        remover = [valueKeys];
      }
      var selecionado = "";
      var opcoes = [];
      for (var i = 0; i < questAdicionais.length; i++) {
        if ($.inArray(questAdicionais[i],remover) < 0) {
          opcoes.push(questAdicionais[i]);
        }
      }
      if (opcoes.length > 0) {
        selecionado = opcoes[Math.floor(Math.random()*opcoes.length)];
        questProibidos.push(selecionado);
        if (opcoes.length == 1) {
          $('button[name="mostrarMais"]').prop('disabled',true);
          $('button[name="mostrarMais"]').removeClass('btn-info');
          $('button[name="mostrarMais"]').addClass('btn-default');
        }
        adicionarQuestionario(selecionado, tempo);
      }
    }
    function adicionarQuestionario(quest, tempo = 666) {
      $('#' + quest).appendTo($('#tabelaQuestAdicionais'));
      $('#' + quest).show(tempo);
    }
    $(document).ready(function(){
      selecionarQuestAdicional(questProibidos,0);
      //Configurando o raty
      $('.estrelas').each(function(index){
        $(this).raty({
          path: 'images/avaliacao',
          score: 0,
          click: function(nota,evento){
            var tipo = $(evento.target.offsetParent).attr('data-name');
            notas[tipo] = nota;
            $('input[name="' + tipo + '"]').attr('value',nota);
          }
        });
      });
      //Atribui o valor que foi clicado ao input hidden
      $('button[data-name="nps"]').click(function(evento){
        var nota = parseInt($(evento.currentTarget).attr('data-value'));
        $('input[name="nps"]').attr('value',nota);
      });
      //Esconde o campo de número de vezes ao estabelecimento se for a primeira vez no estabelecimento
      $('input[name="freq_first_time"]').on("click",function(){
          if($(this).is(":checked")){
          $('input[name="freq_us"]').prop("disabled",true);
          $('input[name="freq_us"]').hide(500);
        } else {
          $('input[name="freq_us"]').prop("disabled",false);
          $('input[name="freq_us"]').show(500);
        }
      });
      //Atribui o valor que foi clicado ao input hidden
      $('button[data-name="comparacao"]').click(function(evento){
        var nota = parseInt($(evento.currentTarget).attr('data-value'));
        var tipo = $(evento.currentTarget).attr('data-tipo');
        $('input[name="' + tipo + '"]').attr('value',nota);
      });
      $('button[data-name="perfil"]').click(function(evento){
        var nota = $(evento.currentTarget).attr('data-value');
        var tipo = $(evento.currentTarget).attr('data-tipo');
        $('input[name="' + tipo + '"]').attr('value',nota);
      });
      $('button[data-name="monthly_income"]').click(function(evento){
        var nota = $(evento.currentTarget).attr('data-value');
        var tipo = $(evento.currentTarget).attr('data-name');
        $('input[name="' + tipo + '"]').attr('value',nota);
      });
      $('button[data-name="marital_status"]').click(function(evento){
        var nota = $(evento.currentTarget).attr('data-value');
        var tipo = $(evento.currentTarget).attr('data-name');
        $('input[name="' + tipo + '"]').attr('value',nota);
      });
      //Pinta os botões que forem sendo selecionados
      $('.btn-group, .btn-group-vertical').click(function(evento){
        var grupo = $(evento.currentTarget);
        var elemento = $(evento.target);
        if (elemento.attr('data-name') && (elemento.attr('data-name') == 'nps')) {
          //apagar do nps que é dividido em grupos diferentes
          $('button[data-name="nps"]').removeClass('botao-selecionado');
          $('button[data-name="nps"][data-value="' + elemento.attr('data-value') + '"]').addClass('botao-selecionado');
        } else {
          grupo.find('button').removeClass('botao-selecionado');
          elemento.addClass('botao-selecionado');
        }
      });
      $('.input-data-nascimento input').focusout(function(evento){
        var dia = $('input[name="nascimentoDia"]').val();
        var mes = $('input[name="nascimentoMes"]').val();
        var ano = $('input[name="nascimentoAno"]').val();
        var data = ano + '-' + mes + '-' + dia;
        if (data != "--") {
          $('input[name="birth_date"]').val(data);
        } else {
          if ($('input[name="birth_date"]').val() != "") {
            $('input[name="birth_date"]').val("");
          }
        }
      });
      $('button[name="mostrarMais"]').click(function(){
        selecionarQuestAdicional(questProibidos);
      });
      //Dando o trigger para fazer a validação assim que o usuário clica nas estrelas.
      $('.estrelas').click(function(evento){
        var elemento = $(evento.currentTarget).next();
        if (elemento.css('display') != "none") {
          $('.inputEstrelas').valid();
        }
      });
      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
