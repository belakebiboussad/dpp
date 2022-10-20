<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div class="row"><div class="col-sm-12">@include('partials.etatHeader-min')</div></div>
	<div class="row" style="margin-top:20px;">
		<h3 style="text-align:center;"><u><b>Ticket d'enregistrement</b></u></h3>
	</div>
	<br><br>
	<table width="100%">
		<tr>
			<td class="col-md-4">	<b> Patient :</b><span>{{ $ticket->Patient->full_name }} </span></td>
			<td class="col-md-4"><b>Date :</b><span>&nbsp;{{ (\Carbon\Carbon::parse($ticket->date))->format('d/m/Y') }}</span></td>
		</tr>
		<tr><td class="col-md-4"></td></tr>
		<tr><td class="col-md-4">&nbsp;</td></tr>	
		<tr>
			<td class="col-md-4"><b>Motif :</b><span>&nbsp;Consultation &nbsp;{{ $ticket->type_consultation }}</span></td>
		</tr>
		<tr><td class="col-md-4">&nbsp;</td></tr>
		<tr>
			<td class="col-md-4"><b>Spécilaité :</b><span>&nbsp;{{ $ticket->Specialite->nom }}</span></td>
		</tr>
	</table><br>
	<div class="right">
		<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG( $ticket->Patient->IPP, 'C128')}}" alt="barcode"/>
	<br><span>IPP:{{$ticket->Patient->IPP }}</span>
	</div>
</body>
</html>