<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> 
		<style>
			.mt-6 {
         			margin-top: -6px !important;
			}
			.mt-3 {
         			margin-top: -10px !important;
         			padding-top:-10px  !important ;
			}
			.mt-10{
			       margin-top:-50px;
			}
			.mt-8{
				margin-top: -8px !important;
         			padding-top:-8px  !important ;
			}
			.ml-2{
				    margin-left: +0.5%;
			}
			.mt-15 {
				    margin-top: -25px !important;
				    padding-top:-25px !important;
			}
			.ml-80{
				    margin-left: +80%;
			}
			.imgCenter{
					text-align: center;/*border: 1px solid black;*/
  					width:13%;/*	margin-top: -10px !important;*/
  					height:13%;
			}
			#container {
		    		display: table;
		    	}
			 #row  {
		    		display: table-row;
		    	}
			 #left, #right, #middle {
			      display: table-cell;
			       font-size:xx-small;
			      /* padding: 5px;*/
		      }			
		  	#parent {
		  		width:100%;
  				height:70px;
  				border: 0.5px solid black !important;
  				border-radius: 5px !important;
  			}
  			#child {
  				height: 30px;
  				 border: 1px solid red;  
  			}
		</style>
		<script src="{{ public_path('js/bootstrap.min.js') }}"></script><script src="{{ public_path('js/jquery.min.js') }}"></script>
	</head>
	<body>
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-sm-12">
			   	<div class="content text-center mt-10">
			      <h5><strong>DIRECTION GENERAL DE LA SÛRETÉ NATIONALEE</strong></h5>
			      <h6 class="mt-6" style =" margin-left: -7px;margin-right:-7px;"><strong>ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</strong></h6>
			      <h6 class="mt-6"><strong> Chemin des Glycines - ALGER</strong><span> - Tél : 023-93-34</span></h6>
			   	</div>
			  </div>
		  </div>
		  <div class="row mt-6">
			  <div class="col-sm-12 content text-center">
				 <div class="col-sm-4"></div>
				 <div class="col-sm-4"><img class = "imgCenter" src="<?php echo $_SERVER["DOCUMENT_ROOT"].'./img/logo.png';?>"/></div>
				 {{-- <img src="storage_path('app/public/logo.png')"  alt="logo"/></h5> --}}
    
				 <div class="col-sm-4"></div>       
			</div>
               </div>
		  <div class="row"><hr class ="mt-3"> </div>
		  <div class="row">
		   	<div class="col-md-4  col-sm-4 float-left" style="font-size:x-small;"></div>
		   	<div class="col-md-4 col-sm-4 content text-center mt-15"><h3><strong>Rendez-Vous de Consultation</strong></h3></div>		
		  </div>
		  <br>	
		  <div class="row mt-8">
			  <div class="col-sm-12">Rendez-vous avec le <strong>Docteur</strong> {{ $rdv->employe->nom}}&nbsp;{{ $rdv->employe->prenom}}</div>
			</div>
		  <div class="row">
		   	<div class="col-sm-12">{{-- l d-m-Y --}}
			 	  <strong> {{ ( $rdv->fixe) ? "Le" : "A partir du" }}</strong>&nbsp;<span> &nbsp;{{ Carbon\Carbon::parse($rdv->Date_RDV)->format('d-m-Y') }}</span>
		   	</div>
		  </div>
		  <div class="row">	<div class="col-sm-12"><strong>Nom : </strong><span>{{ $rdv->patient->Nom}}</span></div></div>
		  <div class="row" ><div class="col-sm-12"><strong>Prenom : </strong><span>{{ $rdv->patient->Prenom}}</span> </div></div>
		  <div id="container" style ="padding-top:8px;">
		 		<div id="row">
		 			<div id="left">
			 			<img src="data:image/png;base64,{{DNS2D::getBarcodePNG($rdv->patient->getCivilite().'|'.$rdv->patient->Nom.'|'.$rdv->patient->Prenom.'|'.$rdv->patient->IPP, 'QRCODE')}}" alt="barcode"/><br>
			 			<span>{{ $rdv->patient->IPP }}</span>
					</div>
		 			<div id="middle">
		 				<div id = "parent">	 				
		 					<span style="font-size: xx-small;">Le jour de votre consultation</span>
			 				<ul style="font-size: xx-small;">	
			 					<li>Rapportez ce Ticket	</li>
			 					<li>	Raportez tous les documents Médicaux en votre possession (résultats d'analyses, radiographies,etc.)</li>
			 					<li>En arrivant à l'hôpital recupéré votre ticket d'ordre depuis la borne.</li>
			 				</ul> 
		 				</div>
		 			</div>
				</div>
		  </div>
   	</div>
	<script src="{{ public_path('js/bootstrap.min.js') }}"></script><script src="{{ public_path('js/jquery.min.js') }}"></script>
	</body>
</html>