<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="css/styles.css">
    <title></title>
    <style>
      @page {
        margin: 100px 25px;
      }
      header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
      footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    </style>
  </head>
  <body>
  <div class="container-fluid">
    <header><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></header>
    <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
    <main> 
      <hr class="h-1 mtp33"/>
      <div class="textCenter mtP40 ft16"><strong>LETTRE D'ORIENTATION MEDICALE</strong></div>
      <div class="tab-space40 mtp10"><strong>Alger le :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div><br/><br/>
      <div class="sec-gauche">
        <strong>Docteur :</strong> {{ $orient->consultation->medecin->full_name }} &nbsp;&nbsp; 
        <strong>Specialité</strong>:&nbsp;{{ $orient->consultation->medecin->Specialite->nom}}
      </div>
      <br>
      <div>
        <h4>Patient(e) :</strong>&nbsp;{{ $orient->consultation->patient->getCivilite() }}
          {{ $orient->consultation->patient->full_name }},&nbsp;</strong>{{ $orient->consultation->patient->age }} ans
        </h4>
      </div>
      <div class="sec-gauche">
        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($orient->consultation->patient->IPP, 'C128') }}" alt="barcode"/>
        <br><span>IPP:{{ $orient->consultation->patient->IPP }}</span>
      </div><br><br><br><br>
      <div class="sec-gauche">Cher confrére,</div><br><br>
      <div>
        <p class="espace">
         Permettez moi de vous adresser le(la) patient(e) sus-nommé(e), {{ $orient->consultation->patient->full_name }} âgé(e) de {{ $orient->consultation->patient->age }} ans,
        </p> 
        @if($orient->consultation->patient->antecedants != null)
        <p>aux Antcd suivants:
          <ul>
            @foreach($orient->consultation->patient->antecedants as $atcd)
            <li>
              {{ \Carbon\Carbon::parse($atcd->date)->format('d/m/Y') }} -{{ $atcd->Antecedant }} - {{ $atcd->description }},
            </li>
            @endforeach
          </ul>
        </p>
        <p>
          ,qui s'est présenté ce jour pour {{ $orient->motif }}, et dont l'éxamen général du patient retrouve {{ $orient->examen }}.Je vous le confie pour une méilleure prise en charge.
        </p>
        @endif
      </div>
    </main>
  </div>
  </body>
  </html>