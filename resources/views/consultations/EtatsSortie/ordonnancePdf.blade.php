
<!-- <div class="textCenter mtP40 ft20"><b>Ordonnance</b></div> -->
<div class="tab-space42 mtp33"><b>Alger le :</b> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
<div class="ml-06 mtp20">
  <b>Médecin prescripteur :</b>{{ $employe->full_name}}
</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="row"><div class="col-sm-12"><span><b>Patient(e) :</b></span></div></div>
<div class="row">
  <div class="col-sm-12 tab ml-06">
    <b>Nom :&nbsp;</b><span>{{ $patient->Nom }}</span>
    <b>Prenom :&nbsp;</b><span>{{ $patient->Prenom }}</span>
    <b>Né(e) le :&nbsp;</b><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d/m/Y') }}</span>
  </div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="row">
  <h6 class="center"><span style="font-size: xx-large;"><b>ORDONNANCE</b></span></h6>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="row">
  <div class="col-sm-12">
    <ol id ="listMeds" class="c"></ol>
  </div>
</div>

