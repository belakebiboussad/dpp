@extends('app')
@section('main-content')
<?php $patient = $hosp->patient; ?>
<div class="row">@include('patient._patientInfo', $patient)</div>
<div class="pull-right">
	 <a href="{{route('hospitalisation.index')}}" class="btn btn-white btn-info btn-bold"><i class="ace-icon fa fa-list bigger-120 blue"></i>Hospitalisations</a>
</div>
<div class="row"><div class="col-sm-12"><h4> <strong> Hospitalisation : suivi(e) du patient</strong></h4></div></div>
<div class="tabbable"  class="user-profile">
  <ul class = "nav nav-pills nav-justified list-group" role="tablist">
		<li class="active"><a data-toggle="tab" href="#hospi"><strong><h4>Hospitalisation</h4></strong></a></li>
		@if(in_array(Auth::user()->role_id,[1,3,14]))
		<li ><a data-toggle="tab" href="#visites"><strong><h4>Visites & Contrôles</h4></strong></a></li>
		@endif
		@if(in_array(Auth::user()->role_id,[1,3,14]))
		<li ><a data-toggle="tab" href="#constantes"><strong><h4>Surveillance clinique</h4></strong></a></li>
		@endif
	</ul>
	<div class="tab-content no-border padding-24">
		<div id="hospi" class="tab-pane in active">
			<div class="row"><div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right"><span class="f-16"><strong>Hospitalisation</strong></span></div></div>
			<div class="row">
  			<div class="col-sm-12">
  		   <ul class="nav navbar-nav list-inline">
            <li class="list-inline-item" style="width:200px;">
              <i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Service->nom }}
            </li>
             <li class="list-inline-item" style="width:200px;">
            <i class="ace-icon fa fa-caret-right blue"></i><strong>Spécialité :</strong>&nbsp;&nbsp;{{ $hosp->admission->demandeHospitalisation->Specialite->nom }}
            </li>
             <li class="list-inline-item" style="width:300px;">
             <i class="ace-icon fa fa-caret-right blue"></i>
            <strong>Mode d'admission:</strong>&nbsp;&nbsp;
              @switch($hosp->admission->demandeHospitalisation->modeAdmission)
                @case(0)
                  <span class="label label-sm label-primary">Programme</span>
                  @break
                @case(1)
                  <span class="label label-sm label-success">Ambulatoire</span>
                  @break
                @case(2)
                  <span class="label label-sm label-warning">Urgence</span>
                  @break    
              @endswitch
            </li>
             <li class="list-inline-item" style="width:300px;">
              <i class="ace-icon fa fa-caret-right blue"></i><strong>Médecin Traitant:</strong>&nbsp;&nbsp;
            {{ $hosp->medecin->nom }} {{$hosp->medecin->prenom}}    
            </li>
             <li class="list-inline-item" style="width:270px;">
             <i class="ace-icon fa fa-caret-right blue"></i><strong>Date d'entrée:</strong>&nbsp;&nbsp;{{ $hosp->Date_entree }}
            </li>
             <li class="list-inline-item" style="width:270px;"><i class="ace-icon fa fa-caret-right blue">
             </i><strong>Date sortie prévue:</strong>&nbsp;&nbsp;{{ $hosp->Date_Prevu_Sortie }}
            </li>
          </ul>
  			</div>
			</div><div class="space-12"></div>	
			<div class="row">
				<div class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
					<strong><span class="f-16"><strong>Hébergement</strong></span>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
		     <ul class="list-unstyled spaced" style="flex-grow: 1;">
		          <li style="width: 300px;" >
		           		<i class="ace-icon fa fa-caret-right blue"></i><strong>Service :</strong>&nbsp;&nbsp;
					   	{{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->service->nom }}
		          </li>
		          <li style="width: 300px;"><i class="ace-icon fa fa-caret-right"></i><strong>Salle :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->salle->nom }}</li>
		          <li style="width: 200px;"><i class="ace-icon fa fa-caret-right"></i><strong>Lit :</strong> {{ $hosp->admission->demandeHospitalisation->bedAffectation->lit->nom }}</li>
		      </ul>
				</div>
			</div>	
			@if(isset($hosp->garde_id))	
			<div class="space-12"></div>
			<div class="row"><div class="col-xs-11 label label-lg label-warning arrowed-in arrowed-right">
			<span class="f-16"><strong>Garde malade</strong></span></div></div>
			<div class="row">
				<ul class="list-unstyled spaced">
			  	<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Nom:</strong> {{ $hosp->garde->nom}}</li>
					<li><i class="ace-icon fa fa-caret-right blue"></i><strong>Prénom:</strong> {{ $hosp->garde->prenom }} </li>
				  <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Né(e) le :</strong> {{ $hosp->garde->date_naiss }}</li>			  	
					<li>
			  		 <i class="ace-icon fa fa-caret-right blue"></i><strong>Âge :</strong> <span class="badge badge-info">{{ Jenssegers\Date\Date::parse($hosp->garde->date_naiss)->age }}</span> ans
				      </li>
			 		<li> <i class="ace-icon fa fa-caret-right blue"></i><strong>Relation :</strong> <span class="badge badge-success">{{ $hosp->garde->lien_par }}</li>
			  	      <li><i class="ace-icon fa fa-caret-right blue"></i><strong>Téléphone :</strong> <span class="badge badge-danger">{{ $hosp->garde->mob }}</li>  	
				</ul>
			</div>
		 @endif
		</div><!-- hospi -->
	  <div id="visites" class="tab-pane">
      <div class="row">{{-- @include('visite.liste') --}}
          dfds
      </div>
    </div>
  </div>
</div><!-- tab-content -->
@endsection