<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
	<link rel="stylesheet" href="css/styles.css">
<style>
	.numberCircle {
    width: 45px;
    line-height: 45px;
    border-radius: 50%;
    text-align: center;
    font-size: 40px;
    border: 2px solid #666;
	}
/*	.mt-10{margin-top:-10px;}*/
</style>
</head>
<body>
  <!-- <br><br> -->
	<h6 style="text-align:center;mt-12">{{ $etablissement->nom }}</h6>
	<h6 style="text-align:center; mt-30">Tél : {{ $etablissement->tel }}</h6>
	<br><br>
	<table width="100%">
		<tr>
			<td class="col-md-4">
				<strong>Patient :</strong>
				<span>{{ $ticket->Patient->Nom }} {{ $ticket->Patient->Prenom }}</span>
			</td>
			<td class="col-md-8" rowspan="3">N° : <div class="numberCircle">{{ $ticket->num_order }}</div></td>
		<tr>
			<td class="col-md-4"><strong>Date :</strong><span>{{ $ticket->date }}</span></td>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Spécilaité :</strong><span>{{ $ticket->Specialite->nom }}</span></td>
		</tr>
	</table>
	<br>
	<div style="text-align: center;">
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($ticket->Patient->code_barre, 'C128',3,33)}}" alt="barcode" />
		<br><span> {{$ticket->Patient->IPP }}</span><!-- <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($ticket->Patient->code_barre, 'C128')}}" alt="barcode" /> -->
	</div>
</body>
</html>