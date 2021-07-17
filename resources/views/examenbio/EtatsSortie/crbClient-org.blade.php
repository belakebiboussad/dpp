<header id="header"> 
	<!-- <div class="row"><div class="col-sm-12 center"> -->
	<div class="col-sm-12 center">
		<img src='{{ asset("img/entete.jpg") }}'/>
	</div>
</header><!-- /header -->
<br><br><br>
<div class="row">
	<div class="col-sm-6 tab-space"><strong>Médecin prescripteur :</strong> 
	{{ $medecin->nom }} {{ $medecin->prenom }}</div><div class="col-sm-3"></div>	
	<div class="col-sm-3 pull-right"><strong>Alger le :</strong>&nbsp;{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>	
</div>
<div class="row"><div class="col-sm-12 tab-space"><strong>Patient(e) :</strong></div></div>
<div class="row">
	<div class="col-sm-2 tab-space"><strong>Nom :&nbsp;</strong><span>{{ $patient->Nom }}</span></div>
	<div class="col-sm-3"><strong>Prenom :&nbsp;</strong><span>{{ $patient->Prenom }}</span></div>
	<div class="col-sm-3"><strong>Né(e) le :&nbsp;</strong><span>{{ \Carbon\Carbon::parse($patient->Dat_Naissance)->format('d-m-Y') }}</span></div>
</div>
<div class="row">
	<h3 data-mce-style="text-align: center;" style="text-align: center;">Compte rendu d'analyses médicales</h3>
</div><div class="space-12"></div> 
<div class="row">
	<div class="col-sm-11 tab-space"><span id ="crbPDF"></span></div>
</div>
<!-- <div class="html2pdf__page-break"></div> -->
	<footer class="footer">
		<div class="col-sm-12 center" >
			<img src='{{ asset("img/footer.png") }}'/>
		</div>	
	</footer>