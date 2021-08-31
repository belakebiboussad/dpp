<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <title>>Résumé standard de sortie</title>
    <style type="text/css" media="screen">
      @page {
          margin: 100px 25px;
      }
      table 
    {
        border-collapse: collapse;
    }
    table, th, td 
    {
        border: 1px solid black;
        padding: 5px;
    }
    .rectangle {
        width:90%;
        height:30px;/*background:#ccc;*/
        border:3px solid black;
        position: relative;
        line-height: 20px;
        padding-top: 5px;
        text-align: center;
      }
    </style>    
  </head>
  <body>
    <div class="container-fluid">
      <header>
        <div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div>
      </header>
      <footer>
        <img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/>
      </footer>
      <main> <!-- Wrap the content of your PDF inside a main tag -->
        <br><br><br>  
        <hr class="hr_1"/>
        <div class="rectangle">
          <h3 class="center"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3>
        </div><!-- / -->
      </main>

    </div>
  </body>
</html>  