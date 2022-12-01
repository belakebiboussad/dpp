<html>
<head>
  <title><b>Demande d'examen(s) radiologique(s)</b></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
  <style type="text/css">
    @page { margin: 100px 25px; }
    table { border-collapse: collapse;  }
    table, th, td { border: 1px solid black; padding: 5px; }
  </style>
</head>
<body>
<div class="container-fluid">{{-- @include('partials.etatHeader') --}}
  <header><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></header>
  <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons"/></footer>
  <main>
<br><br>
  <div class="textCenter mtP40 ft16"><b>Demande d'examen radiologique</b></div>
  <br>
  <div class="row"><div class="col-sm-12"><div class="section"><div class="right"><b><u>Fait le:</u></b>
        {{ (\Carbon\Carbon::parse($date))->format('d/m/Y') }}</div></div></div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="section">
            <div class="sec-gauche">
                  <b><u>Patient(e) :</u></b><b> {{ $patient->getCivilite() }} </b> 
                  {{ $patient->full_name }},&nbsp;
                  {{ $patient->age }} ans,{{ $patient->Sexe }}
            </div>
      </div>
    </div>
  </div><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-gauche">
          {{-- <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode" />--}}
          {{  DNS1D::getBarcodePNG("4445645656", "PHARMA2T")}}
<img src="data:image/png;base64,{{ $barcode->getBarcodePngData(40,40)}}" alt="barcode" />
            <br><b>IPP :</b>{{ $patient->IPP }}
         </div>
      </div>
    </div>
  </div>
  <br>
  <div class="content">
    <div class="col-sm-12">
      <div class="col-xs-12 widget-container-col">
        <div class="widget-box" id="infopatient">
          <div class="widget-body">
            <div class="widget-main">
              <div class="row">
                <div class="col-xs-12"><br>
                  <div>
                    <label for="infosc"><b>Informations cliniques pertinentes :</b> </label>
                    <p>{{ $demande->InfosCliniques }}</p>
                  </div>                    
                  <br>                  
                  <div>
                    <label for="infos"><b>Explication de la demande de diagnostic :</b></label>
                    <p>{{ $demande->Explecations }}</p> 
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
                            <th class="center"><b>Nom</b></th>
                            <th class="center"><b>Type</b></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($demande->examensradios as $index => $examen)
                          <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td>{{ $examen->Examen->nom }}</td>
                            <td class="center">{{ $examen->Type->nom }}</td>
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
      <div class="section"><div class="right"><span><b> Docteur :</b> {{ Auth::user()->employ->full_name }}</span></div></div>
    </div>
  </div>
</main>
</div>
</body>
</html>