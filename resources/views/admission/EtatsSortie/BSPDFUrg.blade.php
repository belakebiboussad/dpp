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
      <br>
     <h3 class="text-uppercase center"><span style="font-size: xx-large;"><strong><u>{{ $etat->nom}}</u></strong></span></h3>
    <br><br> 
    <section class="table solid" style="width:100%;">
     <table>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
            <td colspan="2"><strong>N° :</strong><span>&nbsp;{{ $obj->id }}</td>
            <td><strong>Date d'admission :</strong><span>&nbsp;{{  (\Carbon\Carbon::parse($obj->date_RDVh))->format('d/m/Y') }}</span></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td><strong>Service :</strong><span>&nbsp;{{ $obj->bedAffectation->lit->salle->service->nom}}</span></td>
          <td><strong>Salle :</strong><span>&nbsp;{{ $obj->bedAffectation->lit->salle->num }}</span></td>
          <td><strong>Lit :</strong><span>&nbsp;{{ $obj->bedAffectation->lit->num }}</span></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td><strong>Nom :</strong><span>&nbsp;{{ $patient->Nom}}</span></td>
          <td><strong>Prénom :</strong><span>&nbsp;{{ $patient->Prenom }}</span></td>
            @if(($patient->situation_familiale == "M") && ( $patient->Type == "1") )
          <td><strong>Epoux(se)  :</strong><span>&nbsp;{{ $patient->assure->Nom }} &nbsp; {{ $patient->assure->Prenom }} </span></td>
        @endif
        </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
         <tr>
          <td><strong>Genre :</strong><span>&nbsp;{{ $patient->Sexe }}</span></td>
          <td><strong>Né(e) le :</strong><span>&nbsp;{{ $patient->Dat_Naissance }}</span></td>
          <td><strong>Né(e) à :</strong><span>&nbsp;{{ $patient->lieuNaissance->nom_commune }}</span></td>
        </tr> 
      </table>
    </section><br>  <br>
 
  </body>
</html>