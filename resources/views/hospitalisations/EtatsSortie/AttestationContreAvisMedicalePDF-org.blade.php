<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="css/styles.css">
    <title>Attestation contre avis médical</title>
	  <style>
      @media print  
      {
        @page {
          margin-top: 0;
          margin-bottom: 0;
        }
        body{
          padding-top: 60px;
          padding-bottom: 60px ;
        }
      }
		  .col-2{
		  	font-size: 12px;
			  display: inline-block;
			  width: 100%;
			  text-align: left;
			   padding: 20px 20px 20px 20px; 
		  }
		  .borderv {
        border: 1px solid #000; 
      }
	  </style>
  </head>
  <body>
  <div class="container-fluid"> {{-- id="myDiv" --}}
    @include('partials.etatHeader')
    <h3 class="center mt-10"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3><!-- mt-20,mt-5 -->
    <section class="borderv">
      <br><br>
      <span class="marge">&nbsp;&nbsp;&nbsp;&nbsp;je soussigné M ,Mme  :</span><span>{{ $obj->admission->demandeHospitalisation->DemeandeColloque->medecin->nom }}&nbsp;{{ $obj->admission->demandeHospitalisation->DemeandeColloque->medecin->prenom}}<span><br/>
      <span class="marge">&nbsp;&nbsp;&nbsp;&nbsp;Demande de sortie de l'hopital :</span>
      <span>&nbsp;{{ $etablissement->nom }}</span><br/>	
      <span class="marge">&nbsp;&nbsp;&nbsp;&nbsp;Du patient :</span><span>{{ $obj->patient->Nom }}&nbsp;{{ $obj->patient->Prenom }}</span><br/>
      <span class="marge">&nbsp;&nbsp;&nbsp;&nbsp;immédiatement :</span>&nbsp;<span>(ou Le :{{ $obj->Date_Sortie == null ? "Pas encore" : $obj->Date_Sortie }}</span>
      <span> heures :{{$obj->Heure_sortie}}).</span><br/><br/>
      <span>&nbsp;&nbsp;&nbsp;&nbsp;j'ai été clairement informé de l'avie médical contraire du médcin responsable a cette sortie , ce dernier</span>
      <span> l'estimant  prématurée et présentant un danger pour la santé de mon patient </span><br/><br/><br/><br/>
      <div>
        <span>&nbsp;&nbsp;&nbsp;&nbsp;Fait à : </span><span>&nbsp;{{ $etablissement->nom }}</span>&nbsp;&nbsp;
        <span>&nbsp;&nbsp;&nbsp;&nbsp;le :&nbsp;</span>{{ $date}}<span></span><br/><br/>  
        <span>&nbsp;&nbsp;&nbsp;&nbsp;Signature</span>
      </div><!-- / -->
      <br/><br/><br/>
     <div>
     <span class="col-2">*cette attestation cera établir de préférence , conjointement , par les deux titulaire de l'autorité parentale (le cas échéant)</span>
         </div>
     <section>
  </body>
</html>