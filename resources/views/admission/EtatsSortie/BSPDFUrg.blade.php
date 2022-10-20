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
     <h3 class="text-uppercase center"><span style="font-size: xx-large;"><b><u>{{ $etat->nom}}</u></b></span></h3>
    <br><br> 
    <section class="table solid" style="width:100%;">
     <table>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
            <td colspan="2"><b>N° :</b><span>&nbsp;{{ $obj->id }}</td>
            <td><b>Date d'admission :</b><span>&nbsp;{{  (\Carbon\Carbon::parse($obj->date))->format('d/m/Y') }}</span></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td><b>Service :</b><span>&nbsp;{{ $obj->bedAffectation->lit->salle->service->nom}}</span></td>
          <td><b>Salle :</b><span>&nbsp;{{ $obj->bedAffectation->lit->salle->num }}</span></td>
          <td><b>Lit :</b><span>&nbsp;{{ $obj->bedAffectation->lit->num }}</span></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td><b>Nom :</b><span>&nbsp;{{ $patient->Nom}}</span></td>
          <td><b>Prénom :</b><span>&nbsp;{{ $patient->Prenom }}</span></td>
            @if(($patient->situation_familiale == "M") && ( $patient->Type == "1") )
          <td><b>Epoux(se)  :</b><span>&nbsp;{{ $patient->assure->full_name }}</span></td>
        @endif
        </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
         <tr>
          <td><b>Genre :</b><span>&nbsp;{{ $patient->Sexe }}</span></td>
          <td><b>Né(e) le :</b><span>&nbsp;{{ $patient->Dat_Naissance }}</span></td>
          <td><b>Né(e) à :</b><span>&nbsp;{{ $patient->lieuNaissance->nom_commune }}</span></td>
        </tr> 
      </table>
    </section><br>  <br>
  </body>
</html>