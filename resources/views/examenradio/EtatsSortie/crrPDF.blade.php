<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="css/styles.css"/>
  <title>Compte rendu radiologique </title>
</head>
    	<body>	{{-- <div class="container-fluid" id="myDiv">@include('examenradio.EtatsSortie.crrS', $crr)</div></div> --}}
    	  	<div><img src="img/entete.png" class="center thumb img-icons mt-25" alt="entete"/></div>		
      		 <hr class="mt-6 hr_1">
  		<div class="sec-gauche"><strong>Médecin prescripteur :</strong><span> {{ $medecin->nom }} {{ $medecin->prenom }}</span></div>
 	 	<div class="sec-droite"><strong>Alger le :</strong><span>{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span></div><br> 
 	 	 <div>
 	 	<table width="90%">
  		<tbody>
  			<tr><td colspan="3"><strong>Patient(e) :</strong></td></tr>
	  		<tr>
	  			<td width="25%"><strong>Nom :&nbsp;</strong><span>{{ $patient->Nom }}</span></td>
	  			<td width="25%"><strong>Prenom :&nbsp;</strong><span>{{ $patient->Prenom }}</span></td>
	  			<td width="50%"><strong>Né(e) le :&nbsp;</strong>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</td>
	  		</tr>
	  	</tbody>
		  </table>
 		 </div><br>
        	<div class="center"><h3><strong>Compte rendu d'exploration radiologique</strong></h3></div>
        	<div>{!! nl2br(e($crr->conclusion)) !!}</div>
 		 <div class="foot"><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></div>
    </body>
</html>
