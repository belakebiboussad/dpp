@extends('app')
@section('title','Ajouter un patient')
@section('page-script')
<script>
		function checkFormAddPAtient()
	 	{        
  		if( ! checkPatient() )
   			return false;
   		else{
   		 	$('input:disabled').removeAttr('disabled');    
		   	return true;
   		}
 		}
		function copyAssure(){
			$("#datenaissance").val('{{ $assure->Date_Naissance}}');
			$("input[name=sexe][value=" + '{{ $assure->Sexe }}' + "]").prop('checked', true);
			$('#sf option[value="' + '{{ $assure->SituationFamille}}' + '"]').attr("selected", "selected"); 	
			$("#idwilaya").val('{{ $assure->wilaya_res}}');$("#wilaya").val('{{ $assure->wilaya->nom}}');
			$( "#gs" ).val('{{ $assure->grp_sang }}'.substr(0,'{{ $assure->grp_sang }}'.length - 1));
			$( "#rh" ).val('{{ $assure->grp_sang }}'.substr('{{ $assure->grp_sang }}'.length - 1));
			$("#adresse").val('{{ $assure->adresse }}');//$('.demograph').find('*').each(function () { $(this).attr("disabled", true); });	
		}
  	$( document ).ready(function() {
			if({{ $type }} == 0)
			{	
				copyAssure();
	  		$("#foncform").addClass('hide');
	  		$(".starthidden").hide(250);
			}
			if($('#type').val() =='2')
			{
				$("input[name=sexe][value='M']").prop('checked', true);
				$("input[name=sexe]").prop('disabled',true);
			}
			else if(($('#type').val() =='3') || ($('#type').val() =='1'))
			{
				$("input[name=sexe][value='F']").prop('checked', true);
				$("input[name=sexe]").prop('disabled',true);
			}
  });
</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <h4>Ajouter un Patient</h4>
  <form class="form-horizontal" id = "addPAtient" action="/addpatientAssure" method="POST" role="form" onsubmit="return checkFormAddPAtient(this);">
	  	{{ csrf_field() }}
	  	<input type="hidden" name="assure_id" value="{{ $NSS }}"><input type="hidden" name="typePatient" value="{{$type}}">
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
		@include('patient.addPatientAssure')
		<div class="hr hr-dotted"></div>
		<div class="row">
			<div class="center"><br>
				<button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
				<button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
			</div>
		</div>	
	</form>
</div>{{-- container-fluid --}}
@endsection