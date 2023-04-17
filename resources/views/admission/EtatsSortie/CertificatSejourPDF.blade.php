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
    <div class="container-fluid">
      @include('partials.etatHeader')
      <h3 class="center mt-10"><span style="font-size: xx-large;"><b>{{ $etat->nom}}</b></span></h3>
      <div class="row"><div class="right">Le : {{ $date }}</div> </div>
      <div class="row">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr class="noBorder">
            <td width="206" height="30" >
              <b>Service :</b><span> {{ $obj->demandeHospitalisation->Service->nom}}</span>
            </td>
            <td width="230" height="30"></td><td  width="120" height="30" ></td>
          </tr>
          <tr class="noBorder">
            <td  width="206" height="30" >
              <b>Chef de servise : </b><span>{{ $obj->demandeHospitalisation->Service->responsable->full_name}}</span>
            </td>
            <td width="230" height="30"></td> <td width="120" height="30" ></td>
          </tr>
        </table>
      </div><br/>
      <div class="row">
        <p class="tab">je soussigné, Docteur  {{$obj->demandeHospitalisation->consultation->medecin->full_name}},
         certifie que  {{ $obj->hospitalisation->patient->getCivilite() }} &nbsp;
         <b> {{ $obj->hospitalisation->patient->full_name }}</b> à été hospitalisée du {{ $obj->hospitalisation->date->format('Y-m-d') }} au {{ $obj->hospitalisation->Date_Sortie->format('Y-m-d') }} en {{ $obj->demandeHospitalisation->Service->nom}}
          pour  {{ $obj->demandeHospitalisation->consultation->motif }}
        </p>
      </div><br><br><br>
      <div class="row foo">
        <div class="col-sm-12"><div class="right"><span><b> Docteur :</b> {{ $obj->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->full_name}}</span></div>
        </div>
      </div>
    </div>
    </body>