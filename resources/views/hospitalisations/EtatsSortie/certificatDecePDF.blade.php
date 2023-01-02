<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="css/styles.css">
    <title>CERTIFICAT DE DECES </title>
    <style>
      @page {
        margin: 95px 25px;
      }
    </style>
  </head>
  <body>
    <header><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></header>
    <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
      <main> 
        <hr class="h-1 mtP40"/>
        <div> <h2 class="center rect"><b>{{ $etat->nom}}</b></h2></div><br>
        <section class="mtp20"> 
          <div class="tab">
              Je soussigné(e) docteur {{ $dece->Medecin->full_name }},
           médecin en service  à l'hôpital l'{{ $etab->nom }} certifie le ou la nommé(e)
           {{ $obj->patient->full_name}} né le {{ $obj->patient->Dat_Naissance->format('d/m/Y') }} admis le  {{\Carbon\Carbon::parse($obj->date)->format('d/m/Y') }}
           est décédé(e) le {{ \Carbon\Carbon::parse($dece->date)->format('d/m/Y') }} à {{ $dece->heure }}
           des suites de {{ $dece->cause }}
          </div>
        </section>
        <div class="mtp33 tab">
          En foi de quoi, je délivre le présent certificat pour servir et valoir ce que de droit. 
        </div>
        <div class="row sign"><span>{{ $etab->acronyme}}, Le : {{ $date }}</span></div>
      </main>
  </body>
  </html>
