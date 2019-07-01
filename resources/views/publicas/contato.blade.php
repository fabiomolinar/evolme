@extends('layouts.principal')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/publicas/contato.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-contato') }}">
  <title>{{ trans('mensagens.titulo-contato') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-contato') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  @include('includes.msgErro')
  <div class="row">
    <div class="col-xs-12 m0p0" id="page-wrapper"> <!-- Page Wrapper -->
      <h1 id="titulo-principal"><b>evolm<span class="letra-verde">e</span></b></h1>
      <h3>{{ trans('mensagens.contato') }}</h3>
      <p class="info-contato"><a href="mailto:contato@evolme.com?Subject=Contact%20Evolme">contato@evolme.com</a></p>
      <p class="info-contato"><a href="tel:+5512988855631">+55 (12) 98885-5631</a></p>
      <p class="info-contato"><a href="tel:+5511986854119">+55 (11) 98685-4119</a></p>
      <div class="row">
        <div class="col-xs-6">
          <a href="http://www.facebook.com/evolmebrasil">
            <span class="fa fa-facebook-square fa-2x logoSocial"></span><span class="info-contato">/evolmebrasil</span>
          </a>
        </div>
        <div class="col-xs-6">
          <a href="https://www.linkedin.com/company/9478344">
            <span class="fa fa-linkedin-square fa-2x logoSocial"></span><span class="info-contato">/evolme</span>
          </a>
        </div>
      </div>
      <hr>
      <p class="titulo-formulario">{{ trans('mensagens.titulo-formulario') }}</p><a name="formulario-contato"></a>
      <form class="formulario" action="{{ url("contato") }}" method="post" novalidate="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="text" name="nome" value="{{ old('nome') }}" required=''>
        <label for="nome" alt="{{ trans('mensagens.qual-seu-nome') }}" placeholder="{{ trans('mensagens.nome') }}" original="{{ trans('mensagens.nome') }}"></label>
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
@endsection

@section('footer')
  @include('includes.footer')
@endsection

@section('js')
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  <script type="text/javascript">
    //criando mensagens que serão passadas para o contatoFormValidation
    var valNomeReq = "{{ trans('mensagens.val-req-nome') }}";
    var valEmailReq = "{{ trans('mensagens.val-req-email') }}";
    var valEmailEmail = "{{ trans('mensagens.val-email-email') }}";
    var valTelNum = "{{ trans('mensagens.val-tel-num') }}";
    var valTelMin = "{{ trans('mensagens.val-tel-min') }}";
    var valMsgReq = "{{ trans('mensagens.val-meio-req-msg') }}";
    var valMsgMin = "{{ trans('mensagens.val-min-lenght') }}";
    var ajaxError = "{{ trans('mensagens.ajax-error') }}"
    var ajaxOK = "{{ trans('mensagens.ajax-ok-contato') }}"
  </script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/publicas/contatoFormValidation.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){


      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
