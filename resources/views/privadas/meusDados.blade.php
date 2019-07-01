@extends('layouts.painelUsuario')

@section('headPainel')
  {{-- CSS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/privadas/meusDados.css') }}">
  {{-- meta --}}
  <meta name="keywords" content="{{ trans('mensagens.meta-meus-dados') }}">
  <title>{{ trans('mensagens.titulo-meus-dados') }}</title>
  <meta name="Description" content="{{ trans('mensagens.descricao-meus-dados') }}">
@endsection

@section('conteudoPainel')
  <div class="panel panel-primary">
    <div class="panel-heading">{{ trans('mensagens.meus-dados') }}</div>
    <div class="panel-body">
      <form class="form-horizontal" action="{{ url('/usuario-atualizar-perfil') }}" method="post">
        {!! csrf_field() !!}
        <input type="text" name="name" required='' value="{{ $user->name }}">
        <label for="name" alt="{{ trans('mensagens.qual-seu-nome') }}" placeholder="{{ trans('mensagens.nome') }}" original="{{ trans('mensagens.nome') }}" ></label>
        <input type="text" name="last_name" value="{{ $user->last_name}}" required=''>
        <label for="last_name" alt="{{ trans('mensagens.qual-seu-sobrenome') }}" placeholder="{{ trans('mensagens.sobrenome') }}" original="{{ trans('mensagens.sobrenome') }}"></label>
        <input type="text" name="nickname" value="{{ $user->nickname }}" required=''>
        <label for="nickname" alt="{{ trans('mensagens.escolha-um-apelido') }}" placeholder="{{ trans('mensagens.apelido') }}" original="{{ trans('mensagens.apelido') }}"></label>
        <input type="text" name="zip" value="{{ $user->zip }}" required=''>
        <label for="zip" alt="{{ trans('mensagens.qual-seu-cep') }}" placeholder="{{ trans('mensagens.cep') }}" original="{{ trans('mensagens.cep') }}"></label>
          <input type="text" name="state" value="{{ $user->state }}" required=''>
          <label for="state" alt="{{ trans('mensagens.qual-seu-estado') }}" placeholder="{{ trans('mensagens.estado2') }}" original="{{ trans('mensagens.estado2') }}"></label>
          <input type="text" name="city" value="{{ $user->city }}" required=''>
        <label for="city" alt="{{ trans('mensagens.em-que-cidade-voce-mora') }}" placeholder="{{ trans('mensagens.cidade') }}" original="{{ trans('mensagens.cidade') }}"></label>
        <input type="hidden" name="birth_date" value="{{ $user->birth_date }}">
        <span>{{ trans('mensagens.data-nascimento') }}</span>
        <div class="row input-data-nascimento">
          <div class="col-xs-3 col-sm-2 col-md-2">
            <input type="text" name="nascimentoDia" value="{{ strtotime($user->birth_date) < 0 ? "-" : date('d',strtotime($user->birth_date))  }}" required='' data-toggle="tooltip" title="2 dígitos">
            <label for="nascimentoDia" alt="{{ trans('mensagens.dia') }}" placeholder="{{ trans('mensagens.dia') }}" original="{{ trans('mensagens.dia') }}"></label>
          </div>
          <div class="col-xs-3 col-sm-2 col-md-2">
            <input type="text" name="nascimentoMes" value="{{ strtotime($user->birth_date) > 0 ? date('m',strtotime($user->birth_date)) : "-" }}" required='' data-toggle="tooltip" title="2 dígitos">
            <label for="nascimentoMes" alt="{{ trans('mensagens.mes') }}" placeholder="{{ trans('mensagens.mes') }}" original="{{ trans('mensagens.mes') }}"></label>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-3">
            <input type="text" name="nascimentoAno" value="{{ strtotime($user->birth_date) > 0 ? date('Y',strtotime($user->birth_date)) : "-" }}" required='' data-toggle="tooltip" title="4 dígitos">
            <label for="nascimentoAno" alt="{{ trans('mensagens.ano') }}" placeholder="{{ trans('mensagens.ano') }}" original="{{ trans('mensagens.ano') }}"></label>
          </div>
        </div>
        <div class="botao-alterar-dados">
        <button class="btn btn-primary" type="submit" name="enviar">{{ trans('mensagens.alterar-dados') }}</button>
      </div>
      </form>
    </div>
  </div>
@endsection

@section('jsPainel')
    <script>
          //Mensagens que serão usados pelo Ajax
          var ajaxError = "{{ trans('mensagens.ajax-error') }}";
          var valNomeReq = "{{ trans('mensagens.val-req-nome') }}";
          var valSobrenomeReq = "{{ trans('mensagens.val-req-sobrenome') }}"
          var valEmailReq = "{{ trans('mensagens.val-req-email') }}";
          var valEmailEmail = "{{ trans('mensagens.val-email-email') }}";
  </script>
  <script type="text/javascript" src="{{ asset('/js/privadas/dashboard/moment.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/jquery.validate.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/flashAjaxError.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/ajaxErrorForm.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/privadas/meusDadosFormValidation.js') }}"></script>

  <script type="text/javascript">
  $(document).ready(function(){
      $('input[name="zip"]').on("blur",function(){
          if($('input[name="zip"]').val() != null && $('input[name="zip"]').val() != ""){
              $('input[name="state"]').attr("readonly",true);
              $('input[name="state"]').attr("required",false);
              $('input[name="state"]').attr("placeholder","Carregando...");
              $('input[name="city"]').attr("readonly",true);
              $('input[name="city"]').attr("required",false);
              $('input[name="city"]').attr("placeholder","Carregando...");
              $dados = {};
              $dados.cep = $('input[name="zip"]').val();
              $dados._token = "{!! csrf_token() !!}";
              $.ajax({
                  url: '/cep',
                  type: 'GET',
                  dataType: 'json',
                  data: $dados,
                  success: function(response){
                      if(response != null){
                          address = JSON.parse(response);
                          $('input[name="state"]').attr("readonly",false);
                          $('input[name="state"]').attr("required",true);
                          $('input[name="state"]').val(address.uf);

                          $('input[name="city"]').attr("readonly",false);
                          $('input[name="city"]').attr("required",true);
                          $('input[name="city"]').val(address.localidade);
                      }else{
                          ajaxError = "Oops! Tivemos um problema ao tentar pesquisar seu CEP. Por favor, verifique se o CEP digitado está no formato 00000000 ou 00000-000. Caso o problema persista, por favor nos informe.";
                          $('input[name="state"]').attr("readonly",false);
                          $('input[name="state"]').attr("required",true);
                          $('input[name="state"]').attr("placeholder","");

                          $('input[name="city"]').attr("readonly",false);
                          $('input[name="city"]').attr("required",true);
                          $('input[name="city"]').attr("placeholder","");

                          $('input[name="zip"]').attr("readonly",false);
                          $('input[name="zip"]').attr("required",true);
                          $('input[name="zip"]').attr("placeholder","");
                          $('input[name="zip"]').val("");
                          ajaxErrorForm(ajaxError);
                      }
                  },
                  error: function(jqXHR, textStatus, errorThrown){
                      ajaxError = "Oops! Tivemos um problema ao tentar pesquisar seu CEP. Por favor, verifique se o CEP digitado está no formato 00000000 ou 00000-000. Caso o problema persista, por favor nos informe.";
                      $('input[name="state"]').attr("readonly",false);
                      $('input[name="state"]').attr("required",true);
                      $('input[name="state"]').attr("placeholder","");

                      $('input[name="city"]').attr("readonly",false);
                      $('input[name="city"]').attr("required",true);
                      $('input[name="city"]').attr("placeholder","");

                      $('input[name="zip"]').attr("readonly",false);
                      $('input[name="zip"]').attr("required",true);
                      $('input[name="zip"]').attr("placeholder","");
                      $('input[name="zip"]').val("");
                      ajaxErrorForm(ajaxError);
                  }
              });

              /*$.getJSON("/cep/"+$('input[name="zip"]').val(),function(address){
                  if(address.error != true){
                      $('input[name="address"]').attr("readonly",false);
                      $('input[name="address"]').attr("required",true);
                      $('input[name="address"]').val(address.logradouro);

                      $('input[name="city"]').attr("readonly",false);
                      $('input[name="city"]').attr("required",true);
                      $('input[name="city"]').val(address.localidade);
                  }else{
                      ajaxErrorForm(address.message);
                  }
              }); */
          }

      });
  });

    $(document).ready(function(){
  /*  $('input[name="name"]').val('{!! $user["name"] !!}');
      $('input[name="last_name"]').val('{!! $user["last_name"] !!}');
      $('input[name="nickname"]').val('{!! $user["nickname"] !!}');
      $('input[name="address"]').val('{!! $user["address"] !!}');
      $('input[name="zip"]').val('{!! $user["zip"] !!}');
      $('input[name="city"]').val('{!! $user["city"] !!}');
      $('input[name="birth_date"]').val('{!! $user["birth_date"] !!}');
      $('input[name="nascimentoDia"]').val('{!! substr($user["birth_date"],0,2) !!}');
      $('input[name="nascimentoMes"]').val('{!! substr($user["birth_date"],3,2) !!}');
      $('input[name="nascimentoAno"]').val('{!! substr($user["birth_date"],6,4) !!}');
*/
      $('.input-data-nascimento input').focusout(function(evento){
        var dia = $('input[name="nascimentoDia"]').val();
        var mes = $('input[name="nascimentoMes"]').val();
        var ano = $('input[name="nascimentoAno"]').val();
        var data = ano + '-' + mes + '-' + dia;
        if (data != "--") {
          $('input[name="birth_date"]').val(data);
        } else {
          if ($('input[name="birth_date"]').val() != "") {
            $('input[name="birth_date"]').val("");
          }
        }
      });

      //ON RESIZE
      window.onresize = function(event) {

      }
    });
  </script>
@endsection
