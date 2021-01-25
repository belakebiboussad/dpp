<!DOCTYPE html>
<html>
<head>
  <title>Résumé Standard de Sortie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
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
      <h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Résumé Standard de Sortie</strong></span> </h5><br><br> 
     <div class="row"> <div class="col-sm-12"><strong>Etablisement : </strong><span>{{ (App\modeles\Lieuconsultation::find(session('lieu_id'))->nom )}}</span></div></div>
     <div class="row" ><div class="col-sm-12"> <strong>Chef de servise : </strong>
            <span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->responsable->nom }} {{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->responsable->prenom }}</span> </div>
      </div><br><hr/>
     <section class="table"> 
          <table class="head" style="width:100%;">   <thead> </thead>
               <tbody>
                      <tr>
                          <td class="first"><strong>Matricule :</strong><span> &nbsp;{{ $hosp->patient->assure->matricule }}</span></td>
                          <td><strong>N° Dossier</strong><span> &nbsp;{{ $hosp->patient->IPP}}</span></td>
                     </tr>
                    <tr class="noBorder">
                          <td class="first"><strong>Nom et Prenom : </strong>&nbsp;<span> &nbsp;{{ $hosp->patient->Nom }}{{ $hosp->patient->Prenom }}</span></td>
                          <td></td>
                    </tr>
                  <tr class="noBorder">
                      <td class="first"><strong>Date de Naissance :<strong>&nbsp;
                          <span> &nbsp;{{ $hosp->patient->Dat_Naissance }}</span><span> &nbsp;({{ $hosp->patient->getAge() }} ans)</span>
                      </td>
                     <td><strong>Sexe :<strong>&nbsp;<span> &nbsp;{{ $hosp->patient->Sexe }}</span></td>
                </tr>
                <tr class="noBorder">
                  <td class="first"><strong>Lieu de Naissance:</strong><span> &nbsp;{{ $hosp->patient->lieuNaissance->nom_commune }}</span></td>
                  <td><strong>Lieu de Résidence(Wilaya):</strong><span><span> &nbsp;{{ $hosp->patient->commune->daira->wilaya->nom }}</span></td>
                </tr>
            <tr class="noBorder">
              <td class="first"><strong>Adresse:</strong><span> &nbsp;{{ $hosp->patient->Adresse }}</span></td><td></td>
            </tr>
            <tr class="noBorder">
              <td class="first"><strong>Date d'admisston a hopital :</strong><span> &nbsp;{{ $hosp->admission->rdvHosp->date_RDVh }}</span></td><td></td>
            </tr>
            <tr><td colspan="2" class="center"><span  style="text-transform:uppercase">dernier service d'hospitalisation</span></td>
            </tr>
            <tr class="noBorder">
              <td class="first"><strong>Date d'entrée au Service :</strong><span> &nbsp;{{ $hosp->Date_entree }}</span></td>
              <td><strong>Médecin traitant :</strong><span> &nbsp;{{  $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->nom }}
              {{  $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->prenom }}</span></td>
            </tr>
            <tr class="noBorder">
              <td class="first"><strong>Mode de Sortie :</strong><span> &nbsp;{{ $hosp->modeSortie }}</span></td>
              <td><strong>Date de Sortie de l'Hôpital :</strong><span> &nbsp;{{ $hosp->Date_Sortie }}</span></td>
            </tr>
            <tr>
              <td class="first" colspan="2"><strong>Motif d'hospitalisation :</strong><span> &nbsp;{{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->Motif_Consultation }}</span></td>
            </tr>
            <tr class="noBorder">
              <td class="first" colspan="2"><strong>Diagnostic Principale de sotie :</strong><span> &nbsp;{{ $hosp->diagSortie }}</span></td>
            </tr>
          </tbody>
        </table>
      </section><br><hr/>
 </div><!-- fluid  -->
</body>
</html>