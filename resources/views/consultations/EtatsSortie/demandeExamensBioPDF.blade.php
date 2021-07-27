<div style="text-align: center;font-size: 1.5em;" class="mtP40"><strong>Demande d'examen biologique</strong></div>
<div class="tab-space40 mtp10"><strong>Alger le :</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
<div class="ml-06 mtp20">
	<strong><u>Patient(e):</u></strong>&nbsp;{{ $patient->getCivilite() }}{{ $patient->Nom }}	{{ $patient->Prenom }}
</div>
<div class="ml-06"><canvas id="barcode"></canvas></div><!-- ml-4 -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="ml-06 mtP500"><h4> Prière de faire :</h4></div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="row ml-06"><ol id ="listBioExam"></ol></div><!-- <div class= "center mbp100"><span><strong>Docteur :</strong> {{ $employe->nom}} {{ $employe->prenom }}</span></div> -->
