{{-- variável é chamada $estabelecimento --}}
<div class="col-xs-12 itemBusca">
  <div class="row itemBusca-titulo">
    <div class="col-xs-3">
      @if (strlen($estabelecimento['img']) > 0)
        <img class="itemBusca-img" src="{{ $estabelecimento['img'] }}" alt="" />
      @else
        <img class="itemBusca-img" src="images/painel/user-image.png" alt="" />
      @endif
      @if (strlen($estabelecimento['link']) > 0)
        <a href="{{ $estabelecimento['link'] }}">site</a>
      @endif
    </div>
    <div class="col-xs-9">
      <h3>{{ $estabelecimento['nome'] }}</h3>
      <span>{{ $estabelecimento['endereco'] }}</span>
    </div>
  </div>
  <table class="table table-striped itemBuscaTabela">
    @if($estabelecimento['qualidade'] == 0 &&
        $estabelecimento['tempo'] == 0 &&
        $estabelecimento['preco'] == 0 &&
        $estabelecimento['local'] == 0)
      <tr>
        <td class="sem-avaliacao">
          <span>{{ trans('mensagens.estabelecimento-nao-tem-avaliacao') }}</span>
        </td>
      </tr>
    @else
      <tr>
        <td>{{trans('mensagens.qualidade')}}</td>
        <td class="estrelas" data-estrelas="{{ $estabelecimento['qualidade'] }}"></td>
      </tr>
      <tr>
        <td>{{trans('mensagens.tempo')}}</td>
        <td class="estrelas" data-estrelas="{{ $estabelecimento['tempo'] }}"></td>
      </tr>
      <tr>
        <td>{{trans('mensagens.preco')}}</td>
        <td class="estrelas" data-estrelas="{{ $estabelecimento['preco'] }}"></td>
      </tr>
      <tr>
        <td>{{trans('mensagens.local')}}</td>
        <td class="estrelas" data-estrelas="{{ $estabelecimento['local'] }}"></td>
      </tr>
    @endif
  </table>
  @if($detalhes === false)
    <div class="itemBusca-botoes">
      <button href="" class="btn btn-primary" type="button" name="button">{{ trans('mensagens.avaliar') }}</button>
      <button href="" class="btn btn-primary" type="button" name="button">{{ trans('mensagens.detalhes') }}</button>
    </div>
  @endif
</div>
