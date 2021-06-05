<html>
	<head>
		<meta charset="utf-8">
		<title>Ordonnance-{{ $patient->Nom }}-{{ $patient->Prenom }}</title>
		<link rel="stylesheet" href="{{ asset('/css/styles.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/print.css') }}"  />	
		<style>
  	
   		</style>
	</head>
	<body>
  	<div class="container-fluid" >
  		<h5 class="mt-12 center">{{ $etablissement->tutelle }}</h5>
      		<h5 class="center">{{ $etablissement->nom }}</h5>
		<h6 class="center">{{ $etablissement->adresse }}</h6>
		<h6 class="center">Tél : {{ $etablissement->tel }}</h6>
		<h5 class="mt-10 center" ><img src='{{ asset("img/$etablissement->logo") }}' style="width: 80px; height: 80px" alt="logo"/></h5>
		 	<h6 class="mt-20 center"><span style="font-size: xx-large;"><strong>Ordonnance</strong></span></h6>
  		<div class="row">
				<div class="col-sm-12">
					<div class="sec-droite">
						<h4><strong><u>Fait le:</u></strong>{{ Carbon\Carbon::today()->format('d/m/Y') }}.</h4>
					</div>
				</div>
				</div>
			</div>
			<div class="row ml-4">
				<div class="col-sm-12">
					<div class="sec-gauche">
						<h4><u>Patient(e) :</u></strong>{{ $patient->getCivilite() }}{{ $patient->Nom }}  {{ $patient->Prenom }},&nbsp;</strong>{{ $patient->getAge() }} ans,{{ $patient->Sexe }}</h4>
					</div>
				</div>
			</div><br>
			<div class="row ml-4">
				<div class="col-sm-12">
					<div class="sec-gauche"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode"/><h6>IPP :{{ $patient->IPP }}</h6></div>   
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-sm-12"><br>
					<ol class="c">
						@for ($i = 0; $i < count($medicaments); $i++)
						<li>
						 <h4>	{{ $medicaments[$i]->Nom_com }} {{ $medicaments[$i]->Forme }} &nbsp;&nbsp; {{ $medicaments[$i]->Dosage }}</h4> {{-- $med->Forme --}}
						 <h5>{{ $posologies[$i] }}</h5>
						</li><br><br>	
						@endfor
					</ol>
				</div>
			</div>
			<div class="row foo">
		    	<div class="col-sm-12"><div class="sec-droite"><span><strong> Docteur :</strong> {{ $employe->nom}} {{ $employe->prenom}}</span></div></div>
		  </div>		
    </div>
	</body>
</html>