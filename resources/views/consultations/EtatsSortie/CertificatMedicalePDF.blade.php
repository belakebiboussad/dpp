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
      table.head, table.head thead{border:none;}
      table.head thead tr th{padding:1px 0;}
      table.head tr th, table.head tr td {text-align:left;}
      table.head tbody tr td{text-align:left;}
      table.head tbody tr td{padding:2px 0 2px 45px; padding-bottom: :  2px;}
      table.head tbody tr td.first{padding:2px 0;width:50%;padding-bottom:  2px;}
      table{border-collapse: collapse;text-align:center;border:1px solid #000;}
      thead {border-top:1px solid #000;}
      thead tr th, tbody tr td{padding:8px 0;font-size:14px;}
      thead tr th{border-left:0px solid #000;}
      tbody tr td{border-left:0px solid #000;}
      thead tr th.first, tbody tr td.first{text-align:left;}
    </style>
    </head>
    <body>
      <div class="container-fluid" id="myDiv">
        @include('partials.etatHeader')
        <hr class="mt-10"/>
        <div class="row mt-30"><div class="center"><h3><strong>{{ $etat->nom }}</strong></h3></div></div><br>
        <div class="row"><div class="sec-droite">Le  {{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</div> </div>
        <div class="row"><div><strong>Service : </strong>{{ $obj->docteur->Service->nom }}</div></div>
        <div class="row"><div><strong>Chef de Servise : </strong>{{ $obj->docteur->Service->responsable->nom }} &nbsp;
          {{ $obj->docteur->Service->responsable->prenom }}</div>
        </div>
        <br><br>
        <div class="row">
          <p class="espace">
           Je soussigné , <strong>{{ $obj->docteur->nom }} {{ $obj->docteur->prenom }}</strong>
           Docteur en  <strong> {{ $obj->docteur->Specialite->nom }}</strong>,
          </p>
          <p>
            <strong>certifie avoir examiné {{ $obj->patient->getCivilite() }} </strong>
            <strong>{{ $obj->patient->Nom }} &nbsp;{{ $obj->patient->Prenom }}</strong> né(e) le{{  (\Carbon\Carbon::parse($obj->patient->Dat_Naissance))->format('d/m/Y') }}
        </div>
        <div class="row">
          <div class="col-sm-12"><span style="padding-top: 10px;">
            Presente {{ $obj->Diagnostic }}
          </div>
        </div>
         <div class="row"><div class="col-sm-12"><span style="padding-top: 10px;">  le patient {{ $obj->Resume_OBS }}</div></div><br>      
    </body>
  </html>