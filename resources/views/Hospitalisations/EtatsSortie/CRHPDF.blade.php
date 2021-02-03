<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Resume Clinique de Sortie</title>
  <style>
      table 
    {
        border-collapse: collapse;
    }
    table, th, td 
    {
        border: 1px solid black;
        padding: 5px;
    }
    .center
    {
      text-align: center;
    }
    .sec-droite
    {
      float: right;
    }
    .col-sm-12
    {
      margin-bottom: 10px;
    }
    .mt-15{
        margin-top:-15px;
    }
    .mt-20{
      margin-top:-20px;
    }
    tr.noBorder td {
      border: 0;
    }
    .rectangle{
      width:100%;
      height:25px;
      background:#ccc;
    }
    #box {
      fill: orange;
      stroke: black;
    }
  </style>
  </head>
  <body>
    <div class="container-fluid">
      <h2 class="mt-20 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h2>
      <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
      <h4 class="center">Chemin des Glycines - ALGER</h4>
      <h4 class="center">Tél : 23-93-34</h4>
      <h5 class="mt-15 center" ><img src="img/logo.png" style="width: 60px; height: 60px" alt="logo"/></h5>
      <h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>COMPTE RENDU D’HOSPITALISATION</strong></span></h5><br><br>
      <div class="sec-droite"><strong>FAIT LE :</strong><span>{{ $date }}</span></div><br>
      <div><strong>Cher confrère,</strong></div><br><br>
      <div>
        <strong>Votre patient (e) : {{ $hosp->patient->getCivilite() }}</strong>
        <span>{{ $hosp->patient->Nom }} &nbsp;{{ $hosp->patient->Prenom}}</span>.
      </div><br>
      <div>
        <strong>Né le :</strong><span>{{ $hosp->patient->Dat_Naissance }} </span>
      </div><br>
      <div>
        <strong>A été hospitalisé(e) dans le service de : </strong>
        <span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}</span>
      </div><br>
      <div>
        <strong>Date d’hospitalisation :</strong>
        <span>{{ $hosp->Date_entree }}</span><strong>&nbsp;Au&nbsp;</strong><span>{{ $hosp->Date_Sortie }}</span>
      </div><br>
      <div>
        <strong>Mode d’admission :</strong>
        <span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->modeAdmission }}</span>
      </div><br>
      <div>
        <strong>Motif d’hospitalisation :</strong>
        <span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->observation }}</span>
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
            @foreach ($hosp->patient->antecedants as $ant)
              <tr>
                <td>{{ $ant->Antecedant }}</td>
                <td>{{ $ant->typeAntecedant ? 'Physiologiques' : 'pathologiques' }}</td>  
                <td>{{ $ant->descrioption}}</td>
                <td>{{ $ant->date}}</td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div><br>
      <div>
        <strong>Allergie :</strong>
        <span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->observation }}</span>
      </div><br>
      <div>
        <strong>Traitement d’entrée :</strong>
        <span>Neon</span>
      </div><br>
      <div class="rectangle center"><strong>PRISE EN CHARGE HOSPITALIERE</strong></div><br>
      <div>
        <strong>Histoire de la maladie :</strong>
        <span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->histoire_maladie }}</span>
      </div><br>
      <div>
        <strong>Examen clinique :</strong><br><br>
        <span>
          @if($hosp->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques)
          <ul class="list-unstyled spaced">
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;"><strong>Taille : </strong><span class="badge badge-pill badge-primary"> {{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->taille }}</span></span>&nbsp;(m)</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;"><strong>Poids :</strong><span class="badge badge-pill badge-danger"> {{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->poids  }}</span></span>&nbsp;(kg)</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">IMC : <span class="badge badge-pill badge-danger"> {{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->IMC  }}</span></span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Températeur : {{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->temp  }}</span>&nbsp;&deg;C</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Autre : {{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->autre  }}</span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Etat Géneral du patient  :</span><span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->Etat  }}</span>&nbsp;</li>
            <li><i class="message-star ace-icon fa fa-star orange2"></i><span style="font-size:15px;">Peau et phanéres  : {{ $hosp->admission->rdvHosp->demandeHospitalisation->consultation->examensCliniques->peaupha  }}</span>&nbsp;</li>
          </ul>
        </span>
        @else
          <span>sans particularité.</span>
        @endif  
        </span>
      </div><br>
      <div>
        <strong>Evolution :</strong>
        <span>{{ $hosp->etatSortie }}</span>
      </div><br>
      <div>
        <strong>Conclusion :</strong>
        <span>{{ $hosp->remumeSortie }}</span>
      </div><br>
    </div>
  </body>
</html>