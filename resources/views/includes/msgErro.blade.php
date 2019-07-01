@if (count($errors) > 0) {{-- Div de erros --}}
  <div class="alert alert-danger" id="errosBack">
    <strong>{{ trans('mensagens.opa-algo-deu-errado')}}</strong>
    <br>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<div class="alert alert-danger" style="display:none" id="errosAjax">
  <strong>{{ trans('mensagens.opa-algo-deu-errado')}}</strong>
  <br>
  <p></p>
</div>
