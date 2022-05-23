<h3 class="mt-12 center" id="tutelle">{{ $etablissement->tutelle }}</h3>
<h4 class="center" id="etabname">{{ $etablissement->nom }}</h4>
<h5 class="center" id="etabAdr">{{ $etablissement->adresse }}</h5>  
<h5 class="center" id="etabTel">Tél : {{ $etablissement->tel }}</h5>
<h5 class="mt-10 center" ><img src='{{ asset("img/$etablissement->logo") }}' style="width: 80px; height: 80px" alt="logo"/></h5>
<hr class="mt-1"/>
<div class="row mt-20"><div class="col-sm-12 center"><h4>LETTRE D'ORIENTATION MEDICALE</h4></div></div>
<div class="space-12"></div><div class="space-12"></div>
<div class="row">
	<div class="col-sm-11"><div class="sec-droite">
			<h4><strong><u>Fait le:</u></strong>&nbsp;&nbsp;&nbsp;{{ Carbon\Carbon::today()->format('d/m/Y') }}.</h4>
	</div></div>
</div>
<div class="row ml-4">
	<div class="col-sm-8">
		<div class="sec-gauche">
			<strong>Docteur</strong> :&nbsp;{{ $employe->full_name}}&nbsp;&nbsp;&nbsp;&nbsp;
			<strong>Specialité</strong>:&nbsp;
		  <span id="orSpecialite"></span>
		</div>
	</div>
	<div class="col-sm-4"><div class="sec-droite"></div></div>
</div>
<div class="row ml-4">
	<div class="col-sm-11">
		<div class="sec-gauche">
			<h4><u>Patient(e):</u></strong>&nbsp;{{ $patient->getCivilite() }}{{ $patient->full_name }},&nbsp;</strong>{{ $patient->age }}ans</h4>
		</div>
	</div>
</div>
<div class="row ml-4">
	<div class="col-sm-11">
		<div class="sec-gauche">
			<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($patient->IPP, 'C128') }}" alt="barcode"/><h6>IPP :{{ $patient->IPP }}</h6>
		</div>   
	</div>
</div><br>
<div class="row ml-4">
	<div class="col-sm-11">
	<p class="espace" style="text-align : justify; letter-spacing: 20 em;">
		Permettez moi de vous adresser le(la) patient(e) sus-nommé(e), {{ $patient->full_name }} âgé(e) de {{ $patient->age }} ans,
	</p> 
	@if($patient->antecedants != null)
	       <p style="text-align : justify; letter-spacing: 20 em;">aux Antcd de 
        	@foreach($patient->antecedants as $atcd)
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