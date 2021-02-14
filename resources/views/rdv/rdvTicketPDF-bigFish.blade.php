<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style>
			.mt-3 {
         			margin-top: -5px !important;
			}
			/*.mt-3 {margin-top: -10px !important;	padding-top:-10px  !important ;	}*/
			.mt-10{
			       margin-top:-50px;
			}
			.mt-8{
				margin-top: -5px !important;
        padding-top:-5px  !important ;
			}
			.mt-18 {
				margin-top: -18px !important;
				padding-top:-18px !important;
			}
			.mb-12{
					margin-top: +10px !important;
       		padding-top:+10px  !important ;
					margin-bottom: -40px !important;
				  padding-bottom:-40px !important;
			}
			.imgCenter{
					text-align: center;/*border: 1px solid black;*/
  					width:13%;/*margin-top: -10px !important;*/
  					height:13%;
			}
			#container {
		    display: table;
		  }
			#row  {
		  	display: table-row;
		  }
			#left, #right{
			  display: table-cell;
			  font-size:xx-small; /* padding: 5px;*/
			     
		  }	
		  #left{
		  	margin-top: +4px !important;
				padding-top:+4px !important;
		  }		
		  #parent {
		  	width:100%;
  			height:110px;/*70px*/
  			border: 0.5px solid black !important;
  			border-radius: 5px !important;
  			font-size:xx-small; /* padding: 5px;*/
  		}
		</style>
	</head>
	<body>
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-sm-12">
			   	<div class="content text-center mt-10">
			      <h5><strong>DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</strong></h5>
			      <h6 class="mt-3" style =" margin-left: -7px;margin-right:-7px;"><strong>ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</strong></h6>
			      <h6 class="mt-3"><strong> Chemin des Glycines - ALGER</strong><span> - Tél : 023-93-34</span></h6>
			   	</div>
			  </div>
		  </div>
		  <div class="row mt-3">
			  <div class="col-sm-12 content text-center">
				 <div class="col-sm-4"></div>
				 <div class="col-sm-4"><img class = "imgCenter" src="img/logo.png"/></div><div class="col-sm-4"></div>    
				</div>
      </div>
		  <div class="row"><hr class ="mt-3"> </div>
		  <div class="row">
		   	<div class="col-md-4  col-sm-4 float-left" style="font-size:x-small;"></div>
		   	<div class="col-md-4 col-sm-4 content text-center mt-18"><h4><strong>Rendez-Vous de Consultation</strong></h4></div>		
		  </div><br>	
		  <div class="row mt-8">
			  <div class="col-sm-12"><!-- Rendez-vous avec le <strong>Docteur</strong> {{ $rdv->employe->nom}}&nbsp;{{ $rdv->employe->prenom}} -->
			  	Rendez-vous dans la &nbsp;<strong>Spécialitè</strong>&nbsp;{{ $rdv->employe->Specialite->nom}}
			  </div>
			</div>
		  <div class="row">
		   	<div class="col-sm-12">{{-- l d-m-Y --}}
			 	  <strong> {{ ( $rdv->fixe) ? "Le" : "A partir du" }}</strong>&nbsp;<span> &nbsp;{{ Carbon\Carbon::parse($rdv->Date_RDV)->format('d-m-Y') }}</span>
		   	</div>
		  </div>
		  <div class="row">	<div class="col-sm-12"><strong>Nom : </strong><span>{{ $rdv->patient->Nom}}</span></div></div>
		  <div class="row" >
		  	<div class="col-sm-12"><strong>Prenom : </strong><span>{{ $rdv->patient->Prenom}}</span> </div>
		  </div>
		  <div id="container">
		 		<div id ="row">
		 			<div id="left"><img src="<?= $img->encoded ?>" /></div>
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

   	</div>
	</body>
</html>
