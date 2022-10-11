<div class="tab-space40 mtP40">Alger le :&nbsp;{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
<div class="ml-06"><b>Médecin prescripteur :</b><span>{{ $obj->medecin->full_name }}</span></div>
<div class="ml-06"><b>Patient(e) :</b></div>&nbsp;&nbsp;&nbsp;&nbsp;
<div class="tab">
	<b>Nom :&nbsp;</b><span>{{ $patient->Nom }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
	<b>Prenom :&nbsp;</b><span>{{ $patient->Prenom }}</span>
	<b>Né(e) le :&nbsp;</b><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</span>
</div>
<div class="textCenter mtP40 ft16" >
	<b>Compte rendu d'exploration radiologique</b>
</div><!-- ml-06  -->
<p id ="conclusionPDF" class="mtP50"></p>