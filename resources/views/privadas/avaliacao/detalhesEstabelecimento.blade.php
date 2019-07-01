@extends('layouts.privada')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/avaliacao/detalhesEstabelecimento.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-detalhes-estabelecimento') }}">
  <title>{{ trans('mensagens.titulo-detalhes-estabelecimento') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-detalhes-estabelecimento') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  <div class="row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
      <?php $detalhes = true; ?>
      @if (sizeof($estabelecimento) > 0)
        <div class="row">
          @include('includes.privadas.avaliacao.estabelecimento')
        </div>
        <h4>{{ trans('mensagens.comentarios') }}</h4>
        @if (sizeof($comentarios) > 0)
          <table class="table table-striped">
            @foreach($comentarios as $comentario)
              @include('includes.privadas.avaliacao.comentario')
            @endforeach
          </table>
        @else
        <div class="alert alert-success">
          {{ trans('mensagens.nao-ha-comentarios') }}
        </div>
        @endif
      @else
      <div class="alert alert-warning">
        {{ trans('mensagens.voce-precisa-selecionar-estabelecimento') }}
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
