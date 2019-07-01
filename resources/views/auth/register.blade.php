@extends('layouts.principal')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/publicas/cadastro.css') }}">
  {{-- JS --}}
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  <script src='https://www.google.com/recaptcha/api.js?hl=pt-BR'></script>
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-login') }}">
  <title>{{ trans('mensagens.titulo-cadastro') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-cadastro') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
    @include('includes.msgErro')
	<div class="row" id="cadastro-wrapper">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
      <div class="panel panel-default">
				<div class="panel-heading">{{ trans('mensagens.cadastrar') }}</div>
				<div class="panel-body">
          <p>{{ trans('mensagens.quer-cadastrar-rede-social') }}</p>
    			<p>{{ trans('mensagens.vamos-la-e-rapido') }}</p>
    			<a href="/login/facebook" class="loginSocial"><i class="fa fa-facebook-square fa-5x iconeSocialRegistro"></i></a>
    			<a href="/login/google" class="loginSocial"><i class="fa fa-google-plus-square fa-5x iconeSocialRegistro"></i></a>
    			<p><a href="#">{{ trans('mensagens.termos-condicoes') }}</a>{{ trans('mensagens.da-evolme') }}</p>
    			<hr>
    			<p>{{ trans('mensagens.ou-cadastre-usando-email') }}</p>
    			<form class="form-horizontal" role="form" method="POST" action="{{ url('/cadastrar') }}">
    				{!! csrf_field() !!}
    				<input type="text" name="name" value="{{ old('name') }}" required=''>
    				<label for="name" alt="{{ trans('mensagens.qual-seu-nome') }}" placeholder="{{ trans('mensagens.nome') }}" original="{{ trans('mensagens.nome') }}"></label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required=''>
    				<label for="last_name" alt="{{ trans('mensagens.qual-seu-sobrenome') }}" placeholder="{{ trans('mensagens.sobrenome') }}" original="{{ trans('mensagens.sobrenome') }}"></label>
            <input type="text" name="nickname" value="{{ old('nickname') }}" required=''>
            <label for="nickname" alt="{{ trans('mensagens.qual-seu-apelido') }}" placeholder="{{ trans('mensagens.apelido') }}" original="{{ trans('mensagens.apelido') }}"></label>
            <input type="text" name="email" value="{{ old('email') }}" required=''>
    				<label for="email" alt="{{ trans('mensagens.e-seu-email') }}" placeholder="{{ trans('mensagens.email') }}" original="{{ trans('mensagens.email') }}"></label>
            <input type="text" name="email_confirmation" value="{{ old('email_confirmation') }}" required=''>
    				<label for="email_confirmation" alt="{{ trans('mensagens.confirme-email') }}" placeholder="{{ trans('mensagens.email') }}" original="{{ trans('mensagens.email') }}"></label>
            <input type="password" name="password" value="{{ old('password') }}" required=''>
    				<label for="password" alt="{{ trans('mensagens.crie-senha') }}" placeholder="{{ trans('mensagens.senha') }}" original="{{ trans('mensagens.senha') }}"></label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required=''>
    				<label for="password_confirmation" alt="{{ trans('mensagens.confirme-senha') }}" placeholder="{{ trans('mensagens.senha') }}" original="{{ trans('mensagens.senha') }}"></label>
            <div class="g-recaptcha" data-sitekey="6LfUxiUTAAAAANjZXoqp5qXFeh5bZj96jdZu5H5w"></div>
            <div class="checkbox">
    					<label>
    						<input type="checkbox" name="concordo"> {{ trans('mensagens.concordo-com') }} <a href="#">{{ trans('mensagens.termos-condicoes') }}</a>{{ trans('mensagens.da-evolme') }}
    					</label>
    				</div>
    				<button type="submit" class="btn btn-primary">{{ trans('mensagens.proximo') }}</button>
    			</form>
        </div>
      </div>
		</div>
	</div>
@endsection

@section('footer')
  @include('includes.footer')
@endsection

{{-- Modal area --}}
<div id="aceitoCondicoes" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('mensagens.termos-condicoes') }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ trans('mensagens.voce-aceita-termos') }}</p>
        <div class="alert alert-danger" role="alert" id="condicoesFalhou">
          {{ trans('mensagens.voce-precisa-aceitar') }}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="condicoesAceitar">{{ trans('mensagens.aceitar') }}</button>
        <button type="button" class="btn btn-danger" id="condicoesDeclinar">{{ trans('mensagens.declinar') }}</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" id="condicoesFechar">{{ trans('mensagens.fechar') }}</button>
      </div>
    </div>
  </div>
</div>

@section('js')
  <script type="text/javascript">
    //criando mensagens que serão passadas para o contatoFormValidation
    var ajaxSuccess = $('<textarea />').html("{{ trans('mensagens.bem-vindo-vamos-avaliar') }}").text();
		var valNomeReq = "{{ trans('mensagens.val-req-nome') }}";
    var valEmailReq = "{{ trans('mensagens.val-req-email') }}";
    var valEmailEmail = "{{ trans('mensagens.val-email-email') }}";
    var ajaxError = "{{ trans('mensagens.ajax-error') }}"
    var valEmailIgual = "{{ trans('mensagens.val-email-igual') }}"
    var valSenhaReq = "{{ trans('mensagens.val-senha-req') }}"
    var valSenhaIgual = "{{ trans('mensagens.val-senha-igual') }}"
    var valSenhaMin = "{{ trans('mensagens.val-senha-min') }}"
  </script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/publicas/cadastroFormValidation.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.loginSocial').click(function(e){
        var redirecionar = $(this).attr('href');
        e.preventDefault();
        $('#condicoesFalhou').hide();
        $('#aceitoCondicoes').modal();
        $('#condicoesAceitar').click(function(){
          window.location.replace(redirecionar);
        });
        $('#condicoesDeclinar').click(function(){
          $('#condicoesFalhou').show();
        });
      });

      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
