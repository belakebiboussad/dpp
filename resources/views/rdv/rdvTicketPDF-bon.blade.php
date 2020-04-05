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
		</style>
	</head>
	<body>
		<div class="container-fluid">
		  <div class="row">
			  <div class="col-sm-12">
			   	<div class="content text-center mt-10">
			      <h5><strong>DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</strong></h5>
			      <h6 class="mt-6" style =" margin-left: -7px;margin-right:-7px;"><strong>ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</strong></h6>
			      <h6 class="mt-6"><strong> Chemin des Glycines - ALGER</strong><span> - Tél : 023-93-34</span></h6>
			      {{-- <h6 class="mt-6"><strong>Tél : 023-93-34</strong></h6> --}} {{-- <span class="border border-0" align="center"> </span> --}}{{--  <br> --}}	 
			   	</div>
			  </div>
		  </div>
		  <div class="row mt-6">
			  <div class="col-sm-12 content text-center">
				      <div class="col-sm-4"></div>
				      <div class="col-sm-4"><img class = "imgCenter" src="<?php echo $_SERVER["DOCUMENT_ROOT"].'./img/logo.png';?>"/></div>
				    	<div class="col-sm-4"></div>       
						</div>
      </div>
		  <div class="row">
		    <hr class ="mt-3" >
		  </div>
		  <div class="row">
		   	<div class="col-md-4  col-sm-4 float-left" style="font-size:x-small;"></div>
		   	<div class="col-md-4 col-sm-4 content text-center mt-15">	
		  		<h3><strong>Rendez-Vous de Consultation</strong></h3>
		    </div>	
			</div>
		  <br>	
		  <div class="row mt-8">
			  <div class="col-sm-12">
			  	 Rendez-vous avec le <strong>Docteur</strong> {{ $rdv->employe->Nom_Employe}}&nbsp;{{ $rdv->employe->Prenom_Employe}}.
						</div> 
		  </div>
		  <div class="row">
		   	<div class="col-sm-12">
		   		<strong> {{ ( $rdv->fixe) ? "Le" : "A partir du" }}</strong>&nbsp;<span> &nbsp;{{ Carbon\Carbon::parse($rdv->Date_RDV)->format('l d-m-Y') }}</span>
		   	</div>
		  </div>
		  <div class="row">
		   	<div class="col-sm-12">
		   		<strong>Nom : </strong><span>{{ $rdv->patient->Nom}}</span>
		   	</div>
		  </div>
		  <div class="row" >
		   	<div class="col-sm-12">
		   		<strong>Prenom : </strong><span>{{ $rdv->patient->Prenom}}</span>
		    </div>
		  </div>
			<div class="row" style ="padding-top:5px;">
		    <div class="col-sm-12">
			    <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($rdv->patient->code_barre, 'QRCODE')}}" alt="barcode"/><br>
			   	<span style="font-size:xx-small;">{{ $rdv->patient->code_barre }}</span>   
			  </div>
		  </div>
   	</div>
		<script src="{{ public_path('js/bootstrap.min.js') }}"></script><script src="{{ public_path('js/jquery.min.js') }}"></script>
	</body>
</html>