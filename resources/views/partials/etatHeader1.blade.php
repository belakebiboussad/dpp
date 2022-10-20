
{{-- <h3 class="mt-12 center">
</h3>
<h4 class="center"></h4>
<h5 class="center"></h5>
<h5 class="center"></h5>
<h5 class="center" >
<img src="img/Logo1.png" class="center thumb img-icons" alt="Logo1"></h5>
--}}
<div class="row"><div class="col-sm-12 center"><!-- <img src='{{ asset("img/Logo1.png") }}' alt="Logo1"/> -->
	 <img src="img/{{ $etab->logo }}" class="center thumb img-icons" alt="Logo1"/>
	</div>
	</div>
<div class="space-12"></div>
<div class="row">
	<div class="col-sm-6 tab"><b>Médecin prescripteur :</b> 
	{{ $medecin->full_name }}</div><div class="col-sm-3"></div>	
	<div class="col-sm-3 pull-right"><b>Alger le :</b>&nbsp;{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>	
</div>
<div class="row"><div class="col-sm-12 tab"><b>Patient(e) :</b></div></div>
<div class="row">
	<div class="col-sm-2 tab"><b>Nom :&nbsp;</b><span>{{ $patient->Nom }}</span></div>
	<div class="col-sm-3"><b>Prenom :&nbsp;</b><span>{{ $patient->Prenom }}</span></div>
	<div class="col-sm-3"><b>Né(e) le :&nbsp;</b><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</span></div>
</div>