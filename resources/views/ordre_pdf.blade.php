<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
</head>
<body>
	<h3 style="text-align: center;">HOPITAL CENTRAL DE LA SURETE NATIONAL "LES GLYCINES"</h3>
	<h3 style="text-align: center;">Tél : 23-93-34</h3>
	<h5 style="text-align: center; text-decoration: underline;">SERVICE DES CONSULTATIONS</h5>
	<h6 style="text-align: center; text-decoration: underline;">CARTE DE RENDEZ-VOUS</h6>
	<div style="text-align: center;">
		<img src="data:image/png;base64,{{DNS2D::getBarcodePNG(App\modeles\patient::where("id",$order->Patient_ID_Patient)->get()->first()->code_barre, 'QRCODE')}}" alt="barcode" />
	</div>
	<div>
		<br><br>
		<table width="600">
			<tr>
				<td>
					<b>Nom Patient :</b>
					{{ App\modeles\patient::where("id",$order->Patient_ID_Patient)->get()->first()->Nom }}
					{{ App\modeles\patient::where("id",$order->Patient_ID_Patient)->get()->first()->Prenom }}
				</td>
				<td>
					<b>Date rdv :</b> 
					{{ $order->Date_RDV }}
				</td>
			</tr>
			<tr>
				<td>
					<b>Nom Médecine Traitant :</b>
					{{ App\modeles\employ::where("id",$order->Employe_ID_Employe)->get()->first()->Nom_Employe }}
					{{ App\modeles\employ::where("id",$order->Employe_ID_Employe)->get()->first()->Prenom_Employe }}
				</td>
			</tr>
		</table>
	</div>
	<br/>
	<span style="float: right; text-align: right;"> Signature</span>
</body>
</html>