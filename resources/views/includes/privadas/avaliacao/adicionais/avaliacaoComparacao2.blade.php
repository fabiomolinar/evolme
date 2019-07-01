<tr class="quest-adicional" id="idAvaliacaoComparacao2">
  <td>
    {{-- Comparação 2 --}}
    <p>{{ trans('mensagens.pergunta-comparacao-3') }}</p>
    <input type="hidden" name="time" value="">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="time" data-value="1">{{ trans('mensagens.mais-longo') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="time" data-value="2">{{ trans('mensagens.igual') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="time" data-value="3">{{ trans('mensagens.mais-curto') }}</button>
    </div>
    <p>{{ trans('mensagens.pergunta-comparacao-4') }}</p>
    <input type="hidden" name="price" value="">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="price" data-value="1">{{ trans('mensagens.mais-caro') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="price" data-value="2">{{ trans('mensagens.igual') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="price" data-value="3">{{ trans('mensagens.mais-barato') }}</button>
    </div>
    <p>{{ trans('mensagens.pergunta-comparacao-5') }}</p>
    <input type="hidden" name="location" value="">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="location" data-value="1">{{ trans('mensagens.pior') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="location" data-value="2">{{ trans('mensagens.similar') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="location" data-value="3">{{ trans('mensagens.melhor') }}</button>
    </div>
  </td>
</tr>
