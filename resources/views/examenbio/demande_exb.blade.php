<html>
<head>
  <title>Demande examens biologiques</title>
  <meta charset="utf-8">
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
	  @include('partials.etatHeader')
    <h5 class="mt-20 center">
      <span style="font-size: xx-large;"><strong>Demande examens biologiques</strong></span>
    </h5> 
    <br><br>
    <div class="row">
      <div class="col-sm-12">
        <div class="section">
          <div class="sec-droite"><b><u>Fait le:</u></b> {{ $date  }}.</div>
        </div>
      </div>
    </div><br><br>
    <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-gauche">
          <b><u>Patient(e) :</u></b> <b> {{ $patient->getCivilite() }} </b>  
          {{ $patient->Nom }} {{ $patient->Prenom }},&nbsp;
          {{ $patient->getAge() }} ans,{{ $patient->Sexe }}
        </div>
      </div>
    </div>
  </div> 
  <br><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-gauche">
          <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode" />
          <br> {{ $patient->IPP }}
        </div>
      </div>
    </div>
  </div>
	<br><br><br><br>
	<div class="row">
    <div class="col-sm-12">
      <label><b> Liste Des examens :</b></label><br>
      <ol>
        @foreach($demande->examensbios as $exb)
        <li>{{ $exb->nom_examen }}</li>
        @endforeach
      </ol>
    </div>
  </div>
    <div class="row foo">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-droite"><span><strong> Docteur :</strong> {{ Auth::user()->employ->nom }} {{ Auth::user()->employ->prenom }}</span></div>
      </div>
    </div>
  </div>
</div>
</body>
</html>