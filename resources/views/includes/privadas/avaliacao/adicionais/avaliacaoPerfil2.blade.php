<tr class="quest-adicional" id="idAvaliacaoPerfil2">
  <td>
    {{-- Perfil 2 --}}
    <p>{{ trans('mensagens.qual-sua-renda-familiar') }}</p>
    <input type="hidden" name="monthly_income" value="">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-primary" data-name="monthly_income" data-value="1">{{ trans('mensagens.texto-renda-1') }}</button>
      <button type="button" class="btn btn-primary" data-name="monthly_income" data-value="2">{{ trans('mensagens.texto-renda-2') }}</button>
      <button type="button" class="btn btn-primary" data-name="monthly_income" data-value="3">{{ trans('mensagens.texto-renda-3') }}</button>
      <button type="button" class="btn btn-primary" data-name="monthly_income" data-value="4">{{ trans('mensagens.texto-renda-4') }}</button>
      <button type="button" class="btn btn-primary" data-name="monthly_income" data-value="5">{{ trans('mensagens.texto-renda-5') }}</button>
      <button type="button" class="btn btn-primary" data-name="monthly_income" data-value="6">{{ trans('mensagens.texto-renda-6') }}</button>
      <button type="button" class="btn btn-primary" data-name="monthly_income" data-value="7">{{ trans('mensagens.texto-renda-7') }}</button>
      <button type="button" class="btn btn-primary" data-name="monthly_income" data-value="8">{{ trans('mensagens.texto-renda-8') }}</button>
    </div>
    <p>{{ trans('mensagens.e-seu-estado-civil') }}</p>
    <input type="hidden" name="marital_status" value="">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-primary" data-name="marital_status" data-value="1">{{ trans('mensagens.solteiro-a') }}</button>
      <button type="button" class="btn btn-primary" data-name="marital_status" data-value="2">{{ trans('mensagens.casado-a') }}</button>
      <button type="button" class="btn btn-primary" data-name="marital_status" data-value="3">{{ trans('mensagens.uniao-estavel') }}</button>
      <button type="button" class="btn btn-primary" data-name="marital_status" data-value="4">{{ trans('mensagens.divorciado-a') }}</button>
      <button type="button" class="btn btn-primary" data-name="marital_status" data-value="5">{{ trans('mensagens.viuvo-a') }}</button>
    </div>
  </td>
</tr>
