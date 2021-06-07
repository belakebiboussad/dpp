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
</style>
</head>
<body>
	{{--   <h6 class="mt-15" style="text-align:center;">{{ $etablissement->nom }}</h6><h6 style="text-align:center;">Tél : {{ $etablissement->tel }}</h6>
		<h6 style="text-align:center;"><img src="img/{{ $etablissement->logo }}" alt="logo" style="width: 60px; height: 60px"/></h6>--}}
	<div class="row"><div class="col-sm-12">@include('partials.etatHeader-min')</div></div>
	<br>
	<div class="row">
		<h3 style="text-align:center;"><u><strong>Ticket d'enregistrement</strong></u></h3>
	</div>
	<br>
	<table width="100%">
		<tr>
			<td class="col-md-4">
				<strong>Patient :</strong>
				<span>{{ $ticket->Patient->Nom }} {{ $ticket->Patient->Prenom }}</span>
			</td>
			<td class="col-md-8" rowspan="4">N° : <div class="numberCircle">{{ $ticket->num_order }}</div></td>
		<tr>
			<td class="col-md-4"><strong>Date :</strong><span>{{ $ticket->date }}</span></td>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Motif :</strong><span> consultatin &nsp;{{ $ticket->type_consultation }}</span></td>
		</tr>
		<tr>
			<td class="col-md-4"><strong>Spécilaité :</strong><span>{{ $ticket->Specialite->nom }}</span></td>
		</tr>
	</table>
	<br>
	<div style="text-align: center;">
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($ticket->Patient->code_barre, 'C128',3,33)}}" alt="barcode" />
		<br><span> {{$ticket->Patient->IPP }}</span>
	</div>
</body>
</html>