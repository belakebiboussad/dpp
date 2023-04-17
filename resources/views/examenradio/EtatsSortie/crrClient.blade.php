<div class="ml-46 mtP40"><b>Alger le</b> : {{ \Carbon\Carbon::today()->format('d/m/Y') }}</div>
<div class="ml-06"><b>Médecin prescripteur :</b><span> {{ $demande->imageable->medecin->full_name }}</span></div>
<div class="ml-06"><b>Patient(e)</b> :</div>
<div class="tab"><b>Nom</b> :<span> {{ $patient->Nom }}</span></div>
<div class="tab"><b>Prenom</b> :<span> {{ $patient->Prenom }}</span></div> 
<div class="tab"><b>Né(e) le</b> :<span> {{ $patient->Dat_Naissance->format('d/m/Y') }}</span></div>
<div class="center mtp33 ft20">Compte rendu d'exploration radiologique</div>
<p id ="conclusionPDF" class="mtp33"></p>