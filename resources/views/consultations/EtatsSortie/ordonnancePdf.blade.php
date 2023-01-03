<div class="tab-space42 mtp33"><b>Alger le :</b> {{ \Carbon\Carbon::today()->format('d/m/Y') }}</div>
<div class="ml-06 mtp20">
  <b>Médecin prescripteur :</b> {{ $employe->full_name}}
</div><div class="space-12"></div>
<div class="row"><div class="col-sm-12"><b>Patient(e) :</b></div></div>
<div class="row">
  <div class="col-sm-12 tab ml-06">
    <b>Nom :</b><span> {{ $patient->Nom }}</span>
    <b>Prenom :</b><span> {{ $patient->Prenom }}</span>
    <b>Né(e) le :</b><span> {{ $patient->Dat_Naissance->format('d/m/Y') }}</span>
  </div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> 
<div class="row">
  <div class="col-sm-12 col-xs-12"><h3 class="center"><b><u>ORDONNANCE</u></b></h3></div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="row">
  <div class="col-sm-12">
    <ol id ="listMeds" class="c"></ol>
  </div>
</div>

