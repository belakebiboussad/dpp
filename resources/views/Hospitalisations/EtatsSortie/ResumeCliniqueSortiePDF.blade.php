<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Resume Clinique de Sortie</title>
  <style>
      table 
    {
        border-collapse: collapse;
    }
    table, th, td 
    {
        border: 1px solid black;
        padding: 5px;
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
    {
      margin-bottom: 10px;
    }
    .mt-15{
        margin-top:-15px;
    }
    .mt-20{
      margin-top:-20px;
    }
    .foo{
      position: absolute;
      top: 90%;
      right: 22%;
    }
    tr.noBorder td {
      border: 0;
    }
    </style>
    </head>
    <body>
    <div class="container-fluid">
            <h2 class="mt-20 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h2>
          <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
          <h4 class="center">Chemin des Glycines - ALGER</h4>
          <h4 class="center">Tél : 23-93-34</h4>
          <h5 class="mt-15 center" ><img src="img/logo.png" style="width: 60px; height: 60px" alt="logo"/></h5>
          <h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Résumé Clinique de Sortie</strong></span> </h5><br><br>  
          <div class="row">   <div class="col-sm-12"><strong>Etablisement : </strong><span>{{ (App\modeles\Lieuconsultation::find(session('lieu_id'))->nom )}}</span></div></div>
          <div class="row" ><div class="col-sm-12"><strong>Service : </strong><span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}</span></div></div>
          <div class="row" ><div class="col-sm-12"><strong>Chef de servise : </strong><span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->responsable->nom }} {{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->responsable->prenom }}</span></div>
          </div> <br><hr/>
        <section class="table"> 
          <table class="head" style="width:100%;">
          <thead> </thead>
          <tbody>
          <tr>
            <td class="first"><strong>N° Matricule:</strong><span>{{ $hosp->patient->assure->matricule }}</span>%0</td>
            <td><strong>N° Dossier</strong><span> &nbsp;{{ $hosp->patient->IPP}}</span></td>
          </tr>
          <tr class="noBorder">
               <td class="first"><strong>Nom et Prenom : </strong>&nbsp;<span> &nbsp;{{ $hosp->patient->Nom }}{{ $hosp->patient->Prenom }}</span></td>
                <td><strong>Date de Naissance :<strong>&nbsp;<span> &nbsp;{{ $hosp->patient->Dat_Naissance }}</span></td>
                <td><strong>Sexe :<strong>&nbsp;<span> &nbsp;{{ $hosp->patient->Sexe }}</span></td>
          </tr >
          <tr class="noBorder">
            <td class="first"><strong>Lieu de Naissance :<strong>&nbsp;<span> &nbsp;{{ $hosp->patient->lieuNaissance->nom_commune }}</td>
            <td><strong>Wilaya :<strong>&nbsp;<span> &nbsp;{{ $hosp->patient->lieuNaissance->daira->wilaya->nom }}</span></td>
            
          </tr>
          <tr class="noBorder">
              <td class="first"><strong>Date d'Hospitalisation</strong><span> &nbsp;&nbsp;{{ $hosp->Date_entree }}</span></td>
              <td ><strong>Mode d'entrer</strong><span> &nbsp;{{ $hosp->admission->rdvHosp->demandeHospitalisation->modeAdmission }}</span></td>
          </tr>
          <tr class="noBorder">
              <td class="first"><strong>Service</strong><span> &nbsp;&nbsp;{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}</span></td>
              <td ><strong>Date d'entrée au Service</strong><span> &nbsp;{{$hosp->Date_entree }}</span></td>
               <td><strong>Date de Sortie de Service</strong><span> &nbsp;{{ $hosp->Date_Sortie }}</span></td>
          </tr>
            <tr><td colspan="2" class="center"></td>
          </tbody>
          </table>
        </section><br><hr/>
        <section class="table"> 
        <table class="head" style="width:100%;">
        <thead></thead>
        <tbody>  
          <tr>
            <td class="first"> <strong> Date d'entrer au sevice:</strong>&nbsp;<span>{{ $hosp->Date_entree}} &nbsp;</span>
            </td>
            <td><strong>Medcin traitant : </strong><span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->nom }}{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->prenom}}</span>
            </td>
          </tr>
          <tr>  
             <td class="first"><strong>Date sortie de sevice : </strong><span>{{ $hosp->Date_Sortie == null ? "Pas encore" : $hosp->Date_Sortie }}</span> </td>
          </tr>
        </tbody>
        </table>
        </section><br><hr/>
        <div class="row" ><div class="col-sm-12"><strong>Motif dhospitalisation : </strong><span>{{$hosp->admission->rdvHosp->demandeHospitalisation->
           consultation->Motif_Consultation }} </span> </div></div>
        <div class="row" ><div class="col-sm-12"><strong>Bilan boilogique : </strong><span>dfgdfgdfgdfg</span> </div></div>
        <div class="row" ><div class="col-sm-12"><strong>Bilan radoilogique : </strong><span>dfgdfgdfgdfg</span> </div></div>
        <div class="row" ><div class="col-sm-12"><strong>Autre examain : </strong><span>dfgdfgdfgdfg</span> </div></div>
        <div class="row" ><div class="col-sm-12"><strong>Daognostic principale de sortie : </strong>&nbsp;<span> &nbsp;{{ $hosp->diagSortie }}</span> </div></div>
        <div class="row" ><div class="col-sm-12"><strong>Daognostic associer : </strong><span>dfgdHHHHHHHHHHHHHHHfgdfgdfg</span> <br>
        <span>dfgdHHHHHHHHHHHHHHHfgdfgdfg</span><br><span>dfgdHHHHHHHHHHHHHHHfgdfgdfg</span><br>
        </div></div>
       <div class="row" ><div class="col-sm-12"><strong>Acte et traitement : </strong><span>
          @foreach($hosp->visites as $visite)
            @foreach($visite->actes as $acte )
              {{ $acte->nom }}
            @endforeach
          @endforeach</span> </div></div>
     </div>     
    </body>
</html>