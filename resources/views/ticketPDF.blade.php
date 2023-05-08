<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="center mt-50">@include('partials.etatHeader-min')</div>
	<div class="mtp10"><h3 class="center"><u><b>Ticket d'enregistrement</b></u></h3></div> <br><br>
	<table width="100%">
		<tr>
			<td><b> Patient</b> :<span> {{ $ticket->Patient->full_name }} </span></td>
			<td><b>Date</b> :<span>{{ $ticket->date->format('d/m/Y') }}</span></td>
		</tr>
		<tr><td></td></tr><tr><td class="col-md-4">&nbsp;</td></tr>  
		<tr>
			<td><b>Motif</b> :<span> Consultation {{ $ticket->type_consultation }}</span></td>
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td><b>Spécilaité</b> :<span> {{ $ticket->Specialite->nom }}</span></td>
		</tr>
	</table><br>
	<div class="right">
		<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG( $ticket->Patient->IPP, 'C128')}}" alt="barcode"/><br><span>IPP:{{$ticket->Patient->IPP }}</span>
	</div>
</body>
</html>