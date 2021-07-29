<div id="content">
	<div class="row mt-12 center"><img src='{{ asset("/img/entete.jpg") }}' alt="Entete" width="90%"/></div><hr> 
  <div style="text-align: center;font-size: 1.5em;"><strong>Demande d'examen radiologique</strong></div>
  <div class="row">
		<div class="col-sm-12"><div class="sec-droite">
			<h4><strong><u>Alger le:</u></strong>{{ Carbon\Carbon::today()->format('d/m/Y') }}</h4>
		</div></div>
	</div>
	<div class="row ml-4">
		<div class="col-sm-12">
			<div class="sec-gauche">
				<h4><u>Patient(e):</u></strong>&nbsp;{{ $patient->getCivilite() }}{{ $patient->Nom }}	{{ $patient->Prenom }},&nbsp;</strong>  	{{ $patient->getAge() }} ans,&nbsp;{{ $patient->Sexe }}</h4>
			</div>
		</div>
	</div>
	<div class="row ml-4">
		<div class="col-sm-12">
			<div class="sec-gauche"><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode"/><h6>IPP :{{ $patient->IPP }}</h6></div>   
		</div>
	</div><div class="space-12"></div>
	<div class="row  ml-4"><div class="col-sm-12"><h3>Prière de faire</h3></div></div>
	<div class="row ml-4"><div class="col-sm-12 "><h3>Examens radiologiques demandés:</h3></div></div><div class="space-12"></div>
	<div class="row"><div class="col-sm-1"></div>
		<div class="col-sm-10">
			<div class="widget-body"><div class="widget-main no-padding" id="imgExams"></div></div>
		</div><div class="col-sm-1"></div>
	</div> <div class="space-12"></div>
	<div class="row mt-12 center"><img src='{{ asset("/img/footer.jpg") }}' alt="Entete" width="90%"/></div>
</div>