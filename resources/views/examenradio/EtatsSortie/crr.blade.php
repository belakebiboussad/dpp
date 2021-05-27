  <h3 class="mt-12 center">{{ Session::get('etabTut') }}</h3>
  <h4 class="center">{{ Session::get('etabname') }}</h4>
  <h5 class="center">{{ Session::get('etabAdr') }}</h5>  
  <h5 class="center">Tél : {{ Session::get('etabTel') }} - {{ Session::get('etabTel2') }}</h5>
  {{-- <h5 class="mt-10 center"><img src="/img/{{ Session::get('etabLogo') }}" style="width: 120px; height:70px"/></h5> --}}
  <h5 class="mt-10 center"><img src="{{  url('/img/'.Session::get('etabLogo')) }}" alt="logo" width="100" height="100"/></h5>
  <hr class="mt-10"/>
  <div class="row mt-30"><div class="col-sm-12 center"><h3>Compte Rendu Radiologique</h3></div></div>
   <div class="space-12"></div> <div class="space-12"></div>
  <div class="row">
    <div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:20px;">Indication</span></strong>
   </div>
  </div><div class="space-12"></div>
  <div class="row"><div class="col-xs-12"><p id="indicationPDF" style="font-size:16px;">
    @isset($crr)
      {{ $crr->indication }}
    @endisset
  </p></div>
  </div>
  <div class="space-12"></div>
   <div class="row">
    <div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><strong><span style="font-size:20px;">Technique de réaliation</span></strong>
   </div>
  </div><div class="space-12"></div>
  <div class="row"><div class="col-xs-12">
    <p id="techReaPDF" style="font-size:16px;">
      @isset($crr)
      {{ $crr->techRea }}
      @endisset
    </p>
  </div>
  </div>
   <div class="space-12"></div>
   <div class="row">
    <div class="col-xs-11 label label-lg label-default arrowed-in arrowed-right"><strong><span style="font-size:20px;">Resultat</span></strong>
   </div>
  </div><div class="space-12"></div>
  <div class="row">
    <div class="col-xs-12"><p id="resultPDF" style="font-size:16px;">
     @isset($crr)
      {{ $crr->result }}
      @endisset
    </p></div>
  </div>
  <div class="row">
    <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><strong><span style="font-size:20px;">Synthèse Conclusion</span></strong>
   </div>
  </div><div class="space-12"></div>
  <div class="row"> <div class="col-xs-12"><p id="conclusionPDF" style="font-size:16px;">
    @isset($crr)
      {{ $crr->conclusion }}
      @endisset
  </p></div>
  </div>
 