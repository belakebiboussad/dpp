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
   
    </style>
  </head>
  <body>
   @include('partials.etatHeader')
     <h3 class="text-uppercase center mt-10"><span style="font-size: xx-large;"><strong><u>{{ $etat->nom}}</u></strong></span></h3>
    <br><br> 
    <section class="table solid" style="width:100%;">
     <table>
        <tr>
            <td colspan="2"><strong>N° :</strong><span>{{ $obj->id }}</td>
            <td><strong>Date Admission :</strong><span>&nbsp;{{  (\Carbon\Carbon::parse($obj->date_RDVh))->format('d/m/Y') }}</span></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td><strong>Service :</strong><span>{{ $obj->demandeHospitalisation->bedAffectation->lit->salle->service->nom}}</span></td>
          <td><strong>Salle :</strong><span>{{ $obj->demandeHospitalisation->bedAffectation->lit->salle->num }}</span></td>
          <td><strong>Lit :</strong><span>{{ $obj->demandeHospitalisation->bedAffectation->lit->num }}</span></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td><strong>Nom :</strong><span>{{ $patient->Nom}}</span></td>
          <td><strong>Prenom :</strong><span>{{ $patient->Prenom }}</span></td>
            @if(($patient->situation_familiale == "M") && ( $patient->Type == "1") )
          <td><strong>Epoux(se)  :</strong><span>{{ $patient->assure->Nom }} &nbsp; {{ $patient->assure->Prenom }} </span></td>
        @endif
        </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
         <tr>
          <td><strong>Genre :</strong><span>{{ $patient->Sexe }}</span></td>
          <td><strong>Né(e) le :</strong><span>{{ $patient->Dat_Naissance }}</span></td>
          <td><strong>Né(e) à :</strong><span>{{ $patient->lieuNaissance->nom_commune }}</span></td>
        </tr> 
      </table>
    </section><br>  <br>
 
  </body>
</html>