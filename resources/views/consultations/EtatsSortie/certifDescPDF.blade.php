<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lettre d'orientation médicale</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
      @page {/*margin: 20px 50px 80px;*/
          margin: 20px 100px 80px 40px;
      }
      table {
          border-spacing: 0;
          width: 600px;
      }
      table > tbody > tr > td > div {
          margin: 0 auto;
          border: 0px red solid;
      }
      /*  
      .rectangle {
        width:70%;
        height:60px;
        background:#fff;
        border:3px solid black;
        position: relative;
        line-height: 20px;
        padding-top: 5px;
        text-align: center;
        margin: 0;

      }
      */
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
      <div>
        <p class="lh-1">
        <br>
        <h5>MINISTERE DE L'INTERIEUR ET DES COLLECTIVITES LOCALES</h5>
        <h5>{{ $etab->tutelle }}</h5>
        <h5>SERVICE CENTRALE DE LA SANTE DE L'ACTION SOCIALE ET DES SPORTS</h5>
        <h5>{{ $etab->nom }}</h5>
        </p> 
      </div><br>
      <div class="right"><strong>Alger le :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div><br><br>
      <div class="rectangle">
          <h3 >
            <u>CETIFICAT MEDICAL DESCRIPTIF</u>
          </h3>
        </div>
    </div><br>
    <div>
      <strong>NOM :</strong>
    </div>
    </body>
</html>
