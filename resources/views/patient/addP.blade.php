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
</script>
@stop
@section('main-content')
<div class="container-fluid">
  <h4>Ajouter un Patient</h4>
  <form id = "addPAtient" action="/addpatientAssure" method="POST" role="form" onsubmit="return checkFormAddPAtient(this);">
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
@stop