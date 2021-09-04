<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <title>Certificat medical</title>
    <style type="text/css" media="screen">
     	@page {
          margin: 100px 25px;
      }
		</style>		
  </head>
  <body>
        <header>
           <div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div>
        </header>
        <footer>
          <img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/>
        </footer>
        <main><br><br><br>	
      	  <hr class="hr-1"/>
      		<div class="center"><h3><strong>{{ $etat->nom }}</strong></h3></div><br>
      		<div><strong>Service : </strong>{{ $obj->docteur->Service->nom }}</div>
      		<div>
      			<strong>Chef de Servise : </strong>{{ $obj->docteur->Service->responsable->nom }} &nbsp;
        		{{ $obj->docteur->Service->responsable->prenom }}
      		</div><br><br><br><br>
        	<div>
	          <p class="espace">
	           Je soussigné, Dr <strong>{{ $obj->docteur->nom }} {{ $obj->docteur->prenom }}</strong>
	           Docteur en  <strong> {{ $obj->docteur->Specialite->nom }}</strong>,
	          </p>
	          <p>
	          certifie avoir examiné ce <strong>{{ (\Carbon\Carbon::parse($obj->Date_Consultation))->format('d/m/Y') }}</strong>
	            <strong> {{ $obj->patient->getCivilite() }} </strong>
	            <strong>{{ $obj->patient->Nom }} &nbsp;{{ $obj->patient->Prenom }}</strong> né(e) le  <strong> {{  (\Carbon\Carbon::parse($obj->patient->Dat_Naissance))->format('d/m/Y') }} </strong>
	            et avoir constaté, Ce jour {{ $obj->Resume_OBS }}
	          </p>
	        </div>
	        <div class="sign">Date : {{ $date }}</div>
	        <div class="footer">
	          <div class="textCenter">Certificat fait pour servir et valoir ce que de droit sur la demande de l'intéréssé et remise en mains propre
	          </div>
	        </div>
       	</main>
  </body>
 </html>