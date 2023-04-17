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
  <main><br><br>
  <div class="center mtP40 ft20">Demande d'examen radiologique</div><br>
  <div class="row"><div class="section"><div class="right"><b><u>Fait le:</u></b>
    {{ $demande->imageable->date->format('d/m/Y') }}</div></div>
  </div>
  <div class="row">
    <div>
      <div class="section">
        <div class="sec-gauche">
          <b><u>Patient(e) :</u></b><b> {{$demande->imageable->patient->getCivilite() }} </b> 
          {{ $demande->imageable->patient->full_name }}, {{ $demande->imageable->age }} ans, {{ $demande->imageable->Sexe }}     
        </div>
      </div>
    </div>
  </div><br>
  <div class="row">
    <div>
      <div class="section">
        <div class="sec-gauche">
          <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($demande->imageable->patient->IPP, 'C128')}}" alt="barcode" /><br><b>IPP :</b>{{ $demande->imageable->patient->IPP }}
         </div>
      </div>
    </div>
  </div>
  <br>
  <div class="content">
    <div class="col-sm-12">
      <div class="col-xs-12 widget-container-col">
        <div class="widget-box">
          <div class="widget-body">
            <div class="widget-main">
              <div class="row">
                <div class="col-xs-12"><br>
                  <div>
                    <label><b>Informations cliniques pertinentes :</b></label>
                    <p>{{ $demande->InfosCliniques }}</p>
                  </div>                    
                  <br>                  
                  <div>
                    <label><b>Explication de la demande de diagnostic :</b></label>
                    <p>{{ $demande->Explecations }}</p> 
                  </div>              
                  <br>
                  <div><label><b>Informations supplémentaires pertinentes</b></label>
                    <div>
                      @foreach($demande->infossuppdemande as $index => $info)
                        <span>{{ $info->nom }}{{(! $loop->last) ? ', ' : '' }}</span>
                      @endforeach
                      </div>
                  </div>
                  <div><label><b>Examen(s) proposé(s)</b></label>
                    <div>
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="center" width="10%">#</th><th class="center">Nom</th>
                            <th class="center">Type</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($demande->examensradios as $index => $examen)
                          <tr>
                            <td class="center">{{ $index + 1 }}</td>
                            <td>{{ $examen->Examen->nom }}</td><td class="center">{{ $examen->Type->nom }}</td>
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
  <div class="foo"><div>
    <div class="section"><div class="right"><span><b> Docteur :</b> {{ Auth::user()->employ->full_name }}</span></div></div>
  </div></div>
</main>
</div>
</body>
</html>