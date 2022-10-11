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
				size: 30mm 62mm landscape;
				margin-top: 2.5px;
				margin-bottom: 0px;
				margin-left: +20px;
			}
			.page-break {
 		   page-break-after: always;
			}
			div{
			  line-height: 1;
			}
		</style>
	</head>
	<body>
		<div><small><b>Nom :</b> {{ $hosp->patient->Nom }}</small></div>	
		<div>	<small><b>Prénom :</b> {{ $hosp->patient->Prenom }}</small></div>
		<div>
		  <small><b>DDN :</b> {{ (\Carbon\Carbon::parse( $hosp->patient->Dat_Naissance))->format('d/m/Y') }}</small>
		</div>
		<hr style="visibility: hidden;">
		  <div>
		  	<small><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($hosp->patient->IPP, 'C128')}}" alt="barcode"/></small>
		  	<small>IPP: {{$hosp->patient->IPP}}</small>
		  </div>
	</body>
</html>