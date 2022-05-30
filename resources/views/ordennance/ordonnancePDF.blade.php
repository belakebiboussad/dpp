<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css"> 
    <title>ORDONNANCE</title>
     <style type="text/css" media="screen">
      @page { margin: 100px 25px; }
      ol.list {list-style-type: decimal;}
    </style>
  </head>
  </head>
  <body>
    <header>
       <div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div>
    </header>
    <footer>
      <img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/>
    </footer>
    <main>
      <div class="sec-droite mtP10p"><strong>Alger le :</strong><span>{{ \Carbon\Carbon::parse($ordonnance->date)->format('d/m/Y') }}</span></div>
      <br><br><br><br><br><br>
      <div class="col-sm-6">
        <strong>Médecin prescripteur :</strong>{{ $ordonnance->consultation->medecin->full_name}}
      </div>
      <div class="col-sm-12">
        <b>Patient(e) :</b> 
        <b>{{ $ordonnance->consultation->patient->getCivilite() }} </b> 
          {{ $ordonnance->consultation->patient->full_name }} ,
          {{ $ordonnance->consultation->patient->age }} ans,{{ $ordonnance->consultation->patient->Sexe }}<br>
            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($ordonnance->consultation->patient->IPP, 'C128')}}" alt="barcode" /><br>
          <strong>IPP :</strong>{{ $ordonnance->consultation->patient->IPP }}
      </div>
      <div class="row">
        <h6 class="center"><span style="font-size: xx-large;"><strong>ORDONNANCE</strong></span></h6>
      </div><br><br>
      <div class="col-sm-12 ml-4"><br>
          <ol class="list">
            @foreach($ordonnance->medicamentes as $index => $med)
            <li>
              {{ $med->Nom_com }} {{ $med->Forme }} &nbsp;&nbsp; {{ $med->Dosage }} 
              <h4>{{ $med->pivot->posologie }}</h4>
            </li><br>
            @endforeach
          </ol>
      </div>
      <div class="row foo">
        <div class="col-sm-12">
          <div class="sec-droite"><span><strong>Docteur :</strong> {{ Auth::user()->employ->full_name }}</span></div>
        </div>
      </div>
    </main>   
  </body>
</html>
