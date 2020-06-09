<!DOCTYPE html>
<html>
<head>
	<title>RDV</title>
<style>
	.numberCircle {
    width: 45px;
    line-height: 45px;
    border-radius: 50%;
    text-align: center;
    font-size: 40px;
    border: 2px solid #666;
	}
	.marge {
		position:absolute;
		left:250px;
	}
 

</style>
</head>
<body>
  <br>
  <div class="row">
    <div class="col-xs-6 col-sm-4"></div>
	  <div class="col-xs-6 col-sm-8" style="line-height:10px">
	  		<h5 style="text-align:center;">HOPITAL CENTRAL DE LA SURETE NATIONAL "LES GLYCINES"</h5>
	  		<h5 style="text-align:center;">Tél : 023-93-34</h5>
	  </div>
  </div>
  <div class="row">
    <div class="col-xs-4 col-sm-4"></div> 
    <!-- ;margin-left: 30em -->
    <div class="col-xs-4 col-sm-4" style="text-align:center;"><img style="max-width:48px" src="img/logo.png" class="thumb img-icons" alt="logo"></div>
	  <div class="col-xs-4 col-sm-4"></div>
  </div>
  <hr>
	<div class="space-12"></div>	
  <div class="space-12"></div>	
  <div class="row">
  	<table width="100%" style="line-height:10px">
			<tr>
				<td class="col-md-4">
					<strong>Patient :</strong>
					<span>
						{{ $rdv->demandeHospitalisation->consultation->patient->Nom }}
						{{ $rdv->demandeHospitalisation->consultation->patient->Prenom }}
					</span>
					</td>
					<td class="col-md-8" rowspan="4" >
						<h5 class="float-right" style ="padding-right:1px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hôpital Glycine, le {{ $t->day }} {{ $t->subMonth(0)->format('F')}} {{ $t->year}}</h5>
            <div style="line-height:4px">
	            <h5>M. {{$rdv->demandeHospitalisation->consultation->patient->Nom}}</h5>
	            <h6>
	           		{{ $rdv->demandeHospitalisation->consultation->patient->Adresse }}
	           		{{ $rdv->demandeHospitalisation->consultation->patient->commune->nom_commune }}
	            	{{ $rdv->demandeHospitalisation->consultation->patient->wilaya->nom_wilaya }}
	            </h6>
	          </div>
            	
					</td>
			</tr>	
			<tr>
				<td class="col-md-4">
					<strong>Date RDV:</strong>
					<span>{{ $rdv->date_RDVh }}</span>
				</td>
			</tr>
			<tr>
				<td class="col-md-4">
					<strong>Heure RDV:</strong>
					<span>{{ $rdv->heure_RDVh }}</span>
				</td>
			</tr>
			<tr>
				<td class="col-md-4">
					<strong>Service :</strong>
					<span>{{ $rdv->demandeHospitalisation->Service->nom }}</span>
				</td>
			</tr>
		</table>
		<br><br>
		<strong>Object :</strong> Attribution d'un Rendez-Vous D'hospitalisation
		<br><br>
		<p>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nous vous informons que votre rendez-vous d'hospitalisation dans notre service <strong>&quot;{{ $rdv->demandeHospitalisation->Service->nom }}&quot;</strong>
		 	est pour le: <strong>&quot;{{ $rdv->date_RDVh }}&quot;</strong>.
		</p>
		<p style="line-height: 30px">
			Veuillez <strong>IMPERATIVEMENT</strong> vous présenter <strong>1 heure </strong>avant l'heure prévue de votre rendez-vous 
			
			d'hospitalisation au service <strong>{{ $rdv->demandeHospitalisation->Service->nom }}</strong>muni(e) de votre 
			
			pièce d'identité, votre carte chiffa ou attestation de droits.
			
			En fonctions de l'hospitalisation prévus pensez à apporter le courier de votre médecin ainsi que vos examens récents(biologie,radiologie,...).		
		</p>
		<p>
				Si vous êtes dans l'impossibilité de vous rendre à cette consultatation.veuillez avoir l'amabilité de nous prévenir
				<strong>48 heures</strong> avant en téléphonant au <strong>&quot;023-93-34&quot;</strong>  
		</p>
			
	</div>
	<div class="row">
		<p>
				En vous remerciant, nous vous prions de croire,Monsieur, à l'expression de nous salutations distinguées.
		</p>
	</div>
	<div class ="row">
		<table>
			<tr>
				<td class="col-md-3"></td>
				<td class="col-md-3"></td>
				<td class="col-md-3 center"><span></span><span style="margin-left:30px;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Le Service {{ $rdv->demandeHospitalisation->Service->nom }}</strong></span></td>
				<td class="col-md-3"></td>
			</tr>
		</table>
				
	</div>

</body>
</html>