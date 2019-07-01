@extends('layouts.estabelecimentos')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/estabelecimento/dadosEstabelecimento.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-estabelecimento-dados') }}">
  <title>{{ trans('mensagens.titulo-estabelecimento-dados') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-estabelecimento-dados') }}">
@endsection

@section('conteudoPainel')
@endsection

@section('jsPainel')
  <script type="text/javascript">
    $(document).ready(function(){

      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
