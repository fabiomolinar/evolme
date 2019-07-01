<tr class="quest-adicional" id="idAvaliacaoComparacao1">
  <td>
    {{-- Comparação 1 --}}
    <p>{{ trans('mensagens.pergunta-comparacao-1') }}</p>
    <input type="hidden" name="service" value="">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="service" data-value="1">{{ trans('mensagens.pior') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="service" data-value="2">{{ trans('mensagens.igual') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="service" data-value="3">{{ trans('mensagens.superior') }}</button>
    </div>
    <p>{{ trans('mensagens.pergunta-comparacao-2') }}</p>
    <input type="hidden" name="quality" value="">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="quality" data-value="1">{{ trans('mensagens.inferior') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="quality" data-value="2">{{ trans('mensagens.similar') }}</button>
      <button type="button" class="btn btn-primary botao-comparacao" data-name="comparacao" data-tipo="quality" data-value="3">{{ trans('mensagens.superior') }}</button>
    </div>
  </td>
</tr>
