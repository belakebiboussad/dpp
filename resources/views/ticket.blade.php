<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
</head>
<body>
	<h3 style="text-align: center;">HOPITAL CENTRAL DE LA SURETE NATIONAL "LES GLYCINES"</h3>
	<h3 style="text-align: center;">Tél : 23-93-34</h3>
	<div style="text-align: center;">
		<img src="data:image/png;base64,{{DNS2D::getBarcodePNG(App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->code_barre, 'QRCODE')}}" alt="barcode" />
	</div>
	<table width="400">
		<tr>
			<td>
				<strong>Patient :</strong>
				<span>
					{{ App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->Nom }}
					{{ App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->Prenom }}
				</span>
			</td>
			<td>
				<strong>Date :</strong><span>{{ $ticket->date }}</span>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Spécilaité :</strong><span>{{ $ticket->specialite }}</span>
			</td>
			<td>
				<strong style="color: red;">N° Order : {{ $ticket->num_order }}</strong>
			</td>
		</tr>
	</table>
</body>
</html>