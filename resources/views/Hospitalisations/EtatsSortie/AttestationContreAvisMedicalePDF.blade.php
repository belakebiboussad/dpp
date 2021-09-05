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
		  .borderv {
                    border: 1px solid #000; 
              }
	  </style>
  </head>
      <body>
            <div>
                    <header><div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div></header>
                    <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
                    <main> 
                           <br><br>
                          <hr class="h-1"/>
                         <div>
                                 <h3 class="center rect"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3>
                         </div> <br><br>
                          <section class="borderv">
                                 <h5 class="center"> <strong>PARTIE A REMPLIR PAR LE PRATICIEN</strong></h5>
                           </section>
                          <section class="borderv">
                                 Je soussigné(e), <br>
                                 Madame, Mademoiselle, Monsieur : <span>{{ $obj->admission->demandeHospitalisation->DemeandeColloque->medecin->nom }}&nbsp;{{ $obj->admission->demandeHospitalisation->DemeandeColloque->medecin->prenom}}</span><br/><span>
                                 Docteur en Médecine et exerçant en tant que .................................au sein  de {{ $etablissement->nom }} ,
                                 Certifie avoir été informé que {{ $obj->patient->getCivilite()}} {{ $obj->patient->Nom }}&nbsp;{{ $obj->patient->Prenom }} actuellement hospitalisé(e) à l'Hôpital refuse les soins proposés et déclare vouloir quitter définitivement l'établissement le  {{ (\Carbon\Carbon::parse($date))->format('d/m/Y') }}  à :............................heures </span><br>
                                 Le :  {{ (\Carbon\Carbon::parse($date))->format('d/m/Y') }} <strong>J'ai personnellement informé de manière claire, précise et compréhensible le patient des risques médicaux qu'il encours et des alternatives thérapeutiques dégradées.</strong><br>
                                 <span>En conséquence, je déclare que ni mes responsabilités civiles et pénales et celles de l'établissement ne pourront être engagées si les risques exposés au patient se réalisaient. </span> <br>
                                 <span>Fait à EHSN, le {{ (\Carbon\Carbon::parse($date))->format('d/m/Y') }}</span><h5 class="center" >Signature </h5>
                          </section>
                          <br>
                          <section class="borderv">
                              <h5 class="center"><strong>PARTIE A REMPLIR PAR LE PATIENT</strong></h5>
                           </section>
                          <section class="borderv">   
                            </section>

                    </main>
              </div>
      </body>
  </html>