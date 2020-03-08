<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
	<link  rel="stylesheet" href="{{ asset('/css/styles.css') }}">
<style>
	.numberCircle {
    width: 45px;
    line-height: 45px;
    border-radius: 50%;
    text-align: center;
    font-size: 40px;
    border: 2px solid #666;
	}
</style>
</head>
<body>
  <br><br>
	<h5 style="text-align:center;">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h5>
	<h6 style="text-align:center; mt-10">Tél : 23-93-34</h5>
	<table width="100%">
		<tr>
			<td class="col-md-4">
				<strong>Patient :</strong>
				<span>
				  {{ $ticket->Patient->Nom }} {{ $ticket->Patient->Prenom }}
				</span>
			</td>
			<td class="col-md-8" rowspan="3">
				N° : <div class="numberCircle">{{ $ticket->num_order }}</div> 
			</td>
		<tr>
			<td class="col-md-4">
				<strong>Date :</strong>
				<span>{{ $ticket->date }}</span>
			</td>
		</tr>
		<tr>
			<td class="col-md-4">
				<strong>Spécilaité :</strong>
				<span>{{ $ticket->Specialite->nom }}</span>
			</td>
			
		</tr>
	</table>
	<br>
	<div style="text-align: center;">
<!-- <img src="data:image/png;base64,{{DNS1D::getBarcodePNG(App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->code_barre, 'C128',3,33)}}" alt="barcode" /> -->
	  <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($ticket->Patient->code_barre, 'C128')}}" alt="barcode" />
	  <br>
	  <span> {{$ticket->Patient->code_barre }}</span> 
	</div>
</body>
</html>