<!DOCTYPE html>
<html>
 	<head>
 	  <meta charset="utf-8">
		<title>Ordonnance-{{ $patient->Nom }}-{{ $patient->Prenom }}</title>
		<link rel="stylesheet" href="{{ asset('/css/styles.css') }}"/>
		<link rel="stylesheet" href="{{ asset('css/print.css') }}"/>
    <style>
  		html {
 				 height: 100%;
			}
			body {
			  min-height: 100%;
			  margin: 0;
			  padding: 0;
			  
		
			}
			#content-wrap {
				min-height: 400px;
  			margin-bottom: 79px;
   			clear: both;
			}
			@media screen {
 				footer {
    			display: none;
    		}
			}
			@media print {
  			footer {
    			position: fixed;
    	  	bottom: 0; left: 0; right: 0;
    	   	height: 79px;
    	   	width :100%;
				}
			}
  	 </style>
 </head>
<body>
  <div id="page-container">
    <div id="content-wrap">
	  	<div class="row mt-12 center"><img src='{{ asset("img/entete.png") }}' alt="Entete" width="98%"/></div>
    	<div class="pull-right"><strong>Alger le :</strong>&nbsp;{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div><br><br> 
			<div class="row">
				<div class="col-sm-6">
				  <h6><strong>Médecin prescripteur :</strong>{{ $employe->full_name}}</h6>
				 </div>
			</div>
			<div class="row"><div class="col-sm-12"><span><strong>Patient(e) :</strong></span></div></div>
			<div class="row">
				<div class="col-sm-12 tab-space">
					<strong>Nom :&nbsp;</strong><span>{{ $patient->Nom }}</span>
					<strong>Prenom :&nbsp;</strong><span>{{ $patient->Prenom }}</span>
					<strong>Né(e) le :&nbsp;</strong><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</span>
				</div>
			</div>
			<div class="row">
			<div class="col-sm-12 tab-space">
				<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode"/><br>
				IPP :{{ $patient->IPP }}
			</div>
			</div>
			<div class="row">
				<h6 class="center"><span style="font-size: xx-large;"><strong>Ordonnance</strong></span></h6>
			</div><br><br>
	  	<div class="row">
		  	<div class="col-sm-12"><br>
			  	<ol class="c">
						@foreach($medicaments as $i => $value)
							<li>
								<h4>{{ $medicaments[$i]->Nom_com }} {{ $medicaments[$i]->Forme }} &nbsp;&nbsp; {{ $medicaments[$i]->Dosage }}</h4>
								<h5>{{ $posologies[$i] }}</h5>
							</li>
						@endforeach
					</ol>
				</div>
			</div>
   </div>
    <footer><img src='{{ asset("img/footer.png") }}' alt="footer" width="100%"/></div></footer>
 </div>
</body>
</html>