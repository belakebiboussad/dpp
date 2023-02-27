<html>
<head>
  <title><b>Demande d'examen biologique</b></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/styles.css">
  <style type="text/css" media="screen">
      @page {
          margin: 20px 30px 80px;
      }
      </style>
</head>
<body>
  <div class="container-fluid">
  <div>@include('partials.etatHeader')</div>
  <div class="mt-20"><h2 class="center">Demande d'examen biologique</h2></div><br>
  <div class="section"><div class="right"><b><u>Fait le</u></b> : {{ $demande->imageable->date->format('d/m/Y')  }}.</div></div><div class="section"><br><br></div>
  <div class="section"><div class="sec-gauche">
    <b><u>Patient(e)</u></b> : <b> {{ $demande->imageable->patient->getCivilite() }} </b>  {{ $demande->imageable->patient->full_name }}, {{ $demande->imageable->patient->age }} ans, {{ $demande->imageable->patient->Sexe }}    
    </div>
  </div>
  <div class="section "><div class="sec-gauche mtp20">  
    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($demande->imageable->patient->IPP, 'C128')}}" alt="barcode" /><br>
    <b>IPP :</b> {{ $demande->imageable->patient->IPP }}
   </div>
  </div>
  <div><h3 class="mtP14p tab">Liste des examens :</h3></div>
  <div class ="tab">
     <ol>
      @foreach($demande->examensbios as $key=>$exb)
      <li>{{ $key+1 }} - {{ $exb->nom }}</li>
      @endforeach
    </ol>
  </div>
  </div>
  <div class="foo"><div class="section"><div class="right"><span><b> Docteur :</b> {{ $demande->imageable->medecin->full_name }}</span></div></div></div>
  <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
</body>
</html>