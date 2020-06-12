@extends('app')
@section('title','modifier  foncctionnaire')
@section('page-script')
<script>
$(document).ready(function () {
	$('input[type=radio][name=etatf]').change(function(){
	  	if($(this).val() != "En exercice" && ($(this).val() != "En_exercice"))
	 	{
			$('#serviceFonc').addClass('invisible');$('#service option:eq(0)').prop('selected', true); 
	 	}
		else
			$('#serviceFonc').removeClass('invisible'); 	
	});
	if($("input[type=radio][name='etatf']:checked").val() != "En_exercice" )
		$('#serviceFonc').addClass('invisible');
})
// document
</script>
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>modification du fonctionnaire :&nbsp;</strong>{{ $assure->Nom }} {{ $assure->Prenom }}</h1>
	<div class="pull-right">
		<a href="{{route('assur.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				 Chercher un Fonctionnire
		</a>
	</div>
</div>
<form class="form-horizontal" action="{{ route('assur.update',$assure ->id) }}" method="POST">
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
	@include('assurs.editAssure')
	<div class="hr hr-dotted"></div>
	<div class="row">
		<div class="center">
			<br>
			<button class="btn btn-info btn-sm" type="submit">
				<i class="ace-icon fa fa-save bigger-110"></i>
				Enregistrer
			</button>&nbsp; &nbsp; &nbsp;
			<button class="btn btn-default btn-sm" type="reset">
				<i class="ace-icon fa fa-undo bigger-110"></i>
				Annuler
			</button>
		</div>
	</div>
</form>
@endsection