<html>
<head>
  <title>Demande examens biologiques</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
  <style type="text/css">
    table 
    {
        border-collapse: collapse;
    }
    table, th, td 
    {
        border: 1px solid black;
        padding: 5px;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <h2 class="mt-20 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h2>
  <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
  <h4 class="center">Chemin des Glycines - ALGER</h4>
  <h4 class="center">Tél : 23-93-34</h4> {{-- {{ storage_path('app/public/logo.png') }} --}}
  <h5 class="mt-15 center" ><img src="img/logo.png" style="width: 60px; height: 60px" alt="logo"/></h5>
  <h5 class="mt-20 center">
    <span style="font-size: xx-large;"><strong>Demande d'examens radiologiques</strong></span>
  </h5> 
  <br><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-droite"><b><u>Fait le:</u></b> {{ $demande->consultation->Date_Consultation  }} </div>
      </div>
    </div>
  </div>
  <br><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-gauche">
          <b><u>Patient(e) :</u></b> 
          <b> {{ $demande->consultation->patient->getCivilite() }} </b> 
          {{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }},&nbsp;
          {{ $demande->consultation->patient->getAge() }} ans,{{ $demande->consultation->patient->Sexe }}
        </div>
      </div>
    </div>
  </div>
  <br><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-gauche">
            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($demande->consultation->patient->IPP, 'C128')}}" alt="barcode" />
            <br>{{ $demande->consultation->patient->IPP }}
         </div>
      </div>
    </div>
  </div>
  <br><br><br>
  <div class="content">
    <div class="col-sm-12">
      <div class="col-xs-12 widget-container-col" id="consultation">
        <div class="widget-box" id="infopatient">
          <div class="widget-body">
            <div class="widget-main">
              <div class="row">
                <div class="col-xs-12">
                  <br>
                  <div>
                    <label for="infosc"><b>Informations cliniques pertinentes</b> </label>
                    <textarea class="form-control" id="infosc" name="infosc" >{{ $demande->InfosCliniques }}</textarea>
                  </div>                    
                  <br>                  
                  <div>
                    <label for="infos"><b>Informations supplémentaires pertinentes</b></label>
                    <textarea class="form-control" id="infosc" name="infosc" >{{ $demande->Explecations }}</textarea> 
                  </div>              
                  <br>
                  <div>
                      <label><b>Informations supplémentaires pertinentes</b></label>
                      <div>
                        <ul class="list-inline">
                            @foreach($demande->infossuppdemande as $index => $info)
                                <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                            @endforeach
                        </ul>    
                      </div>
                  </div>
                  <div>
                    <label><b>Examen(s) proposé(s)</b></label>
                    <div>
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th class="center" width="10%">#</th>
                            <th class="center"><strong>Nom</strong></th>
                            <th class="center"><strong>Type</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($demande->examensradios as $index => $examen)
                          <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td>{{ $examen->nom }}</td>
                            <td>
                              <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
                              @foreach($exams as $id)
                              <span class="badge badge-success">{{ App\modeles\exmnsrelatifdemande::FindOrFail($id)->nom}}</span>
                              @endforeach
                            </td>
                          </tr>
                         @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div><!-- .row -->
          </div>  
        </div>
      </div>
  </div>
  </div>
  </div>
  <div class="row foo">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-droite">
          <span><strong> Docteur :</strong> {{ Auth::user()->employ->nom }} {{ Auth::user()->employ->prenom }}</span>
        </div>
      </div>
    </div>
  </div>
</div><!-- container-fluid -->
</body>
</html>