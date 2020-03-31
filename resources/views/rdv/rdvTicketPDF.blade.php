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
				.ml-2{
				    margin-left: +0.5%;
				}
				.mt-15 {
				    margin-top: -15px !important;
				    padding-top:-10px !important;
				}
				.ml-80{
				    margin-left: +80%;
				}
				.imgCenter{
					  text-align: center;/*border: 1px solid black;*/
  					width:6%;/*	margin-top: -10px !important;*/
				}
				
			</style>
	</head>
	<body>
		<div class="container" >
		    	<div class="row">
			        <div class="col-sm-12">
			            	<div class="content text-center mt-10">
				              <h5><strong>DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</strong></h5>
				              <h6 class="mt-6"><b>ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</b></h6>
				              <h6 class="mt-6"><strong> Chemin des Glycines - ALGER</strong></h6>
				              <h6 class="mt-6"><strong>Tél : 023-93-34</strong></h6> <!-- <span class="border border-0" align="center"> </span> --><!--  <br> -->	 
			            	</div>
			        </div>
		      </div>
		       <div class="row mt-6">
			        <div class="col-sm-12 content text-center">
				          <div class="col-sm-4"></div>
				          <div class="col-sm-4"> <img class = "imgCenter" src="<?php echo $_SERVER["DOCUMENT_ROOT"].'./img/logo-40_x_40.png';?>"/></div>
				          <div class="col-sm-4"></div>       
				</div>
      			</div>
		      <div class="row">
		      		 <hr class ="mt-3" >
		      </div>
		      <div class="row">
		      		<div class="col-md-4  col-sm-4 float-left" style="font-size:x-small;">
		      			<strong>{{ $rdv->patient->getCivilite() }}</strong>{{ $rdv->patient->Nom }} &nbsp;{{ $rdv->patient->Prenom }}({{$rdv->patient->getAge()}}ans)
		      		</div>	
		      		<div class="col-md-4 col-sm-4 content text-center  mt-15 ">	<!-- <span  class ="mt-10" style="font-size:medium;"></span> -->
		      		  	<h4><strong>Consultations Externes</strong></h5>
		      		</div>	
		      		<div class="col-md-4col-sm-4  pull-right mt-15" style="font-size:x-small;">{{-- <strong>Fait le :&nbsp;</strong>{{ Carbon\Carbon::today()->format('d-m-y') }} --}}
		      		</div>	
			</div>
		      <div class="row" style="margin-top: -0px;">
			      	 <div class="col-md-4 col-sm-4 float-left" style="font-size:x-small;">
				      	<strong>Adr:</strong><span class="large">{{ $rdv->patient->commune->nom_commune }} &nbsp;{{ $rdv->patient->wilaya->nom_wilaya }}.</span>	
				</div>
				<div class="col-md-4 col-sm-4 "></div>
		      		<div class="col-md-4 col-sm-4" style="font-size:x-small;">		
		      		</div>	
		      </div>
		      <br>	
		      <div class="row">
			      	<div class="col-sm-12">
				        <div class="col-sm-2">
						<img src="data:image/png;base64,{{DNS2D::getBarcodePNG($rdv->patient->code_barre, 'QRCODE')}}" alt="barcode"/>	
				        </div>
				        <div class="col-sm-5">
					      &nbsp; Rendez-vous avec le <strong>Docteur</strong> {{ $rdv->employe->Nom_Employe}}
				        </div>
				        <div class="col-sm-5">	
				       <strong> {{ ( $rdv->fixe) ? "&nbsp;Le" : "&nbsp;A partir du" }}</strong>&nbsp;<span>{{ $rdv->Date_RDV->format('d-m-Y')}}</span>
				        </div>
				 </div>
		      </div>
   		</div>
   		 <script src="{{ public_path('js/bootstrap.min.js') }}"></script>
 		 <script src="{{ public_path('js/jquery.min.js') }}"></script>
		
	</body>
</html>