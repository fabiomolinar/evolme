<tr class="quest-adicional" id="idAvaliacaoNPS">
  <td>
    {{-- NPS --}}
    <p>{{ trans('mensagens.pergunta-nps') }}</p>
    <input type="hidden" name="nps" value="">
    <div class="hidden-xs">
      <div class="btn-group hidden-xs-12" role="group">
        @for($i = 0; $i <= 10; $i++)
          <button type="button" class="btn btn-primary" data-name="nps" data-value="{{ $i }}">{{ $i }}</button>
        @endfor
      </div>
    </div>
    <div class="visible-xs">
      <div class="row">
        <div class="col-xs-12">
          <div class="btn-group">
            @for($i = 0; $i <= 5; $i++)
              <button type="button" class="btn btn-primary" data-name="nps" data-value="{{ $i }}">{{ $i }}</button>
            @endfor
          </div>
        </div>
        <div class="col-xs-12 separadorBotoesNPS">
          <div class="btn-group">
            @for($i = 6; $i <= 10; $i++)
              <button type="button" class="btn btn-primary" data-name="nps" data-value="{{ $i }}">{{ $i }}</button>
            @endfor
          </div>
        </div>
      </div>
    </div>
  </td>
</tr>
