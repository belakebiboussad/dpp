<div class="center mtP40 ft20">Demande d'examen d'imagerie</div>
<div class="ml-46 mtp10"><b>Alger le</b> : {{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
<div class="ml-06 mtp20">
	<b><u>Patient(e):</u></b> {{ $obj->patient->getCivilite() }}{{ $obj->patient->full_name }}
</div>
<div class="ml-06"><canvas id="barcode"></canvas></div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="infoSupPertinante"></div><div class="ml-06"><h4> Prière de faire :</h4></div>
<div class="row ml-06"><ol id ="listImgExam"></ol></div>