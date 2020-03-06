<!DOCTYPE html>
<html>
<head>
	<title>Demande examens radiologiques</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
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
	<h3 class="center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h3>
	<h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE</h4>
	<h4 class="center">Chemin des Glycines - ALGER</h4>
	<h4 class="center">Tél : 23-93-34</h4>
	<br><br>
	<div class="center">
		<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($demande->consultation->patient->code_barre, 'C128')}}" alt="barcode" />
	</div>
	<br><br>
	<h4 class="center"><b>Demande examens radiologiques</b></h4>
	<br><br>
	<div class="row">
		<div class="col-sm-12">
			<div class="section">
				<div class="sec-gauche">
					<b><u>Patient :</u></b> 
					{{ $demande->consultation->patient->Nom }} 
					{{ $demande->consultation->patient->Prenom }}
					&nbsp;
					{{ Jenssegers\Date\Date::parse($demande->consultation->patient->Dat_Naissance)->age }} ans
				</div>
				<div class="sec-droite">
					<b><u>Alger le :</u></b> {{ $demande->Date }}.
				</div>
			</div>
		</div>
		<br><br>
		<div class="col-sm-12">
			<label>Informations cliniques pertinentes :</label><br>
			<p style="text-align: justify;">{{ $demande->InfosCliniques }}.</p>
			<label>Explication de la demande de diagnostic :</label><br>
			<p style="text-align: justify;">{{ $demande->Explecations }}.</p>
			<label>Informations supplémentaires pertinentes :</label><br>
            @foreach($demande->infossuppdemande as $index => $info)
            	<span>{{ $info->nom }},&nbsp;</span>
            @endforeach
            <br><br>
            <label>Examen(s) proposé(s) :</label><br>
            @foreach($demande->examensradios as $index => $examen)
            	<span>{{ $examen->nom }},&nbsp;</span>
            @endforeach
            <br><br>
            <label>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic :</label><br>
            @foreach($demande->examensrelatifsdemande as $index => $exm)
            	<span>{{ $exm->nom }},&nbsp;</span>
            @endforeach
		</div>
	</div>
</div>
</body>
</html>