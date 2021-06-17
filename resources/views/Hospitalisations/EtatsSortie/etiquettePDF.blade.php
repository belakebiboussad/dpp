<!DOCTYPE html>
<html>
	<head>
		<title>CodeBarre</title>
	<!-- 	<link rel="stylesheet" href="css/styles.css"> -->
		<link rel="stylesheet" href="css/print.css">
		<style>
			body {
			  font-family: sans-serif;
			  font-size: 10pt;
			  margin: 0px;
			}
			@page {
				size: 2.9cm 4.9cm landscape;
				margin-top: 5px;
				margin-bottom: -0px;
				margin-left: +7px;

			}
			.page-break {
 		   page-break-after: always;
			}
		</style>
	</head>
	<body>
		@for ($i = 0; $i <= 6; $i++)
    <div class="row">
		  <div class="col-sm-12">
		   	<div class="mt-20">
		   		<small><strong>Nom :</strong> {{ $hosp->patient->Nom }}</small>
		   	</div>
		   </div>
		</div>	
		<div class="row">
		 	<div class="col-sm-12">
			<div class="mt-20">
		  	<small><strong>Pré :</strong> {{ $hosp->patient->Prenom }}</small>
		  </div>
		 </div> 
		</div>
		<div class="row">
		  <div class="col-sm-12"><small><strong>DDN :</strong> {{ (\Carbon\Carbon::parse( $hosp->patient->Dat_Naissance))->format('d/m/Y') }}</small></div>
		</div>
		<div class="row">
		  <div class="col-sm-12">
		  	<small><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($hosp->patient->IPP, 'C128')}}" alt="barcode"/></small>
		  	<small>IPP: {{$hosp->patient->IPP}}</small>
		  </div>
		</div>
		@if($i != 6)
			<div class="page-break"></div>
		@endif	
	@endfor
	</body>
</html>