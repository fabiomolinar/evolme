@extends('layouts.privada')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/avaliacao/resultadoBusca.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-resultado-busca') }}">
  <title>{{ trans('mensagens.titulo-resultado-busca') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-resultado-busca') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  <div class="row">
    <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8" id="listaDeResultados">
      @if (sizeof($estabelecimentos) > 0)
        <div class="row">
          {{-- A variável chamada 'detalhes' abaixo configura o include que será usado nessa página --}}
          <?php $detalhes = false; ?>
          @foreach ($estabelecimentos as $estabelecimento)
            @include('includes.privadas.avaliacao.estabelecimento')
          @endforeach
        </div>
        <div class="row">
          <div class="col-xs-12 criarEstabelecimento">
            <p>{{ trans('mensagens.nao-encontrou-estabelecimento-crie-um') }}</p>
            <a href="/"><button type="button" name="criar" class="btn btn-primary botao-criar">{{ trans('mensagens.criar') }}</button></a>
          </div>
        </div>
      @else
        <div class="alert alert-warning">
          {{ trans('mensagens.nao-encontramos-nenhum-estabelecimento') }}
        </div>
        <hr>
        <div class="criarEstabelecimento">
          <p>{{ trans('mensagens.nao-preocupe-crie-estabelecimento') }}</p>
          <a href="/"><button type="button" name="criar" class="btn btn-primary botao-criar">{{ trans('mensagens.criar') }}</button></a>
        </div>
      @endif
    </div>
  </div>
@endsection

@section('footer')
  @include('includes.footer')
@endsection

@section('js')
  <script type="text/javascript" src="{{ asset('/js/privadas/avaliacao/jquery.raty.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.estrelas').each(function(index){
        $(this).raty({
          path: 'images/avaliacao',
          readOnly: true,
          score: parseInt($(this).attr('data-estrelas'))
        });
      });

      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
