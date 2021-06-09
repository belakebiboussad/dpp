<!DOCTYPE html>
<html>
	<head>
		<title>CodeBarre</title>
<!-- 		<link rel="stylesheet" href="css/styles.css"> -->
		<link rel="stylesheet" href="css/print.css">
		<style>
			/*@page { size: 100pt 50pt; }*/
			body {
			  font-family: sans-serif;
			  font-size: 10pt;
			  margin: 0px;
			}
		</style>
	</head>
	<body>
		<div class="row">
		  <div class="col-sm-12">
		   	<div class="mt-20">
		   		<small><strong>Nom :</strong> {{ $hosp->patient->Nom }}</small>
		   	</div>	
		   	<div class="mt-20">
		   		<small><strong>Prénom :</strong> {{ $hosp->patient->Prenom }}</small>
		   	</div>
		  </div> 
		</div>
	</body>
</html>