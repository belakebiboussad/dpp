<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <title>Certificat medical</title>
      <style>
      .espace{
         margin-left:6em
      }
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
          padding-top: 72px;
          padding-bottom: 72px ;
        }
      }
      span {
        display: inline-block;/*padding:6px 0;font-size:16px;*/
      } 
  
    </style>
    </head>
    <body>
      <div class="container-fluid" id="myDiv">
        @include('partials.etatHeader')
        <hr class="mt-10"/>
        <div class="row mt-30"><div class="center"><h3><strong>{{ $etat->nom }}</strong></h3></div></div><br>
        <div class="row"><div><strong>Service : </strong>{{ $obj->docteur->Service->nom }}</div></div>
        <div class="row"><div><strong>Chef de Servise : </strong>{{ $obj->docteur->Service->responsable->nom }} &nbsp;
          {{ $obj->docteur->Service->responsable->prenom }}</div>
        </div>
        <br><br><br><br>
        <div class="row">
          <p class="espace">
           Je soussigné , <strong>{{ $obj->docteur->nom }} {{ $obj->docteur->prenom }}</strong>
           Docteur en  <strong> {{ $obj->docteur->Specialite->nom }}</strong>,
          </p>
          <p>
            <strong>certifie avoir examiné {{ $obj->patient->getCivilite() }} </strong>
            <strong>{{ $obj->patient->Nom }} &nbsp;{{ $obj->patient->Prenom }}</strong> né(e) le &nbsp;{{  (\Carbon\Carbon::parse($obj->patient->Dat_Naissance))->format('d/m/Y') }}
            et avoir constaté, Ce jour &nbsp {{ $obj->Resume_OBS }}
          </p>
        </div><br><br>
        <div class="row foo">
          <div><strong>Certificat fait pour servir et valoir ce que de droit sur la demande de l'intéréssé et remise en mains propre</strong>
          <div>Le:  {{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</div>
          </div><br>
          <div class="sec-droite">à : {{ $etablissement->nom }}</div>
        </div>
    </body>
  </html>