@extends('layouts.principal')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/publicas/sobre.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-sobre') }}">
  <title>{{ trans('mensagens.titulo-sobre') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-sobre') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  @include('includes.msgErro')
  <div class="row">
    <div class="col-xs-12 m0p0" id="page-wrapper"> <!-- Page Wrapper -->
      {{-- SOBRE --}}
      <div class="row">
        <div class="col-xs-12 sobre-sobre bloco-conteudo">
          <h3>{{ trans('mensagens.sobre') }}</h3>
          <p>{{ trans('mensagens.sobre-sobre') }}</p>
        </div>
      </div>
      {{-- ORIGENS --}}
      <div class="row">
        <div class="col-xs-12 sobre-origens bloco-conteudo">
          <h3>{{ trans('mensagens.origens') }}</h3>
          <p>{{ trans('mensagens.sobre-origens') }}</p>
        </div>
      </div>
      {{-- CULTURA --}}
      <div class="row">
        <div class="col-xs-12 sobre-cultura bloco-conteudo">
          <h3>{{ trans('mensagens.cultura') }}</h3>
          <p>{{ trans('mensagens.sobre-cultura') }}</p>
        </div>
      </div>
      {{-- EVOLMERS --}}
      <div class="row">
        <div class="col-xs-12 sobre-evolmers bloco-conteudo">
          <h3>{{ trans('mensagens.evolmers') }}</h3>
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 blocoFundadores">
              <img src="images/sobre/foto-thiago-min.jpg" alt="{{ trans('mensagens.alt-img-thiago') }}" class="imgFundadores"></img>
              <p class="nomeFundadores">Thiago Villela</p>
              <p class="cargoFundadores">CEO - <span class="letra-verde">e</span>Exec</p>
              <p class="descFundadores">{{ trans('mensagens.desc-cargo-thiago') }}</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 blocoFundadores">
              <img src="images/sobre/foto-gabriel-min.jpg" alt="{{ trans('mensagens.alt-img-gabriel') }}" class="imgFundadores"></img>
              <p class="nomeFundadores">Gabriel Viscondi</p>
              <p class="cargoFundadores">COO - <span class="letra-verde">e</span>Man</p>
              <p class="descFundadores">{{ trans('mensagens.desc-cargo-gabriel') }}</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 blocoFundadores">
              <img src="images/sobre/foto-fabio-min.png" alt="{{ trans('mensagens.alt-img-fabio') }}" class="imgFundadores"></img>
              <p class="nomeFundadores">Fábio Molinar</p>
              <p class="cargoFundadores">CPO - <span class="letra-verde">e</span>Proj</p>
              <p class="descFundadores">{{ trans('mensagens.desc-cargo-fabio') }}</p>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 blocoFundadores">
              <img src="images/sobre/foto-claudionor-min.png" alt="{{ trans('mensagens.alt-img-claudionor') }}" class="imgFundadores"></img>
              <p class="nomeFundadores">Claudionor Silva</p>
              <p class="cargoFundadores">CTO - <span class="letra-verde">e</span>Tec</p>
              <p class="descFundadores">{{ trans('mensagens.desc-cargo-claudionor') }}</p>
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
    $(document).ready(function(){


      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
