<div class="tab-space40 mtP40">Alger le : {{ \Carbon\Carbon::today()->format('d/m/Y') }}</div>
<div class="ml-06"><b>Médecin prescripteur :</b><span> {{ $medecin->full_name }}</span></div>
<div class="ml-06"><b>Patient(e) :</b></div>&nbsp;&nbsp;&nbsp;&nbsp;
<div class="tab">
	<b>Nom :</b><span> {{ $patient->Nom }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
	<b>Prenom :</b><span> {{ $patient->Prenom }}</span>
	<b>Né(e) le :</b><span> {{ $patient->Dat_Naissance->format('d/m/Y') }}</span>
</div>
<div class="textCenter mtP40 ft20" >
	<span>Compte rendu d'analyses médicales</span>
</div>
<p id ="crbPDF" class="mtP10p"></p>