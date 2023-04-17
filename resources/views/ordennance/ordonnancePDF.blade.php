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
      <div class="right mtp20"><b>Alger le :</b><span> {{ $ordonnance->Consultation->date->format('d/m/Y') }}</span></div>
      <div class="mtP10p">
        <b>Médecin prescripteur :</b> {{ $ordonnance->Consultation->medecin->full_name}}
      </div>
      <div>
        <b>Patient(e) :</b> 
        <b>{{ $ordonnance->Consultation->patient->getCivilite() }} </b> 
          {{ $ordonnance->Consultation->patient->full_name }} ,
          {{ $ordonnance->Consultation->patient->age }} ans,{{ $ordonnance->Consultation->patient->Sexe }}<br>
            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($ordonnance->Consultation->patient->IPP, 'C128')}}" alt="barcode" /><br>
          <b>IPP :</b>{{ $ordonnance->Consultation->patient->IPP }}
      </div>
      <div class="row"><h3 class="center"><b>ORDONNANCE</b></h3></div><br><br>
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
          <div class="right"><span><b>Docteur :</b> {{ Auth::user()->employ->full_name }}</span></div>
        </div>
      </div>
    </main>   
  </body>
</html>
