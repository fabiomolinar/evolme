<nav class="navbar navbar-default">
  {{-- Adicionando as divs de row e coluna abaixo apenas para que suas respectivas definições de margem e padding sejam aplicadas ao header também --}}
  <div class="row">
    <div class="col-xs-12 margem-dinamica">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-menu-principal" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          <img src="{{ asset('/images/logo-branco.svg') }}" alt="{{ trans('mensagens.logo') }}" class="header-logo"/>
        </a>
        @if(Auth::check())
        <a href="">
          <span class="visible-xs">{{ trans('mensagens.avalie') }}</span>
        </a>
        @endif
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="header-menu-principal">
        @if (Auth::check())
          <ul class="nav navbar-nav">
            <li><a href="">{{ trans('mensagens.buscar') }}</a></li>
            <li><a href="">{{ trans('mensagens.meus-estabelecimentos') }}</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                Mais <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="/#ComoFunciona">{{ trans('mensagens.como-funciona') }}</a></li>
                <li><a href="/#Vantagens">{{ trans('mensagens.vantagens') }}</a></li>
                <li><a href="/#SejaUmEvolmer">{{ trans('mensagens.faca-parte') }}</a></li>
                <li><a href="/contato">{{ trans('mensagens.contato') }}</a></li>
                <li><a href="/sobre">{{ trans('mensagens.sobre') }}</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="">Meu Perfil</a> </li>
                <li><a href="{{ url('/logout') }}">Logout</a></li>
              </ul>
            </li>
          </ul>
        @else
          <ul class="nav navbar-nav">
            <li><a href="/#ComoFunciona">{{ trans('mensagens.como-funciona') }}</a></li>
            <li><a href="/#Vantagens">{{ trans('mensagens.vantagens') }}</a></li>
            <li><a href="/#SejaUmEvolmer">{{ trans('mensagens.faca-parte') }}</a></li>
            <li><a href="/contato">{{ trans('mensagens.contato') }}</a></li>
            <li><a href="/sobre">{{ trans('mensagens.sobre') }}</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right header-icones">
            <li><a href="{{ url('/login') }}">
              <span class="fa fa-user fa-lg"></span>{{ trans('mensagens.entrar') }}</a>
            </li>
            <li><a href="{{ url('cadastro') }}">
              <span class="fa fa-pencil fa-lg"></span>{{ trans('mensagens.inscrever') }}</a>
            </li>
          </ul>
        @endif
      </div><!-- /.navbar-collapse -->
    </div>
  </div>
</nav>
@include('includes.modalCarregando')
@include('includes.modalSuccesso')
<script type="text/javascript" src="{{ asset('/js/ajaxCarregandoForm.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/ajaxSucessoForm.js') }}"></script>
<script type="text/javascript">
  var ajaxMensagemCarregando = "{{ trans('mensagens.modal-ajax-carregando-mensagem') }}";
  var ajaxMensagemSucesso = "{{ trans('mensagens.modal-ajax-sucesso-mensagem') }}";
  function piscarLogo() {
    var relacao = $('.header-logo').width()/$('.header-logo').height();
    $('.header-logo')
      .animate({
        height:69,
        width:69*relacao,
        marginTop:0
      },90)
      .animate({
        height:51,
        width:96.6,
        marginTop:9
      },90);
  }
  function headerReacaoScrollDown() {
    var posicao = $(window).scrollTop();
    var opacidade = $('#header .navbar').css('opacity');
    if (posicao > 71 && opacidade == 1){
      $('#header .navbar').fadeTo(500,0.69);
    } else if (posicao < 71 && opacidade == 0.69){
      $('#header .navbar').fadeTo(500,1);
    }
  }
    $(document).ready(function(){
      $('.header-logo').hover(function(){
        piscarLogo();
      },function(){});
      $(window).scroll(function(){
        headerReacaoScrollDown();
      });
    });
</script>
