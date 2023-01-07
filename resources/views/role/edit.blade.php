@extends('app')
@section('main-content')
<div class="page-header"><h1>Modifier le rôle :</h1></div>
<div class="row">
	<div class="col-sm-12">
		<div class="space-10"></div>
			<form class="form-horizontal" role="form" method="POST" action="{{ route('role.update',$role->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nom du rôle:</label>
					<div class="col-sm-9">
						<input type="text" id="rolename" name="rolename" placeholder="Nom du role" class="col-xs-10 col-sm-5"  value="{{ $role->role }}" required/>
					</div>
				</div>
        <div class="hr hr-dotted"></div>
				<div class="center mb-0">
      		<button class="btn btn-sm btn-primary" type="submit">
        		<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer 
      		</button>&nbsp;
      		<button class="btn btn-sm btn-warning" type="reset">
        		<i class="ace-icon fa fa-undo bigger-110"></i>Réinitialiser
      		</button>
    	</div>
			</form>
	</div>
</div>
@endsection