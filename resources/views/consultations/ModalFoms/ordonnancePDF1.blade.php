<html>
	<head>
		<meta charset="utf-8">
		<title>Ordonnance-{{ $patient->Nom }}-{{ $patient->Prenom }}</title>
		<link rel="stylesheet" href="{{ asset('/css/styles.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/print.css') }}"/>
		<style>
		 .foo4 { position: absolute; top: 93.%;}
			.allButFooter {
			    min-height: calc(100vh - 40px);
			}
		</style>	
	</head>
	<body>
  	<div class="container-fluid">
			<div class="row"><div class="col-sm-12 center"><img src='{{ asset("img/entete.png") }}' alt="Entete"/></div></div>
			<div class="pull-right"><strong>Alger le :</strong>&nbsp;{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
			<br><br> 
			<div class="row">
				<div class="col-sm-6">
					<strong>Médecin prescripteur :</strong> 
					{{ $employe->nom}} {{ $employe->prenom}}
				</div>
			</div>	
			<div class="row">
				<div class="col-sm-12">
					<span><strong>Patient(e) :</strong></span>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 tab-space">
					<h6>
						<strong>Nom :&nbsp;</strong><span>{{ $patient->Nom }}</span>
						<strong>Prenom :&nbsp;</strong><span>{{ $patient->Prenom }}</span>
						<strong>Né(e) le :&nbsp;</strong><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</span>
					</h6>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 tab-space">
					<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode"/><br>
					IPP :{{ $patient->IPP }}
				</div>
			</div>
			<div class="row">
				<h6 class="mt-20 center"><span style="font-size: xx-large;"><strong>Ordonnance</strong></span></h6>
			</div>
			<br><br>
			<div class="row">
				<div class="col-sm-12"><br>
					<ol class="c">
						@foreach($medicaments as $i => $value)
							<li>
								<h4>{{ $medicaments[$i]->Nom_com }} {{ $medicaments[$i]->Forme }} &nbsp;&nbsp; {{ $medicaments[$i]->Dosage }}</h4>
								<h5>{{ $posologies[$i] }}</h5>
							</li>
						@endforeach
					</ol>
				</div>
			</div>
			<div class="row foot4">
				<img src='{{ asset("img/footer.png") }}' alt="footer"/>
			</div>
		</div><!-- fluid -->
	</body>
</html>