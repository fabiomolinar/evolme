@extends('layouts.principal')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/publicas/home.css') }}">
  {{-- JS --}}
  <script type="text/javascript" src="{{ asset('/js/jquery.waypoints.js') }}"></script>
  {{-- meta --}}
  <title>{{ trans('mensagens.titulo-inicial') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-inicial') }}">
  <meta name="programmers" content="Fabio Thomaz Molinar, Claudionor Borges">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  @include('includes.msgErro')
  <div class="row">
    <div class="col-xs-12 m0p0" id="page-wrapper"> <!-- Page Wrapper -->
      {{-- Imagem de apresentação --}}
      <div class="row home-capa-fundo">
        <div class="col-xs-12 cor-branca centralizar" id="capa-wrapper"> <!-- Content wrapper -->
          <div class="row">
            <div class="col-xs-12" id="capa1">
              <p class="home-capa-texto">{{ trans('mensagens.capa1') }}<strong>{{ trans('mensagens.capa2') }}</strong>{{ trans('mensagens.capa3') }}</p>
              <p class="home-capa-texto">{{ trans('mensagens.capa4') }}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12" id="capa2">
              <div class="col-xs-12 col-sm-6">
                <a href="/cadastro">
                  <button type="submit" class="btn btn-success margem-cinco btn-simetrico">
                    {{ trans('mensagens.seja-avaliador') }}
                  </button>
                </a>
              </div>
              <div class="col-xs-12 col-sm-6">
                <a href="/planos-precos">
                  <button type="submit" class="btn btn-success margem-cinco btn-simetrico">
                    {{ trans('mensagens.evolua-estabelecimento') }}
                  </button>
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12" id="capa3">
              <p class="home-capa-texto"><strong>evolme</strong>, feedback matters.</p>
            </div>
          </div>
        </div>
      </div>
      {{-- Vídeo --}}
      <div class="row fundo-cinza margem-dinamica">
        <div class="col-xs-12 home-conteudo centralizar"> <!-- Content wrapper -->
          <h3>{{ trans('mensagens.home-video-titulo') }}</h3>
          <iframe class="home-video" src="https://www.youtube.com/embed/PSAjTgBqYB4" frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
      {{-- Como funciona --}}
      <div class="row fundo-branco margem-dinamica">
        <a id="ComoFunciona"></a> <!-- anchor -->
        <div class="col-xs-12 home-conteudo centralizar"> <!-- Content wrapper -->
          <h3>{{ trans('mensagens.home-como-funciona-titulo') }}</h3>
          <div class="row" id="comoFuncionaConteudo"> <!-- Imagens e textos -->
            <div class="col-xs-6">
              <img src="images/home/funciona-consumidor-min.png" alt="Foto do avaliador" class="img-responsive home-como-funciona-img"></img>
              <p><b>{{ trans('mensagens.avaliador') }}</b></p>
            </div>
            <div class="col-xs-6">
              <img src="images/home/funciona-empreendedor-min.png" alt="Foto do empreendedor" class="img-responsive home-como-funciona-img"></img>
              <p><b>{{ trans('mensagens.estabelecimento') }}</b></p>
            </div>
            <div class="col-xs-12 home-como-funciona-texto"> <!-- Textos -->
              <div class="row">
                <div class="col-xs-6">
                  {{ trans('mensagens.home-como-funciona-l1c1') }}
                </div>
                <div class="col-xs-6">
                  {{ trans('mensagens.home-como-funciona-l1c2') }}
                </div>
              </div>
              @include('includes.publicas.home.comoFuncionaSeta')
              <div class="row">
                <div class="col-xs-6">
                  {{ trans('mensagens.home-como-funciona-l2c1') }}
                </div>
                <div class="col-xs-6">
                  {{ trans('mensagens.home-como-funciona-l2c2') }}
                </div>
              </div>
              @include('includes.publicas.home.comoFuncionaSeta')
              <div class="row">
                <div class="col-xs-6">
                  {{ trans('mensagens.home-como-funciona-l3c1') }}
                </div>
                <div class="col-xs-6">
                  {{ trans('mensagens.home-como-funciona-l3c2') }}
                </div>
              </div>
              @include('includes.publicas.home.comoFuncionaSeta')
              <div class="row">
                <div class="col-xs-6">
                  {{ trans('mensagens.home-como-funciona-l4c1') }}
                </div>
                <div class="col-xs-6">
                  {{ trans('mensagens.home-como-funciona-l4c2') }}
                </div>
              </div>
            </div>
          </div>
          <div class="row home-como-funciona-conclusao"> <!-- Texto da conclusão -->
            <div class="col-xs-offset-1 col-xs-2">
              <span class="hidden-xs fa fa-angle-double-right fa-3x home-como-funciona-seta"></span>
              <span class="visible-xs fa fa-angle-double-right fa-2x home-como-funciona-seta"></span>
            </div>
            <div class="col-xs-6 home-como-funciona-texto">
              {{ trans('mensagens.home-como-funciona-conclusao') }}
            </div>
            <div class="col-xs-2">
              <span class="hidden-xs fa fa-angle-double-left fa-3x home-como-funciona-seta"></span>
              <span class="visible-xs fa fa-angle-double-left fa-2x home-como-funciona-seta"></span>
            </div>
          </div>
        </div>
      </div>
      {{-- Vantagens --}}
      <div class="row fundo-verde margem-dinamica">
        <a id="Vantagens"></a> <!-- anchor -->
        <div class="col-xs-12 home-conteudo centralizar"> <!-- Content wrapper -->
          <h3>{{ trans('mensagens.home-vantagens') }}</h3>
          <p>{{ trans('mensagens.avaliador') }}</p>
          @include('includes.publicas.home.vantagensHexagonos')
          <p>{{ trans('mensagens.estabelecimento') }}</p>
        </div>
      </div>
      {{-- Parceiros --}}
      <div class="row fundo-branco margem-dinamica">
        <a id="Parceiros"></a> <!-- anchor -->
        <div class="col-xs-12 home-conteudo home-parceiros">
          <h3>Parceiros</h3>
          <div class="col-xs-6">
            <a href="http://apptitoso.com/" target="_blank">
              <img src="images/parceiros/apptitoso_v2.png" alt="Apptitoso" class="img-responsive home-img-parceiros"></img>
            </a>
          </div>
          <div class="col-xs-6">
            <a href="https://web.facebook.com/bigdealhamburgueria/" target="_blank">
              <img src="images/parceiros/big_deal_v2.png" alt="Big Deal" class="img-responsive home-img-parceiros"></img>
            </a>
          </div>
        </div>
      </div>
      {{-- Extra footer --}}
      <div class="row">
        <a id="SejaUmEvolmer"></a> <!-- anchor -->
        <div class="col-xs-12 m0p0"> <!-- Content wrapper -->
          <div class="row home-extra-footer-wrapper">
            <div class="col-xs-12">
              <h3>{{ trans('mensagens.faca-parte-dessa-evolucao') }}</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
              <a href="/cadastro">
                <button type="submit" class="btn btn-success margem-cinco btn-simetrico">
                  {{ trans('mensagens.seja-avaliador') }}
                </button>
              </a>
            </div>
            <div class="col-xs-12 col-sm-6">
              <a href="/planos-precos">
                <button type="submit" class="btn btn-success margem-cinco btn-simetrico">
                  {{ trans('mensagens.evolua-estabelecimento') }}
                </button>
              </a>
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
    function ajustarCapa() {
      {{-- Configuração da capa --}}
      var alturaCapa = $(window).height() - $('#header').height();
      $('#capa-wrapper').height(alturaCapa);
      var espacamento = (alturaCapa - ($('#capa1').height() + $('#capa2').height() + $('#capa3').height()))/4;
      $('#capa1').css('margin-top',espacamento);
      $('#capa1').css('margin-bottom',espacamento);
      $('#capa2').css('margin-bottom',espacamento);
      $('#capa3').css('margin-bottom',espacamento);
    }
    function ajustarSetaComoFuncionaConclusao(){
      var tamanhoBlocoConclusao = $('.home-como-funciona-conclusao .home-como-funciona-texto').height();
      if (tamanhoBlocoConclusao > 44){
        $('.home-como-funciona-conclusao .home-como-funciona-seta').height(tamanhoBlocoConclusao);
        $('.home-como-funciona-conclusao .home-como-funciona-seta').css('margin-top',(tamanhoBlocoConclusao - 42)/2);
      }
    }
    function ajustarHexagonos(){
      var tamanhoJanela = $(window).width();
      var tamanhoJanelaHex = $('.home-vantagens-hex .col-xs-12').width();
      if ($('.home-vantagens-hex .col-xs-12 + .col-xs-12').width() > tamanhoJanelaHex){
        tamanhoJanelaHex = $('.home-vantagens-hex .col-xs-12 + .col-xs-12').width();
      }
      var margem = 0;
      var tamanhoMaxBlocos = 0;
      if (tamanhoJanela < 480){
        tamanhoMaxBlocos = 103*2
      } else if (tamanhoJanela < 768) {
        tamanhoMaxBlocos = 183*2
      } else {
        tamanhoMaxBlocos = 183*3
      }
      margem = (tamanhoJanelaHex - tamanhoMaxBlocos)/2;
      if (margem > 0) {
        $('.home-vantagens-hex .col-xs-12').css('padding-left',margem + 15);
      }
    }
    $(document).ready(function(){
      ajustarCapa();
      ajustarSetaComoFuncionaConclusao();
      ajustarHexagonos();
      //Mudando textos dentro do hex ao hover.
      $('.hex').hover(function(){
        $(this).toggleClass('sel');
        $(this).children('.textoHex.main').hide();
        $(this).children('.textoHex.sel').css('display','block');
      },function(){
        $(this).toggleClass('sel');
        $(this).children('.textoHex.main').show();
        $(this).children('.textoHex.sel').hide();
      });
      //smooth scroll
      $('a').click(function(){
          var elemento = $.attr(this, 'href');
          var elemento = elemento.substr(1,elemento.length);
            $('html, body').animate({
                scrollTop: ($(elemento).offset().top - 10)  //o "-10" é um ajuste de offset
            }, 500);
            return false;
      });

      //Configurando waypoints
      $('.home-extra-footer-wrapper div:nth-child(2)').waypoint(function(direction){
        if (direction === 'down') {
          var elemento = $(this.element);
          elemento.hide();
          elemento.fadeIn(1521);
        }
      },{
        offset: '100%'
      });
      $('.home-extra-footer-wrapper div:nth-child(3)').waypoint(function(direction){
        if (direction === 'down') {
          var elemento = $(this.element);
          elemento.hide();
          elemento.fadeIn(1521);
        }
      },{
        offset: '100%'
      });
      $('.home-vantagens-hex').each(function(){
        $(this).waypoint(function(direction){
          if (direction === 'down') {
            var elemento = $(this.element);
            elemento.hide();
            elemento.fadeIn(1521);
          }
        },{
          offset: '100%'
        });
      });
      $('#comoFuncionaConteudo div:nth-child(1)').waypoint(function(direction){
        if (direction === 'down') {
          var elemento = $(this.element);
          elemento.hide();
          elemento.fadeIn(1521);
        }
      },{
        offset: '100%'
      });
      $('#comoFuncionaConteudo div:nth-child(2)').waypoint(function(direction){
        if (direction === 'down') {
          var elemento = $(this.element);
          elemento.hide();
          elemento.fadeIn(1521);
        }
      },{
        offset: '100%'
      });
      $('.home-como-funciona-conclusao').waypoint(function(direction){
        if (direction === 'down') {
          var elemento = $(this.element);
          elemento.hide();
          elemento.fadeIn(1521);
        }
      },{
        offset: '100%'
      });

      //ON RESIZE
      window.onresize = function(event) {
      	ajustarCapa();
        ajustarSetaComoFuncionaConclusao();
        ajustarHexagonos();
      }
    });
  </script>
@endsection
