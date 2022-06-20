<h3 class="mt-12 center" id="tutelle">{{ $etab->tutelle }}</h3>
<h4 class="center" id="etabname">{{ $etab->nom }}</h4>
<h5 class="center" id="etabAdr">{{ $etab->adresse }}</h5>  
<h5 class="center" id="etabTel">Tél : {{ $etab->tel }}</h5>
<h5 class="mt-10 center" ><img src='{{ asset("img/$etab->logo") }}' style="width: 80px; height: 80px" alt="logo"/></h5>
<hr class="mt-1"/>
<div class="row mt-20"><div class="col-sm-12 center"><h4>LETTRE D'ORIENTATION MEDICALE</h4></div></div>
<div class="space-12"></div><div class="space-12"></div>
<div class="row">
	<div class="col-sm-11"><div class="right">
			<h4><strong><u>Fait le:</u></strong>&nbsp;&nbsp;&nbsp;{{ Carbon\Carbon::today()->format('d/m/Y') }}.</h4>
	</div></div>
</div>
<div class="row ml-4">
	<div class="col-sm-8">
		<div class="sec-gauche">
			<strong>Docteur</strong> :&nbsp;{{ $orient->consultation->medecin->full_name }}&nbsp;&nbsp;&nbsp;&nbsp;
			<strong>Specialité</strong>:&nbsp;
		  <span id="orSpecialite"></span>
		</div>
	</div>
	<div class="col-sm-4"><div class="right"></div></div>
</div>
<div class="row ml-4">
	<div class="col-sm-11">
		<div class="sec-gauche">
			<h4><u>Patient(e):</u></strong>&nbsp;{{ $orient->consultation->patient->getCivilite() }}
        {{ $orient->consultation->patient->full_name }},&nbsp;</strong>{{ $orient->consultation->patient->age }}ans
      </h4>
		</div>
	</div>
</div>
<div class="row ml-4">
	<div class="col-sm-11">
		<div class="sec-gauche">
			<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($orient->consultation->patient->IPP, 'C128') }}" alt="barcode"/>
       <br><span>IPP:{{ $orient->consultation->patient->IPP }}</span>
		</div>   
	</div>
</div><br>
<div class="row ml-4">
	<div class="col-sm-11">
	<p class="espace" style="text-align : justify; letter-spacing: 20 em;">
		Permettez moi de vous adresser le(la) patient(e) sus-nommé(e), {{ $orient->consultation->patient->full_name }} âgé(e) de {{ $orient->consultation->patient->age }} ans,
	</p> 
	@if($orient->consultation->patient->antecedants != null)
	       <p style="text-align : justify; letter-spacing: 20 em;">aux Antcd de 
        	@foreach($orient->consultation->patient->antecedants as $atcd)
        		{{ $atcd->description }},
        	@endforeach
	@endif
	,qui s'est présenté ce jour pour <span id ="motifCons"></span>, et dont l'éxamen général du patient retrouve <span id ="motifO"></span>.Je vous le confie pour une méilleure prise en charge.
	</p>.
	</div>
</div>
<div class="row">
<div class="col-sm-12">
  Je vous le confie pour une meilleur de prise en charge.
</div>  
</div>
<div class="row">
  <div class="col-sm-12"><p class="espace"> <strong>Respectueusement</strong></p></div>
</div>