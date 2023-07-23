@extends('app')
@section('title','Modifier  le patient')
@section('page-script')
@include('patient.scripts.functions')
<script type="text/javascript">
  $(function(){  
    patTypeChange('{{ $patient->type_id }}');
    $('#editPatientForm').on('submit', function(e){
      e.preventDefault(); 
      if(validPatient())
      {
        activaTab("Patient");
        return false;
      }
      else  if(validAssure()) 
      {
        activaTab("Assure");
        return false;
      }
      $( "#editPatientForm" )[0].submit(); 
    });
  });
</script>
@stop
@section('main-content')
	<div class="page-header">
		<h1>Modification des données du patient : <q class="blue"> {{ $patient->getCivilite() }} {{ $patient->full_name }} </q></h1>
		<div class="pull-right">
			<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left  blue"></i> Rechercher un Patient
			</a>
		</div>
	</div>
	<form id="editPatientForm" action="{{ route('patient.update',$patient) }}" method="POST" role="form" novalidate>
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group" id="error" aria-live="polite">
					@if (count($errors) > 0)
			  	<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
					 	  <li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
				</div>
			</div>
		</div>
		<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
		  <li class="active" role="presentation">
        <a data-toggle="tab" href="#Patient" role="presentation" class="Deptnav_link">
          <h4>Patient(e)</h4></a>
      </li>
      <li role="presentation">
			 <a data-toggle="tab" href="#Assure" data-toggle="tab" class="Deptnav_link" aria-selected="true">
				<h4>Assuré(e)</h4>
	    </a>
 		</li>
	</ul>
	<div class="tab-content">
    <div id="Patient" class="tab-pane active">@include('patient.editPatient')
    </div>
  	<div id="Assure" class="tab-pane">@include('assurs.editAssure')</div>
  </div><div class="hr hr-dotted"></div>
  <div class="row">
		<div class="center">
			<button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
			<button class="btn btn-warning btn-sm" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
		</div>
	</div>
</form>	
@stop