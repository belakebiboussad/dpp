<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/styles.css">
      <title>Attestation Contre Avis Médical</title>
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
                      padding-top: 60px;
                     padding-bottom: 60px ;
               }
          }
          .mt-40{
                margin-top:-40px;
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
			text-align: left;
			padding: 20px 20px 20px 20px; 
		}
		.borderv {
                  border: 1px     solid #000; 
          }
          .marge {
                margin-left: 5em;
          }
	</style>
     </head>
    <body>
          <div class="container-fluid"> {{-- id="myDiv" --}}
                <h2 class="mt-40 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h2>
                <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
                <h4 class="center">Chemin des Glycines - ALGER</h4>
                <h4 class="center">Tél : 23-93-34</h4>
                <h5 class="mt-15 center" ><img src="img/logo.png" style="width: 60px; height: 60px" alt="logo"/></h5>
               <h5 class="mt-15 center"><span style="font-size: xx-large;"><strong>Attestation contre avis medical</strong></span></h5>
                <section class="borderv">
	                 <span class="marge">&nbsp;&nbsp;&nbsp;&nbsp;je soussigné M ,Mme  :</span><span>{{ $obj->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->nom }}&nbsp;{{ $obj->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->prenom}}<span><br/>
	                <span class="marge">&nbsp;&nbsp;&nbsp;&nbsp;Demande de sortie de l'hopital :</span>
                     <span>&nbsp;{{ (App\modeles\Lieuconsultation::find(session('lieu_id'))->nom )}}</span><br/>	
	                <span class="marge">&nbsp;&nbsp;&nbsp;&nbsp;Du patient :</span><span>{{ $obj->patient->Nom }}&nbsp;{{ $obj->patient->Prenom }}</span><br/>
	                <span class="marge">&nbsp;&nbsp;&nbsp;&nbsp;immédiatement :</span>&nbsp;<span>(ou Le :{{ $obj->Date_Sortie == null ? "Pas encore" : $obj->Date_Sortie }}</span>
                     <span> heures :{{$obj->Heure_sortie}}).</span><br/><br/>
	                <span>&nbsp;&nbsp;&nbsp;&nbsp;j'ai été clairement informé de l'avie médical contraire du médcin responsable a cette sortie , ce dernier</span>
                     <span> l'estimant  prématurée et présentant un danger pour la santé de mon patient </span><br/><br/><br/><br/>
                     <span>&nbsp;&nbsp;&nbsp;&nbsp;Fait  à </span><span>&nbsp;{{ (App\modeles\Lieuconsultation::find(session('lieu_id'))->nom )}}</span>&nbsp;&nbsp;
                     <span>&nbsp;&nbsp;&nbsp;&nbsp;le</span>{{ $date}}<span></span><br/><br/>	
                	<span>&nbsp;&nbsp;&nbsp;&nbsp;Signature</span>	
                 	<div class="space"></div><div class="space"></div> <br/>
	               <div>
		             <span class="col-2">*cette attestation cera établir de préférence , conjointement , par les deux titulaire de l'autorité parentale (le cas échéant)</span>
	               </div>
	         <section>
</body></html>