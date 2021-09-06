<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Compte rendu médical</title>
  <link rel="stylesheet" href="css/styles.css">
  <style>
    @page {
        margin: 95px 25px;
    }
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 5px;
    }
    .rectangle {
      width:100%;
      height:25px;
      background:#ccc;
    }
  </style>
  </head>
  <body>
    <div>
      <header><div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div></header>
      <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
      <main> 
        <div>
          <strong>Nom et Prénom du patient(e) : {{ $obj->patient->getCivilite() }}</strong>
          <span>{{ $obj->patient->Nom }} &nbsp;{{ $obj->patient->Prenom}}</span>.
        </div><br>
        <div><strong>Né le :</strong><span>{{ $obj->patient->Dat_Naissance }}</span></div><br>
        <h3 class="center"><span><strong>{{ $etat->nom}}</strong></span></h3>
      </main>
    </div>
  </body>
</style>