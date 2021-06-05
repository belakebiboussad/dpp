<div class="page-header" style="margin-top:-5px;"> <h5><strong>Détails de l'Hospitalisation :</strong></h5></div>
<div class="row">
	<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hospitalisation</span></strong></div>
</div>
<div class="row">
	<ul class="list-unstyled spaced">
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Mode Admission :</strong> {{ $hosp->admission->demandeHospitalisation->modeAdmission }}</li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Specialité :</strong> {{ $hosp->admission->demandeHospitalisation->Specialite->nom }}</li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Mode Hospitalisation :</strong> {{ $hosp->modeHospi->nom }}</li>
		<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Etat :</strong>
		 	@if($hosp->etat_hosp == "1" )
		 		<span class="badge badge-pill badge-succes">Cloturé</span>
		 	@else
		 		<span class="badge badge-pill badge-warning">En Cours</span>
		 	@endif
		 </li>
		@if($hosp->etat_hosp == "1" )
			<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Résumé de sortie :</strong> {{ $hosp->resumeSortie }}</li>	
			<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Etat a la sortie :</strong> {{ $hosp->etatSortie }}</li>	
			<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Mode de Sortie :</strong>
			@if(!(isset($hosp->modeSortie)))
				Domicile
			@else
				@switch($hosp->modeSortie)
				 	@case(0)
				 		Transfet
				 		@break
				 	@case(1)
				 		Contre avis médicale
				 		@break
				 	@case(2)
				 		Décés
				 		@break
				 	@case(3)
				 		reporter
				 		@break
				 	@default
				 		Domicile
				 		@break
				@endswitch
			@endif
			 </li>	
			<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Diagnostic de Sortie :</strong> {{ $hosp->diagSortie }}</li>	
			<li><i class="ace-icon fa fa-caret-right blue"></i><strong>CIM10 :</strong> {{ $hosp->ccimdiagSortie }}</li>	
		@endif
	</ul>
</div>
<div class="row">
	<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><strong><span style="font-size:16px;">Hébergement</span></strong></div>
</div>
<div class="row">
	<ul class="list-unstyled spaced">
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Service :</strong><span class="badge badge-pill badge-success">
			{{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}</span>
		</li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>Salle :</strong><span>{{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</span></li>
		<li><i class="message-star ace-icon fa fa-star orange2"></i><strong>lit :</strong><span>{{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}
		</span></li>
	</ul>
</div>
@if(isset($hosp->garde_id))
<div class="row">
	<div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><strong><span style="font-size:16px;">Garde Malade</span></strong>
	</div>
</div>
<div class="row">
	<ul class="list-unstyled spaced">
	<li><i class="ace-icon fa fa-chevron-circle-right green"></i><strong>Nom :</strong>{{ $hosp->garde->nom }}</li>
	<li><i class="ace-icon fa fa-chevron-circle-right green"></i><strong>Prenom :</strong>{{ $hosp->garde->prenom }}</li>
	<li><i class="ace-icon fa fa-chevron-circle-right green"></i><strong>Né(e) le :</strong>{{ $hosp->garde->date_naiss }}</li>
	<li><i class="ace-icon fa fa-chevron-circle-right green"></i><strong>Adresse :</strong>{{ $hosp->garde->adresse }}</li>
	<li><i class="ace-icon fa fa-chevron-circle-right green"></i><strong>Mobile :</strong>{{ $hosp->garde->mob }}</li>
</ul>
</div>
@endif
@if($hosp->visites->count() > 0)
<div class="row"><div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><strong><span style="font-size:16px;">Visites & Contrôles</span></strong></div>
</div>
<div class="row">
	<div class="col-xs-11 widget-container-col">
		<div class="widget-box widget-color-blue">
			<div class="widget-header"><h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Visites & Contrôles</h5></div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thin-border-bottom">
							<tr>
							  <th class="center"><strong>Date</strong></th><th class="center"><strong>Medecin</strong></th>
							  <th class="center"><strong>Actes</strong></th>
							  <th class="center"><strong>Traitement</strong></th>	
							  <th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
						@foreach($hosp->visites as $visite)
						 <tr>
							 	<td>{{ $visite->date}}</td>
							 	<td>{{ $visite->medecin->nom }} <span>{{ $visite->medecin->prenom }}</span></td>
							 	<td class="text-primary">
							 	@foreach($visite->actes as $acte)
							 		{{ $acte->nom }} <br>
							 	@endforeach
							 	</td>
							 	<td class="text-primary">
								 	@foreach($visite->traitements as $trait)
								 		{{ $trait->medicament->nom }} <br>
								 	@endforeach
							 	</td>
							 	<td class="center"><a href="{{ route('visites.show', $visite->id) }}"><i class="fa fa-eye"></i></a></td>
						 </tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif