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
  		<div><strong>Service : </strong>{{ $obj->medecin->Service->nom }}</div>
  		<div>
  			<strong>Chef de Servise : </strong>{{ $obj->medecin->Service->responsable->full_name }}
  		</div><br><br><br><br>
    	<div>
        <p class="espace">
         Je soussigné, Dr <strong>{{ $obj->medecin->full_name }}</strong>
         Docteur en  <strong> {{ $obj->medecin->Specialite->nom }}</strong>,
        </p>
        <p>
        certifie avoir examiné ce <strong>{{ (\Carbon\Carbon::parse($obj->date))->format('d/m/Y') }}</strong>
          <strong> {{ $obj->patient->getCivilite() }} </strong>
          <strong>{{ $obj->patient->full_name }}</strong> né(e) le  <strong> {{  (\Carbon\Carbon::parse($obj->patient->Dat_Naissance))->format('d/m/Y') }} </strong>
          et avoir constaté, Ce jour {{ $obj->Resume_OBS }}
        </p>
      </div>
      <div class="row sign">
        <div class="col-sm-12">
         <span><strong> Date :</strong> {{ $date }}</span>
        </div>
      </div>
      <div class="footer">
        <div class="textCenter">Certificat fait pour servir et valoir ce que de droit sur la demande de l'intéréssé et remise en mains propre
        </div>
      </div>
   	</main>
  </body>
 </html>