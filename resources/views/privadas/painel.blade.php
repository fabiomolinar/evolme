@extends('layouts.painelUsuario')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/painel.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-painel') }}">
  <title>{{ trans('mensagens.titulo-painel') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-painel') }}">
@endsection

@section('conteudoPainel')
  <h2>Nome do usuário</h2>
  <table>
    <tr>
      <td>{{ trans('mensagens.minhas-avaliacoes') }}</td>
      <td>{{ trans('mensagens.estabelecimentos-favoritos') }}</td>
      <td>{{ trans('mensagens.meus-estabelecimentos') }}</td>
    </tr>
    <tr>
      <td>24</td>
      <td>3</td>
      <td>9</td>
    </tr>
  </table>
  @include('includes.privadas.painel.gameBoard')
  @include('includes.privadas.painel.timeline')
@endsection

@section('jsPainel')
  <script type="text/javascript">
    function esconderPrimeiroMini(){
      if ($(window).width() < 768) {
        $($('#gb-conquistas-mini div div')[0]).hide();
      } else{
        $($('#gb-conquistas-mini div div')[0]).show();
      }
      if ($(window).width() < 380) {
        $($('#gb-conquistas-mini div div')[1]).hide();
      } else {
        $($('#gb-conquistas-mini div div')[1]).show();
      }
    }
    $(document).ready(function(){
      esconderPrimeiroMini();

      //ON RESIZE
      window.onresize = function(event) {
        esconderPrimeiroMini();
      }
    });
  </script>
@endsection
