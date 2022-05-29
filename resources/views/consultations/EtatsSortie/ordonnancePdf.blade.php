
<!-- <div class="textCenter mtP40 ft20"><strong>Ordonnance</strong></div> -->
<div class="tab-space42 mtp33"><strong>Alger le :</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
<div class="ml-06 mtp20">
  <strong>Médecin prescripteur :</strong>{{ $employe->full_name}}
</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="row"><div class="col-sm-12"><span><strong>Patient(e) :</strong></span></div></div>
<div class="row">
  <div class="col-sm-12 tab-space ml-06">
    <strong>Nom :&nbsp;</strong><span>{{ $patient->Nom }}</span>
    <strong>Prenom :&nbsp;</strong><span>{{ $patient->Prenom }}</span>
    <strong>Né(e) le :&nbsp;</strong><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d/m/Y') }}</span>
  </div>
</div>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="row">
  <h6 class="center"><span style="font-size: xx-large;"><strong>ORDONNANCE</strong></span></h6>
</div><br><br>
<div class="row">
  <div class="col-sm-12"><br>
    <div class="row ml-06">
      <ol id ="listMeds" class="c">
      </ol>
    </div>
  </div>
</div>

