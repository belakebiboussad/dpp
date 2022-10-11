<h3 class="mt-12 center" id="tutelle">{{ $etab->tutelle }}</h3>
<h4 class="center" id="etabname">{{ $etab->nom }}</h4>
<h5 class="center" id="etabAdr">{{ $etab->adresse }}</h5>  
<h5 class="center" id="etabTel">Tél : {{ $etab->tel }}- {{ $etab->tel2 }}</h5>
<h5 class="mt-10 center" ><img src="img/{{ $etab->logo }}" alt="logo" style="width: 80px; height: 80px"/></h5>
<hr class="mt-10"/>
  <div class="row mt-30"><div class="col-sm-12 center"><h3>Compte rendu radiologique</h3></div></div>
  <br><br>
  <div class="row">
    <div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right" hidden><b><span style="font-size:20px;"></span></b>
   </div>
  </div><div class="space-12"></div>
  <div class="row"><div class="col-xs-12"><p id="conclusionPDF" style="font-size:16px;">
    @isset($crr)
      {{ $crr->conclusion }}
      @endisset
  </p></div>
  </div>