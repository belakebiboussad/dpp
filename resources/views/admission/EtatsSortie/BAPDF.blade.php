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
    <br><h4>IDENTIFICATION PATIENT</h4> <br>
    <section class="table solid" style="width:100%;" > 
      <table >
      <tr><td class="first"><strong>N° Admission :</strong><span>&nbsp;{{ $obj->id }}</span></td></tr>
      <tr>
        <td><strong>Nom :</strong><span>&nbsp;{{ $obj->consultation->patient->Nom }}</span></td>
        <td><strong>Prénom :</strong><span>&nbsp; {{ $obj->consultation->patient->Prenom }}</span></td>
        <td><strong>Genre :</strong><span>&nbsp; {{ $obj->consultation->patient->Sexe }}</span></td>
      </tr>
      <tr>
        <td><strong>Date de Naissance :</strong><span>&nbsp;{{ $obj->consultation->patient->Dat_Naissance }}</span></td>
        <td><strong>Lieu de Naissance  :</strong><span>&nbsp; {{ $obj->consultation->patient->lieuNaissance->nom_commune }}</span></td>
        <td><strong>Code Wilaye :</strong><span>&nbsp; {{ $obj->consultation->patient->lieuNaissance->daira->wilaya->id }}</span></td>
      </tr>
      <tr>
        <td><strong>Situation familliale :</strong><span>&nbsp;{{ $obj->consultation->patient->situation_familiale }}</span></td>
        @if(($obj->consultation->patient->situation_familiale == "M") && ( $obj->consultation->patient->Type == "1") )
        <td><strong>Epoux(se)  :</strong><span>{{ $obj->consultation->patient->assure->Nom }} &nbsp; {{ $obj->consultation->patient->assure->Prenom }} </span></td>
        @endif
      </tr>
      </table>
    </section>
  </div>
  </body>
</html>