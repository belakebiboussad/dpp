<html>
<head>
  <title><b>Demande d'examen biologique</b></title>
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
    <div class="space-12"></div>
    <h5 class="mt-20 center">
      <span style="font-size: xx-large;"><b>Demande d'examen biologique</b></span>
    </h5> 
    <br><br>
    <div class="row">
      <div class="col-sm-12">
        <div class="section">
          <div class="right"><b><u>Fait le:</u></b> {{ $date  }}.</div>
        </div>
      </div>
    </div><br><br>
    <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-gauche">
                <b><u>Patient(e) :</u></b> <b> {{ $patient->getCivilite() }} </b>  {{ $patient->full_name }},&nbsp; {{ $patient->age }} ans,{{ $patient->Sexe }}  
        </div>
      </div>
    </div>
  </div> 
  <br><br>
  <div class="row">
    <div class="col-sm-12">
      <div class="section">
        <div class="sec-gauche">
          <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode" /><br>
          <b>IPP :</b> {{ $patient->IPP }}
        </div>
      </div>
    </div>
  </div>
	<br><br><br><br>
	<div class="row">
    <div class="col-sm-12">
      <label><b> Liste des examens :</b></label><br>
      <ol>
        @foreach($demande->examensbios as $exb)
        <li>{{ $exb->nom }}</li>
        @endforeach
      </ol>
    </div>
  </div>
    <div class="row foo">
    <div class="col-sm-12">
      <div class="section"><div class="right"><span><b> Docteur :</b> {{ $medecin->full_name }}</span></div></div>
    </div>
  </div>
</div>
</body>
</html>