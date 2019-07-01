<div class="PP-pacotes">
  <h4>{{ $plano['titulo'] }}</h4>
  <p>{{ $plano['descricao'] }}</p>
  <p>{{ trans('mensagens.itens-no-pacote') }}</p>
  <ul>
    @foreach ($plano['incluso'] as $incluso)
    <li>{{ $incluso }}</li>
    @endforeach
  </ul>
  <div>
    <button class="btn btn-success" id="{{ $plano['ID'] }}">{{ trans('mensagens.quero-este') }}</button>
  </div>
  <p>{{ 'R$ ' . $plano['preco'] . '/' . trans('mensagens.mes') }}</p>
</div>
