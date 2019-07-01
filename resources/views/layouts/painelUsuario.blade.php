@extends('layouts.privada')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/painelUsuario.css') }}">
  @yield('headPainel')
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  @include('includes.msgErro')
  <div class="row" id="page-wrapper">
    <div class="col-xs-12">
      <div class="row" id="menu-topo-row">
        <div class="visible-xs col-xs-12" id="menu-topo">
          <ul class="nav nav-pills">
            <li role="presentation"><a href="#">{{ trans('mensagens.avaliar') }}</a></li>
            <li class="dropdown" role="presentation">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                {{ trans('mensagens.outros') }} <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" id="menu-topo-hidden">
                @include('includes.privadas.painel.outrosItensMenu')
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="hidden-xs col-sm-3 col-lg-2" id="menu-lateral">
          <img src="images/painel/user-image.png" alt="" />
          <ul class="nav nav-pills nav-stacked">
            <li class="btn btn-primary"><a href="#" style="color: #FFFFFF;">{{ trans('mensagens.avaliar') }}</a></li>
            <li role="separator" class="divider"></li>
            @include('includes.privadas.painel.outrosItensMenu')
          </ul>

        </div>
        <div class="col-xs-12 col-sm-9 col-lg-10">
          <div class="row">
            <div class="col-xs-12" id="conteudo">
              @yield('conteudoPainel')
            </div>
          </div>
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
    $('#menu-lateral ul li').each(function(index){
      if (index > 1) {
        $(this).addClass('btn btn-default');
      }
    });
  </script>
  @yield('jsPainel')
@endsection
