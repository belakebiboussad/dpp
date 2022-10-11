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
    <header><div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div> </header>
    <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
    <main><br><br><br>	
  	  <hr class="hr-1"/>
  		<div class="center"><h3><b>{{ $etat->nom }}</b></h3></div><br>
  		<div><b>Service : </b>{{ $obj->medecin->Service->nom }}</div>
  		<div>
  			<b>Chef de Servise : </b>{{ $obj->medecin->Service->responsable->full_name }}
  		</div><br><br><br><br>
    	<div>
        <p class="espace">
         Je soussigné, Dr <b>{{ $obj->medecin->full_name }}</b>
         Docteur en {{ (isset($obj->medecin->specialite))  ? $obj->medecin->Specialite->nom :  $obj->medecin->Service->Specialite->nom }} ,
        </p>
        <p>
        certifie avoir examiné ce <b>{{ (\Carbon\Carbon::parse($obj->date))->format('d/m/Y') }}</b>
          <b> {{ $obj->patient->getCivilite() }} </b>
          <b>{{ $obj->patient->full_name }}</b> né(e) le  <b> {{  (\Carbon\Carbon::parse($obj->patient->Dat_Naissance))->format('d/m/Y') }} </b>
          et avoir constaté, Ce jour {{ $obj->Resume_OBS }}
        </p>
      </div>
      <div class="sign"><span><b> Date :</b> {{ $date }}</span></div>
      <div class="footer">
        <div class="textCenter">Certificat établit pour servir et valoir ce que de droit sur la demande de l'intéréssé et remise en mains propre
        </div>
      </div>
   	</main>
  </body>
 </html>