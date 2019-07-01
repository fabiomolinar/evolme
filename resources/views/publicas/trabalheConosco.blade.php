@extends('layouts.principal')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/publicas/trabalheConosco.css') }}">
  {{-- JS --}}
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-trabalhe-conosco') }}">
  <title>{{ trans('mensagens.titulo-trabalhe-conosco') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-trabalhe-conosco') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  @include('includes.msgErro')
  <div class="row">
    <div class="col-xs-12 m0p0" id="page-wrapper"> <!-- Page Wrapper -->
      <div class="row trabalhe-conosco-mensagem">
        <div class="col-xs-12">
          <h1 id="titulo-principal"><b>evolm<span class="letra-verde">e</b></span></h1>
          <p class="trabalhe-conosco"><b>{{ trans('mensagens.trabalhe-conosco-p1') }}</b></p>
          <p class="trabalhe-conosco">{{ trans('mensagens.trabalhe-conosco-p2') }}</p>
          <p class="trabalhe-conosco">{{ trans('mensagens.trabalhe-conosco-p3') }}</p>
          <p class="trabalhe-conosco">{{ trans('mensagens.trabalhe-conosco-p4') }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <form class="formulario" action="" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="nome" value="{{ old('nome') }}" required=''>
            <label for="nome" alt="{{ trans('mensagens.qual-seu-nome') }}" placeholder="{{ trans('mensagens.nome') }}" original="{{ trans('mensagens.nome') }}"></label>
            <input type="text" name="email" value="{{ old('email') }}" required=''>
            <label for="email" alt="{{ trans('mensagens.e-seu-email') }}" placeholder="{{ trans('mensagens.email') }}" original="{{ trans('mensagens.email') }}"></label>
            <input type="text" name="telefone" value="{{ old('telefone') }}" required=''>
            <label for="telefone" alt="{{ trans('mensagens.deixe-telefone') }}" placeholder="{{ trans('mensagens.telefone') }}" original="{{ trans('mensagens.telefone') }}"></label>
            <textarea type="text" name="mensagem" required></textarea>
            <label for="mensagem" alt="{{ trans('mensagens.deixe-recado') }}" placeholder="{{ trans('mensagens.mensagem') }}" original="{{ trans('mensagens.mensagem') }}"></label>
            <button type="submit" name="sendContato" class="btn btn-success">{{ trans('mensagens.enviar') }}</button>
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
    $(document).ready(function(){


      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
  <script type="text/javascript">
    //criando mensagens que serão passadas para o form validation
    var ajaxOK = "{{ trans('mensagens.ajax-ok-trabalhe-conosco') }}"
    var ajaxError = "{{ trans('mensagens.ajax-error') }}"
    var valNomeReq = "{{ trans('mensagens.val-req-nome') }}";
    var valEmailReq = "{{ trans('mensagens.val-req-email') }}";
    var valEmailEmail = "{{ trans('mensagens.val-email-email') }}";
    var valTelNum = "{{ trans('mensagens.val-tel-num') }}";
    var valTelMin = "{{ trans('mensagens.val-tel-min') }}";
    var valMsgReq = "{{ trans('mensagens.val-msg-req-trabalhe-conosco') }}";
    var valMsgMin = "{{ trans('mensagens.val-msg-min-trabalhe-conosco') }}";
  </script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/publicas/trabalheConoscoFormValidation.js') }}"></script>
@endsection
