<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
	 <style>
    @page { size: 10cm 20cm landscape; }
  </style>
</head>
<body>
<br><br>
	<h5 style="text-align:center;">HOPITAL CENTRAL DE LA SURETE NATIONAL "LES GLYCINES"</h5>
	<h5 style="text-align:center;">Tél : 23-93-34</h5>
	<table width="100%">
		<tr>
			<td class="col-md-6">
				<strong>Patient :</strong>
				<span>
					{{ App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->Nom }}
					{{ App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->Prenom }}
				</span>
			</td>
			<td class="col-md-6">
				<strong>Date :</strong><span>{{ $ticket->date }}</span>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Spécilaité :</strong><span>{{ $ticket->specialite }}</span>
			</td>
			<td>
				<strong>N° Order : {{ $ticket->num_order }}</strong>
			</td>
		</tr>
	</table>
	<br><br>
	<div style="text-align: center;">
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG(App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->code_barre, 'C128')}}" alt="barcode" />
	</div>
</body>
</html>