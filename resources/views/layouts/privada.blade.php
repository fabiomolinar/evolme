<!DOCTYPE html>
<html lang="pt">
<head>
  {{-- Os ítens abaixo estarão presentes em TODOS os heads --}}
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="author" content="Fabio Thomaz Molinar, Claudionor Borges Silva, Gabriel Viscondi, Thiago Villela">
  <meta name="contact" content="suporte@evolme.com">
  <meta name="keywords" content="{{ trans('mensagens.head') }}">
  <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

  {{-- Adicionando fontes adicionais que o Gabriel pediu --}}
  <style type="text/css">
  @font-face {
    font-family: "Litera";
    src: url("{{ asset('/fonts/Litera.ttf') }}") format("truetype");
  }
  </style>

  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-theme.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/font-awesome.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/principal.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/inputs.css') }}" id="css-inputs">

  {{-- JS --}}
  <script type="text/javascript" src="{{ asset('/js/jquery-1.12.3.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/bootstrap.js') }}"></script>

  {{-- Trackers --}}
  @include('includes.trackers')

  {{-- O container abaixo será usado para criar os heads específicos de cada página --}}
  @yield('head')
</head>
<body>
  <div id="super-wrapper">
    <div class="container-fluid zero-padding">
      <div class="master-wrapper" id="header">
        @yield('header')
      </div>
      <div class="master-wrapper" id="conteudo">
        @yield('conteudo')
      </div>
      <div class="master-wrapper" id="footer">
        @yield('footer')
        @include('includes.modalErro')
      </div>
    </div>
    <div class="master-wrapper" id="js">
      @yield('js')
    </div>
  </div>
</body>
</html>
