<div class="row">
	<div class="col-sm-12">
	{{-- change --}}
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title"> 
					<i class="fa fa-user" aria-hidden="true"></i>
					<strong>Patient :</strong>
				</h4>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<label class="inline">
						<span class="blue"><strong>Nom :</strong></span>
						<span class="lbl"> {{ $patient->Nom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Prénom :</strong></span>
						<span class="lbl"> {{ $patient->Prenom }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue">	<i class="fa fa-mars-stroke" aria-hidden="true"></i><strong>Sexe:</strong></span>
						<span class="lbl"> {{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><i class="fa fa-calendar" aria-hidden="true"></i><strong> Né(e) le :</strong></span>
						<span class="lbl"> {{ $patient->Dat_Naissance }}</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Age:</strong></span>
						<span class="lb circle">{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }}
						</span>ans
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline"> 	
						<span class="blue"><i class="fa fa-phone"></i>&nbsp;<strong>Mobile :</strong></span>
						<span class="lbl">{{ $patient->tele_mobile1 }}
						</span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>