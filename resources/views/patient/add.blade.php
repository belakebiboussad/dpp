@extends('app')
@section('title','Ajouter un patient')
@section('page-script')
 <script>
  $(function(){
 	$('#type').change(function(){
    $('#patientSave').removeAttr('disabled');
 		showTypeEdit(this.value,1);
 	})
 	$( "#addPatientForm" ).submit(function( event ) {
 		if( ! checkPatient() )
    {
		 	activaTab("Patient");
	  	event.preventDefault();
	  }else{
    	/*
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
      */
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
      if($("#datenaissance").val() == '')
      {
        event.preventDefault();
      //   Swal.fire({
      //       title: 'le patient est-il un mineur ou un vieu ?',
      //       html: '<br/><h4><strong id="dateRendezVous">'+'</strong></h4>',
      //       input: 'checkbox',
      //       inputPlaceholder: 'Estimer age du patient',
      //       showCancelButton: true,
      //       confirmButtonColor: '#3085d6',
      //       cancelButtonColor: '#d33',
      //       confirmButtonText: 'Oui',
      //       cancelButtonText: "Non",
      //       allowOutsideClick: false,
      //   }).then((result) => {
      //   if(!isEmpty(result.value))//result.value indique rdv fixe ou pas
      //   {
      //     alert("sdf"); 
      //   }
      // })
     }
   }
 	});
 })
</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div>
  	<h4><strong>Ajouter un nouveau patient</strong></h4>
  	<div class="pull-right">
			<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
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
			   			<a data-toggle="tab" href="#Assure" class="jumbotron"><span class="bigger-130"><strong>Assuré(e)</strong></span></a>
						</li>
						<li ><a class="jumbotron" data-toggle="tab" href="#Patient"><span class="bigger-130"><strong>Patient</strong></span></a></li>
			 		</ul>
			 		<div class="tab-content">
						<div id="Assure" class="tab-pane in active">@include("assurs.addAssure")</div>
						<div id="Patient" class="tab-pane fade">@include('patient.addPatient')</div>
					</div>
					<div class="hr hr-dotted"></div>
					<div class="row">
						<div class="col-sm-12 center">
							<button class="btn btn-info" type="submit" id="patientSave" disabled><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
						</div>
					</div>	
		  	</div>	<!-- col-sm-12 -->
			</div><!-- row -->
		</form>
	</div>
</div>
 @endsection