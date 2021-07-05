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
			  
			/*  min-height: 400px;
   			margin-bottom: 100px;
   			clear: both;*/
			}
			/*body {position: relative;}*/
			#content-wrap {
 			/*  min-height: 100%;
			  height: auto !important;
				height: 100%;
				margin: 0 auto -80px;
				width: 940px;
				overflow:hidden;*/
				min-height: 400px;
  			margin-bottom: 80px;
   			clear: both;
			}

			/*footer {position: absolute; bottom: -10; left: 0; right: 0}*/
			@media screen {
 				footer {
    			display: none;/*background: url('{{ asset('img/footer.png')}}') no-repeat center top;*/
    		}
			}
			@media print {
  			footer {
    			position: fixed;
    	  	bottom: 0; left: 0; right: 0;
    	   	height: 80px;
    	   	width :100%;/*content: url('{{ asset('img/footer.png')}}');*/
				}
			}
  	 </style>

 </head>

<body>
  <div id="page-container">
    <div id="content-wrap">
	  	<div class="row mt-13 center"><img src='{{ asset("img/entete.png") }}' alt="Entete" width="100%"/></div>
    	<div class="pull-right"><strong>Alger le :</strong>&nbsp;{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div><br><br> 
			<div class="row">
				<div class="col-sm-6"><strong>Médecin prescripteur :</strong>{{ $employe->nom}} {{ $employe->prenom}}</div>
			</div>
			<div class="row"><div class="col-sm-12"><span><strong>Patient(e) :</strong></span></div></div>
			<div class="row">
				<div class="col-sm-12 tab-space">
					<h6>
						<strong>Nom :&nbsp;</strong><span>{{ $patient->Nom }}</span>
						<strong>Prenom :&nbsp;</strong><span>{{ $patient->Prenom }}</span>
						<strong>Né(e) le :&nbsp;</strong><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</span>
					</h6>
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
   <footer class="mb-20">
   	<img src='{{ asset("img/footer.png") }}' alt="footer" width="100%"/>
   </footer>
 </div>
</body>

</html>