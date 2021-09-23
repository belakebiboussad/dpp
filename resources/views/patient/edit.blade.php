@extends('app')
@section('title','Modifier  le patient')
@section('page-script')
<script>
	function ayantToassure()
	{
		alert("assureToAyant");
	} 
	function ayantToOther()
	{
		alert("assureToDerog");
	} 
	function showTypeEdit(i)
	{
		switch($('#type').val()){
			case "0":	
				if(i !=0){
					switch('{{ $patient->Type }}'){
						case "1":
							ayantToassure();
							break;
						case "2":
							ayantToassure();
							break;
						case "3":
							ayantToassure();
							break;
						case "4":
								ayantToassure();
							break;
						case "5":
							break;
						case "6":
							ayantToOther();
							break;	
						default:
							ayantToOther();
							break;	
					}	
				}else
				{

				}
				break;
			case "6":
				if(i !=0){


				}else
				{
					$(".starthidden").show(250);
					$('#description').attr('disabled', false); 
					$("#foncform").addClass('hide'); 
					if(! ($( "ul#menuPatient li:eq(0)" ).hasClass("hidden")))
					{
						$( "ul#menuPatient li:eq(0)").addClass("hidden");
						$('div#Assure').addClass("hidden");
					}
					if(($( "ul#menuPatient li:eq(0)" ).hasClass("active")))
					{
						$( "ul#menuPatient li:eq(0)").removeClass("active");
			  		$("ul#menuPatient li:eq(1)").addClass("active");
						$('#Patient').addClass("active");
		  			$('#Patient').addClass("in");
		  			$('#Assure').removeClass("active");
		  			$('#Assure').removeClass("in");
		  			$('#Assure').find('input').prop("required",false);
						$('#Assure').find("select").prop("required",false);
						$('#nsspatient').attr('disabled', true);  
					}
					
				}
				break;
			default:	
				break;
		}
	}
	$(function(){
		  $( "#editPatientForm" ).submit(function( event ) {
	      	if( ! checkPatient() )
      		{
			   		activaTab("Patient");
			   		event.preventDefault();
	      	}else{
  					//if(($('#type').val() != "5" )){ 
  					if(jQuery.inArray('{{ $patient->Type }}', [0,1,2,3,4]) !== -1){		
  						$('.Asdemograph').find('*').each(function () { 
  							$(this).attr("disabled", false);
  						});	
							if( ! checkAssure() )
							{
					 			activaTab("Assure");
			  				event.preventDefault();
							}else
								$( "#editPatientForm" ).submit();
  						}else
  						{
  							$("#Position").prop("disabled", true);
					  		$('#Assure').find('input').prop("disabled", true).attr('required', false);
					  		$( "#editPatientForm" ).submit();
  						}
	    		}
	    });
	})
	$(document).ready(function(){
	  showTypeEdit(0);	
	});    
</script>
@endsection
@section('main-content')
<div class="row">
	<h4 style="display: inline;"><strong>Modification des données du patient :&nbsp;</strong>{{ $patient->getCivilite() }} {{ $patient->Nom }} {{ $patient->Prenom }}</h4>
	<div class="pull-right">
		<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i> Rechercher un Patient
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
		<li class=" @if($patient->Type !="5") active @else hidden @endif">
		  <a data-toggle="tab" href="#Assure" data-toggle="tab" onclick="copyPatientInfo('{{ $patient->id}}');">
	    	<span class="bigger-130"><strong>Assuré(e)</strong></span>
	    </a>
 		</li>
	 	<li class=" @if($patient->Type =="5") active  @endif" ><a data-toggle="tab" href="#Patient">
	   	 	<span class="bigger-130"><strong>Patient</strong></span></a>
	   	</li>
	</ul>	
  	<div class="tab-content">
  		<div id="Assure" class='tab-pane fade @if($patient->Type =="5") hidden @else in active  @endif '>
    			@include('assurs.editAssure')
    		</div>
		<div id="Patient" class="tab-pane fade @if($patient->Type =="5") in active  @endif">@include('patient.editPatient')</div>
  </div> <div class="hr hr-dotted"></div>
	<div class="row">
		<div class="center"><br>
			<button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
			<button class="btn btn-default btn-sm" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
		</div>
	</div>
</form>
@endsection