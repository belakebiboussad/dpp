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
	<div>@include('partials.etatHeader') </div>
       <div class="mt-20"><h2 class="center">Demande d'examen biologique</h2></div><br>
      <div class="section"><div class="right"><b><u>Fait le</u></b> : {{ $date->format('d/m/Y')  }}.</div></div>
      <div class="section"><br><br></div>
       <div class="section"><div class="sec-gauche">
       <b><u>Patient(e)</u></b> : <b> {{ $patient->getCivilite() }} </b>  {{ $patient->full_name }}, {{ $patient->age }} ans, {{ $patient->Sexe }}    
        </div></div>
       <div class="section "><div class="sec-gauche mtp20">  
            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode" /><br>
            <b>IPP :</b> {{ $patient->IPP }}
       </div></div>
       <div><h3 class="mtP14p tab">Liste des examens :</h3></div>
       <div class ="tab">
           <ol>
            @foreach($demande->examensbios as $key=>$exb)
            <li>{{ $key+1 }} - {{ $exb->nom }}</li>
            @endforeach
          </ol>
    </div>
     <div class="foo"><div class="section"><div class="right"><span><b> Docteur :</b> {{ $medecin->full_name }}</span></div></div></div>
     <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
</div>
</body>
</html>