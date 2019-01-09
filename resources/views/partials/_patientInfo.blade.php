<div class="row">
	<div class="col-sm-12">
	{{-- change --}}
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title"> 
					<i class="fa fa-angle-right" aria-hidden="true"></i>
					<strong>Patient :</strong>
				</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<label class="inline">
						<span class="blue"><strong>Nom du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Nom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Prénom du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Prenom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Sexe du Patient :</strong></span>
						<span class="lbl"> {{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong> Né(e) le :</strong></span>
						<span class="lbl"> {{ $patient->Dat_Naissance }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Age du Patient :</strong></span>
						<span class="lbl"> 
							{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} ans
						</span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>