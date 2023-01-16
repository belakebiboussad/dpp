<div class="ml-46 mtP40"><b>Alger le</b> : {{ \Carbon\Carbon::today()->format('d/m/Y') }}</div>
<div class="ml-06 mtp33">
  <b>Médecin prescripteur :</b> {{ $employe->full_name}}
</div><br>
<div><b>Patient(e)</b> :</div>
<div class="tab ml-06">
    <b>Nom</b> :<span> {{ $patient->Nom }}</span>
    <b>Prenom</b> :<span> {{ $patient->Prenom }}</span>
    <b>Né(e) le</b> :<span> {{ $patient->Dat_Naissance->format('d/m/Y') }}</span>
  </div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 
<div class="row">
  <div><h1 class="center"><u><b>ORDONNANCE</b></u></h1></div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div><ol id ="listMeds" class="c"></ol> </div>