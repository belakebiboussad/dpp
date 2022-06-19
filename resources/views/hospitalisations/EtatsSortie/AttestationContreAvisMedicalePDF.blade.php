<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="css/styles.css">
    <title>Attestation contre avis médical</title>
    <style>
      @page {
        margin: 95px 25px;
      }
      .col-2{
        font-size: 12px;
        display: inline-block;
        width: 100%;
        text-align: left;
        padding: 20px 20px 20px 20px; 
      }
      .marge {
        margin-left:5px;
      }
      .borderv {
        border: 1px solid #000; 
      }
       table 
      {
         border-collapse: collapse;
      } 
      table, th, td 
      {
        padding: 5px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div>
      <header><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></header>
      <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
      <main> 
        <hr class="h-1 mtp33"/>
        <div>
         <h3 class="center rect"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3>
        </div><br>
        <section class="borderv">
          <h5 class="center"> <strong>PARTIE A REMPLIR PAR LE PRATICIEN</strong></h5>
        </section>
        <section class="borderv">
          <div class="marge">
            Je soussigné(e), <br>
            Madame, Mademoiselle, Monsieur : <span>{{ $obj->medecin->full_name }}</span><br/><span>
            Docteur en Médecine et exerçant en tant que .................................au sein  de {{ $etab->nom }} ,
            Certifie avoir été informé que {{ $obj->patient->getCivilite()}} {{ $obj->patient->full_name }} actuellement hospitalisé(e) à l'Hôpital refuse les soins proposés et 
            déclare vouloir quitter définitivement l'établissement le  {{ $date}}
              à :............................heures </span><br>
            Le :  {{ $date }} <strong>J'ai personnellement informé de manière claire, précise et compréhensible le patient des risques médicaux qu'il encours et des alternatives thérapeutiques dégradées.</strong><br><br>
            <span>En conséquence, je déclare que ni mes responsabilités civiles et pénales et celles de l'établissement ne pourront être engagées si les risques exposés au patient se réalisaient.</span>
            <br><br>
            <table>
              <tr>
                <td>Fait à EHSN, le {{ $date }}</td>
                <td></td>
                <td>Signature</td>
              </tr>
            </table>
           <br><br>
          </div>
        </section>
        <br>
        <section class="borderv">
          <h5 class="center"><strong>PARTIE A REMPLIR PAR LE PATIENT</strong></h5>
        </section>
        <section class="borderv"> 
        <div class="marge">
          Je soussigné(e), <br>
          {{ $obj->patient->getCivilite() }} {{ $obj->patient->getCivilite()}} {{ $obj->patient->full_name }} actuellement hospitalisé(e) à l'Hôpital refuse les soins proposés et déclare vouloir 
          quitter définitivement l'établissement le  {{ $date }}
          à :............................heures </span><br>
          <span>
            Je reconnais avoir été informé(e) de manière claire, précise et compréhensible par le Docteur exerçant
            dans l'établissement, des risques médicaux encourus du fait de ce refus de soins et de cette sortie contre
            avis médical. 
          </span><br>
          <strong>
            Je reconnais que cette décision est prise selon ma propre volonté et qu'elle va à l'encontre de
            l'avis du Médecin. 
          </strong><br>
          <span>En conséquence, je reconnais que ni les responsabilités civiles et pénales du Médecin et de l'établissement
                ne pourront être engagées si les risques qui m'ont été exposés se réalisaient.
          </span><br>
          <strong>Je maintiens néanmoins ma décision.</strong>
          <br><br>
          <table>
            <tr>
              <td>Fait à EHSN, le {{ $date }}</td>
              <td></td>
              <td>Signature</td>
            </tr>
          </table>
          <br><br>
        </div>
        </section>
        </main>
        </div>
    </body>
  </html>