<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
	 <style>
    @page { size: 10cm 20cm landscape; }
  </style>
</head>
<body>
<!-- style="text-align:center;" -->
	<h6>HOPITAL CENTRAL DE LA SURETE NATIONAL "LES GLYCINES" <small>Tél : 23-93-34</small></h6> 
	<table width="100%">
		<tr>
			<td class="col-md-12">
				<strong>Patient :</strong>
				<span>
					{{ App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->Nom }}
					{{ App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->Prenom }}
				</span>
			</td>
			<tr>
				<td class="col-md-12">
					<strong>Date :</strong><span>{{ $ticket->date }}</span>
				</td>
			</tr>
		</tr>
	  <tr>
			<td>
				<strong>Spécilaité :</strong><span>{{ $ticket->specialite }}</span>
			</td>
		</tr>
		<tr>
			<td>
				<strong>N° Order : {{ $ticket->num_order }}</strong>
			</td>
		</tr>
	</table>
	 <!-- style="text-align: center;" -->
	<div>
		<img src="data:image/png;base64,{{DNS1D::getBarcodePNG(App\modeles\patient::where("id",$ticket->id_patient)->get()->first()->code_barre, 'C128')}}" alt="barcode" />
	</div>
</body>
</html>