<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
  <link rel="stylesheet" href="css/styles.css">
  <title>Compte rendu biologique</title>
  <style type="text/css">
  	p.b {
 			 text-align: left;
	 }
  </style>
  </head>
  <body>
  <div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div>
  <div class="right"><b>Alger le :</b><span> {{ \Carbon\Carbon::today()->format('d/m/Y') }}</span></div><br>
  <div class="sec-gauche mtp20"><b>Médecin prescripteur :</b><span> {{ $medecin->full_name }}</span></div>
  <div class="mtP40">
  	<table width="90%">
  		<tbody>
  			<tr><td colspan="3"><b>Patient(e) :</b></td></tr>
	  		<tr>
	  			<td width="25%"><b>Nom :</b><span> {{ $patient->Nom }}</span></td>
	  			<td width="25%"><b>Prenom :</b><span> {{ $patient->Prenom }}</span></td>
	  			<td width="50%"><b>Né(e) le :</b> {{ $patient->Dat_Naissance->format('d/m/Y') }}</td>
	  		</tr>
	  	</tbody>
	  </table>
  </div><br><br>
  <div class="center"><h3><b>Compte rendu d'analyses médicales</b></h3></div><br/>
  <div>{!! nl2br(e($crb)) !!}</div>
  <div class="footer2"><img src="img/footer.png" alt="footer" class="center" width="100%"/></div>
</body>  
</html>