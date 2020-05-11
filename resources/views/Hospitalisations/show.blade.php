@extends('app_sur')
@section('main-content')
<div class="page-header">
  <div class="row">
  	<?php $patient = $hosp->admission->demandeHospitalisation->consultation->patient; ?>
   	@include('patient._patientInfo', $patient)
  </div>
  <div class="row">
		<h2>Détails de l'hospitalisation :</h2>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right">
				<b>Hospitalisation</b>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<ul class="list-unstyled spaced">
					<li>
				       	  <i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>{{ $hosp->admission->demandeHospitalisation->Service->nom }}
					</li>
					<li>
		 				<i class="ace-icon fa fa-caret-right blue"></i><strong>Specialite :</strong> {{ $hosp->admission->demandeHospitalisation->Specialite->nom }}
					</li>
					<li>
							<i class="ace-icon fa fa-caret-right blue"></i><strong>Mode d'admission:</strong>{{ $hosp->admission->demandeHospitalisation->modeAdmission }}
						</li>
						<li>
							<i class="ace-icon fa fa-caret-right blue"></i><strong>Medecin Traitant:</strong>
							 	{{ $hosp->admission->demandeHospitalisation->DemeandeColloque->medecin->Nom_Employe }}
								{{$hosp->admission->demandeHospitalisation->DemeandeColloque->medecin->Prenom_Employe}}													
						</li>
						</ul>
			</div>
			<div class="col-sm-6">
				<ul class="list-unstyled spaced">
					<li>
						<i class="ace-icon fa fa-caret-right blue"></i><strong> Priorité :</strong>
						  <label>
				        <input name="priorite" class="ace" type="radio" value="1" disabled @if( $hosp->admission->demandeHospitalisation->DemeandeColloque->ordre_priorite==1)checked="checked"@endif >
				        <span class="lbl"> 1 </span>
				      </label>&nbsp; &nbsp;
				      <label>
				      <input name="priorite" class="ace" type="radio" value="2" disabled @if( $hosp->admission->demandeHospitalisation->DemeandeColloque->ordre_priorite==2)checked="checked"@endif>
				        <span class="lbl"> 2 </span>
				        </label>&nbsp; &nbsp;
				        <label>
				   		    <input name="priorite" class="ace" type="radio" value="3" disabled @if( $hosp->admission->demandeHospitalisation->DemeandeColloque->ordre_priorite==3 )checked="checked"@endif>
				        	<span class="lbl"> 3 </span>
				        </label>	
					</li>
					<li>
					  <i class="ace-icon fa fa-caret-right blue"></i><strong>observation :</strong>
							{{ $hosp->admission->demandeHospitalisation->DemeandeColloque->observation}}
					</li>
					<li>
							<i class="ace-icon fa fa-caret-right blue"></i> <strong>Etat :</strong> {{ $hosp->etat_hosp }}
					</li>
				</ul>
			</div>
		</div>	<!-- 	<li class="divider"></li> -->
	</div>
</div>
<div class="space-12"></div>		
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
				<b>Hébergement</b>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul class="list-unstyled spaced">
					<li>
		 				<i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong> {{ $hosp->admission->lit->salle->service->nom }}
					</li>
					<li>
		 				<i class="ace-icon fa fa-caret-right blue"></i><strong>Salle :</strong> {{ $hosp->admission->lit->salle->nom }}
					</li>
					<li>
		 				<i class="ace-icon fa fa-caret-right blue"></i><strong>Lit :</strong> {{ $hosp->admission->lit->nom }}
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="space-12"></div>		
<div class="row">
  <div @if( !isset($hosp->garde_id)) class="col-sm-12"	@else class="col-sm-6" @endif>
		<div class="row">
			<div class="col-xs-11 label label-lg label-black arrowed-in arrowed-right">
				<b>Admission</b>
			</div>
		</div>
		<div class="row">
			<ul class="list-unstyled spaced">
				<li>
						<i class="ace-icon fa fa-caret-right blue"></i><strong>Date d'entrée:</strong>{{ $hosp->Date_entree }}
				</li>
				<li>
						<i class="ace-icon fa fa-caret-right blue"></i><strong>Heure d'entrée :</strong>{{ $hosp->heure_entrée }}
				</li>
				<li>
						<i class="ace-icon fa fa-caret-right blue"></i><strong>Durée prévue :</strong><label for="" id =""></label> <small><strong>&nbsp;nuit(s)</strong></small>
				</li>
				<li>
						<i class="ace-icon fa fa-caret-right blue"></i><strong>Date sortie prévue:</strong>{{ $hosp->Date_Prevu_Sortie }}
				</li>
				<li>
						<i class="ace-icon fa fa-caret-right blue"></i><strong>Heure sortie Prévue :</strong>{{ $hosp->Heure_Prevu_Sortie }}
				</li>
			</ul>	
		</div>
	</div>
	@if(isset($hosp->garde_id))
	<div class="col-sm-6">
			<div class="row">
			<div class="col-xs-11 label label-lg label-light arrowed-in arrowed-right">
				<b>Garde Malade</b>
			</div>
		</div>
		<div class="row">
			<ul class="list-unstyled spaced">
			  <li>
			  	 <i class="ace-icon fa fa-caret-right blue"></i><strong>Nom:</strong> {{ $hosp->garde->nom}}
			  </li>
				<li>
			  	 <i class="ace-icon fa fa-caret-right blue"></i><strong>Prenom:</strong> {{ $hosp->garde->prenom }}
			  </li>
			  <li>
			    <i class="ace-icon fa fa-caret-right blue"></i><strong>Né(e) le :</strong> {{ $hosp->garde->date_naiss }}
			  </li>
				<li>
			  	 <i class="ace-icon fa fa-caret-right blue"></i><strong>Age :</strong> <span class="badge badge-info">{{ Jenssegers\Date\Date::parse($hosp->garde->date_naiss)->age }}</span> ans
			  </li>
			 	<li>
			  	 <i class="ace-icon fa fa-caret-right blue"></i><strong>Relation :</strong> <span class="badge badge-success">{{ $hosp->garde->lien_par }}
			  </li>
			  <li>
			  	 <i class="ace-icon fa fa-caret-right blue"></i><strong>Téléphone :</strong> <span class="badge badge-danger">{{ $hosp->garde->mob }}
			  </li>
			</ul>

		</div>
	</div>
	@endif
</div>
@endsection