<div class="tab-space40 mtP40">Alger le :&nbsp;{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
<div class="ml-06"><strong>Médecin prescripteur :</strong><span>{{ $obj->medecin->full_name }}</span></div>
<div class="ml-06"><strong>Patient(e) :</strong></div>&nbsp;&nbsp;&nbsp;&nbsp;
<div class="tab-space">
	<strong>Nom :&nbsp;</strong><span>{{ $patient->Nom }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
	<strong>Prenom :&nbsp;</strong><span>{{ $patient->Prenom }}</span>
	<strong>Né(e) le :&nbsp;</strong><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</span>
</div>
<div class="textCenter mtP40 ft16" >
	<strong>Compte rendu d'exploration radiologique</strong>
</div>
<!-- ml-06  -->
<p id ="conclusionPDF" class="mtP50"></p>