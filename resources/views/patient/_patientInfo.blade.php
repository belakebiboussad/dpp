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
						<span class="blue"><i class = "fa fa-transgender" aria-hidden="true"></i><strong>&nbsp;Sexe:</strong></span>
						<span class="lbl"> {{ $patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
					</label>
						&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><strong>Âge:</strong></span>
						<!-- <span class="lb circle">{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }} -->
						<span class="badge badge-info">{{ Jenssegers\Date\Date::parse($patient->Dat_Naissance)->age }}</span>
						</span>ans
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline">
						<span class="blue"><span class="glyphicon glyphicon-map-marker"></span><strong> Né(e) à :</strong></span>
						<span class="lbl"> {{ $patient->lieuNaissance->nom_commune }}</span>
					</label>
				
					&nbsp;&nbsp;&nbsp;
					<label class="inline"> 	
						<span class="blue"><i class="fa fa-phone"></i>&nbsp;<strong>Mobile :</strong></span>
						<span class="lbl">{{ $patient->tele_mobile1 }}
						</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline"> 	
						<span class="blue"><span class="glyphicon glyphicon-home"></span>&nbsp;<strong>Adresse :</strong></span>
						<span class="lbl">{{ $patient->commune->nom_commune }},{{ $patient->wilaya->nom_wilaya }}
						</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline"> 	
						<span class="blue">&nbsp;<strong>NSS :</strong></span>
						<span class="lbl">{{ $patient->NSS }}
						</span>
					</label>
					&nbsp;&nbsp;&nbsp;
					<label class="inline"> 	
						<span class="blue">&nbsp;<strong>Type :</strong></span>
						<span class="lbl badge badge-info">{{ $patient->Type }}</span>
					</label>
				</div>
			</div>
		</div>
	</div>
</div>