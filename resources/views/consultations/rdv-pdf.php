<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet"> -->
		<!-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}"/> -->
		<!-- <link rel="stylesheet" type="text/css" src="{{ url('/') }}/css/bootstrap.min.css"/> -->
 		<link href="{{public_path('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> 
		
		<style>
				.mt-6 {
         		margin-top: -6px !important;
				}
				.mt-4 {
         		margin-top: -4px !important;
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
          <!-- <span class="border border-0" align="center"> </span> -->
          <img class = "imgCenter" src="<?php echo $_SERVER["DOCUMENT_ROOT"].'./img/logo-40_x_40.png';?>"/>
         <!--  <br> -->
          <hr class ="mt-4" >
          <span  class ="mt-10" style="font-size:medium;"><strong>Rendez-Vous</strong></span>
        </div>
      </div>
     <!--  <div>
      	  <img src="{{ $base64 }}" alt="Logo" class="logo" style="width: 100px; height:80px;"/>
           <h2>Logo</h2>
      </div> -->
		</div>
	</body>
</html>