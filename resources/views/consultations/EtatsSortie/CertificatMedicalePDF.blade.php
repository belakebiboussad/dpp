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
			header {
          position: fixed;
          top: -60px;
          left: 0px;
          right: 0px;
          height: 50px;
          color: white;
          text-align: center;
          line-height: 35px;
      }
      footer {
          position: fixed; 
          bottom: -60px; 
          left: 0px; 
          right: 0px;
          height: 35px; 

          /** Extra personal styles **/
          /*color: white;*/
          text-align: center;
          line-height: 35px;
      }
    </style>		
  </head>
  <body>
    <!-- Define header and footer blocks before your content -->
        <header>
           <div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div>
        </header>
        <footer>
          <img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        		<br><br><br>	
        	  <hr />
        		<div class="row"><div class="center"><h3><strong>{{ $etat->nom }}</strong></h3></div></div><br>
        		<div class="row"><div><strong>Service : </strong>{{ $obj->docteur->Service->nom }}</div></div>
        		<div class="row"><div><strong>Chef de Servise : </strong>{{ $obj->docteur->Service->responsable->nom }} &nbsp;
          		{{ $obj->docteur->Service->responsable->prenom }}</div>
        		</div>
       	</main>
  </body>
 </html>