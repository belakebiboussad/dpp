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
      @include('partials.etatHeader')
      <h3 class="center mt-10"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3><!-- mt-20,mt-5 -->
      <div class="sec-droite"><strong>FAIT LE :</strong><span>{{ $date }}</span></div><br>
      <div><strong>Cher confrère,</strong></div><br><br>
      <div>
        <strong>Votre patient (e) : {{ $obj->patient->getCivilite() }}</strong>
        <span>{{ $obj->patient->Nom }} &nbsp;{{ $obj->patient->Prenom}}</span>.
      </div><br>
      <div>
        <strong>Né le :</strong><span>{{ $obj->patient->Dat_Naissance }} </span>
      </div><br>
      <div>
        <strong>A été hospitalisé(e) dans le service de : </strong>
        <span>{{ $obj->admission->rdvHosp->demandeHospitalisation->Service->nom }}</span>
      </div><br>
      <div>
        <strong>Date d’hospitalisation :</strong>
        <span>{{ $obj->Date_entree }}</span><strong>&nbsp;Au&nbsp;</strong><span>{{ $obj->Date_Sortie }}</span>
      </div><br>
      <div>
        <strong>Mode d’admission :</strong>
        <span>{{ $obj->admission->rdvHosp->demandeHospitalisation->modeAdmission }}</span>
      </div><br>
      <div>
        <strong>Motif d’hospitalisation :</strong>
        <span>{{ $obj->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->observation }}</span>
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
      <div>
        <strong>Allergie :</strong>
        <span>{{ $obj->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->observation }}</span>
      </div><br>
      <div>
        <strong>Traitement d’entrée :</strong>
        <span>Neon</span>
      </div><br>
      <div class="rectangle center"><strong>PRISE EN CHARGE HOSPITALIERE</strong></div><br>
      <div>
        <strong>Histoire de la maladie :</strong>
        <span>{{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->histoire_maladie }}</span>
      </div><br>
      <div>
        <strong>Examen clinique :</strong><br><br>
        <span>
          @if($obj->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques)
          <ul class="list-unstyled spaced">
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;"><strong>Taille : </strong><span class="badge badge-pill badge-primary"> {{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->taille }}</span></span>&nbsp;(m)</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;"><strong>Poids :</strong><span class="badge badge-pill badge-danger"> {{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->poids  }}</span></span>&nbsp;(kg)</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">IMC : <span class="badge badge-pill badge-danger"> {{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->IMC  }}</span></span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Températeur : {{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->temp  }}</span>&nbsp;&deg;C</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Autre : {{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->autre  }}</span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Etat Géneral du patient  :</span><span>{{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->Etat  }}</span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Peau et phanéres  : {{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->peaupha  }}</span>&nbsp;</li>
          </ul>
        </span>
        @else
          <span>sans particularité.</span>
        @endif  
        </span>
      </div><br>
      <div>
        <strong>Evolution :</strong>
        <span>{{ $obj->etatSortie }}</span>
      </div><br>
      <div>
        <strong>Conclusion :</strong>
        <span>{{ $obj->resumeSortie }}</span>
      </div><br>
    </div>
  </body>
</html>