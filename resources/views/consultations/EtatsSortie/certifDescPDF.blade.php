<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CETIFICAT MEDICAL DESCRIPTIF</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
      @page {
          margin: 20px 100px 80px 40px;
      }
      .container {
        justify-content: center;
      }
      .rectangle {
        border:3px solid black;
        width:60%; 
        height:55px;
        padding: 10px;
        border-radius:10px;
        background: #fff;
        font-weight: bold;
        margin: 0 auto;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="mt-12 right"><h4 class="center">REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE</h4></div><br>
      <div><p class="lh-1"><br>
        <h5>MINISTERE DE L'INTERIEUR ET DES COLLECTIVITES LOCALES</h5>
        <h5>{{ $etab->tutelle }}</h5>
        <h5>SERVICE CENTRALE DE LA SANTE DE L'ACTION SOCIALE ET DES SPORTS</h5><h5>{{ $etab->nom }}</h5>
        </p> 
      </div><div class="right"><b>Alger le</b> : {{ $today }}</div><br><br>
      <div class="rectangle"><h3><u>CETIFICAT MEDICAL DESCRIPTIF</u></h3></div><br>
    <div class="espace">
      <h5><b>Nom :</b> {{ $certif->consultation->patient->Nom }}</h5>
      <h5><b>PRENOM :</b> {{ $certif->consultation->patient->Prenom }}</h5>
      <h5><b>DATE DE NAISSANCE :</b> {{ $certif->consultation->patient->Dat_Naissance->format('d/m/Y') }}</h5>
    </div><br>
    <div class="tab">
    je soussigné(e), Docteur {{ $certif->consultation->medecin->full_name }}, avoir examiné le sus nommé qui présente :
    </div><br><div>{{$certif->examen}}</div><br>
    <div><span>{{ ($certif->isChronic) ? "Il s'agit d'une maladie chronique." :''}}</span></div>
    <div class="footer"><div class="center">Certificat établit pour servir et valoir ce que de droit.</div>
    </div>
  </div>
  </body>
</html>