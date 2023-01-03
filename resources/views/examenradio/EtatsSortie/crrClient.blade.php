<div class="tab-space40 mtP40">Alger le : {{ \Carbon\Carbon::today()->format('d/m/Y') }}</div>
<div class="ml-06"><b>Médecin prescripteur :</b><span> {{ $obj->medecin->full_name }}</span></div>
<div class="ml-06"><b>Patient(e) :</b></div>
	<div class="tab">
  <b>Nom :</b><span> {{ $patient->Nom }}</span>
  </div> 
  <div class="tab">
	  <b>Prenom :</b><span> {{ $patient->Prenom }}</span> 
  </div>
  <div class="tab">
	 <b>Né(e) le :</b><span> {{ $patient->Dat_Naissance->format('d/m/Y') }}</span>
  </div>
<div class="textCenter mtP40 ft20" ><b>Compte rendu d'exploration radiologique</b></div>
<p id ="conclusionPDF" class="mtP10p"></p>