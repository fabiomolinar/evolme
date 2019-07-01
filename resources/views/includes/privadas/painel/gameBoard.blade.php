<h4 class="painel-sub-titulo">{{ trans('mensagens.evolming-process') }}</h4>
<div class="row" id="gb-row">
  <div class="col-sm-12 col-md-6" id="gb-barra-progresso">
    <div class="">
      <span>{{ trans('mensagens.level') }} 2</span>
      <span>333 {{ trans('mensagens.pontos') }}</span>
    </div>
    <div class="progress">
      <div class="progress-bar" role="progressbar progress-bar-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
        60%
      </div>
    </div>
  </div>
  <div class="col-sm-12 col-md-6" id="gb-conquistas-mini">
    <div class="">
      <span>{{ trans('mensagens.ultimas-conquistas') }}</span>
      <i class="fa fa-plus-square fa-2x" style="color: #FFFFFF;"></i>
      @for($i = 4; $i > 0; $i--)
        <div class="gb-mini-blocos"></div>
      @endfor
    </div>
  </div>
</div>
