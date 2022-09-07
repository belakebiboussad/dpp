@extends('app')
@section('title','Ajouter un Rôle')
@section('main-content')
<div class="row"><h4><strong>Ajouter un nouveau rôle :</strong></h4>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="space-10"></div>
			<form class="form-horizontal" role="form" method="POST" action="{{ route('role.store') }}">
				{{ csrf_field() }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">
						<strong> Nom: </strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="rolename" name="rolename" placeholder="Nom du rôle" class="col-xs-10 col-sm-5" required/>
					</div>
				</div>
				<div class="center">
              			<button class="btn btn-sm btn-info" type="submit"><i class="ace-icon fa fa-save "></i>Enregistrer</button>&nbsp; 
	                	<button class="btn btn-sm btn-warning" type="reset"> <i class="ace-icon fa fa-undo"></i>Annuler </button>
            	</div>
			</form>
	</div>
</div>
@endsection