<div class="textCenter mtP40 ft16" >
  <b>LETTRE D'ORIENTATION MEDICALE</b>
</div>
<div class="tab-space40 mtp10"><b>Alger le :</b> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div><br/><br/>
<div class="row ml-4">
  <div class="col-sm-11">
    <div class="sec-gauche">
      <b><u>Docteur:</u></b>&nbsp;{{ $employe->full_name}}
      <b class="espace">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Specialité</b>:&nbsp;{{ $specialite->nom}}
    </div>
  </div>
</div>
<div class="row ml-4">
  <div class="col-sm-11">
    <div class="sec-gauche">
      <b><u>Patient(e):</u></b>&nbsp;{{ $patient->getCivilite() }}{{ $patient->full_name }},&nbsp;</b>{{ $patient->age }}ans
    </div>
  </div>
</div>
<div class="ml-06"><canvas id="barcode"></canvas></div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="row ml-4">
  <div class="col-sm-11">
    <div class="sec-gauche">Cher confrére
    </div>
  </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="row ml-4">
  <div class="col-sm-11">
    <p class="espace">
      Permettez moi de vous adresser le(la) patient(e) sus-nommé(e), {{ $patient->full_name }}
         âgé(e) de {{ $patient->age }} ans,
    </p>
    @if($patient->antecedants->count() > 0 )
    <p class="pageCenter">
    aux Antcd de 
      @foreach($patient->antecedants as $atcd)
        {{ $atcd->description }},
      @endforeach
    @endif
    qui s'est présenté ce jour pour <span id ="motifCons"></span>,
    , et dont l'éxamen général du patient retrouve <span id ="motifO"></span>
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">Je vous le confie pour une meilleur de prise en charge.</div>  
</div>
