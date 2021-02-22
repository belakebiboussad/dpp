<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">{{--   <link href="{{public_path('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />  --}}
   <title>Attestation de Séjour</title>
  <style>
     table {
            border-spacing: 0;
            width: 600px;
        }
     table >  tr > td {
            border: 1px solid black;
            vertical-align: top;
            text-align: center;
        }

        table >  tr > td > div {
            margin: 0 auto;
            border: 0px red solid;
        }
    .center
    {
      text-align: center;
    }
     .mt-12{
      margin-top:-12px;
    }
    .mt-10{
        margin-top:-10px;
    } 
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <h3 class="center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h3>
      <h4 class="mt-10  center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
      <h5 class="mt-10 center">Chemin des Glycines - ALGER</h5>
      <h6 class="mt-10 center">Tél : 023-93-34</h6>
      <h5 class="mt-10 center" ><img src="img/logo.png" style="width: 60px; height: 60px" alt="logo"/></h5>
      <h5 class="mt-10 center"><span style="font-size: xx-large;">
        <strong>Attestation de Séjour</strong></span>
      </h5><br><br>  
      <div class="row">
          <table border="0" cellspacing="0" cellpadding="0">
               <tr class="noBorder">
                     <td rowspan="1" colspan="1" width="206" height="30" >
                      <strong>Service :</strong><span>{{ $obj->demandeHospitalisation->Service->nom}}</span>
                     </td>
                     <td rowspan="1" colspan="1" width="230" height="30"></td>
                      <td  rowspan="1" colspan="1" width="120" height="30" >Le {{ $date }}</td>
                </tr>
                <tr class="noBorder">
                     <td rowspan="1" colspan="1" width="206" height="30" >
                     <strong>Chef de servise : </strong>
                     <span>
                            {{ $obj->demandeHospitalisation->Service->responsable->nom}} &nbsp;
                            {{ $obj->demandeHospitalisation->Service->responsable->prenom}}
                     </span>&nbs;
                     </td>
                     <td rowspan="1" colspan="1" width="230" height="30"></td>
                    <td rowspan="1" colspan="1" width="120" height="30" ></td>
                </tr>
          </table>
      </div>
      <div class="row" >
          je soussigné, Docteur  <span>{{$obj->demandeHospitalisation->DemeandeColloque->medecin->nom}} &nbsp;{{$obj->demandeHospitalisation->DemeandeColloque->medecin->prenom}}</span>,certifie que  {{ $obj->hospitalisation->patient->nom }} &nbsp; {{ $obj->hospitalisation->patient->nom }}
      </div>
      <div class="row" >
       
      </div>
      <br><hr/>
    </div>
    </body>
