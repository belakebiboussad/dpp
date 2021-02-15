<html>
	<head>
		<meta charset="utf-8">
		<title>Ordonnance</title>
		<style>
  		@media print {
	      .print {display:block}
	      .btn-print {display:none;}
	    }
    	.section{
				margin-bottom: 20px;
			}
			.sec-gauche{
				float: left;
			}
			.sec-droite{
				float: right;
			}
			.center{
				text-align: center;
			}
			.col-sm-12{
				margin-bottom: 10px;
			}
			.mt-15{
	        margin-top:-15px;
			}
			.mt12{
	        padding-top:+12px;
			}
			.mt-20{
	      margin-top:-20px;
			}
			.ml-80{
      	 margin-left: +80%;
			}
			.ml-4{
        margin-left: +4%;
			}
			.foo{
      position: absolute;
      top: 90%;
      right: 22%;
		}
    </style>
	</head>
	<body>
  	<div class="container-fluid" >
  		<h4 class="mt12 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h4>
      <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
			<h4 class="center">Chemin des Glycines - ALGER</h4>
			<h4 class="center">Tél : 023-93-34</h4>
			<h5 class="mt-15 center" ><img src="{{ asset('/img/logo.png') }}" style="width: 60px; height: 60px" alt="logo"/></h5>
  		<h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Ordonnance</strong></span></h5>
  		<div class="row">
			<div class="col-sm-12">
				<div class="section"><div class="ml-80"><b><u>Fait le:</u></b> {{ Carbon\Carbon::today()->format('Y-m-d') }}.</div></div>
			</div>
			</div>
			<div class="row ml-4">
				<div class="col-sm-12">
					<div class="section">
						<div class="sec-gauche">
							<b><u>Patient(e) :</u></b><b>	{{ $patient->getCivilite() }}</b>{{ $patient->Nom }}	{{ $patient->Prenom }},&nbsp;  
							{{ $patient->getAge() }} ans,{{ $patient->Sexe }}
						</div>
					</div>
				</div>
			</div>
			<br>
			<div class="row ml-4">
				<div class="col-sm-12">
					<div class="section">
						<div class="sec-gauche">
								<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode"/><br> {{ $patient->IPP }}   
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-sm-12"><br>
					<ol>
						@for ($i = 0; $i < count($medicaments); $i++)
						<li>
							{{ $medicaments[$i]->Nom_com }} {{ $medicaments[$i]->Forme }} {{ $medicaments[$i]->Dosage }} <br>{{ $posologies[$i] }}.		
						</li><br><br>
						@endfor
					</ol>
				</div>
			</div>
			<div class="row foo">
		       <div class="col-sm-12">
			<div class="section"><div class="sec-droite"><span><strong> Docteur :</strong> {{ $employe->nom}} {{ $employe->prenom}}</span></div></div>
		      </div>
  		      </div>
  		      <div class="row foo">
		    <div class="col-sm-12">
			<div class="section"><div class="sec-droite"><span><strong> Docteur :</strong> {{ $employe->nom}} {{ $employe->prenom}}</span></div> </div>
		    </div>
 		 </div>				
    </div>
	</body>
</html>