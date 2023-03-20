<div class="ml-46 mtP40"><b>Alger le</b> : {{ \Carbon\Carbon::today()->format('d/m/Y') }}</div>
<div class="ml-06 mtp33"><b>Médecin prescripteur :</b> {{ $employe->full_name}}</div><br>
 <div><b>Patient(e)</b> :</div>
<div class="tab">
  <b>Nom</b> :<span> {{ $obj->patient->Nom }}</span> <b>Prenom</b> :<span> {{ $obj->patient->Prenom }}</span>
  <b>Né(e) le</b> :<span> {{ $obj->patient->Dat_Naissance->format('d/m/Y') }}</span>
</div>
<div><h1 class="mtP70 ml-7"><b>ORDONNANCE</b></h1></div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div><ol id="listMeds"></ol></div>