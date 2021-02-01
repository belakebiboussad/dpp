@extends('app')
@section('title','Modifier  fonctionnaire')
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>Modification du fonctionnaire :&nbsp;</strong>
		 <i class="ace-icon fa fa-angle-double-left" style="font-size:20px;"></i>{{ $assure->Nom }} {{ $assure->Prenom }}
		<i class="ace-icon fa fa-angle-double-right" style="font-size:20px;"></i>
	</h1>
	<div class="pull-right">
		<a href="{{route('assur.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i> Chercher un Fonctionnire
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
			<button class="btn btn-info btn-sm" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
			<button class="btn btn-default btn-sm" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
		</div>
	</div>
</form>
@endsection