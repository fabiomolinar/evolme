@extends('layouts.painelUsuario')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/meusEstabelecimentos.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-meus-estabelecimentos') }}">
  <title>{{ trans('mensagens.titulo-meus-estabelecimentos') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-meus-estabelecimentos') }}">
@endsection

@section('conteudoPainel')
  <h2>{{ trans('mensagens.meus-estabelecimentos') }}</h2>
  <div class="panel panel-default">
    <div class="panel-body">
      @for($i = 1; $i < 4; $i++)
        <p><a href="#">{{ 'Nome do estabelecimento ' . $i }}</a></p>
      @endfor
    </div>
  </div>
  <div class="div-btn-adicionar-estabelecimento">
    <button class="btn btn-primary" type="button" name="button">{{ trans('mensagens.adicionar-estabelecimento') }}</button>
  </div>
  <hr id="hr">
  <div class="" id="formulario">
    <h4>{{ trans('mensagens.adicione-novo-estabelecimento') }}</h4>
    <form class="" action="{{ url('/') }}" method="post">
      <input type="text" name="estabelecimento" value="{{ old('estabelecimento') }}" required=''>
      <label for="estabelecimento" alt="{{ trans('mensagens.qual-nome-seu-estabelecimento') }}" placeholder="{{ trans('mensagens.nome-estabelecimento') }}" original="{{ trans('mensagens.nome-estabelecimento') }}"></label>
      <input type="text" name="cidade" value="{{ old('cidade') }}" required=''>
      <label for="cidade" alt="{{ trans('mensagens.qual-cidade-seu-estabelecimento') }}" placeholder="{{ trans('mensagens.cidade') }}" original="{{ trans('mensagens.cidade') }}"></label>
      <input type="text" name="telefone" value="{{ old('telefone') }}" required=''>
      <label for="telefone" alt="{{ trans('mensagens.deixe-telefone') }}" placeholder="{{ trans('mensagens.telefone') }}" original="{{ trans('mensagens.telefone') }}"></label>
    </form>
    <div class="">
      <button class="btn btn-primary" type="submit" name="enviar">{{ trans('mensagens.requisitar-estabelecimento') }}</button>
      <button class="btn btn-danger" name="cancelar">{{ trans('mensagens.cancelar') }}</button>
    </div>
  </div>
@endsection

@section('jsPainel')
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  <script type="text/javascript">
    //criando mensagens que serão passadas para o contatoFormValidation
    var ajaxOKAdicionarEstabelecimento = "{{ trans('mensagens.ajax-ok-adicionar-estabelecimento') }}"
    var ajaxError = "{{ trans('mensagens.ajax-error') }}"
    var valEstabelecimentoReq = "{{ trans('mensagens.val-estab-req') }}"
    var valCidadeReq = "{{ trans('mensagens.val-cidade-req') }}"
    var valTelNum = "{{ trans('mensagens.val-tel-num') }}";
    var valTelMin = "{{ trans('mensagens.val-tel-min') }}";
  </script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/adicionarEstabelecimentoFormValidation.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#formulario').hide();
      $('hr').hide();
      $('.div-btn-adicionar-estabelecimento button').click(function(){
        $(this).hide(999);
        $('#formulario').show(999);
        $('hr').show(999);
      });
      $('#formulario div button[name="cancelar"]').click(function(){
        $('#formulario').hide(999);
        $('hr').hide(999);
        $('.div-btn-adicionar-estabelecimento button').show(999);
      });
      $('#formulario div button[name="enviar"]').click(function(){
        $('form').submit();
      });

      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
