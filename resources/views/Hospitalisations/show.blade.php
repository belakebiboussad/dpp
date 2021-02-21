@extends('app')
@section('main-content')
<?php $patient = $hosp->admission->rdvHosp->demandeHospitalisation->consultation->patient; ?>
<div class="row">@include('patient._patientInfo', $patient)</div>
<div class="pull-right">
	<a href="{{route('hospitalisation.edit',$hosp->id )}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-edit bigger-120 blue"></i>Edit</a>
</div>
<div class="row"><h3>Détails de l'hospitalisation :</h3></div>
<div class="tabbable"  class="user-profile">
	<ul class="nav nav-tabs padding-18">
		<li class="active">
			<a data-toggle="tab" href="#hospi">Hospitalisation</a>
		</li>
		@if(in_array(Auth::user()->role_id,[1,14]))
		<li >
			<a data-toggle="tab" href="#visites">Visites</a>
		</li>
		@endif
	</ul>
	<div class="tab-content no-border padding-24">
		<div id="hospi" class="tab-pane in active">
			<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><b>Hospitalisation</b></div>
				</div>
				<div class="row">
					<div class="col-sm-12">
					<ul class="list-unstyled spaced">
						<li>
					    <i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}
						</li>
						<li>
			 				<i class="ace-icon fa fa-caret-right blue"></i><strong>Specialite :</strong> {{ $hosp->admission->rdvHosp->demandeHospitalisation->Specialite->nom }}
						</li>
						<li>
							<i class="ace-icon fa fa-caret-right blue"></i><strong>Mode d'admission:</strong>{{ $hosp->admission->rdvHosp->demandeHospitalisation->modeAdmission }}
						</li>
						<li>
							<i class="ace-icon fa fa-caret-right blue"></i><strong>Medecin Traitant:</strong>
							{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->nom }}
							{{$hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->prenom}}					
						</li>
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Date d'entrée:</strong>{{ $hosp->Date_entree }}</li>	
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Date sortie prévue:</strong>{{ $hosp->Date_Prevu_Sortie }}</li>
					</ul>
					</div>
				</div>
			</div>
		</div><div class="space-12"></div>	
		<div class="row">
			<div class="col-sm-12">
				<div class="row"><div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right"><b>Hébergement</b></div></div>
				<div class="row">
					<div class="col-sm-12">
					     <ul class="list-inline" style="flex-grow: 1;">
					          <li style="width: 300px;" > {{-- {{ $hosp->admission->lit->salle->service->nom }} --}}
					           	<i class="ace-icon fa fa-caret-right blue"></i><strong>Service:</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}
					          </li>
					          <li style="width: 300px;"><a href = "#"><i class="ace-icon fa fa-caret-right blue"></i><strong>Salle :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</a></li>
					          <li style="width: 200px;"><a href = "#"><i class="ace-icon fa fa-caret-right blue"></i><strong>Lit :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}</a></li>
					      </ul>
					</div>
				</div>
			</div>
		</div>
		@if(isset($hosp->garde_id))	
		<div class="space-12"></div>		
		<div class="row">
			<div class="col-sm-12">
				<div class="row"><div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right"><b>Garde Malade</b></div></div>
				<div class="row">
					<ul class="list-unstyled spaced">
					  	<li> <i class="ace-icon fa fa-caret-right blue"></i><strong>Nom:</strong> {{ $hosp->garde->nom}}</li>
						<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Prenom:</strong> {{ $hosp->garde->prenom }} </li>
						 <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Né(e) le :</strong> {{ $hosp->garde->date_naiss }}</li>			  	
						<li>
					  		 <i class="ace-icon fa fa-caret-right blue"></i><strong>Age :</strong> <span class="badge badge-info">{{ Jenssegers\Date\Date::parse($hosp->garde->date_naiss)->age }}</span> ans
						 </li>
					 	<li> <i class="ace-icon fa fa-caret-right blue"></i><strong>Relation :</strong> <span class="badge badge-success">{{ $hosp->garde->lien_par }}</li>
					  	<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Téléphone :</strong> <span class="badge badge-danger">{{ $hosp->garde->mob }}</li>  	
					</ul>
				</div>
			</div>
		</div>
		@endif
		</div>	{{-- tab-pane --}}
		<div id="visites" class="tab-pane in">
			<div class="row">@include('visite.liste')</div>
		</div>	{{-- tab-pane --}}
	</div>	{{-- tab-content --}}

</div>
@endsection