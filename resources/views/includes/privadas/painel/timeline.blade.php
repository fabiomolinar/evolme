<h4 class="painel-sub-titulo">{{ trans('mensagens.atividades-recentes') }}</h4>
<div class="row">
  @for ($i = 0; $i < 10; $i++)
  <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
    <div class="timeline-info">
      <div class="timeline-info-data">
        <span>13/10/1989</span>
        <span>12:00</span>
      </div>
      <div class="timeline-info-img">
        <img src="images/painel/user-image.png" alt="" />
      </div>
      <div class="timeline-info-texto">
        <p>Aqui virá uma descrição de qual é a novidade na timeline! Uhuuul!</p>
      </div>
    </div>
  </div>
  @endfor
</div>
