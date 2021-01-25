<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
        
        
    <title>Resume Clinique de Sortie</title>
	<style>

		   @media print  
 {
a[href]:after {
content: none !important;
 }
@page {
margin-top: 0;
margin-bottom: 0;
}
 body{
  padding-top: 72px;
padding-bottom: 72px ;
}
}

                    .section
            {
                margin-bottom: 20px;
            }
            .sec-gauche
            {
                float: left;
            }
            .sec-droite
            {
                float: right;
            }
            .center
            {
                text-align: center;
            }
              .col-sm-12
            { font-size: 14px;
                margin-bottom: 5px;
            }
            .mt-15{
            margin-top:-15px;
            }
            .mt12{
            padding-top:+12px;
            }
            .mt-20{
          margin-top:-20px;
            }
            .ml-80{
         margin-left: +80%;
            }
            .ml-4{
        margin-left: +4%;
            }
            .foo{
      position: absolute;
      top: 90%;
      right: 22%;
        }
	      span {
            padding-left: 20px; 
            font-size:16px;
            width:100%;
            
        }
		.col-2{
			font-size: 12px;
			display: inline-block;
			width: 100%;
			text-align: left
			padding: 20px 20px 20px 20px; 
		}
		.borderv {border: 1px     solid #000; }
		
	</style>
 </head>
    <body>
    <div class="container-fluid" id="myDiv">
        <h4 class="mt12 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h4>
      <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
            <h4 class="center">Chemin des Glycines - ALGER</h4>
            <h4 class="center">Tél : 23-93-34</h4>
            <h5 class="mt-15 center" ><img src="{{ asset('/img/logo.png') }}" style="width: 60px; height: 60px" alt="logo"/></h5>
        <h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Attestation cntre avis medical</strong></span></h5>
<section class="borderv">
    <h3 style="text-align: center; text-decoration: underline;">Attestation</h3>
	<span>je soussigné M ,Mme  :</span> <span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->nom }}{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->prenom}}<span>
    <br/><br/>
	<span>Demande de sortie de l'hopital :</span><span>.......................................................................................</span>
    <br/><br/>	
	<span>Du patient :</span><span>{{ $hosp->patient->Nom }}{{ $hosp->patient->Prenom }}</span>
	<br/><br/>
	<span>immédiatement :</span><span>(ou Le :{{ $hosp->Date_Sortie == null ? "Pas encore" : $hosp->Date_Sortie }}</span><span> heures :{{   
    $hosp->Heure_sortie}}).</span><br/>	<br/>
	<span>j'ai été clairement informé de l'avie médical contraire du médcin responsable a cette sortie , ce dernier</span><span> l'estimant  prématurée et présentant un danger pour la santé de mon patient </span>
    <br/><br/>
    <span>Fait à  le {{ $date}}</span><br/>	<br/>	
	<span>Signature</span>	
	<div class="space"></div><div class="space"></div> <br/><br/><br/>
	<div>
		<span class="col-2">
		*cette attestation cera établir de préférence , conjointement , par les deux titulaire de l'autorité parentale (le cas échéant)	     	
		</span>
	</div>
	<section>
</body></html>