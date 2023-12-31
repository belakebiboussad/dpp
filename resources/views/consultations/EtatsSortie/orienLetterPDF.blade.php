<div class="center mtP40 ft20">LETTRE D'ORIENTATION MEDICALE</div>
<div class="ml-46 mtp20"><b>Alger le</b> : {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div><br/><br/>
<div class="ml-06"><span> <b>Docteur</b> : {{ Auth::user()->employ->full_name}}</span>
<span> <b>Specialité</b> : {{ $specialite->nom}}</span></div>
<div class="ml-06">
<b>Patient(e)</b> : {{ $obj->patient->getCivilite() }}{{ $obj->patient->full_name }}, {{ $obj->patient->age }}ans
</div>
<div class="ml-06"><canvas id="barcode"></canvas></div>
<div class="ml-4"><h5 class="mte7"> Cher confrère,</h5></div>
<div class="ml-4 ">
  <p class="espace mtp33">
      Permettez moi de vous adresser le(la) patient(e) sus-nommé(e), {{ $obj->patient->full_name }}
        âgé(e) de {{ $obj->patient->age }} ans,
    </p>
    @if($obj->patient->antecedants->count() > 0 )
    <p class="pageCenter">
    aux Antcd de 
      @foreach($obj->patient->antecedants as $atcd)
        {{ $atcd->description }},
      @endforeach
    @endif
    qui s'est présenté ce jour pour <span id ="motifCons"></span>,
    et dont l'éxamen général du patient retrouve <span id ="motifO"></span>
  </p>
</div>
<div><b>Je vous le confie pour une meilleur de prise en charge.</b></div>  