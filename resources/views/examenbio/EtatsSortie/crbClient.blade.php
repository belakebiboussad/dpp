<div class="ml-46 mtP40"><b>Alger le</b> : {{ \Carbon\Carbon::today()->format('d/m/Y') }}</div>
<div class="ml-06"><b>Médecin prescripteur</b> :<span> {{ $demande->imageable->medecin->full_name }}</span></div>
<div class="ml-06"><b>Patient(e)</b> :</div>
<div class="tab"><b>Nom</b> :<span> {{ $demande->imageable->patient->Nom }}</span></div>
<div class="tab"><b>Prenom</b> :<span> {{ $demande->imageable->patient->Prenom }}</span></div> 
<div class="tab"><b>Né(e) le</b> :<span> {{ $demande->imageable->patient->Dat_Naissance->format('d/m/Y') }}</span></div>
<div class="center mtp33 ft20">Compte rendu d'analyses médicales</div>
<p id ="crbPDF" class="mtp33"></p>