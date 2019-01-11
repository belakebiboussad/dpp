@extends('app')
@section('title','Ajouter un Rôle')
@section('main-content')
<div class="page-header">
	<h1><strong>Ajouter un Role :</strong></h1>
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
						<input type="text" id="rolename" name="rolename" placeholder="Nom du role" class="col-xs-10 col-sm-5" required/>
					</div>
				</div>
				<div class="center">
              			<button class="btn btn-info" type="submit" style="margin-top:10px">
	                		<i class="ace-icon fa fa-save bigger-110"></i>
	                		Enregistre
	              		</button>
	              		&nbsp; &nbsp; &nbsp;
	              		<button class="btn" type="reset" style="margin-top:10px">
	                		<i class="ace-icon fa fa-undo bigger-110"></i>
	                		Réinitialiser
	              		</button>
            	</div>
			</form>
	</div>
</div>
@endsection