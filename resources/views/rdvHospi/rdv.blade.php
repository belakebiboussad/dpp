<!-- <div class="row">
	<img src="img/entete.png" class="mt-12" alt="entete" width="100%"></div>	
</div>
 <hr> -->
 <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="css/styles.css">
  <title>Resume Clinique de Sortie</title>
  <style>
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 5px;
    }
    .rectangle {
      width:100%;
      height:25px;
      background:#ccc;
    }
  </style>
  </head>
  <body>
    <div class="container-fluid">
    	<img src="img/entete.png"class="mt-12" alt="Entete" width="100%"/>
    	<div class="space-12"></div><div class="space-12"></div>	
  		<div class="row">
  		<table width="100%" style="line-height:10px">
				<tr>
				<td class="col-md-4">
					<strong> Patient :</strong>
					<span>{{ $rdv->demandeHospitalisation->consultation->patient->Nom }}{{ $rdv->demandeHospitalisation->consultation->patient->Prenom }}</span>
				</td>
				<td class="col-md-8" rowspan="4" >
						<h5 class="float-right" style ="padding-right:1px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Hôpital Glycine, le {{ $t->day }} {{ $t->subMonth(0)->format('F')}} {{ $t->year}}</h5>
            <div style="line-height:4px">
	            <h5>
	            	{{	$rdv->demandeHospitalisation->consultation->patient->getCivilite() }}
	            	{{$rdv->demandeHospitalisation->consultation->patient->Nom}}
	            </h5>
	            @if(isset($rdv->demandeHospitalisation->consultation->patient->commune_res))
	            <h6>{{ $rdv->demandeHospitalisation->consultation->patient->Adresse }}&nbsp;&nbsp;{{ $rdv->demandeHospitalisation->consultation->patient->commune->nom_commune }}
	            	&nbsp;&nbsp;{{ $rdv->demandeHospitalisation->consultation->patient->wilaya->nom }}
	            </h6>
	            @endif
	          </div> 	
					</td>
			</tr>	
			<tr><td class="col-md-4"><strong>Date RDV:</strong><span>{{ $rdv->date_RDVh }}</span></td></tr>
			<tr><td class="col-md-4"><strong>Heure RDV:</strong><span>{{ $rdv->heure_RDVh }}</span></td></tr>
			<tr><td class="col-md-4"><strong>Service :</strong><span>{{ $rdv->demandeHospitalisation->Service->nom }}</span></td>
			</tr>
		</table><br><br>
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
		<p>Si vous êtes dans l'impossibilité de vous rendre à cette consultatation.veuillez avoir l'amabilité de nous prévenir
			<strong>48 heures</strong> avant en téléphonant au <strong>&quot;023-93-34&quot;</strong>  
		</p>
			
	</div>
	<div class="row"><p>En vous remerciant, nous vous prions de croire,Monsieur, à l'expression de nous salutations distinguées.</p></div>
    </div>
   </body>
 </html>