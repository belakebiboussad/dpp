@extends('app')
@section('main-content')
<div class="row"><h4><b> Modifier le nom du rôle : </b></h4></div>
<div class="row">
	<div class="col-sm-12">
		<div class="space-10"></div>
			<form class="form-horizontal" role="form" method="POST" action="{{ route('role.update',$role->id) }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"><strong> Nom du rôle </strong></label>
					<div class="col-sm-9">
						<input type="text" id="rolename" name="rolename" placeholder="Nom du role" class="col-xs-10 col-sm-5"  value="{{ $role->role }}" required/>
					</div>
				</div>
				<div class="center">
              		<button class="btn btn-info" type="submit" style="margin-top:10px">
                		<i class="ace-icon fa fa-save bigger-110"></i>
                		Enregistrer 
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