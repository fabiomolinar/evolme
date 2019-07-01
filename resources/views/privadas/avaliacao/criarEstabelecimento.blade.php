@extends('layouts.privada')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/avaliacao/criarEstabelecimento.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/avaliacao/jquery-ui-base.theme.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-criar-estabelecimento') }}">
  <title>{{ trans('mensagens.titulo-criar-estabelecimento') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-criar-estabelecimento') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  <div class="row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">{{ trans('mensagens.criar-estabelecimento') }}</div>
        <div class="panel-body">
          <form class="" action="" method="post" novalidate="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="estabelecimento" value="{{ old('estabelecimento') }}" required=''>
            <label for="estabelecimento" alt="{{ trans('mensagens.nome-do-estabelecimento') }}" placeholder="{{ trans('mensagens.estabelecimento2') }}" original="{{ trans('mensagens.estabelecimento2') }}"></label>
            <input type="text" name="cidade" value="{{ old('cidade') }}" required=''>
            <label for="cidade" alt="{{ trans('mensagens.em-qual-cidade') }}" placeholder="{{ trans('mensagens.cidade') }}" original="{{ trans('mensagens.cidade') }}"></label>
            <input type="text" name="endereco" value="{{ old('endereco') }}" required=''>
            <label for="endereco" alt="{{ trans('mensagens.qual-o-endereco') }}" placeholder="{{ trans('mensagens.endereco2') }}" original="{{ trans('mensagens.endereco2') }}"></label>
            <button type="submit" name="criar" class="btn btn-primary">{{ trans('mensagens.criar') }}</button>
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
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  <script type="text/javascript">
    //criando mensagens que serão passadas para o contatoFormValidation
    var valNomeReq = "{{ trans('mensagens.val-req-nome') }}";
    var valEstabelecimentoReq = "{{ trans('mensagens.val-estab-req') }}";
    var valEnderecoReq = "{{ trans('mensagens.val-endereco-req') }}";
    var ajaxError = "{{ trans('mensagens.ajax-error') }}"
    var ajaxOK = "{{ trans('mensagens.ajax-ok-criar-estabelecimento') }}"
  </script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/avaliacao/criarFormValidation.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/avaliacao/jquery-ui-autocomplete.js') }}"></script>
  {{-- Definindo uma variável chamada cidades onde guardarei o nome das cidades --}}
  <script type="text/javascript" src="{{ asset('/js/privadas/avaliacao/cidades.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      //variável 'cidades' guarda os nomes das cidades
      $('input[name="cidade"]').autocomplete({
        source: cidades
      });
      $('input').removeClass('ui-autocomplete-input');

      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
