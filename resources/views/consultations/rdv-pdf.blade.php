<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href="{{public_path('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> 
		
		<style>
				.mt-6 {
         		margin-top: -6px !important;
				}
				.mt-3 {
         					margin-top: -20px !important;
         					padding-top:-20px  !important ;
				}
				.mt-10{
				    margin-top:-50px;
				}
				.ml-2{
				    margin-left: +0.5%;
				}
				.mt-15 {
				    margin-top: -30px !important;
				}
				.ml-80{
				    margin-left: +80%;
				}
				.imgCenter{
					  text-align: center;
  					/*border: 1px solid black;*/
  					width:6%;
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
		              <h6 class="mt-6"><strong>Tél : 023-93-34</strong></h6>
	            	</div>
	        </div>
      </div>
       <div class="row">
	        <div class="col-sm-12 content text-center">
	          <div class="col-sm-4"></div>
	          <div class="col-sm-4"> <img class = "imgCenter" src="<?php echo $_SERVER["DOCUMENT_ROOT"].'./img/logo-40_x_40.png';?>"/></div> <div class="col-sm-4"></div>        
	          <!-- <span class="border border-0" align="center"> </span> -->
	          <!--  <br> -->
	          <hr class ="mt-3" >
	          	<span  class ="mt-10" style="font-size:medium;"><strong>Rendez-Vous Consultations Externes</strong></span>
	        </div>
      </div>
      <div class="row">
      		<div style="text-align: center;">
		{{-- 	<img src="data:image/png;base64,{{DNS2D::getBarcodePNG($rdv->patient->code_barre, 'QRCODE')}}" alt="barcode" /> --}}
		</div>
      </div>
   	</div>
	</body>
</html>