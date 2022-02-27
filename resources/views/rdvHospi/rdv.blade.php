<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
	<title>RDV</title>
	  <link rel="stylesheet" href="css/styles.css">
<style>
	
</style>
</head>
<body>	
	<div class="row"><img src="img/entete.png" class="mt-12" alt="entete" width="100%"></div>	
	<hr/>
	<div class="sec-droite"><strong>Alger le :</strong><span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span></div>	
	<div class="row"><strong>Patient(e) :</strong></div>
	<div class="tab-space"><strong>Nom & Prenom :&nbsp;</strong><span>{{ $rdv->demandeHospitalisation->consultation->patient->full_name }} </span></div>
		<div  class="tab-space">
			<strong>Né(e) le :&nbsp;</strong><span>{{ \Carbon\Carbon::parse($rdv->demandeHospitalisation->consultation->patient->Dat_Naissance)->format('d-m-Y') }}</span>
		</div> 
		<div class="tab-space"><strong>Date RDV :&nbsp;</strong><span>{{ $rdv->date}} </span></div>
		<div class="tab-space"><strong>Heure RDV :&nbsp;</strong><span>{{ $rdv->heure}} </span></div>
		<h3 class="center mt-40"><span><strong>Rendez-Vous d'hospitalisation</strong></span></h3>
		<br><div class="row"><strong>Object :</strong>&nbsp;Attribution d'un Rendez-vous d'hospitalisation</div><br>
		<div>
			<p  class="espace">
				Nous vous informons que votre rendez-vous d'hospitalisation dans notre service <strong>&quot;{{ $rdv->demandeHospitalisation->Service->nom }}&quot;</strong>est pour le: <strong>&quot;{{ $rdv->date }}&quot;</strong>.
			</p>
			<p class="tab-space"  style="line-height: 30px">
				Veuillez <strong>IMPERATIVEMENT</strong> vous présenter <strong>1 heure </strong>avant l'heure prévue de votre rendez-vous d'hospitalisation au service <strong>{{ $rdv->demandeHospitalisation->Service->nom }}</strong>muni(e) de votre pièce d'identité, votre carte chiffa ou attestation de droits.En fonctions de l'hospitalisation prévus pensez à apporter le courier de votre médecin ainsi que vos examens récents(biologie,radiologie,...).	
			</p>
			<p class="tab-space">Si vous êtes dans l'impossibilité de vous rendre à cette consultatation.veuillez avoir l'amabilité de nous prévenir
			<strong>48 heures</strong> avant en téléphonant au <strong>&quot;023-93-34&quot;</strong>  
			</p>
			<p class="espace">En vous remerciant, nous vous prions de croire,Monsieur, à l'expression de nous salutations distinguées.</p>
		</div>
		<div class="sec-droite"><strong> Le Service {{ $rdv->demandeHospitalisation->Service->nom }}</strong></div>
	</body>
</html>