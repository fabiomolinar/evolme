@extends('layouts.painelUsuario')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/atividadesRecentes.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-atividades-recentes') }}">
  <title>{{ trans('mensagens.titulo-atividades-recentes') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-atividades-recentes') }}">
@endsection

@section('conteudoPainel')
  <h2>Nome do usuário</h2>
  @include('includes.privadas.painel.timeline')
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
