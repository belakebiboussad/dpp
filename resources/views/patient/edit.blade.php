@extends('app')
@section('title','Modifier  le patient')
@section('page-script')
<script type="text/javascript">
   function patTypeChange(value)
   {
      switch(value){
        case "0":
          if ($('ul#menuPatient li:eq(0)').hasClass("hide"))
            assureShow();
          copyPatient();
          $("#foncform").addClass('hide');
          $('.asdemogData').prop('disabled', true);
          break;
        case  "1": case "2": case "3": case "4":
          $("#foncform").removeClass('hide');
          $('#nsspatient').attr('disabled', false);
          $('.asdemogData').prop('disabled', false);
          break;
        case "5": case "6":
          assurHide();
          resetAsInp();
          break;    
      }
   } 
	 function showTypeEdit(i){//edition patient
    var value = {{ $patient->Type}};
    switch(value){
      case 0:
        if(i == 0)// if ($('ul#menuPatient li:eq(0)').hasClass("hide"))assureShow();
        {   
          $("#foncform").addClass('hide');
          $('.asdemogData').prop('disabled', true);
        }else
          patTypeChange($('#type').val());
        break;
      case  1: case 2: case 3: case 4:
          if(i == 0)
          {   
            $("#foncform").removeClass('hide');
            $('#nsspatient').attr('disabled', false);
          }else
            patTypeChange($('#type').val());
            
          break;
      case 5: case 6:
          if(i == 0)
          {   
            assurHide();
            resetAsInp();
          }else
            patTypeChange($('#type').val()); 
          break;
    }     
  }
  $(function(){
		showTypeEdit(0);
		$( "#editPatientForm" ).submit(function( event ) {
			if( ! checkPatient() )
      {
      	activaTab("Patient");
				event.preventDefault();
      }else
      {
      	switch($("#type").val()){
      		case "0": case "1": case "1": case "2": case "3": case "4":
      			if($("#type").val() == "0")
 							$('.asdemogData').prop("disabled", false);
 						if( ! checkAssure() )
						{
			 				activaTab("Assure");
		  				event.preventDefault();
						}
						break;
      		default:
 	 					break;
      	}
      }
      $( "#editPatientForm" ).submit();	
 		});	
	});
</script>
@endsection
@section('main-content')
	<div class="page-header">
		<h4>Modification des données du patient :&nbsp;{{ $patient->getCivilite() }} {{ $patient->full_name }}</h4>
		<div class="pull-right">
			<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left  blue"></i> Rechercher un Patient
			</a>
		</div>
	</div>
	<form class="form-horizontal" id="editPatientForm" action="{{ route('patient.update',$patient->id) }}" method="POST" role="form">
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
			<a data-toggle="tab" href="#Assure" data-toggle="tab" class="Deptnav_link" aria-selected="true">
				<span class="bigger-130"><strong>Assuré(e)</strong></span>
	    </a>
 		</li>
	 	<li role="presentation">
	 	<a data-toggle="tab" href="#Patient" role="presentation" class="Deptnav_link">
	   	<span class="bigger-130"><strong>Patient</strong></span></a>
	  </li>
	</ul>
	<div class="tab-content">
  	<div id="Assure" class="tab-pane active">@include('assurs.editAssure')</div>
		<div id="Patient" class="tab-pane">@include('patient.editPatient')</div>
  </div><div class="hr hr-dotted"></div>
  <div class="row">
		<div class="center"><br>
			<button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
			<button class="btn btn-warning btn-sm" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
		</div>
	</div>
</form>	
@endsection