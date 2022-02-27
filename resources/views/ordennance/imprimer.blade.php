<!DOCTYPE html>
<html>
<head>
	<title>Ordonnance</title>
		<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="css/styles.css">
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
		ol.c {list-style-type: decimal;}
		.foo{
      position: absolute;
      top: 90%;
      right: 22%;
		}
	</style>
</head>
<body>
<div class="container-fluid">
	@include('partials.etatHeader')
  <h5 class="mt-20 center">
  	<span style="font-size: xx-large;"><strong>Ordonnance</strong></span>
  </h5><br><br>			
	<div class="row">
		<div class="col-sm-12">
			<div class="section">
				<div class="sec-droite"><b><u>Fait le:</u></b> {{ $ordonnance->date }}.</div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-sm-12">
			<div class="section">
				<div class="sec-gauche">
					<b><u>Patient(e) :</u></b> 
					<b>{{ $ordonnance->consultation->patient->getCivilite() }} </b> 
					{{ $ordonnance->consultation->patient->full_name }}	,
					&nbsp;
					{{ $ordonnance->consultation->patient->getAge() }} ans,{{ $ordonnance->consultation->patient->Sexe }}
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-sm-12">
			<div class="section">
				<div class="sec-gauche">
					<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($ordonnance->consultation->patient->IPP, 'C128')}}" alt="barcode" /><br>
					<strong>IPP :</strong>{{ $ordonnance->consultation->patient->IPP }}
        </div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-sm-12"><br>
			<ol class="c">
				@foreach($ordonnance->medicamentes as $index => $med)
				<li>
					{{ $med->Nom_com }} &nbsp;&nbsp; {{ $med->Dosage }}	{{-- $med->Forme --}}
					<h4>{{ $med->pivot->posologie }}</h4>
				</li><br>
				@endforeach
			</ol>
		</div>
	</div>
	<div class="row foo">
    <div class="col-sm-12">
			<div class="section">
				<div class="sec-droite"><span><strong> Docteur :</strong> {{ Auth::user()->employ->full_name }}</span></div>
    	</div>
    </div>
  </div>
</div>
</body>
</html>