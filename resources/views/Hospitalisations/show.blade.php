@extends('app_sur')
@section('main-content')
<div class="page-header">
	<h1>Détails de l'hospitalisation :</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-xs-11 label label-lg label-primary arrowed-in arrowed-right">
				<b>Hospitalisation</b>
			</div>
		</div>
		<div class="row">
			<ul class="list-unstyled spaced">
				<li>
				  <i class="ace-icon fa fa-caret-right blue"></i><strong>Service:</strong>{{ $hosp->admission->demandeHospitalisation->Service->nom }}
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
			<!-- 	<li class="divider"></li> -->
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
	</div>
</div>
<div class="space-12"></div>		
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-xs-11 label label-lg label-light arrowed-in arrowed-right">
				<b>Admission</b>
			</div>
		</div>
	</div>
</div>
<div class="space-12"></div>		
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-xs-11 label label-lg label-dark arrowed-in arrowed-right">
				<b>Hébergement</b>
			</div>
		</div>
	</div>
</div>
@endsection