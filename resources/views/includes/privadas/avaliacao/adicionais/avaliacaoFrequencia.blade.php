<tr class="quest-adicional" id="idAvaliacaoFrequencia">
  <td>
    {{-- Frequência --}}
    <p>{{ trans('mensagens.pergunta-freq-1') }}</p>
    <div class="row">
      <div class="col-xs-4 col-sm-3 col-lg-2">
        <input type="text" name="freq_us" value="{{ old('freq_us') }}" required=''>
        <label for="freq_us" alt="" placeholder="" original=""></label>
      </div>
      <div class="col-xs-8 col-sm-9 col-lg-10" id="checkbox-primeira-vez">
        <input type="checkbox" name="freq_first_time" value="">
        <span>{{ trans('mensagens.e-minha-primeira-vez') }}</span>
      </div>
    </div>
    <p>{{ trans('mensagens.pergunta-freq-2') }}</p>
    <div class="col-xs-4 col-sm-3 col-lg-2">
      <input type="text" name="freq_general" value="{{ old('freq_general') }}" required=''>
      <label for="freq_general" alt="" placeholder="" original=""></label>
    </div>
  </td>
</tr>
