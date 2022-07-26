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
      <h3 class="center mt-10"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3>
      <div class="row"><div class="right">Le : {{ $date }}</div> </div>
      <div class="row">
        <table border="0" cellspacing="0" cellpadding="0">
          <tr class="noBorder">
            <td width="206" height="30" >
              <strong>Service :</strong><span> {{ $obj->demandeHospitalisation->Service->nom}}</span>
            </td>
            <td width="230" height="30"></td><td  width="120" height="30" ></td>
          </tr>
          <tr class="noBorder">
            <td  width="206" height="30" >
              <strong>Chef de servise : </strong><span>{{ $obj->demandeHospitalisation->Service->responsable->full_name}}</span>
            </td>
            <td width="230" height="30"></td> <td width="120" height="30" ></td>
          </tr>
        </table>
      </div><br/>
      <div class="row">
        <p class="tab">je soussigné, Docteur  {{$obj->demandeHospitalisation->DemeandeColloque->medecin->full_name}},
         certifie que  {{ $obj->hospitalisation->patient->getCivilite() }} &nbsp;
         <strong> {{ $obj->hospitalisation->patient->full_name }}</strong> à été hospitalisée du {{ $obj->hospitalisation->Date_entree }} au {{ $obj->hospitalisation->Date_Sortie }} en {{ $obj->demandeHospitalisation->Service->nom}}
          pour  {{ $obj->demandeHospitalisation->consultation->motif }}
        </p>
      </div><br><br><br>
      <div class="row foo">
        <div class="col-sm-12"><div class="right"><span><strong> Docteur :</strong> {{ $obj->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->full_name}}</span></div>
        </div>
      </div>
    </div>
    </body>