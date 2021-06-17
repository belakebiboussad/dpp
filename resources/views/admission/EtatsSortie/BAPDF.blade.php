<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
   <title>Attestation de Séjour</title>
  <style>
    table {
        border-spacing: 0;
        width: 600px;
    }
    table >  tr > td > div {
      margin: 0 auto;
      border: 0px red solid;
    }
    .solid {border-style: solid;}
    </style>
  </head>
  <body>
  <div class="container-fluid">
    @include('partials.etatHeader')
    <h3 class="text-uppercase center mt-10"><span style="font-size: xx-large;"><strong><u>{{ $etat->nom}}</u></strong></span></h3>
    <br><h4>IDENTIFICATION PATIENT</h4>
    <section class="table solid" style="width:100%;"> 
      <table>
      <tr><td><strong>&nbsp;N° Admission :</strong><span>&nbsp;{{ $obj->id }}</span></td></tr>
      <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
      <tr>
        <td><strong>&nbsp;Nom :</strong><span>&nbsp;{{ $patient->Nom }}</span></td>
        <td><strong>Prénom :</strong><span>&nbsp; {{ $patient->Prenom }}</span></td>
        <td><strong>Genre :</strong><span>&nbsp; {{ $patient->Sexe }}</span></td>
      </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
      <tr>
        <td><strong>&nbsp;Né(e) le :</strong><span>&nbsp;{{ $patient->Dat_Naissance }}</span></td>
        <td><strong>&nbsp;Né(e) à  :</strong><span>&nbsp; {{ $patient->lieuNaissance->nom_commune }}</span></td>
        <td><strong>Code Wilaye :</strong><span>&nbsp; {{ $patient->lieuNaissance->daira->wilaya->id }}</span></td>
      </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
      <tr>
        <td><strong>&nbsp;Situation familliale :</strong><span>&nbsp;{{ $patient->situation_familiale }}</span></td>
        @if(($patient->situation_familiale == "M") && ( $patient->Type == "1") )
        <td><strong>Epoux(se)  :</strong><span>{{ $patient->assure->Nom }} &nbsp; {{ $patient->assure->Prenom }} </span></td>
        @endif
      </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
      <tr>
        <td colspan="2"><strong>&nbsp;Adresse de résidene :</strong><span>&nbsp;{{ $patient->Adresse}} &nbsp;{{ $patient->commune->nom_commune}}</span></td>
        <td><strong>Code Wilaye :</strong><span>&nbsp; {{ $patient->wilaya->nom }}</span></td>
      </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
       <tr>
        <td colspan="2"><strong>&nbsp;Personne à contacter :</strong><span>&nbsp;{{ $patient->hommesConf[0]->nom }}&nbsp;{{ $patient->hommesConf[0]->prenom }}</span></td>
        <td><strong>N° Tel :</strong><span>&nbsp;{{ $patient->hommesConf[0]->mob }}</span></td>
      </tr> 
      </table>
    </section>
     <br><h4>IDENTIFICATION DE L'ASUURE</h4>
    <section class="table solid" style="width:100%;">
     <table>
      <tr>
        <td><strong>&nbsp;IMMATRICULATION :</strong><span>&nbsp;{{ $patient->assure->NSS }}</span></td>
        <td colspan="2"><strong>&nbsp;N° Prise En Charge :</strong><span></span></td>
      </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
      <tr>
        <td><strong>&nbsp;Nom :</strong><span>&nbsp;{{ $patient->assure->Nom }}</span></td>
        <td><strong>&nbsp;Prénom :</strong><span>&nbsp;{{ $patient->assure->Prenom }}</span></td>
        <td><strong>Né(e) le :</strong><span>&nbsp;{{ $patient->assure->Date_Naissance }}</span></td>
      </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
      <tr>
        <td><strong>&nbsp;Matricule :</strong><span>&nbsp;{{ $patient->assure->Matricule }}</span></td>
        <td><strong>&nbsp;Position :</strong><span>&nbsp;{{ $patient->assure->Position }}</span></td>
        <td><strong>Service :</strong><span>&nbsp;{{ $patient->assure->Service }}</span></td>
      </tr>
      </table>
    </section>
    <br><h4>HOSPITALISATION</h4>
    <section class="table solid" style="width:100%;">
     <table>
        <tr>
          <td><strong>&nbsp;Service :</strong><span>&nbsp;{{ $obj->demandeHospitalisation->Service->nom }}</span></td>
          <td>
            <strong>Date d'entée :</strong>
            <span>&nbsp;{{  (\Carbon\Carbon::parse($obj->date_RDVh))->format('d/m/Y') }}</span>
          </td>
          <td><strong>Heure d'entrée :</strong><span>&nbsp;{{(\Carbon\Carbon::parse($obj->heure_RDVh))->format("H:i")}}</span></td>
        </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td><strong>&nbsp;Médecin traitant :</strong>
            <span>&nbsp;{{ $obj->demandeHospitalisation->DemeandeColloque->medecin->nom}} &nbsp;
              {{ $obj->demandeHospitalisation->DemeandeColloque->medecin->prenom}}
            </span>
          </td>
          <td><strong>Mode d'entrée :</strong>
            <span>&nbsp;{{ $obj->demandeHospitalisation->modeAdmission }}</span>
          </td> 
        </tr>
      </table>
    </section>
    <br><br><h4>HEBERGEMENT</h4>
    <section class="table solid" style="width:100%;">
      <table>
        <tr>
          <td><strong>&nbsp;Service :</strong>
            <span>&nbsp;{{ $obj->demandeHospitalisation->bedAffectation->lit->salle->service->nom}}</span>
          </td>
          <td><strong>N° de salle :</strong>
            <span>{{ $obj->demandeHospitalisation->bedAffectation->lit->salle->num }}</span>
          </td>
            <td><strong>N° de lit :</strong>
            <span>{{ $obj->demandeHospitalisation->bedAffectation->lit->num }}</span>
          </td> 
        </tr>
      </table>
    </section>
  </div>
  </body>
</html>