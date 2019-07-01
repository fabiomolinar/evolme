<tr class="quest-adicional" id="idAvaliacaoPerfil1">
  <td>
    {{-- Perfil 1 --}}
    <p>{{ trans('mensagens.nos-diga-seu-genero') }}</p>
    <input type="hidden" name="gender" value="">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-primary" data-name="perfil" data-tipo="gender" data-value="F">{{ trans('mensagens.feminino') }}</button>
      <button type="button" class="btn btn-primary" data-name="perfil" data-tipo="gender" data-value="M">{{ trans('mensagens.masculino') }}</button>
    </div>
    <p>{{ trans('mensagens.e-sua-data-nascimento') }}</p>
    <input type="hidden" name="birth_date" value="">
    <div class="row input-data-nascimento">
      <div class="col-xs-3 col-sm-offset-2 col-sm-2 col-md-offset-2 col-md-2">
        <input type="text" name="nascimentoDia" value="{{ old('nascimentoDia') }}" required='' data-toggle="tooltip" title="2 dígitos">
        <label for="nascimentoDia" alt="{{ trans('mensagens.dia') }}" placeholder="{{ trans('mensagens.dia') }}" original="{{ trans('mensagens.dia') }}"></label>
      </div>
      <div class="col-xs-3 col-sm-2 col-md-2">
        <input type="text" name="nascimentoMes" value="{{ old('nascimentoMes') }}" required='' data-toggle="tooltip" title="2 dígitos">
        <label for="nascimentoMes" alt="{{ trans('mensagens.mes') }}" placeholder="{{ trans('mensagens.mes') }}" original="{{ trans('mensagens.mes') }}"></label>
      </div>
      <div class="col-xs-6 col-sm-4 col-md-3">
        <input type="text" name="nascimentoAno" value="{{ old('nascimentoAno') }}" required='' data-toggle="tooltip" title="4 dígitos">
        <label for="nascimentoAno" alt="{{ trans('mensagens.ano') }}" placeholder="{{ trans('mensagens.ano') }}" original="{{ trans('mensagens.ano') }}"></label>
      </div>
    </div>
    <div class="alert alert-danger" role="alert" id="nascimentoAlerta">
      {{ trans('mensagens.val-data-invalida') }}
    </div>
  </td>
</tr>
