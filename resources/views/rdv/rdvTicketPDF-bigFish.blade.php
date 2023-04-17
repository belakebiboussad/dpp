<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/styles.css">
		<style>
			.mb-12{
				margin-bottom: -25px !important;
				padding-bottom:-25px !important;
			}
			#container {
		    display: table;
		  }
			#row  {
		  	display: table-row;
		  }
			#left {
			  display: table-cell;
			  font-size:xx-small; /* padding: 5px;*/
			  margin-top: +4px !important;
				padding-top:+4px !important;
		  }		
		  #parent {
		  	width:100%;
  			height:110px;/*70px*/
  			border: 0.5px solid black !important;
  			border-radius: 5px !important;
  			font-size:xx-small;
  		}
		</style>
	</head>
	<body>
	  <div class="row">
		  <div class="col-sm-12">
		   	<div class="content text-center mt-50">@include('partials.etatHeader-min')</div>
		  </div>
	  </div>
	  <div class="row mt-5">
		  <div class="col-sm-12 content text-center"><div class="col-sm-4"></div>
			 <div class="col-sm-4"><img class = "imgCenter" src="img/{{ $etab->logo }}"/></div><div class="col-sm-4"></div>
			</div>
    </div>
		<div class="row"><hr class ="mt-5"></div>
	  <div class="row">  <div class="col-md-4 col-sm-4 float-left"></div>
	    <div class="col-md-4 col-sm-4 content text-center pt-21">
        <h4><b>Rendez-Vous de Consultation</b></h4>
      </div>		
	  </div><br>	
	  <div class="row mt-10 pt-10">
		  <div class="col-sm-12">Rendez-vous dans la Spécialitè &quot;<b>{{ $rdv->specialite->nom}}</b>&quot;</div>
		</div>
	  <div class="row">
	   	<div class="col-sm-12">
		 	  <b> {{ ( $rdv->fixe) ? "Le" : "A partir du" }}</b><u> {{ $rdv->date->format('d/m/Y') }}</u>
	   	</div>
	  </div>
		<div class="row"><div class="col-sm-12"><b>Nom : </b><span>{{ $rdv->patient->Nom}}</span></div></div>
		<div class="row" >
		  <div class="col-sm-12"><b>Prenom : </b><span>{{ $rdv->patient->Prenom}}</span> </div>
		</div>
		<div id="container" class="mt-2">
		 		<div id ="row">
		 			<div id="left"><img src="<?= $img->encoded ?>"/><br><b>IPP :</b><span>{{ $rdv->patient->IPP }}</span></div>
        </div>
		 		<div id ="parent" class="row mb-12">
		 			<span>&nbsp;Le jour de votre consultation</span>
			 		<ul style="font-size: xx-small;">	
			 			<li>Rapportez ce Ticket	</li>
			 			<li>	Raportez tous les documents Médicaux en votre possession (résultats d'analyses, radiographies,etc.)
			 			</li>
			 			<li>En arrivant à l'hôpital recupéré votre ticket d'ordre depuis la borne.</li>
			 		</ul> 
		 		</div>
		 		</div>
		 	</div>
	</body>
</html>
