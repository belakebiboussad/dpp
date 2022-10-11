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
	<div class="row"><img src="img/entete.jpg" class="mt-12" alt="entete" width="100%"></div>	
	<hr/>
	<div class="right"><b>Alger le :</b><span>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</span></div>	
	<div class="row"><b>Patient(e) :</b></div>
	<div class="tab"><b>Nom & Prenom :&nbsp;</b><span>{{ $rdv->demandeHospitalisation->consultation->patient->full_name }} </span></div>
		<div  class="tab">
			<b>Né(e) le :&nbsp;</b><span>{{ \Carbon\Carbon::parse($rdv->demandeHospitalisation->consultation->patient->Dat_Naissance)->format('d-m-Y') }}</span>
		</div> 
		<div class="tab"><b>Date RDV :&nbsp;</b><span>{{ $rdv->date}} </span></div>
		<div class="tab"><b>Heure RDV :&nbsp;</b><span>{{ $rdv->heure}} </span></div>
		<h3 class="center mt-40"><span><b>Rendez-Vous d'hospitalisation</b></span></h3>
		<br><div class="row"><b>Object :</b>&nbsp;Attribution d'un Rendez-vous d'hospitalisation</div><br>
		<div>
			<p  class="espace">
				Nous vous informons que votre rendez-vous d'hospitalisation dans notre service <b>&quot;{{ $rdv->demandeHospitalisation->Service->nom }}&quot;</b>est pour le: <b>&quot;{{ $rdv->date }}&quot;</b>.
			</p>
			<p class="tab"  style="line-height: 30px">
				Veuillez <b>IMPERATIVEMENT</b> vous présenter <b>1 heure </b>avant l'heure prévue de votre rendez-vous d'hospitalisation au service <b>{{ $rdv->demandeHospitalisation->Service->nom }}</b>muni(e) de votre pièce d'identité, votre carte chiffa ou attestation de droits.En fonctions de l'hospitalisation prévus pensez à apporter le courier de votre médecin ainsi que vos examens récents(biologie,radiologie,...).	
			</p>
			<p class="tab">Si vous êtes dans l'impossibilité de vous rendre à cette consultatation.veuillez avoir l'amabilité de nous prévenir
			<b>48 heures</b> avant en téléphonant au <b>&quot;023-93-34&quot;</b>  
			</p>
			<p class="espace">En vous remerciant, nous vous prions de croire,Monsieur, à l'expression de nous salutations distinguées.</p>
		</div>
		<div class="right"><b> Le Service {{ $rdv->demandeHospitalisation->Service->nom }}</b></div>
	</body>
</html>