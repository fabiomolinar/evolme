@extends('layouts.principal')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/publicas/suporte.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-suporte') }}">
  <title>{{ trans('mensagens.titulo-suporte') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-suporte') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  @include('includes.msgErro')
  <div class="row">
    <div class="col-xs-12 m0p0" id="page-wrapper"> <!-- Page Wrapper -->
      <h1 id="titulo-principal"><b>evolm<span class="letra-verde">e</b></span></h1>
      <p class="suporte-contato">{{ trans('mensagens.suporte-p1') }}</p>
      <p class="suporte-contato">{{ trans('mensagens.suporte-p2') }}</p>
      <p class="suporte-contato">{{ trans('mensagens.suporte-p3') }}</p>
      <p class="suporte-contato suporte-email"><a href="mailto:suporte@evolme.com">suporte@evolme.com</a></p>
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
@endsection
