<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Certificat medical</title>
      <style>
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
      .center
      {
        text-align: center;
      }
      
      .mt-15{
        margin-top:-15px;
      }
      .mt12{
        padding-top:+12px;
      }
      .mt-20{
        margin-top:-20px;
      }
      .ml-80{
        margin-left: +80%;
      }
      span {
        display: inline-block;
        /*padding:6px 0;*/
       /* font-size:16px;*/
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
        <h4 class="mt12 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h4>
        <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
        <h4 class="center">Chemin des Glycines - ALGER</h4>
        <h4 class="center">Tél : 023-93-34</h4>
        <h5 class="mt-15 center" ><img src="img/logo.png" style="width: 60px; height: 60px" alt="logo"/></h5>
        <h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Certificat medical</strong></span></h5>
        <div class="row"><br><span class="ml-80">Alger le {{ $date}}</span><br><br></div>
        <div class="row"><div class="col-sm-12"><strong>Service : </strong>
          <span>{{ $obj->docteur->Service->nom }}</span> </div>
        </div>
        <div class="row"><div class="col-sm-12"><strong>Chef de servise : </strong>
        <span>{{ $obj->docteur->Service->responsable->nom }}</span></div>
        </div><br>
        <div class="row">
          <div class="col-sm-12"><strong>je soussigné docteur  : </strong>
            <span>{{ $obj->docteur->nom }} {{ $obj->docteur->prenom }}</span>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12"><strong>certifier que {{ $obj->patient->getCivilite() }} : </strong>
          <span>{{ $obj->patient->Nom }}{{ $obj->patient->Prenom }}</span></div>
        </div>
        <div class="row">
          <div class="col-sm-12"><span style="padding-top: 10px;">
            Presente {{ $obj->Diagnostic }}
          </div>
        </div>
         <div class="row">
          <div class="col-sm-12"><span style="padding-top: 10px;">
            le patient {{ $obj->Resume_OBS }}
          </div>
        </div><br>      
    </body>
  </html>