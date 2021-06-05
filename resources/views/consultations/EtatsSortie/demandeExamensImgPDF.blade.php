<h3 class="mt-12 center" id="tutelle">{{ $etablissement->tutelle }}</h3>
 <h4 class="center" id="etabname">{{ $etablissement->nom }}</h4>
<h5 class="center" id="etabAdr">{{ $etablissement->adresse }}</h5>  
<h5 class="center" id="etabTel">Tél : {{ $etablissement->tel }}- {{ $etablissement->tel2 }}</h5>
<h5 class="mt-10 center" ><img src='{{ asset("img/$etablissement->logo") }}' style="width: 80px; height: 80px" alt="logo"/></h5>
<hr class="mt-1"/>
<div class="row mt-20"><div class="col-sm-12 center"><h3>Demande Examens d'Imagerie</h3></div></div>
<div class="space-12"></div><div class="space-12"></div>
<div class="row">
	<div class="col-sm-12"><div class="sec-droite">
			<h4><strong><u>Fait le:</u></strong>{{ Carbon\Carbon::today()->format('d/m/Y') }}.</h4>
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
.<div class="row ml-4"><div class="col-sm-12 ">
	<h3>Examens Radiologiques Demandées:</h3>
</div></div><div class="space-12"></div>
<div class="row"><div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="widget-body">
			<div class="widget-main no-padding" id="imgExams"></div>
		</div>
	</div><div class="col-sm-1"></div>
</div> <div class="space-12"></div>
  <footer class= "center">
  <div class="sec-droite"><span><strong> Docteur :</strong> {{ $employe->nom}} {{ $employe->prenom}}</span></div>
  </footer>

