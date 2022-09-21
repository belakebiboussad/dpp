@extends('app')
@section('style')
<style type="text/css" media="screen">
  .widget {
    background: #ffffff;
    border: 1px solid transparent;
    border-radius: 2px;
    -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
    border-color: #e9e9e9;
  }
  .widget .widget-body {
    padding: 20px;
  }
  .pull-left {
    float: left!important;
  }
</style>
@endsection
@section('main-content')
<div class="row">
  <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
          <div class="widget-icon pull-left">
              <i class="ace-icon fa fa-user-md bigger-180"></i>
          </div>
          <div class="widget-content pull-left">
              <div class="title">&nbsp;{{ $medsCount }}</div>
              <div class="comment">Medecins</div>
          </div>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="widget-icon  pull-left">
                       <i class="fa fa-users bigger-180"></i>
                    </div>
                    <div class="widget-content pull-left">
                        <div class="title">&nbsp;{{ $infsCount  }}</div>
                        <div class="comment">Infirmiers</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="widget">
                <div class="widget-body">
                    <div class="widget-icon green pull-left">
                      <i class="fa fa-cogs bigger-180"></i>
                    </div>
                    <div class="widget-content pull-left">
                        <div class="title">&nbsp; {{ $hospCount }}</div>
                        <div class="comment">Hospitalisation En cours</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
          <div class="widget">
            <div class="widget-body">
              <div class="widget-icon blue pull-left">
                  <i class="fa fa-spinner bigger-180"></i>
              </div>
              <div class="widget-content pull-left">
                <div class="title">&nbsp;{{ $nbRequest}}</div>
                <div class="comment">Hospitalisation En attente</div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
    </div><div class="space-12"></div>
    <div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
          <div class="widget-icon pull-left">
            <i class="ace-icon fa fa-clock-o bigger-180"></i>
          </div>
          <div class="widget-content pull-left">
              <div class="title">&nbsp;{{ $nbrdvs }}</div>
              <div class="comment">Rendez-vous d'hospitalisation</div>
          </div>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
    <div class="widget">
      <div class="widget-body">
          <div class="widget-icon pull-left">
           <i class="fa fa-bed fa-1x bigger-180"></i>
          </div>
          <div class="widget-content pull-left">
              <div class="title">&nbsp;{{ $nbFreeBed }}</div>
              <div class="comment">Lit libre</div>
          </div>
          <div class="clearfix"></div>
      </div>
    </div>
    </div>
  </div><div class="space-12"></div>
  <div class="row">
    <div class="col-lg-6">
      <div class="widget">
        <div class="widget-title">
          <i class="fa fa-cloud-download"></i>Nombre de consultattions
          <a class="pull-right" href="/stats/view">Plus de statistiques</a>
          <div class="clearfix"></div>
        </div>
        <div class="widget-body medium no-padding">
          <div id="bandwidthChart" class="morrisChart" style="width: 99%; height: 230px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
          <!-- <svg height="230" version="1.1" width="618" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">
            <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with</desc>
            <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
            <text x="18.90000009536743" y="191.39999961853027" text-anchor="end" font="10px &quot;Arial&quot;"  stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" 
            >
            <tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,191.39999961853027H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="18.90000009536743" y="149.7999997138977" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.399993419647217" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,149.7999997138977H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="18.90000009536743" y="108.19999980926514" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.399999618530273" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">4</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,108.19999980926514H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="18.90000009536743" y="66.59999990463257" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.399998188018799" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">6</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,66.59999990463257H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="18.90000009536743" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.399999618530273" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">8</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,25H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="569.6000000039736" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">septembre</tspan></text><text x="476.0000000198682" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">juillet</tspan></text><text x="382.4000000357628" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">mai</tspan></text><text x="288.8000000516574" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">mars</tspan></text><text x="195.20000006755194" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">janvier</tspan></text><text x="101.6000000834465" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">novembre</tspan></text><rect x="37.250000094374016" y="179.54399964571" width="35.099999994039536" height="11.855999972820285" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="84.05000008642672" y="181.41599964141847" width="35.099999994039536" height="9.983999977111807" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="130.85000007847944" y="176.83999965190887" width="35.099999994039536" height="14.559999966621405" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="177.65000007053217" y="153.95999970436097" width="35.099999994039536" height="37.439999914169306" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="224.45000006258488" y="103.83199981927872" width="35.099999994039536" height="87.56799979925155" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="271.25000005463755" y="78.87199987649917" width="35.099999994039536" height="112.5279997420311" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="318.0500000466903" y="74.9199998855591" width="35.099999994039536" height="116.47999973297118" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="364.85000003874296" y="55.78399992942812" width="35.099999994039536" height="135.61599968910215" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="411.6500000307957" y="76.16799988269806" width="35.099999994039536" height="115.23199973583222" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="458.4500000228484" y="88.855999853611" width="35.099999994039536" height="102.54399976491928" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="505.2500000149011" y="152.29599970817566" width="35.099999994039536" height="39.10399991035462" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="552.0500000069538" y="69.51199989795684" width="35.099999994039536" height="121.88799972057343" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
          </svg> -->
          <canvas id = "Conscanvas" height = "280" width = "99%"</canvas>
          <div class="morris-hover morris-default-style" style="left: 111.4px; top: 86px;">
            <div class="morris-hover-row-label">décembre</div>
              <div class="morris-hover-point" style="color: #0b62a4">Valeur:0.7</div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <div class="col-lg-6">
      <div class="widget">
        <div class="widget-title">
          <i class="fa fa-cloud-download"></i>Nombre d'hospitalisation
          <a class="pull-right" href="/stats/view">Plus de statistiques</a>
          <div class="clearfix"></div>
        </div>
        <div class="widget-body medium no-padding">
          <div id="bandwidthChart" class="morrisChart" style="width: 99%; height: 230px; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
            <svg height="230" version="1.1" width="618" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">
            <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with</desc>
            <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
            <text x="18.90000009536743" y="191.39999961853027" text-anchor="end" font="10px &quot;Arial&quot;"  stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" 
            >
            <tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,191.39999961853027H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="18.90000009536743" y="149.7999997138977" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.399993419647217" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,149.7999997138977H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="18.90000009536743" y="108.19999980926514" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.399999618530273" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">4</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,108.19999980926514H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="18.90000009536743" y="66.59999990463257" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.399998188018799" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">6</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,66.59999990463257H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="18.90000009536743" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.399999618530273" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">8</tspan></text><path fill="none" stroke="#aaaaaa" d="M31.40000009536743,25H593" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="569.6000000039736" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">septembre</tspan></text><text x="476.0000000198682" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">juillet</tspan></text><text x="382.4000000357628" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">mai</tspan></text><text x="288.8000000516574" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">mars</tspan></text><text x="195.20000006755194" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">janvier</tspan></text><text x="101.6000000834465" y="203.89999961853027" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,6.8)"><tspan dy="4.400002479553223" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">novembre</tspan></text><rect x="37.250000094374016" y="179.54399964571" width="35.099999994039536" height="11.855999972820285" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="84.05000008642672" y="181.41599964141847" width="35.099999994039536" height="9.983999977111807" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="130.85000007847944" y="176.83999965190887" width="35.099999994039536" height="14.559999966621405" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="177.65000007053217" y="153.95999970436097" width="35.099999994039536" height="37.439999914169306" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="224.45000006258488" y="103.83199981927872" width="35.099999994039536" height="87.56799979925155" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="271.25000005463755" y="78.87199987649917" width="35.099999994039536" height="112.5279997420311" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="318.0500000466903" y="74.9199998855591" width="35.099999994039536" height="116.47999973297118" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="364.85000003874296" y="55.78399992942812" width="35.099999994039536" height="135.61599968910215" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="411.6500000307957" y="76.16799988269806" width="35.099999994039536" height="115.23199973583222" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="458.4500000228484" y="88.855999853611" width="35.099999994039536" height="102.54399976491928" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="505.2500000149011" y="152.29599970817566" width="35.099999994039536" height="39.10399991035462" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="552.0500000069538" y="69.51199989795684" width="35.099999994039536" height="121.88799972057343" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
          </svg> 
          <!-- <canvas id = "Hospcanvas" height = "280" width = "99%"</canvas> -->
          <div class="morris-hover morris-default-style" style="left: 111.4px; top: 86px;">
            <div class="morris-hover-row-label">décembre</div>
              <div class="morris-hover-point" style="color: #0b62a4">Valeur:</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('page-script')
<script type="text/javascript">
  var barConsultstData = {
        labels:      serv,serv,
        datasets: [{
            label: 'nombre de consultations par service',
            backgroundColor: "pink",
            data: nbcons
        }]
  };
$(function(){
   var ctxXX = document.getElementById("Conscanvas").getContext("2d");
    window.myBar = new Chart(ctxXX, {
        type: 'bar',
        data: barConsultstData,
    });
})
</script>
@endsection