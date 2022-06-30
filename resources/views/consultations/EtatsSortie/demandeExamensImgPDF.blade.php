<div class="textCenter mtP40 ft16">
<strong>Demande d'examen d'imagerie</strong>
</div>
<div class="tab-space40 mtp10"><strong>Alger le :</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
<div class="ml-06 mtp20">
	<strong><u>Patient(e):</u></strong>&nbsp;{{ $patient->getCivilite() }}{{ $patient->full_name }}
</div>
<div class="ml-06"><canvas id="barcode"></canvas></div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="infoSupPertinante"></div>
<div class="ml-06"><h4> Prière de faire :</h4></div>
<div class="row ml-06"><ol id ="listImgExam"></ol></div>