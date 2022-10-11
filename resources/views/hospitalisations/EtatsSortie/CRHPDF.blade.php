<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Compte rendu médical</title>
  <link rel="stylesheet" href="css/styles.css">
  <style>
    @page {
        margin: 95px 25px;
    }
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 5px;
    }
    .rectangle {
      width:100%;
      height:25px;
      background:#ccc;
    }
  </style>
  </head>
  <body>
    <div>
      <header><div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div></header>
      <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
      <main><br><br><br>
        <hr class="h-1"/>
        <h3 class="center"><span style="font-size: xx-large;"><b>{{ $etat->nom}}</b></span></h3>
        <div class="right"><b>Alger le :</b><span>{{ $date }}</span></div>
        <div><br><br><br>
          <b>Nom et Prénom du patient(e) : {{ $obj->patient->getCivilite() }}</b><span>{{ $obj->patient->full_name }}</span>.
        </div>
        <div><b>Né le :</b><span>{{ $obj->patient->Dat_Naissance }}</span></div>
        <div>
          <b>Motif d’hospitalisation :</b>
          <span>
          @if(isset($obj->admission->id_rdvHosp))
            {{ $obj->admission->demandeHospitalisation->DemeandeColloque->observation }}
          @else
            {{ $obj->admission->demandeHospitalisation->consultation->motif }}
          @endif
          </span>
        </div><br>
        <div class="rectangle center"><b>INFORMATION PATIENT</b></div>
        <div><br>
          <b>Antécédent :</b>
          <table width="100%">
            <thead>
            <tr>
              <th>type</th>
              <th>physio/pathol</th>
              <th>description</th>
              <th>date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($obj->patient->antecedants as $ant)
              <tr>
                <td>{{ $ant->Antecedant }}</td>
                <td>{{ $ant->typeAntecedant ? 'Physiologiques' : 'pathologiques' }}</td>  
                <td>{{ $ant->description}}</td>
                <td>{{ $ant->date}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div><br>
          <div class="rectangle center"><b>PRISE EN CHARGE HOSPITALIERE</b></div><br>
      <div>
        <b>Examen clinique :</b><br>
        <span>
          @if($obj->admission->demandeHospitalisation->consultation->examensCliniques)
          <ul class="list-unstyled spaced">
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;"><b>Taille : </b><span class="badge badge-pill badge-primary"> {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->taille }}</span></span>&nbsp;(m)</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;"><b>Poids :</b><span class="badge badge-pill badge-danger"> {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->poids  }}</span></span>&nbsp;(kg)</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">IMC : <span class="badge badge-pill badge-danger"> {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->IMC  }}</span></span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Températeur : {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->temp  }}</span>&nbsp;&deg;C</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Autre : {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->autre  }}</span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Etat Géneral du patient  :</span><span>{{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->Etat  }}</span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Peau et phanéres  : {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->peaupha  }}</span>&nbsp;</li>
          </ul>
        @else
        sans particularité.
        @endif  
        </span>
      </div><br>
      <div><b>Diagnostic :</b><span>{{ $obj->diagSortie }}</span></div><br>
      <div>
        <div class="right"><span><b>Respectueusement</b></span></div><br/><br/>
        <div class="right"><span><b>Dr :&nbsp;</b></span><span>{{ $obj->medecin->full_name}}</span></div>
      </div>
      </main>
    </div>
  </body>
</style>