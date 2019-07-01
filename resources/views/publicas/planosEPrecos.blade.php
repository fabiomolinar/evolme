@extends('layouts.principal')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/publicas/planosEPrecos.css') }}">
  {{-- JS --}}
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-PP') }}">
  <title>{{ trans('mensagens.titulo-PP') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-PP') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  @include('includes.msgErro')
  <div class="row">
    <div class="col-xs-12 m0p0" id="page-wrapper"> <!-- Page Wrapper -->
      <div class="row">
        <div class="col-xs-12">
          <h1 id="titulo-principal"><b>evolm<span style="color: #00c252;">e</b></span></h1>
          <p>{{ trans('mensagens.planos-precos-resumo') }}</p>
          <h3>{{ trans('mensagens.planos-precos-sub-titulo') }}</h3>
        </div>
      </div>
      {{-- Botões --}}
      <a name="planos"></a>
      <div class="row PP-botoes">
        <div class="col-xs-12 col-sm-4">
          <button name="BPasso1" id="BPasso1" class="btn btn-default">{{ trans('mensagens.PPbotao1') }}</button>
        </div>
        <div class="col-xs-12 col-sm-4">
          <button name="BPasso2" id="BPasso2" class="btn btn-default">{{ trans('mensagens.PPbotao2') }}</button>
        </div>
        <div class="col-xs-12 col-sm-4">
          <button  name="BPasso3" id="BPasso3" class="btn btn-default">{{ trans('mensagens.PPbotao3') }}</button>
        </div>
      </div>
      {{-- Planos --}}
      <div class="row" id="passo1">
        @foreach ($planos as $plano)
          <div class="col-xs-12 col-sm-4">
            @include('includes.publicas.planosEPrecos.planoTemplate')
          </div>
        @endforeach
      </div>
      <div class="row" id="passo2e3">
        <div class="col-xs-12">
          <form name="PPFormPasso1e2" class="formulario" action="" method="post" novalidate="">
            <div class="" id="passo2">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="text" name="name" value="{{ old('name') }}" required=''>
              <label for="name" alt="{{ trans('mensagens.qual-seu-nome') }}" placeholder="{{ trans('mensagens.nome') }}" original="{{ trans('mensagens.nome') }}"></label>
              <input type="text" name="last_name" value="{{ old('last_name') }}" required=''>
              <label for="last_name" alt="{{ trans('mensagens.qual-seu-sobrenome') }}" placeholder="{{ trans('mensagens.sobrenome') }}" original="{{ trans('mensagens.sobrenome') }}"></label>
              <input type="text" name="email" value="{{ old('email') }}" required=''>
              <label for="email" alt="{{ trans('mensagens.e-seu-email') }}" placeholder="{{ trans('mensagens.email') }}" original="{{ trans('mensagens.email') }}"></label>
              <input type="text" name="email_confirmation" value="{{ old('email_confirmation') }}" required=''>
              <label for="email_confirmation" alt="{{ trans('mensagens.confirme-email') }}" placeholder="{{ trans('mensagens.email') }}" original="{{ trans('mensagens.email') }}"></label>
              <input type="password" name="password" value="{{ old('password') }}" required=''>
              <label for="password" alt="{{ trans('mensagens.crie-senha') }}" placeholder="{{ trans('mensagens.senha') }}" original="{{ trans('mensagens.senha') }}"></label>
              <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required=''>
              <label for="password_confirmation" alt="{{ trans('mensagens.confirme-senha') }}" placeholder="{{ trans('mensagens.senha') }}" original="{{ trans('mensagens.senha') }}"></label>
              <button type="button" id="proxParteForm" class="btn btn-primary">{{ trans('mensagens.proximo') }}</button>
            </div>
            <div class="" id="passo3">
              <input type="text" name="estabelecimento" value="{{ old('estabelecimento') }}" required=''>
              <label for="estabelecimento" alt="{{ trans('mensagens.qual-nome-seu-estabelecimento') }}" placeholder="{{ trans('mensagens.nome-estabelecimento') }}" original="{{ trans('mensagens.nome-estabelecimento') }}"></label>
              <input type="text" name="cidade" value="{{ old('cidade') }}" required=''>
              <label for="cidade" alt="{{ trans('mensagens.qual-cidade-seu-estabelecimento') }}" placeholder="{{ trans('mensagens.cidade') }}" original="{{ trans('mensagens.cidade') }}"></label>
              <input type="text" name="telefone" value="{{ old('telefone') }}" required=''>
              <label for="telefone" alt="{{ trans('mensagens.deixe-telefone') }}" placeholder="{{ trans('mensagens.telefone') }}" original="{{ trans('mensagens.telefone') }}"></label>
              <button type="submit" name="enviarFormPasso1e2" class="btn btn-primary">{{ trans('mensagens.enviar') }}</button>
            </div>
          </form>
        </div>
      </div>
      <div class="row" id="passo3">
        <div class="col-xs-12">

        </div>
      </div>
      <hr>
      {{-- Contato --}}
      <div class="row">
        <div class="col-xs-12">
          <p>{{ trans('mensagens.planos-precos-contato') }}</p>
          <form name="PPFormContato" class="formulario" action="/ppContato" method="post" novalidate="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="nome" value="{{ old('nome') }}" required=''>
            <label for="nome" alt="{{ trans('mensagens.qual-seu-nome') }}" placeholder="{{ trans('mensagens.nome') }}" original="{{ trans('mensagens.nome') }}"></label>
            <input type="text" name="estabelecimento" value="{{ old('estabelecimento') }}" required=''>
            <label for="estabelecimento" alt="{{ trans('mensagens.qual-nome-seu-estabelecimento') }}" placeholder="{{ trans('mensagens.nome-estabelecimento') }}" original="{{ trans('mensagens.nome-estabelecimento') }}"></label>
            <input type="text" name="email" value="{{ old('email') }}" required=''>
            <label for="email" alt="{{ trans('mensagens.e-seu-email') }}" placeholder="{{ trans('mensagens.email') }}" original="{{ trans('mensagens.email') }}"></label>
            <input type="text" name="telefone" value="{{ old('telefone') }}" required=''>
            <label for="telefone" alt="{{ trans('mensagens.deixe-telefone') }}" placeholder="{{ trans('mensagens.telefone') }}" original="{{ trans('mensagens.telefone') }}"></label>
            <textarea type="text" name="mensagem" required></textarea>
            <label for="mensagem" alt="{{ trans('mensagens.deixe-recado') }}" placeholder="{{ trans('mensagens.mensagem') }}" original="{{ trans('mensagens.mensagem') }}"></label>
            <button type="submit" name="sendContato" class="btn btn-primary">{{ trans('mensagens.enviar') }}</button>
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
    //variáveis globais
    var pacoteSelecionado = "";
    //funções
    function alinharLista() {
      if ($(document).width() > 768) {
        var maisAlta = 0;
        var lista = $('.PP-pacotes');
        for (var i = 0; i < lista.length; i++) {
          if (parseInt($(lista[i]).find('ul').css('height')) > maisAlta) {
            maisAlta = parseInt($(lista[i]).find('ul').css('height'));
          }
        }
        $('.PP-pacotes ul').css('height',maisAlta);
      }
    }
    function triggerBotoes(){
      $('#BPasso1').click(function(){
        $(this).removeClass('btn-default');
        $(this).addClass('btn-primary');
        $('#BPasso2').removeClass('btn-primary');
        $('#BPasso2').addClass('btn-default');
        $('#BPasso3').removeClass('btn-primary');
        $('#BPasso3').addClass('btn-default');
        $('#passo2e3').hide(333);
        $('#passo1').show(333);
      });
      $('#BPasso2').click(function(){
        $('html,body').animate({scrollTop: $('a[name=planos]').offset().top - 69},333);
        $(this).removeClass('btn-default');
        $(this).addClass('btn-primary');
        $('#BPasso1').removeClass('btn-primary');
        $('#BPasso1').addClass('btn-default');
        $('#BPasso3').removeClass('btn-primary');
        $('#BPasso3').addClass('btn-default');
        $('#passo1').hide(333);
        $('#passo3').hide(333);
        $('#passo2').show(333);
        $('#passo2e3').show(333);
      });
      $('#BPasso3').click(function(){
        $('html,body').animate({scrollTop: $('a[name=planos]').offset().top - 69},333);
        $(this).removeClass('btn-default');
        $(this).addClass('btn-primary');
        $('#BPasso2').removeClass('btn-primary');
        $('#BPasso2').addClass('btn-default');
        $('#BPasso1').removeClass('btn-primary');
        $('#BPasso1').addClass('btn-default');
        $('#passo1').hide(333);
        $('#passo2').hide(333);
        $('#passo3').show(333);
        $('#passo2e3').show(333);
      });
      $('#proxParteForm').click(function(){
        $('#BPasso3').trigger('click');
      });
      $('.PP-pacotes div button').click(function(){
        pacoteSelecionado = $(this).attr('id');
        console.log(pacoteSelecionado);
        $('#BPasso2').trigger('click');
      });
    }
    $(document).ready(function(){
      alinharLista();
      triggerBotoes();
      $('#BPasso1').trigger('click');
      //ON RESIZE
      window.onresize = function(event) {
        alinharLista();
      }
    });
  </script>
  <script type="text/javascript">
    //criando mensagens que serão passadas para o form validation
    var valNomeReq = "{{ trans('mensagens.val-req-nome') }}";
    var valEstabelecimentoReq = "{{ trans('mensagens.val-estab-req') }}"
    var valEmailReq = "{{ trans('mensagens.val-req-email') }}";
    var valEmailEmail = "{{ trans('mensagens.val-email-email') }}";
    var valTelNum = "{{ trans('mensagens.val-tel-num') }}";
    var valTelMin = "{{ trans('mensagens.val-tel-min') }}";
    var valMsgReq = "{{ trans('mensagens.val-meio-req-msg') }}";
    var valMsgMin = "{{ trans('mensagens.val-min-lenght') }}";
    var ajaxError = "{{ trans('mensagens.ajax-error') }}"
    var ajaxOKContato = "{{ trans('mensagens.ajax-ok-contato-PP') }}"
    var ajaxOKSelecaoProduto = "{{ trans('mensagens.ajax-ok-selecao-produto') }}"
    var valEmailIgual = "{{ trans('mensagens.val-email-igual') }}"
    var valSenhaReq = "{{ trans('mensagens.val-senha-req') }}"
    var valSenhaIgual = "{{ trans('mensagens.val-senha-igual') }}"
    var valSenhaMin = "{{ trans('mensagens.val-senha-min') }}"
  </script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/publicas/PPContatoFormValidation.js') }}"></script>
@endsection
