<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Ordonnance-{{ $patient->Nom }}-{{ $patient->Prenom }}</title>
  <link rel="stylesheet" href="{{ asset('/css/styles.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/print.css') }}"/>
  <style>
      html {
        height: 100%;
        box-sizing: border-box;
      }
      *,
     *:before,
      *:after {
        box-sizing: inherit;
      }
    
    .body-for-sticky {
      position: relative;
      min-height: 100%;
      padding-bottom: 6rem;
    }
    .sticky-footer {
      position: absolute;
      bottom: 0;
    } 
/* for the rendering */
    body {
      margin: 0;
      font-family: "Helvetica Neue", Arial, sans-serif;
    }
    
    .footer {
      right: 0;
      left: 0;
      padding: 1rem;
      background-color: #efefef;
      text-align: center;
    }
    
    .demo {
      margin: 0 auto;
      padding-top: 64px;
      max-width: 640px;
      width: 94%;
    }
  </style>
</head>

<body class="body-for-sticky">

  <div class="demo">
    <div class="row mt-13 center"><img src='{{ asset("img/entete.png") }}' alt="Entete" width="100%"/></div>
      <div class="pull-right"><strong>Alger le :</strong>&nbsp;{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div><br><br> 
      <div class="row">
        <div class="col-sm-6"><strong>Médecin prescripteur :</strong>{{ $employe->nom}} {{ $employe->prenom}}</div>
      </div>
      <div class="row"><div class="col-sm-12"><span><strong>Patient(e) :</strong></span></div></div>
      <div class="row">
        <div class="col-sm-12 tab-space">
          <h6>
            <strong>Nom :&nbsp;</strong><span>{{ $patient->Nom }}</span>
            <strong>Prenom :&nbsp;</strong><span>{{ $patient->Prenom }}</span>
            <strong>Né(e) le :&nbsp;</strong><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</span>
          </h6>
        </div>
      </div>
      <div class="row">
      <div class="col-sm-12 tab-space">
        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode"/><br>
        IPP :{{ $patient->IPP }}
      </div>
      </div>
      <div class="row">
        <h6 class="center"><span style="font-size: xx-large;"><strong>Ordonnance</strong></span></h6>
      </div><br><br>
      <div class="row">
        <div class="col-sm-12"><br>
          <ol class="c">
            @foreach($medicaments as $i => $value)
              <li>
                <h4>{{ $medicaments[$i]->Nom_com }} {{ $medicaments[$i]->Forme }} &nbsp;&nbsp; {{ $medicaments[$i]->Dosage }}</h4>
                <h5>{{ $posologies[$i] }}</h5>
              </li>
            @endforeach
          </ol>
        </div>
      </div>

  </div>
  <div class="footer sticky-footer">
    <img src='{{ asset("img/footer.png") }}' alt="footer" width="100%"/>
  </div>

</body>
