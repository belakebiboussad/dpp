<html>
	<head>
		<meta charset="utf-8">
		<title>Ordonnance</title>
		<link rel="stylesheet" href="{{ asset('/css/styles.css') }}"/>
		<style>
  		@media print {
		      .print {display:block}
		      .btn-print {display:none;}
	 	 }
   	</style>
	</head>
	<body>
  	<div class="container-fluid" >
  		<h4 class="mt-12 center">{{ $etablissement->tutelle }}</h4>
      <h4 class="center">{{ $etablissement->nom }}</h4>
			<h5 class="center">{{ $etablissement->adresse }}</h5>
			<h5 class="center">Tél : {{ $etablissement->tel }}</h5>
			<h5 class="mt-10 center" >
				<img src='{{ asset("img/$etablissement->logo") }}' style="width: 80px; height: 80px" alt="logo"/>
				{{-- <img src="img/{{ $etablissement->logo }}" alt="logo" style="width: 80px; height: 80px"/> --}}
			</h5>
		 	<h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Ordonnance</strong></span></h5>
  		<div class="row">
			<div class="col-sm-12"><div class="section"><div class="ml-80"><b><u>Fait le:</u></b> {{ Carbon\Carbon::today()->format('Y-m-d') }}.</div></div></div>
			</div>
			<div class="row ml-4">
				<div class="col-sm-12">
					<div class="section">
						<div class="sec-gauche">
							<b><u>Patient(e) :</u></b><b>	{{ $patient->getCivilite() }}</b>{{ $patient->Nom }}	{{ $patient->Prenom }},&nbsp;  
							{{ $patient->getAge() }} ans,{{ $patient->Sexe }}
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row ml-4">
				<div class="col-sm-12">
					<div class="section">
						<div class="sec-gauche"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode"/><br> {{ $patient->IPP }}</div>   
					</div>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-sm-12"><br>
					<ol>
						@for ($i = 0; $i < count($medicaments); $i++)
						<li>{{ $medicaments[$i]->Nom_com }} {{ $medicaments[$i]->Forme }} {{ $medicaments[$i]->Dosage }} <br>{{ $posologies[$i] }}.</li><br><br>	
						@endfor
					</ol>
				</div>
			</div>
			<div class="row foo">
		    <div class="col-sm-12"><div class="section"><div class="sec-droite"><span><strong> Docteur :</strong> {{ $employe->nom}} {{ $employe->prenom}}</span></div></div></div>
		  </div>		
    </div>
	</body>
</html>