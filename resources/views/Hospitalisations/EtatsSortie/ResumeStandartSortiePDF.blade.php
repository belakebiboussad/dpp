<!DOCTYPE html>
<html>
<head>
  <title>Résumé Standard de Sortie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
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
  </style>
</head>
<body>
 <div class="container-fluid">
    @include('partials.etatHeader')
    <h3 class="center mt-10"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3><!-- mt-20,mt-5 -->
    <div class="row"> <div class="mb-10"><strong>Etablisement : </strong><span>{{ $etablissement->nom }}</span></div></div>
    <div class="row" ><div class="mb-10"> <strong>Chef de servise : </strong>
      <span>{{ $obj->admission->rdvHosp->demandeHospitalisation->Service->responsable->nom }} {{ $obj->admission->rdvHosp->demandeHospitalisation->Service->responsable->prenom }}</span> </div>
    </div><br><hr/>
     <section class="table"> 
          <table class="head" style="width:100%;">   <thead> </thead>
               <tbody>
                      <tr>
                          <td class="first"><strong>Matricule :</strong><span> &nbsp;{{ $obj->patient->assure->matricule }}</span></td>
                          <td><strong>N° Dossier</strong><span> &nbsp;{{ $obj->patient->IPP}}</span></td>
                     </tr>
                    <tr class="noBorder">
                          <td class="first"><strong>Nom et Prenom : </strong>&nbsp;<span> &nbsp;{{ $obj->patient->Nom }}&nbsp;{{ $obj->patient->Prenom }}</span></td>
                          <td></td>
                    </tr>
                  <tr class="noBorder">
                      <td class="first"><strong>Date de Naissance :<strong>&nbsp;
                          <span> &nbsp;{{ $obj->patient->Dat_Naissance }}</span><span> &nbsp;({{ $obj->patient->getAge() }} ans)</span>
                      </td>
                     <td><strong>Sexe :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->Sexe }}</span></td>
                </tr>
                <tr class="noBorder">
                  <td class="first"><strong>Lieu de Naissance:</strong><span> &nbsp;{{ $obj->patient->lieuNaissance->nom_commune }}</span></td>
                  <td><strong>Lieu de Résidence(Wilaya):</strong><span><span> &nbsp;{{ $obj->patient->commune->daira->wilaya->nom }}</span></td>
                </tr>
            <tr class="noBorder">
              <td class="first"><strong>Adresse:</strong><span> &nbsp;{{ $obj->patient->Adresse }}</span></td><td></td>
            </tr>
            <tr class="noBorder">
              <td class="first"><strong>Date d'admisston a hopital :</strong><span> &nbsp;{{ $obj->admission->rdvHosp->date_RDVh }}</span></td><td></td>
            </tr>
            <tr><td colspan="2" class="center"><span  style="text-transform:uppercase">dernier service d'hospitalisation</span></td>
            </tr>
            <tr class="noBorder">
              <td class="first"><strong>Date d'entrée au Service :</strong><span> &nbsp;{{ $obj->Date_entree }}</span></td>
              <td><strong>Médecin traitant :</strong><span> &nbsp;{{  $obj->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->nom }}
              {{  $obj->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->prenom }}</span></td>
            </tr>
            <tr class="noBorder">
              <td class="first"><strong>Mode de Sortie :</strong>
                   @switch($obj->modeSortie)
                          @case(0)
                              &nbsp;Transfert
                               @break
                          @case(1)
                                &nbsp;Contre avis médical
                               @break
                          @case(2)
                               &nbsp;Décès
                               @break
                          @case(3)
                               &nbsp;Reporter
                               @break
                          @default  {{-- Domicile = null --}}
                                &nbsp;Domicile
                               @break
                     @endswitch
                </td>
              <td><strong>Date de Sortie de l'Hôpital :</strong><span> &nbsp;{{ $obj->Date_Sortie }}</span></td>
            </tr>
            <tr>
              <td class="first" colspan="2"><strong>Motif d'hospitalisation :</strong><span> &nbsp;{{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->motif }}</span></td>
            </tr>
            <tr class="noBorder">
              <td class="first" colspan="2"><strong>Diagnostic Principale de sotie :</strong><span> &nbsp;{{ $obj->diagSortie }}</span></td>
            </tr>
          </tbody>
        </table>
      </section><br><hr/>
 </div><!-- fluid  -->
</body>
</html>