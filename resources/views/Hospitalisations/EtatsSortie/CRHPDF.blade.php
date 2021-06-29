<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="css/styles.css">
  <title>Resume Clinique de Sortie</title>
  <style>
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
    <div class="container-fluid">
       @include('partials.etatHeader1')
      <h3 class="center"><span><strong>{{ $etat->nom}}</strong></span></h3>
      <div class="sec-droite"><strong>Alger LE :</strong><span>{{ $date }}</span></div><br>
      <div>
        <strong>Nom et Prénom du patient(e) : {{ $obj->patient->getCivilite() }}</strong>
        <span>{{ $obj->patient->Nom }} &nbsp;{{ $obj->patient->Prenom}}</span>.
      </div><br>
      <div>
        <strong>Né le :</strong><span>{{ $obj->patient->Dat_Naissance }} </span>
      </div><br>

      <div>
        <strong>Motif d’hospitalisation :</strong>
        <span>{{ $obj->admission->demandeHospitalisation->DemeandeColloque->observation }}</span>
      </div><br>
      <div class="rectangle center"><strong>INFORMATION PATIENT</strong></div>
      <div><br>
        <strong>Antécédent :</strong>
        <table width="100%">
          <thead>
            <tr>
              <th>type</th>
              <th>physio/pathol</th>
              <th>decription</th>
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
      <div class="rectangle center"><strong>PRISE EN CHARGE HOSPITALIERE</strong></div><br>
      <div>
        <strong>Examen clinique :</strong><br><br>
        <span>
          @if($obj->admission->demandeHospitalisation->consultation->examensCliniques)
          <ul class="list-unstyled spaced">
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;"><strong>Taille : </strong><span class="badge badge-pill badge-primary"> {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->taille }}</span></span>&nbsp;(m)</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;"><strong>Poids :</strong><span class="badge badge-pill badge-danger"> {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->poids  }}</span></span>&nbsp;(kg)</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">IMC : <span class="badge badge-pill badge-danger"> {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->IMC  }}</span></span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Températeur : {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->temp  }}</span>&nbsp;&deg;C</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Autre : {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->autre  }}</span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Etat Géneral du patient  :</span><span>{{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->Etat  }}</span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Peau et phanéres  : {{ $obj->admission->demandeHospitalisation->consultation->examensCliniques->peaupha  }}</span>&nbsp;</li>
          </ul>
        </span>
        @else
          <span>sans particularité.</span>
        @endif  
        </span>
      </div><br>
      <div>
        <strong>Diagnostic :</strong>
        <span>{{ $obj->diagSortie }}</span>
      </div><br>
      <footer class= "center">
        <div class="sec-droite"><span><strong>Respectueusement Dr :</strong> {{ $obj->medecin->nom}} {{ $obj->medecin->prenom}}</span></div>
      </footer>
    </div>
  </body>
</html>