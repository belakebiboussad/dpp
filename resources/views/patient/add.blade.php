@extends('app')
@section('title','Ajouter un patient')
@section('page-script')
 <script>
  $(function(){
    $('ul#menuPatient li').click(function(e) 
    { 
      if(($(this).index() == 1) && ($("#type").val() == 0))
       copyPatient();
    });
 	  $('#type').change(function(){
      $('#patientSave').removeAttr('disabled');
    	 showTypeAdd(this.value,1);
    });
    $( "#addPatientForm" ).submit(function( event ) {
    	if( ! checkPatient() )
      {
		 	  activaTab("Patient");
	  	    event.preventDefault();
	      }else{
          if(($("#type").val() == 0) || ($("#type").val() == 1) || ($("#type").val() == 2)|| ($("#type").val() == 3)|| ($("#type").val() == 4))
        	{
            if($("#type").val() == "0")
              $('.asdemogData').prop("disabled", false);
            if( ! checkAssure() )
            {
              activaTab("Assure");
              event.preventDefault();
            }
          } 
      }
 	});
  $('#unkDate').click(function() {
    if ($(this).is(':checked')) {
      $('#dateExact').addClass('hidden');
      $('#datePresume').removeClass('hidden');
    }else
    {
      $('#dateExact').removeClass('hidden');
      $('#datePresume').addClass('hidden');
    }
   });       
 })
</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div><h4>Ajouter un nouveau patient</h4>
  	<div class="pull-right">
			<a href="{{route('patient.index')}}" class="btn btn-white btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i> Rechercher un patient
			</a>
		</div>
  </div>
  <div class="row tabs">
		<form class="form-horizontal" id ="addPatientForm" action="{{ route('patient.store') }}" method="POST" role="form">
	    {{ csrf_field() }}
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
	   		 	<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
			  	 	<li class="active">
			   			<a data-toggle="tab" href="#Patient" class="jumbotron"><h4>Patient(e)</h4></a>
						</li>
						<li ><a class="jumbotron" data-toggle="tab" href="#Assure"><h4>Assuré(e)</h4></a></li>
			 		</ul>
			 		<div class="tab-content">
						<div id="Patient" class="tab-pane in active">@include('patient.addPatient')</div>
            <div id="Assure" class="tab-pane  fade">@include("assurs.addAssure")</div>
					</div>
			  </div>
      </div><div class="hr hr-dotted"></div><!-- row -->
      <div class="row">
        <div class="col-sm-12 center">
          <button class="btn btn-primary btn-xs" type="submit" id="patientSave" disabled><i class="ace-icon fa fa-save"></i>Enregistrer</button>
          <button class="btn btn-warning btn-xs" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
        </div>
      </div>  
		</form>
	</div>
</div>
 @endsection