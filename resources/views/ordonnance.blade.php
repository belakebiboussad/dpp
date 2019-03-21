<!DOCTYPE html>
<html>
<head>
	<title>Ordonnance</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		table 
		{
    		border-collapse: collapse;
		}
		table, th, td 
		{
    		border: 1px solid black;
    		padding: 5px;
		}
		.section
		{
			margin-bottom: 20px;
		}
		.sec-gauche
		{
			float: left;
		}
		.sec-droite
		{
			float: right;
		}
		.center
		{
			text-align: center;
		}
		.col-sm-12
		{
			margin-bottom: 10px;
		}
	</style>
</head>
<body>
<div class="container-fluid">
	<h3 class="center">Direction Générale de la Sûreté Nationale</h3>
	<h4 class="center">HOPITAL CENTRAL DE LA SURETE NATIONAL "LES GLYCINES"</h4>
	<h4 class="center">Tél : 23-93-34</h4>
	<br><br>
	<div class="center">
		{{-- <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($ordonnance->consultation->patient->code_barre, 'C128')}}" alt="barcode" /> --}}
	</div>
	<br><br>
	<h4 class="center"><b>Ordonnance</b></h4>
	<br><br>
	<div class="row">
		<div class="col-sm-12">
			<div class="section">
				<div class="sec-gauche">
					<b><u>Patient :</u></b> 
					{{ $ordonnance->consultation->patient->Nom }} 
					{{ $ordonnance->consultation->patient->Prenom }}
					&nbsp;
					{{ Jenssegers\Date\Date::parse($ordonnance->consultation->patient->Dat_Naissance)->age }} ans
				</div>
				<div class="sec-droite">
					<b><u>Alger le :</u></b> {{ $ordonnance->date }}.
				</div>
			</div>
		</div>
	</div>
	<div class="space-12"></div>			
	<div class="row">		 
	 	<div class="col-sm-12">
			<br>
			<ol>
				@foreach($ordonnance->medicamentes as $index => $med)
					<li>
						{{ $med->Nom_com }} {{ $med->Dosage }} {{ $med->Forme }}&nbsp;&nbsp; 
						{{ $med->pivot->posologie }}.
					</li>
					<br><br>
				@endforeach
			</ol>
		</div>
	</div> 
</div>
</body>
</html>