@extends('layouts.principal')

@section('head')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/publicas/login.css') }}">
  {{-- JS --}}
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-login') }}">
  <title>{{ trans('mensagens.titulo-login') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-login') }}">
@endsection

@section('header')
  @include('includes.header')
@endsection

@section('conteudo')
  @include('includes.msgErro')
	<div class="row" id="login-wrapper">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('mensagens.entrar') }}</div>
				<div class="panel-body">

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<input type="text" class="" name="email" value="{{ old('email') }}" required="">
                <label for="email" alt="{{ trans('mensagens.qual-seu-email') }}" placeholder="{{ trans('mensagens.email') }}" original="{{ trans('mensagens.email') }}"></label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<input type="password" class="" name="password" required="">
                <label for="password" alt="{{ trans('mensagens.digite-senha') }}" placeholder="{{ trans('mensagens.senha') }}" original="{{ trans('mensagens.senha') }}"></label>
                <div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> {{ trans('mensagens.lembre-mim') }}
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
                				<button type="submit" class="btn btn-primary">{{ trans('mensagens.entrar') }}</button>
								<a class="btn btn-link" href="{{ url('/password/email') }}">{{ trans('mensagens.esqueceu-senha') }}</a>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								{{ trans('mensagens.nao-registrado-label') }}<a href="{{ url('cadastro') }}">{{ trans('mensagens.nao-registrado') }}</a>
							</div>
						</div>
					</form>
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
    //criando mensagens que serão passadas para o contatoFormValidation
    var ajaxError = "{{ trans('mensagens.ajax-error') }}";
    var valEmailEmail = "{{ trans('mensagens.val-email-email') }}";
    var valEmailReq = "{{ trans('mensagens.val-req-email') }}";
    var valSenhaReq = "{{ trans('mensagens.val-senha-req') }}";
    var valSenhaMin = "{{ trans('mensagens.val-senha-min') }}";
  </script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/publicas/loginFormValidation.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){


      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
