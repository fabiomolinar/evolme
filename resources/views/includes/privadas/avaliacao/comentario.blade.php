<tr>
  <td>
    <div class="row itemComentario">
      <div class="col-xs-2">
        @if (strlen($comentario['img']) > 0)
          <img class="itemBusca-img" src="{{ $comentario['img'] }}" alt="" />
        @else
          <img class="itemBusca-img" src="images/painel/user-image.png" alt="" />
        @endif
      </div>
      <div class="col-xs-10">
        <h5>{{ $comentario['nome'] }}</h5>
        <p>{{ $comentario['comentario'] }}</p>
      </div>
    </div>
  </td>
</tr>
